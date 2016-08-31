<?php

namespace Ait\Updater;

use Ait\Updater\Admin\SettingsPage;


class Base
{

	/**
	 * @var Ait\Updater
	 */
	protected $updater;

	/**
	 * @var array
	 */
	protected $errors = array();

	/**
	 * @var self
	 */
	private static $instance;



	public function run($updater)
	{
		$this->updater = $updater;
		add_action('plugins_loaded', array($this, 'onPluginsLoadedCallback'));
		add_action('admin_head', array($this, 'onAdminHeadCallback'));
	}



	public static function getInstance()
	{
		$class = get_called_class();
		if(!isset(self::$instance[$class])){
			self::$instance[$class] = new static;
		}

		return self::$instance[$class];
	}



	protected function extractItemIdsAndVersions($envatoApiResponse)
	{
		$pairs = array();

		$list = $envatoApiResponse->getData()->{'wp-list-themes'};

		foreach($list as $theme){
			$pairs[$theme->item_id] = $theme->version;
		}

		return $pairs;
	}



	protected function extractItemIds($envatoApiResponse)
	{
		$ids = array();

		$list = $envatoApiResponse->getData()->{'wp-list-themes'};

		foreach($list as $theme){
			$ids[] = $theme->item_id;
		}

		return $ids;
	}



	public function onAdminHeadCallback()
	{
		$hook = is_multisite() ? 'network_admin_notices' : 'admin_notices';
		add_action($hook, array($this, 'onAdminNoticesCallback'));
	}



	public function onAdminNoticesCallback()
	{
		$this->updater->displayAdminNotices($this->errors);
	}



	/**
	 * Returns WP_Error with message that credentials for given type of API are not provided
	 * @param  string $type system|envato
	 * @return \WP_Error
	 */
	public function credentialsAreNotProvided($type = 'system')
	{
		$settingsPageUrl = admin_url('admin.php?page=' . SettingsPage::getPageSlug());
		if(is_multisite()){
			$settingsPageUrl = network_admin_url('admin.php?page=' . SettingsPage::getPageSlug());
		}
		if($type === 'envato'){
			return new \WP_Error(
				'envato_api_empty_credentials',
				sprintf(__('You did not provide your Envato credentials. Please enter your Envato username and API key on the <a href="%s" target="_top">AIT Updater Settings Page</a>.', 'ait-updater'), $settingsPageUrl)
			);
		}elseif($type === 'system'){
			return new \WP_Error(
				'ait_api_empty_credentials',
				sprintf(__('You did not provide your credentials. Please enter your username and API key on the <a href="%s" target="_top">AIT Updater Settings Page</a>.', 'ait-updater'), $settingsPageUrl)
			);
		}
	}



	protected function createTempFilePlaceholder($codename)
	{
		$tmpfname = wp_tempnam($codename);

		if(!$tmpfname){
			return new \WP_Error('http_no_file', __('Could not create temporary file.', 'ait-updater'));
		}

		return $tmpfname;
	}



	public function addError($errorMsg)
	{
		$this->errors[] = $errorMsg;
	}



	public function getErrors()
	{
		return $this->errors;
	}



	public function hasErrors()
	{
		return !empty($this->errors);
	}
}