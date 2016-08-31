<?php

namespace Ait\SystemApi\Modules;


class Stats extends Base
{

	public function getStats()
	{
		return $this->get('/stats');
	}

}
