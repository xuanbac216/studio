<?php

namespace Ait\EnvatoApi;

use Ait\SystemApi;


class Response extends SystemApi\Response
{

	public function getData()
	{
		if($this->isSuccessful() and ($body = $this->getResponseBody())){
			$data = @json_decode($body);
			if(is_object($data)){
				return $data;
			}else{
				return array();
			}
		}else{
			return array();
		}
	}



	public function getError()
	{
		if(is_wp_error($this->rawResponse)){
			return $this->rawResponse;
		}

		if($this->getResponseCode() != 200){
			if($this->isDownloadRequest){
				if($this->getResponseCode() == 403 and $this->getResponseHeader('content-type') === 'application/xml'){
					return new \WP_Error('envato_api_download_error', 'Access denied to theme zip package on Amazon S3 provided by Envato API. Access token probably expired.');
				}
				return new \WP_Error('envato_api_download_error', 'Some problem occured during downloading of theme package via Envato API');
			}else{
				$json = @json_decode($this->getResponseBody());
				if(is_object($json) and isset($json->error)){
					return new \WP_Error('envato_api_error', $json->error);
				}else{
					// the server return 400 code
					if($this->getResponseCode() == 400){
						return new \WP_Error('envato_api_error', '"400 Bad Request". Make sure that your Envato API Key is the same as it is in your ThemeForest account and what you entered in the Envato API Key field on the AIT Updater Settings.');
					// the server did not return JSON string but some crap, maybe 500 server interal error message
					}else{
						return new \WP_Error('envato_api_error', 'Server response is not valid JSON.');
					}
				}
			}
		}

		return null;
	}
}
