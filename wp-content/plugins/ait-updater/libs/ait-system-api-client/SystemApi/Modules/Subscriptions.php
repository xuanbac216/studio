<?php

namespace Ait\SystemApi\Modules;


class Subscriptions extends Base
{


	public function getSubscription($type)
	{
		if(!$type){
			trigger_error("You must provide type", E_USER_WARNING);
			return false;
		}

		return $this->get('/subscriptions/info/' . $type);
	}



	public function getAllSubscriptions()
	{
		return $this->get('/subscriptions');
	}
}