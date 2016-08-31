<?php

/*
 * AIT Shortcodes WordPress Plugin
 *
 * Copyright (c) 2013, Affinity Information Technology, s.r.o. (http://ait-themes.com)
 */


class AitShortcodesManager
{

	protected static $instance;

	protected static $paths;

	protected $shortcodes = array();

	protected $titlesList = array();

	protected $configFiles = array();


	public static function run($basedir, $baseurl)
	{
		self::$paths = (object) array(
			'dir' => (object) array(
				'root'       => $basedir,
				'shortcodes' => $basedir . '/shortcodes',
				'assets'     => $basedir . '/assets',
				'templates'  => $basedir . '/shortcodes/templates',
			),
			'url' => (object) array(
				'root'       => $baseurl,
				'assets'     => $baseurl . '/assets',
			),
		);


		self::getInstance()->initialize();
	}



	public function initialize()
	{
		add_action('init', array($this, 'onInit'));

		if(!AitShortcodesUtils::isAjax()){
			add_action('wp_enqueue_scripts', array($this, 'onEnqueueFrontendAssets'), 11);
			add_action('admin_enqueue_scripts', array($this, 'onEnqueueAdminAssets'));
			add_action('admin_head', array($this, 'generateShortcodesListForJs'), 9);
		}
	}



	public static function getInstance()
	{
		if(self::$instance === null){
			self::$instance = new self;
			return self::$instance;
		}

		return self::$instance;
	}



	public function generateShortcodesListForJs()
	{
		echo '<script>AitShortcodesList = ';
		echo json_encode($this->getTitlesList());
		echo ';</script>';
	}



	public function onInit()
	{
		load_plugin_textdomain('ait-shortcodes', false, basename(self::$paths->dir->root) . '/languages');

		add_filter('ait-shortcode-content', 'shortcode_unautop');
		add_filter('ait-shortcode-content', array($this, 'removeJunkHtml'));
		add_filter('ait-shortcode-content', 'do_shortcode');

		$list = require self::$paths->dir->root . '/@shortcodes.list.php';
		$list = apply_filters('ait-shortcodes-list', $list);

		$paths = self::$paths;
		$aitThemePaths = array();

		if(current_theme_supports('ait-shortcodes-plugin')){
			$theme = wp_get_theme();

			$suffix = "/ait-theme/shortcodes";

			$parentDir = $theme->template_dir . $suffix;
			$childDir = $theme->stylesheet_dir . $suffix;

			$aitThemePaths = array(
				'dir' => (object) array(
					'parent' => $parentDir,
					'child'  => $childDir,
				),
				'url' => (object) array(
					'parent' => $theme->get_template_directory_uri() . $suffix,
					'child'  => $theme->get_stylesheet_directory_uri() . $suffix,
				),
			);
		}

		foreach($list as $shortcode => $enabled){
			if(!$enabled) continue;

			$isFromAitTheme = false;
			$configFilename = "@{$shortcode}.php";
			$configFile = self::$paths->dir->shortcodes . "/{$configFilename}";

			if(current_theme_supports('ait-shortcodes-plugin')){
				if(file_exists("$childDir/$configFilename")){
					$configFile = "$childDir/$configFilename";
					$isFromAitTheme = true;
				}elseif(file_exists("$parentDir/$configFilename")){
					$configFile = "$parentDir/$configFilename";
					$isFromAitTheme = true;
				}
			}


			$config = self::loadRawConfig($configFile);

			$config['paths'] = $paths;
			$config['ait-theme-paths'] = $aitThemePaths;

			$class = 'AitShortcode';
			if(isset($config['configuration']['class']) and $config['configuration']['class']){
				$class = $config['configuration']['class'];
			}

			$sc = new $class($shortcode, $config, $isFromAitTheme);

			$this->configFiles[$sc->getName()] = $configFile;

			$this->shortcodes[$sc->getName()] = $sc;

			if(!$sc->isChild()){
				$this->titlesList[$sc->getName()] = $sc->getTitle();
			}

			add_shortcode($sc->getName(), array($sc, 'prepareRender'));
		}
	}



	public function getShortcodes()
	{
		return $this->shortcodes;
	}



	public function getTitlesList()
	{
		return $this->titlesList;
	}



	public function getConfigFiles()
	{
		return $this->configFiles;
	}



	/**
	 * Registers frontend assets
	 */
	public function onEnqueueFrontendAssets()
	{
		// css

		foreach($this->shortcodes as $shortcode){
			foreach($shortcode->getAssets('css') as $handler => $css){

				if($css === true or wp_style_is($handler, 'registered') or wp_style_is($handler, 'enqueued')){
					wp_enqueue_style($handler);
				}else{
					if(!wp_style_is($handler, 'registered') or !wp_style_is($handler, 'enqueued')){
						$url = self::$paths->url->assets;
						$url = AitShortcodesUtils::isExtUrl($css['file']) ? $css['file'] : $url . $css['file'];

						wp_enqueue_style(
							$handler,
							$url,
							isset($css['deps']) ? $css['deps'] : array(),
							isset($css['ver']) ? $css['ver'] : false,
							isset($style['media']) ? $style['media'] : 'all'
						);
					}
				}
			}
		}

		//if(!current_theme_supports('ait-shortcodes-plugin')){
		//	wp_enqueue_style(
		//		'ait-shortcodes-main-style',
		//		self::$paths->url->assets . "/css/style.css"
		//	);
		//}

		// js

		foreach($this->shortcodes as $shortcode){
			foreach($shortcode->getAssets('js') as $handler => $js){

				if($js === true or wp_script_is($handler, 'registered') or wp_script_is($handler, 'enqueued')){
					wp_enqueue_script($handler);
				}else{
					if(!wp_script_is($handler, 'registered') or !wp_script_is($handler, 'enqueued')){
						$f = $js['file'];

						if(isset($js['min']) and $js['min'] === true and (!defined('SCRIPT_DEBUG') or (defined('SCRIPT_DEBUG') and SCRIPT_DEBUG == false))){
							$f = str_replace('.js', '.min.js', strtolower($f));
						}
						$url = self::$paths->url->assets;
						$url = AitShortcodesUtils::isExtUrl($js['file']) ? $js['file'] : $url . $f;

						wp_enqueue_script(
							$handler,
							$url,
							isset($js['deps']) ? $js['deps'] : array(),
							isset($js['ver']) ? $js['ver'] : false,
							isset($style['media']) ? $style['media'] : 'all'
						);
					}
				}
			}
		}
	}



	/**
	 * Registers admin assets
	 */
	public function onEnqueueAdminAssets()
	{
		foreach($this->shortcodes as $shortcode){

			// CSS

			foreach($shortcode->getAssets('admin-css') as $handler => $css){

				if($css === true){
					wp_enqueue_style($handler);
				}else{
					$url = self::$paths->url->assets;
					$url = AitShortcodesUtils::isExtUrl($css['file']) ? $css['file'] : $url . $css['file'];

					wp_enqueue_style(
						$handler,
						$url,
						isset($css['deps']) ? $css['deps'] : array(),
						isset($css['ver']) ? $css['ver'] : false,
						isset($style['media']) ? $style['media'] : 'all'
					);
				}
			}

			// JS

			foreach($shortcode->getAssets('admin-js') as $handler => $js){

				if($js === true){
					wp_enqueue_script($handler);
				}else{
					$url = self::$paths->url->assets;

					$url = AitShortcodesUtils::isExtUrl($js['file']) ? $js['file'] : $url . $js['file'];

					wp_enqueue_script(
						$handler,
						$url,
						isset($js['deps']) ? $js['deps'] : array(),
						isset($js['ver']) ? $js['ver'] : false,
						true // in the footer by default
					);

					if(isset($js['localize'])){
						wp_localize_script($handler, AitShortcodesUtils::dash2class($handler), $js['localize']);
					}
				}
			}
		}
	}



	public function removeJunkHtml($content)
	{
		// array of custom shortcodes requiring the fix
		$block = implode("|", array_keys($this->shortcodes));

		// opening tag
		$content = preg_replace("/(<\/p>|<br \/>)?\[($block)(\s[^\]]+)?\](<\/p>|<br \/>)?/","[$2$3]", $content);

		// closing tag
		$content = preg_replace("/(<\/p>|<br \/>)?\[\/($block)\](<\/p>|<br \/>)?/","[/$2]", $content);

		return $content;
	}



	public static function loadRawConfig($f)
	{
		if(file_exists($f)){
			return require $f;
		}else{
			trigger_error("Config file '{$f}' does not exist.");
			return array();
		}
	}



	public static function shortcodesAutoload($class)
	{
		if(substr($class, 0, 3) == 'Ait' and substr($class, -9) == 'Shortcode'){

			$file = self::$paths->dir->root . "/shortcodes/{$class}.php";

			if(file_exists($file)){
				require_once $file;
				return;
			}else{
				throw new Exception("Unable to find '{$class}' in file '{$file}'.");
			}
		}
	}
}
