<?php

namespace Ait\Updater;

use Ait\Updater\ThemesAndPluginsDetector as Detector;


class Themes extends Base
{


	public function onPluginsLoadedCallback()
	{
		add_filter('pre_set_site_transient_update_themes', array($this, 'checkThemesUpdatesCallback'));
		add_filter('upgrader_pre_download', array($this, 'downloadPackageCallback'), 10, 3);
		add_filter('http_request_args', array($this, 'excludeAitThemesFromWpOrgUpdateCheckCallback'), 10, 2);
	}



	public function checkThemesUpdatesCallback($transient)
	{
		if(empty($transient->checked)){
			return $transient;
		}

		$aitThemes = Detector::getAllAitThemes();

		$requestArgs = array(
			'body' => array(
				'themes' => wp_json_encode($aitThemes),
			),
		);

		if($this->updater->getCredentials()){
			$requestArgs['body']['credentials'] = $this->updater->getCredentialsForRequest();
		}

		if(!is_multisite()){
			$requestArgs['body']['acitve_theme'] = get_option('stylesheet');
		}

		$api = $this->updater->getApiClient();
		$themesModule = $api->getModule('themes');
		$apiResponse = $themesModule->checkUpdates($requestArgs);

		$themeforestItems = array();
		$themeforestThemesRetrived = false;

	 	if(Detector::isThereAnyThemeforestThemes() and $envatoCredentials = $this->updater->getCredentials('envato')){
			$envatoApiResponse = $this->updater->getApiClient('envato')->getThemes($envatoCredentials);

	 		if($envatoApiResponse->isSuccessful()){
				$themeforestItems = $this->extractItemIdsAndVersions($envatoApiResponse);
	 			$themeforestThemesRetrived = true;
	 		}else{
				if(!$envatoApiResponse->isSuccessful()){
					$this->addError(sprintf(__('%s could not check for updates for themes purchased on ThemeForest. Response from Envato API: %s', 'ait-updater'), 'AIT Updater', $envatoApiResponse->getError()->get_error_message()));
				}
	 		}

	 	}


		if($apiResponse->isSuccessful()){
			$data = (array) $apiResponse->getData();

			foreach($data as $themeCodename => $value){
				$transient->response[$themeCodename] = (array) $value;
				$transient->response[$themeCodename]['url'] = $api->getApiUrl() . $themesModule->getThemeChangelogEndpoint($value->theme);

				if(Detector::getTypeOfTheme($themeCodename) == 'themeforest'){
					if(!$themeforestThemesRetrived){
						unset($transient->response[$themeCodename]); // do not add this theme to notifications when envato api is not reachable
					}elseif($themeforestThemesRetrived and $value->themeforest_id and isset($themeforestItems[$value->themeforest_id])){
						if(
							isset($aitThemes[$themeCodename]) and $aitThemes[$themeCodename] < $themeforestItems[$value->themeforest_id]
							 and
							$themeforestItems[$value->themeforest_id] <= $value->new_version
						){
							$transient->response[$themeCodename]['new_version'] = $themeforestItems[$value->themeforest_id]; // override club version with themeforest version
						}

						if($transient->response[$themeCodename]['new_version'] != $themeforestItems[$value->themeforest_id] and $themeforestItems[$value->themeforest_id] < $value->new_version){
							unset($transient->response[$themeCodename]);
						}
					}
				}
			}

		}else{
			$this->addError(sprintf(__('%s could not check updates for themes. Reason: %s', 'ait-updater'), 'AIT Updater', $apiResponse->getError()->get_error_message()));
		}

		return $transient;
	}



	/**
	 * Callback for 'upgrader_pre_download' hook
	 * It's called from WP_*Upgrader::run()
	 *
	 * @param  bolean      $false     Default return value for pre_
	 * @param  string      $codename  Codename a.k.a. slug
	 * @param  WP_Upgrader $upgrader  Upgrader instance
	 * @return string|WP_Error        When WP_Error is returned, downloading will fail, otherwise path to downloaded temporary file
	 */
	public function downloadPackageCallback($false, $codename, $upgrader)
	{
		$return = $false;

		$isFromInstaller = (substr($codename, 0, 4) === 'ait-'); // it's from installer, this theme with $codename is not installed yet

		$aitThemes = Detector::getAllAitThemes(); // detected already installed themes

		if((isset($aitThemes[$codename]) or $isFromInstaller) and $upgrader instanceof \Theme_Upgrader){

			$themeType = Detector::getTypeOfTheme($codename);

			if($isFromInstaller){
				$codename = substr($codename, 4);
				$themeType = 'club';
			}

			if(is_wp_error($tmpfname = $this->createTempFilePlaceholder($codename))){
				return $tmpfname; // wp_error
			}

			if($themeType === 'club'){
				$return = $this->downloadAitClubTheme($codename, $upgrader, $tmpfname, $isFromInstaller);
			}else{
				$return = $this->downloadThemeforestTheme($codename, $tmpfname);
			}

			if(is_wp_error($return)){
				return $return;
			}

			if($this->updater->getOption('do_backup')){
				$this->updater->doBackup('theme', $codename);
			}
		}

		return $return;
	}



	protected function downloadAitClubTheme($codename, $upgrader, $tmpfname, $isFromInstaller)
	{
		$args = array(
			'timeout' => 300,
			'stream' => true,
			'filename' => $tmpfname,
			'body' => array(
				'credentials' => $this->updater->getCredentialsForRequest(),
			),
		);

		$apiResponse = $this->updater->getApiClient()->getModule('themes')->downloadTheme($codename, $args);

		if(!$apiResponse->isSuccessful()){
			unlink($tmpfname);

			// custom errors instead server one's
			if($apiResponse->getResponseCode() == 400){ // better UX
				return new \WP_Error('download_failed', $upgrader->strings['download_failed'], $apiResponse->getError()->get_error_message());
			}elseif($apiResponse->getResponseCode() == 403 and $isFromInstaller){
				return new \WP_Error('download_failed', '<div class="ait-updater-purchase-message notice notice-warning">' .
					sprintf(
						__('Oops, you haven’t purchased this theme yet. Please <a href="%s" target="_blank">purchase this product as single theme</a> or get access to all themes by <a href="%s" target="_blank">upgrading to our Business Membership</a> or get access to all plugins, themes and graphics by <a href="%s" target="_blank">upgrading to our Premium Membership</a>', 'ait-updater'),
						"https://system.ait-themes.club/join/single/{$codename}",
						'https://system.ait-themes.club/join/membership/business',
						'https://system.ait-themes.club/join/membership/premium'
					) . '</div>'
				);
			}

			// defautl error from server
			return $apiResponse->getError(); // wp_error
		}else{
			$contentMd5 = $apiResponse->getResponseHeader('content-md5');
			if($contentMd5){
				$md5Check = verify_file_md5($tmpfname, $contentMd5);
				if(is_wp_error($md5Check)){
					unlink($tmpfname);
					return $md5Check; // wp_error
				}
			}
			return $tmpfname; // this is what we want, path to successfully downloaded package
		}
	}



	protected function downloadThemeforestTheme($codename, $tmpfname)
	{
		$themeforestItemId = '0';

		$transient = get_site_transient('update_themes');

		if(isset($transient->response[$codename]['themeforest_id']) and $transient->response[$codename]['themeforest_id']){
			$themeforestItemId = $transient->response[$codename]['themeforest_id'];
		}else{
			return new \WP_Error('themeforest_id_missing', sprintf(__("Package for theme '%s' can not be downloaded because Themeforest Item ID is missing.", 'ait-updater'), $codename));
		}

		$args = array(
			'timeout' => 300,
			'stream' => true,
			'filename' => $tmpfname,
		);

		$credentials = $this->updater->getCredentials('envato');

		$apiResponse = $this->updater->getApiClient('envato')->downloadTheme($themeforestItemId, $credentials, $args);

		if(!$apiResponse->isSuccessful()){
			unlink($tmpfname);
			return $apiResponse->getError(); // wp_error
		}else{
			$contentLenght = $apiResponse->getResponseHeader('content-length');
			if($contentLenght and filesize($tmpfname) != $contentLenght){
				unlink($tmpfname);
				return new \WP_Error('filesize_mismatch', __('Downloaded theme package is maybe corrupted. File size provided from server is not identical to file size of downloaded package.', 'ait-updater'));
			}
			return $tmpfname; // this is what we want, path to successfully downloaded package
		}
	}



	public function excludeAitThemesFromWpOrgUpdateCheckCallback($args, $url)
	{
		if($url === 'https://api.wordpress.org/themes/update-check/1.1/'){

			$body = json_decode($args['body']['themes']);
			$themes = (array) $body->themes;
			$aitThemes = Detector::getAllAitThemes();
			foreach($themes as $slug => $theme){
				if(isset($aitThemes[$slug])){
					unset($themes[$slug]);
				}
			}

			$body->themes = $themes;
			$args['body']['themes'] = wp_json_encode($body);

			return $args;
		}
		return $args;
	}

}
