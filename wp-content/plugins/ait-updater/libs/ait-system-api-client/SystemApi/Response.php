<?php

namespace Ait\SystemApi;


class Response
{

	protected $rawResponse;
	protected $endpoint = '';
	protected $requestArgs = array();
	protected $isDownloadRequest = false;



	/**
	 * @param \WP_Error|array $rawResponse
	 */
	public function __construct($rawResponse, $endpoint, $requestArgs = array())
	{
		$this->rawResponse = $rawResponse;
		$this->endpoint = $endpoint;
		$this->requestArgs = $requestArgs;
		$this->isDownloadRequest = (isset($requestArgs['stream']) and isset($requestArgs['filename']));
	}



	/**
	 * Flag wether request was successful
	 * @return boolean
	 */
	public function isSuccessful()
	{
		if(is_wp_error($this->rawResponse)){
			return false;
		}elseif($this->getResponseCode() != 200){
			return false;
		}
		return true;
	}



	public function getData()
	{
		if($this->isSuccessful() and ($body = $this->getResponseBody())){
			$body = @json_decode($body);
			if(is_object($body)){
				return $body->data;
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
				$msg = base64_decode($this->getResponseHeader('ait-api-download-error'));
				return new \WP_Error('ait_api_download_error', $msg);
			}else{
				$json = @json_decode($this->getResponseBody());
				if(is_object($json)){
					return new \WP_Error('ait_api_error', $json->error);
				}else{ // server did not return JSON string but some crap, maybe 500 server interal error message
					return new \WP_Error('ait_api_error', 'Server response is not valid JSON.');
				}
			}
		}

		return null;
	}



	public function getResponseCode()
	{
		return wp_remote_retrieve_response_code($this->rawResponse);
	}



	public function getResponseBody()
	{
		return wp_remote_retrieve_body($this->rawResponse);
	}



	public function getResponseHeaders()
	{
		return wp_remote_retrieve_headers($this->rawResponse);
	}



	public function getResponseHeader($header)
	{
		return wp_remote_retrieve_header($this->rawResponse, $header);
	}



	public function getEndpoint()
	{
		return $this->endpoint;
	}



	public function getRequestArgs()
	{
		return $this->requestArgs;
	}

}
