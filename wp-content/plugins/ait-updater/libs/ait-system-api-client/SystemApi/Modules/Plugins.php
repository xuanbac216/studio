<?php

namespace Ait\SystemApi\Modules;


class Plugins extends Base
{


	public function getPlugin($pluginCodename)
	{
		if(!$pluginCodename){
			trigger_error("You must provide codename of theme", E_USER_WARNING);
			return false;
		}

		return $this->get('/plugins/info/' . $pluginCodename);
	}



	public function getAllPlugins()
	{
		return $this->get('/plugins');
	}



	public function getPluginsCount()
	{
		return $this->get('/plugins/count');
	}



	public function checkUpdates($args = array())
	{
		$args['use_cache'] = false; // do not cache this request, update checks are once in 12 hours or so
		return $this->post('/plugins/update-check', $args);
	}



	public function downloadPlugin($pluginCodename, $args)
	{
		$args['use_cache'] = false;
		return $this->post('/plugins/download/' . $pluginCodename, $args);
	}
}
