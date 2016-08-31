<?php

namespace Ait\SystemApi;


/**
 * Main AIT System API client class for WordPress
 */
class Client
{

	public static $version = '2.1.1';

	protected static $instance = array();

	protected $apiUrl = 'https://system.ait-themes.club/api/2.0';

	protected $mdules = array();

	protected $isDebugMode = false;



	public static function getInstance()
	{
		$class = get_called_class();
		if(!isset(self::$instance[$class])){
			self::$instance[$class] = new static;
		}

		return self::$instance[$class];
	}



	public function setApiUrl($url)
	{
		$this->apiUrl = $url;
	}



	public function getApiUrl()
	{
		return $this->apiUrl;
	}



	public function setIsDebugMode($isDebugMode)
	{
		$this->isDebugMode = $isDebugMode;
	}



	public function getModule($moduleName)
	{
		$moduleName = ucfirst(strtolower($moduleName));
		if(!isset($this->modules[$moduleName])){
			$className = '\Ait\SystemApi\Modules\\' . $moduleName;
			$this->modules[$moduleName] = new $className($this);
		}

		return $this->modules[$moduleName];
	}



	public function request($endpointOrUrl, $args = array(), $responseClass = 'Ait\SystemApi\Response')
	{

		$transientKey = 'ait_api_' . md5($endpointOrUrl);

		include ABSPATH . WPINC . '/version.php'; // include an unmodified $wp_version

		$defaultArgs = array(
			'method' => 'GET',
			'use_cache' => true,
			'cache_expiration' => HOUR_IN_SECONDS,
			'timeout' => (defined('DOING_CRON') && DOING_CRON) ? 40 : 8,
			'user-agent' => 'WordPress/' . $wp_version . '; ' . get_bloginfo('url'),
		);

		$args = wp_parse_args($args, $defaultArgs);
		if(!$this->isDebugMode and $args['use_cache']){
			$apiResponse = get_site_transient($transientKey);

			if($apiResponse !== false){
				return $apiResponse;
			}
		}

		if(strncmp($endpointOrUrl, 'http', 4) === 0){ // starts with
			$url = $endpointOrUrl;
		}else{
			$url = $this->apiUrl . $endpointOrUrl;
		}

		$method = strtolower($args['method']);
		$remoteFn = "wp_remote_{$args['method']}";

		$wpResponse = $remoteFn($url, $args);

		$apiResponse = new $responseClass($wpResponse, $endpointOrUrl, $args);

		if($apiResponse->isSuccessful() and !$this->isDebugMode and $args['use_cache']){
			set_site_transient($transientKey, $apiResponse, $args['cache_expiration']);
		}

		return $apiResponse;
	}
}
