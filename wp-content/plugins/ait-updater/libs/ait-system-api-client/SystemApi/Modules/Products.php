<?php

namespace Ait\SystemApi\Modules;


class Products extends Base
{

	public function getProduct($codename)
	{
		if(!$codename){
			trigger_error("You must provide codename", E_USER_WARNING);
			return false;
		}

		return $this->get('/products/info/' . $codename);
	}



	public function getAllProducts()
	{
		return $this->get('/products');
	}



	public function getProductsCount()
	{
		return $this->get('/products/count');
	}

}
