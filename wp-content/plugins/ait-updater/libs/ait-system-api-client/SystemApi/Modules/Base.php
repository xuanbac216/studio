<?php

namespace Ait\SystemApi\Modules;


class Base
{
	protected $api;



	public function __construct($api)
	{
		$this->api = $api;
	}



	public function get($endpoint, $args = array())
	{
		$args['method'] = 'GET';
		return $this->api->request($endpoint, $args);
	}



	public function post($endpoint, $args = array())
	{
		$args['method'] = 'POST';
		return $this->api->request($endpoint, $args);
	}

}