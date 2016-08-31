<?php

namespace Ait;

use Ait\Updater\Plugins;
use Ait\Updater\Themes;
use Ait\Updater\ThemeforestThemes;
use Ait\Updater\Admin\SettingsPage;
use Ait\Updater\Admin\AddPluginsTab;
use Ait\Updater\Admin\AddThemesTab;
use Ait\Updater\ThemesAndPluginsDetector as Detector;
use Ait\SystemApi;
use Ait\EnvatoApi;


/**
 *
 * Main Updater class.
 *
 * Responsible for:
 * * Managing Updater settings
 * * Fires up Plugins updater and Themes updater
 * * Register admin menu item and page for Updater settings
 *
 */
class Updater
{

	/**
	 * @var array
	 */
	protected $paths;

	/**
	 * @var Ait\Updater
	 */
	private static $instance;

	/**
	 * @var array
	 */
	protected $options;



	/**
	 * Main entry point to Updater
	 *
	 * @param  string $pluginFile Full path to plugin file
	 * @return void
	 */
	public function run($pluginFile)
	{
		$rootPath = dirname($pluginFile);
		$rootUrl = plugins_url('', $pluginFile);

		$uploadDir = wp_upload_dir();

		$this->paths = array(
			'path.pluginFile' => $pluginFile,
			'path.root'       => $rootPath,
			'path.src'        => "$rootPath/src",
			'path.libs'       => "$rootPath/libs",
			'path.backups'    => $uploadDir['basedir'] . '/backups',

			'url.root'        => $rootUrl,
			'url.backups'     => $uploadDir['baseurl'] . '/backups',
		);


		add_action('plugins_loaded', array($this, 'onPluginsLoadedCallback'));

		Plugins::getInstance()->run($this);
		Themes::getInstance()->run($this);

		SettingsPage::getInstance()->run($this);

		AddPluginsTab::getInstance()->run($this);
		AddThemesTab::getInstance()->run($this);
	}



	/**
	 * Gets instance of System API Client
	 *
	 * @return Ait\SystemApi\Client
	 */
	public function getApiClient($type = 'ait-system')
	{
		if($type === 'envato'){
			$client = EnvatoApi\Client::getInstance();
			$client->setIsDebugMode(false);
		}else{
			$client = SystemApi\Client::getInstance();
			$client->setIsDebugMode((defined('AIT_SYSTEM_API_DEBUG') and AIT_SYSTEM_API_DEBUG));

			if(defined('AIT_SYSTEM_API_TESTING_URL') and AIT_SYSTEM_API_TESTING_URL){
				$client->setApiUrl(AIT_SYSTEM_API_TESTING_URL);
			}
		}

		return $client;
	}



	/**
	 * Callbak for 'plugins_loaded' action hook
	 *
	 * @return void
	 */
	public function onPluginsLoadedCallback()
	{
		load_plugin_textdomain('ait-updater', false, basename($this->path('root')) . '/languages');

		include_once $this->path('libs') . '/ait-system-api-client/load.php';
		include_once $this->path('libs') . '/envato-api-client/load.php';

		$this->maybeRunHttpApiDebug();
	}



	/**
	 * Gets credentials from username and api key
	 * @return string
	 */
	public function getCredentials($type = 'system')
	{
		$prefix = ($type === 'envato') ? 'envato_' : '';

		$username = "{$prefix}username";
		$key = "{$prefix}api_key";

		if($u = $this->getOption($username) and $k = $this->getOption($key)){
			return array(
				'username' => $u,
				'api_key' => $k,
			);
		}

		return array();
	}



	public function getCredentialsForRequest($type = 'system')
	{
		return implode(':', $this->getCredentials());
	}



	/**
	 * Gets options key
	 *
	 * @return string
	 */
	public function getOptionsKey()
	{
		return '_ait_updater_options';
	}



	/**
	 * Default Updater options
	 *
	 * @return array
	 */
	public function getDefaultOptions()
	{
		return array(
			'username'        => '',
			'api_key'         => '',
			'envato_username' => '',
			'envato_api_key'  => '',
			'do_backup'       => true,
		);
	}



	/**
	 * Gets saved options
	 *
	 * @return array
	 */
	public function getOptions()
	{
		if($this->options === null){
			$o = get_site_option($this->getOptionsKey(), $this->getDefaultOptions());
			$this->options = wp_parse_args($o, $this->getDefaultOptions());
		}

		return $this->options;
	}



	/**
	 * Gets single saved option with specified $key
	 *
	 * @param  string $key Key of desired option
	 * @return mixed       Value of option
	 */
	public function getOption($key)
	{
		$options = $this->getOptions();

		if(isset($options[$key])){
			return $options[$key];
		}

		return null;
	}



	public function getErrorMessage($name, $prefix = true)
	{
		$ait = __('AitThemes.Club API Credentials:', 'ait-updater');
		$env = __('Envato API Credentials:', 'ait-updater');

		$messages = array(
			'empty_username'         => ($prefix ? "$ait " : '') . sprintf(__('You have to enter value to %s', 'ait-updater'), __('Username', 'ait-updater')),
			'empty_api_key'          => ($prefix ? "$ait " : '') . sprintf(__('You have to enter value to %s', 'ait-updater'), __('API Key', 'ait-updater')),
			'invalid_api_key'        => ($prefix ? "$ait " : '') . sprintf(__('The %s is incorrect, it should be 64 characters long. You probably entered <em>Envato Secret API Key</em> to this field. You have to enter <em>AitThemes.Club API Key</em> to the field.', 'ait-updater'), __('API Key', 'ait-updater')),
			'empty_envato_username'  => ($prefix ? "$env " : '') . sprintf(__('You have to enter value to %s', 'ait-updater'), __('Marketplace Username', 'ait-updater')),
			'empty_envato_api_key'   => ($prefix ? "$env " : '') . sprintf(__('You have to enter value to %s', 'ait-updater'), __('Secret API Key', 'ait-updater')),
			'invalid_envato_api_key' => ($prefix ? "$env " : '') . sprintf(__('The %s is incorrect, it should be 32 characters long.  You probably entered <em>AitThemes.Club API Key</em> to this field. You have to enter <em>Envato Secret API Key</em> to the field.', 'ait-updater'), __('Secret API Key', 'ait-updater')),
		);

		return isset($messages[$name]) ? $messages[$name] : '';
	}



	/**
	 * Validates options from form before saving to DB
	 *
	 * @param  array $input Values from form
	 * @return array        Validated options
	 */
	public function validateOptions($input)
	{
		if(Detector::isThereAnyAitClubThemes() or Detector::isThereAnyAitPluginsExceptPrepackedAndFree()){
			if(empty($input['username'])){
				add_settings_error($this->getOptionsKey(), 'empty_username', $this->getErrorMessage('empty_username'), 'error');
			}

			if(empty($input['api_key'])){
				add_settings_error($this->getOptionsKey(), 'empty_api_key', $this->getErrorMessage('empty_api_key'), 'error');
			}elseif(strlen($input['api_key']) != 64){
				add_settings_error($this->getOptionsKey(), 'invalid_api_key', $this->getErrorMessage('invalid_api_key'), 'error');
			}
		}

		if(Detector::isThereAnyThemeforestThemes()){
			if(empty($input['envato_username'])){
				add_settings_error($this->getOptionsKey(), 'empty_envato_username', $this->getErrorMessage('empty_envato_username'), 'error');
			}

			if(empty($input['envato_api_key'])){
				add_settings_error($this->getOptionsKey(), 'empty_envato_api_key', $this->getErrorMessage('empty_envato_api_key'), 'error');
			}elseif(strlen($input['envato_api_key']) != 32){
				add_settings_error($this->getOptionsKey(), 'invalid_envato_api_key', $this->getErrorMessage('invalid_envato_api_key'), 'error');
			}
		}

		if(empty($input['do_backup'])){
			$input['do_backup'] = false;
		}

		return $input;
	}



	/**
	 * Updates options
	 *
	 * @param  array $options Values from form
	 * @return void
	 */
	public function updateOptions($options)
	{
		update_site_option($this->getOptionsKey(), $options);
	}



	/**
	 * Displays admin notices
	 * @param  array &$errors Array of WP_Error objects
	 * @return void
	 */
	public function displayAdminNotices(&$errors)
	{
		if($errors){
			$msgs = array();
			foreach($errors as $errorMsg){
				$msgs[] = "<p>{$errorMsg}</p>";
			}
			echo '<div class="error">' . implode('', $msgs) . '</div>';
			$errors = array();
		}
	}



	public function doBackup($packageType, $codename)
	{
		$backupsDir = $this->path('backups');
		if(file_exists(!$backupsDir)){
			wp_mkdir_p($backupsDir);
			@file_put_contents("$backupsDir/index.php", "<?php\n// Silence is golden.");
		}

		$prefix = ($packageType == 'theme') ? 'ait-' : '';

		$zipfile = "$backupsDir/{$prefix}$codename-" . date('Y-m-d_H-i-s') . '.zip';

		$srcRoot = ($packageType == 'theme') ? get_theme_root($codename) : WP_PLUGIN_DIR;
		$src = "$srcRoot/$codename";

		if(file_exists($src)){
			$result = $this->makeBackupZip($src, $zipfile);
		}
	}



	protected function makeBackupZip($src, $zipfile)
	{
		if(!class_exists('\ZipArchive')) return false;

		$src = realpath($src);

		@ini_set('memory_limit', apply_filters('admin_memory_limit', WP_MAX_MEMORY_LIMIT));

		$zip = new \ZipArchive();
		$zip->open($zipfile, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);


		// Create recursive directory iterator
		/** @var SplFileInfo[] $files */
		$files = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($src), \RecursiveIteratorIterator::LEAVES_ONLY);

		foreach ($files as $name => $file){
			// Skip directories (they would be added automatically)
			if (!$file->isDir()){
				// Get real and relative path for current file
				$filePath = $file->getRealPath();
				$relativePath = substr($filePath, strlen(dirname($src)) + 1);
				// Add current file to archive
				$zip->addFile($filePath, $relativePath);
			}
		}

		// Zip archive will be created only after closing object
		return $zip->close();
	}



	/* ************ helper methods ********** */



	public static function getInstance()
	{
		if(!self::$instance){
			self::$instance = new self;
		}

		return self::$instance;
	}



	/**
	 * Gets paths (disk paths and urls) to various location of plugin
	 *
	 * @return array
	 */
	public function getPaths()
	{
		return apply_filters('ait-updater-get-paths', $this->paths);
	}



	/**
	 * Returns path to specified location
	 *
	 * @param  string $location Specified location
	 * @return string           Absolute path to location
	 */
	public function path($location)
	{
		$paths = $this->getPaths();

		if(isset($paths["path.{$location}"])){
			return apply_filters('ait-updater-path', $paths["path.{$location}"], $location);
		}

		return '';
	}



	/**
	 * Returns URL to specified location
	 *
	 * @param  string $location Specified
	 * @return string           Url to location
	 */
	public function url($location)
	{
		$paths = $this->getPaths();

		if(isset($paths["url.{$location}"])){
			return apply_filters('ait-updater-url', $paths["url.{$location}"], $location);
		}

		return '';
	}



	protected function maybeRunHttpApiDebug()
	{
		if(defined('AIT_UPDATER_HTTP_API_DEBUG') and AIT_UPDATER_HTTP_API_DEBUG){
			if(defined('AIT_UPDATER_HTTP_API_DEBUG_LOG_FILE') and AIT_UPDATER_HTTP_API_DEBUG_LOG_FILE){
				if(file_exists(AIT_UPDATER_HTTP_API_DEBUG_LOG_FILE)){
					@unlink(AIT_UPDATER_HTTP_API_DEBUG_LOG_FILE);
				}
			}
			add_action('http_api_debug', array($this, 'onHttpApiDebugCallback'), 10, 5);
		}
	}



	/**
	 * For debugging purposes
	 */
	public function onHttpApiDebugCallback($response, $context, $class, $args, $url)
	{
		ob_start();

		print_r($url);
		echo "\n------------------------------\n";
		print_r($args);
		echo "\n------------------------------\n";
		print_r($response);
		echo "\n------------------------------\n";
		print_r($class);
		echo "\n\n------------------------------------------------------------------------------------------\n\n";

		$dump = ob_get_clean();

		if(defined('AIT_UPDATER_HTTP_API_DEBUG_LOG_FILE') and AIT_UPDATER_HTTP_API_DEBUG_LOG_FILE){
			file_put_contents(AIT_UPDATER_HTTP_API_DEBUG_LOG_FILE, $dump, FILE_APPEND);
		}else{
			echo "<xmp>$dump</xmp>";
		}
	}

}
