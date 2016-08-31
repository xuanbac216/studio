<?php

namespace Ait\SystemApi\Modules;


class Assets extends Base
{


	public function getAsset($assetCodename)
	{
		if(!$assetCodename){
			trigger_error("You must provide codename of asset", E_USER_WARNING);
			return false;
		}

		return $this->get('/assets/info/' . $assetCodename);
	}



	public function getAllAssets()
	{
		return $this->get('/assets');
	}



	public function getAssetsCount()
	{
		return $this->get('/assets/count');
	}
}
