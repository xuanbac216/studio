<?php

namespace Ait\SystemApi\Modules;


class Themes extends Base
{

	public function getTheme($themeCodename)
	{
		if(!$themeCodename){
			trigger_error("You must provide codename of theme", E_USER_WARNING);
			return false;
		}

		return $this->get('/themes/info/' . $themeCodename);
	}



	public function getAllThemes()
	{
		return $this->get('/themes');
	}



	public function getThemesCount()
	{
		return $this->get('/themes/count');
	}



	public function getThemeChangelog($themeCodename, $version = 'all', $html = true)
	{
		return $this->get($this->getThemeChangelogEndpoint($themeCodename, $version, $html));
	}



	public function getThemeChangelogEndpoint($themeCodename, $version = 'all', $html = true)
	{
		$params = http_build_query(array(
			'v'          => $version,
			'output'     => $html ? 'html' : 'json',
			'dateformat' => get_option('date_format'),
		));
		return "/themes/changelog/$themeCodename?$params";
	}



	public function checkUpdates($args = array())
	{
		$args['use_cache'] = false; // do not cache this request, update checks are once in 12 hours or so
		return $this->post('/themes/update-check', $args);
	}



	public function downloadTheme($themeCodename, $args)
	{
		$args['use_cache'] = false;
		return $this->post('/themes/download/' . $themeCodename, $args);
	}
}
