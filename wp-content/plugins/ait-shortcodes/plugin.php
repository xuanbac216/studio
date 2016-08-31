<?php

/*
Plugin Name: AIT Shortcodes
Plugin URI: http://ait-themes.club
Description:
Version: 1.1.1
Author: AitThemes.Club
Author URI: http://ait-themes.club
License: GPLv2 or later
*/

/* stable@r310 */

define('AIT_SHORTCODES_ENABLED', true);


require_once dirname(__FILE__) . '/AitShortcodesUtils.php';
require_once dirname(__FILE__) . '/AitShortcode.php';
require_once dirname(__FILE__) . '/AitShortcodesManager.php';

spl_autoload_register(array('AitShortcodesManager', 'shortcodesAutoload'), true);

AitShortcodesManager::run(
	dirname(__FILE__),
	plugins_url('', __FILE__)
);
