<?php

/*
Plugin Name: AIT Toolkit
Plugin URI: http://ait-themes.club
Description: Adds custom post types for AIT themes
Version: 1.7.5
Author: AitThemes.Club
Author URI: http://ait-themes.club
License: GPLv2 or later
*/

/* stable@r684 */

define('AIT_TOOLKIT_ENABLED', true);
define('AIT_TOOLKIT_PACKAGE', 'developer');

require_once dirname(__FILE__) . '/lib/AitToolkitUtils.php';
require_once dirname(__FILE__) . '/AitToolkit.php';

spl_autoload_register(array('AitToolkit', 'autoload'));

AitToolkit::run(
	__FILE__,
	dirname(__FILE__),
	plugins_url('', __FILE__)
);


// ===============================================
// PHP compatibility
// -----------------------------------------------

 if(!function_exists('array_replace_recursive')){
	/**
	 * Replaces elements from passed arrays into the first array recursively
	 * for PHP 5 <= 5.3.0
	 * @return array|null
	 */
	function array_replace_recursive()
	{
		$arrays = func_get_args();
		$original = array_shift($arrays);

		foreach($arrays as $array){
			foreach($array as $key => $value){
				if(is_array($value) and isset($original[$key])){
					$original[$key] = array_replace_recursive($original[$key], $array[$key]);
				}else{
					$original[$key] = $value;
				}
			}
		}
		return $original;
	}
}