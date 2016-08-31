<?php

namespace Ait\EnvatoApi;

use Ait\SystemApi;


class Client extends SystemApi\Client
{

	protected $apiUrl = 'http://marketplace.envato.com/api/edge';



	public function getThemes($credentials)
	{
		$url = $this->apiUrl . "/{$credentials['username']}/{$credentials['api_key']}/wp-list-themes.json";

		$args = array(
			'use_cache' => false,
			'headers'    => array('Accept-Encoding' => ''),
			'sslverify'  => false,
			'timeout'    => 300,
			'user-agent' => 'WordPress',
		);

		return $this->request($url, $args, 'Ait\EnvatoApi\Response');
	}




	public function downloadTheme($themeforestItemid, $credentials, $args)
	{
		// first request to Envato API, it returns url to theme zip file stored on Amazon S3
		$response = $this->getThemePackageUrl($themeforestItemid, $credentials);

		if($response->isSuccessful()){
			$set = $response->getData()->{'wp-download'};
			if($set){
				return $this->request($set->url, $args); // download zip file from Amazon S3
			}else{
				// user does not purchased this item on ThemeForest, returned URL is empty string
				return new Response(new \WP_Error('download_failed', "You did not purchased item id:$themeforestItemid on ThemeForest yet"), 'wp-download');
			}
		}

		return $response;
	}



	public function getThemePackageUrl($themeforestItemid, $credentials)
	{
		$url = $this->apiUrl . "/{$credentials['username']}/{$credentials['api_key']}/wp-download:{$themeforestItemid}.json";

		$args = array(
			'use_cache' => false,
			'headers'    => array('Accept-Encoding' => ''),
			'sslverify'  => false,
			'timeout'    => 300,
			'user-agent' => 'WordPress',
		);

		return $this->request($url, $args, 'Ait\EnvatoApi\Response');
	}

}
