<?php

namespace Ait\Updater\Admin;

use Ait\Updater\ThemesAndPluginsDetector as Detector;


class AddPluginsTab
{

	protected static $instance;

	/**
	 * @var Ait\Updater
	 */
	protected $updater;



	public function run($updater)
	{
		$this->updater = $updater;

		add_filter('install_plugins_tabs', array($this, 'addTab'));
		add_filter('install_plugins_ait', array($this, 'renderTabContent'));
		add_filter('install_plugins_table_api_args_ait', array($this, 'overrideArgs'));
		add_filter('plugins_api', array($this, 'getAitPlugins'), 10, 3); // query_plugins
		add_filter('plugins_api', array($this, 'searchWithAitPlugins'), 10, 3);

		add_filter('plugin_row_meta', array($this, 'addChangelogLink'), 10, 4);

		add_action('admin_print_styles-plugin-install.php', array($this, 'printStyles'));
		add_action('admin_print_scripts', array($this, 'addTabViaScript'), 20); // 20 - after jQuery
	}



	public function addTab($tabs)
	{
		$tabs = array_merge(array('ait' => 'AitThemes.club'), $tabs);
		return $tabs;
	}



	public function overrideArgs($args)
	{
		$args = array(
			'ait' => true, // flag
			'locale' => get_locale(),
			'plugins' => array_keys(Detector::getAitPlugins()),
			'per_page' => 30,
		);
		return $args;
	}



	public function getAitPlugins($false, $action, $args)
	{
		if(!($action === 'query_plugins' and isset($args->ait))) return $false;

		$apiResponse = $this->updater->getApiClient()->getModule('plugins')->getAllPlugins();

		if(!$apiResponse->isSuccessful()){
			return $apiResponse->getError(); // wp_error;
		}

		$data = $apiResponse->getData();

		$numberOfPlugins = count($data);

		$plugins = array();

		foreach($data as $plugin){
			if(!$this->isPluginLatestInstalled($plugin->codename, $plugin->latestVersion->version)) continue;

			$plugins[] = (object) array(
				'name' => $plugin->name,
				'slug' => $plugin->codename,
				'version' => $plugin->latestVersion->version,
				'author' => '<a href="https://ait-themes.club">AitThemes.club</a>',
				'requires' => $plugin->minRequiredWpVersion,
				'tested' => $plugin->testedUpToWpVersion,
				'rating' => 0,
				'num_ratings' => 0,
				'active_installs' => 0,
				'last_updated' => $plugin->latestVersion->releasedAt,
				'short_description' => $plugin->description,
				'icons' => array(
					'2x' => $plugin->thumbnailUrl,
					'1x' => $plugin->thumbnailUrl,
					'default' => $plugin->thumbnailUrl,
				)
			);
		}


		$return = (object) array(
			'info' => array(
				'page' => 1,
				'pages' => 1,
				'results' => $numberOfPlugins,
			),
			'plugins' => $plugins,
		);

		return $return;
	}



	public function searchWithAitPlugins($false, $action, $args)
	{
		if(!($action === 'query_plugins' and !empty($args->search))) return $false;

		$apiResponse = $this->updater->getApiClient()->getModule('plugins')->getAllPlugins();

		if(!$apiResponse->isSuccessful()){
			return $apiResponse->getError(); // wp_error;
		}

		$searchTerm = $args->search;

		$data = $apiResponse->getData();

		$numberOfPlugins = count($data);

		$plugins = array();

		foreach($data as $plugin){
			if(!$this->isPluginLatestInstalled($plugin->codename, $plugin->latestVersion->version)) continue;

			if($this->search($plugin->name, $searchTerm) or $this->search($plugin->description, $searchTerm)){

				$plugins[] = (object) array(
					'name' => $plugin->name,
					'slug' => $plugin->codename,
					'version' => $plugin->latestVersion->version,
					'author' => '<a href="https://ait-themes.club">AitThemes.club</a>',
					'requires' => $plugin->minRequiredWpVersion,
					'tested' => $plugin->testedUpToWpVersion,
					'rating' => 0,
					'num_ratings' => 0,
					'active_installs' => 0,
					'last_updated' => $plugin->latestVersion->releasedAt,
					'short_description' => $plugin->description,
					'icons' => array(
						'2x' => $plugin->thumbnailUrl,
						'1x' => $plugin->thumbnailUrl,
						'default' => $plugin->thumbnailUrl,
					)
				);
			}
		}

		$numberOfPlugins = count($plugins);

		if($numberOfPlugins == 0) return $false; // no ait plugins were found

		$return = (object) array(
			'info' => array(
				'page' => 1,
				'pages' => 1,
				'results' => $numberOfPlugins,
			),
			'plugins' => $plugins,
		);

		return $return;

		return $false;
	}



	protected function isPluginLatestInstalled($codename, $version)
	{
		$status = install_plugin_install_status(array(
			'slug' => $codename,
			'version' => $version,
		));

		return !($status['status'] === 'latest_installed' or $status['status'] === 'newer_installed');
	}



	public function renderTabContent($paged)
	{
		echo '<div class="install-plugins-ait">';
		display_plugins_table();
		echo '</div>';
	}



	public function addChangelogLink($pluginMeta, $pluginFile, $pluginData, $status)
	{
		$slug = dirname($pluginFile);
		$changelogLink = array(
			sprintf('<a href="%s" class="thickbox">%s</a>',
				esc_url(network_admin_url('plugin-install.php?tab=plugin-information&plugin=' . $slug . '&TB_iframe=true&width=600&height=550' )),
				__( 'Changelog', 'ait-updater')
			)
		);
		array_splice($pluginMeta, 1, 0, $changelogLink);
		return $pluginMeta;
	}



	public function printStyles()
	{
		?>
		<style>
			.install-plugins-ait .vers.column-rating,
			.install-plugins-ait .column-downloaded,
			div[class*="plugin-card-ait-"] .vers.column-rating,
			div[class*="plugin-card-ait-"] .column-downloaded
			{ display: none; }

			.plugin-install-ait { font-weight: bold; }

			.install-plugins-ait .plugin-icon { background-size: cover; background-position: 50% 5%; }

			.install-plugins-ait .plugin-icon > img { opacity: 0 }
		</style>
		<?php
	}



	public function addTabViaScript()
	{
		global $pagenow;
		if($pagenow !== 'plugin-install.php') return;
		?>
		<script>
		jQuery(function(){
			jQuery('.install-plugins-ait .plugin-icon').each(function(){
				var $this = jQuery(this);
				$this.css('background-image', 'url(' + $this.find('img').attr('src') + ')');
			});
		});

		</script>
		<?php
	}



	private function search($haystack, $needle)
	{
		return strpos(strtolower($haystack), strtolower($needle)) !== FALSE;
	}



	public static function getInstance()
	{
		if(!self::$instance){
			self::$instance = new self;
		}

		return self::$instance;
	}
}