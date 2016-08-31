<?php

class AitToolkit
{

	protected static $instance;

	protected static $paths;

	/** @var array */
	protected static $managers = array();


	public static function run($file, $basedir, $baseurl)
	{
		self::$paths = (object) array(
			'dir' => (object) array(
				'root'   => $basedir,
				'lib'    => $basedir . '/lib',
				'cpts'   => $basedir . '/cpts',
				'assets' => $basedir . '/assets',
			),
			'url' => (object) array(
				'root'   => $baseurl,
				'lib'    => $baseurl . '/lib',
				'cpts'   => $baseurl . '/cpts',
				'assets' => $baseurl . '/assets',
			),
		);

		self::getInstance()->initialize();

		register_activation_hook($file, array(__CLASS__, 'onActivation'));
		register_deactivation_hook($file, array(__CLASS__, 'onDeactivation'));
	}



	public static function getInstance()
	{
		if(self::$instance === null){
			self::$instance = new self;
			return self::$instance;
		}

		return self::$instance;
	}



	public function initialize()
	{
		self::$managers['cpts'] = new AitCptsManager(self::$paths);

		add_action('init', array($this, 'onInit'));


		if(!AitToolkitUtils::isAjax()){
			add_action('wp_enqueue_scripts', array($this, 'onEnqueueFrontendAssets'), 11);
			add_action('admin_enqueue_scripts', array($this, 'onEnqueueAdminAssets'));
		}

		// for WP 4.2
		add_action('split_shared_term', array(self::getManager('cpts'), 'updateTermIdsOnSplitSharedTerm'), 10, 4);
	}



	public function onInit()
	{
		load_plugin_textdomain('ait-toolkit', false, basename(self::$paths->dir->root) . '/languages');

		self::getManager('cpts')->registerCpts();

		add_filter('pll_get_post_types', array($this, 'addCptsToPolylang'), 10, 2);
		add_filter('pll_get_taxonomies', array($this, 'addTaxsToPolylang'), 10, 2);
	}



	public function addCptsToPolylang($cpts, $onSettingsPage)
	{
		if(!$onSettingsPage) return $cpts;
		$aitCpts = self::getManager('cpts')->getTranslatable('list');

		$x = array_merge($cpts, $aitCpts);
		return $x;
	}



	public function addTaxsToPolylang($taxs, $onSettingsPage)
	{
		if(!$onSettingsPage) return $taxs;

		$aitCpts = self::getManager('cpts')->getAll();
		foreach($aitCpts as $cpt){
			$taxs = array_merge($taxs, $cpt->getTranslatableTaxonomyList());
		}

		return $taxs;
	}



	public static function getManager($manager)
	{
		if(isset(self::$managers[$manager]))
			return self::$managers[$manager];
		else
			trigger_error(sprintf("Manager '{$manager}' does not exist. Available managers are: %s", array_keys(self::$managers)), E_USER_WARNING);

		return false;
	}



	public static function onActivation()
	{
		flush_rewrite_rules();
	}



	public static function onDeactivation()
	{
		flush_rewrite_rules();
	}



	/**
	 * Registers frontend assets
	 */
	public function onEnqueueFrontendAssets()
	{
		// foreach($this->shortcodes as $shortcode){
		// 	foreach($shortcode->getAssets('css') as $handler => $css){

		// 		if($css === true or wp_style_is($handler, 'registered') or wp_style_is($handler, 'enqueued')){
		// 			wp_enqueue_style($handler);
		// 		}else{
		// 			if(!wp_style_is($handler, 'registered') or !wp_style_is($handler, 'enqueued')){
		// 				$url = self::$paths->url->assets;
		// 				$url = AitShortcodesUtils::isExtUrl($css['file']) ? $css['file'] : $url . $css['file'];

		// 				wp_enqueue_style(
		// 					$handler,
		// 					$url,
		// 					isset($css['deps']) ? $css['deps'] : array(),
		// 					isset($css['ver']) ? $css['ver'] : false,
		// 					isset($style['media']) ? $style['media'] : 'all'
		// 				);
		// 			}
		// 		}
		// 	}
		// }

		// wp_enqueue_style(
		// 	'ait-toolkit-main-style',
		// 	self::$paths->url->assets . "/css/style.css"
		// );
	}



	/**
	 * Registers admin assets
	 */
	public function onEnqueueAdminAssets()
	{
		// foreach($this->shortcodes as $shortcode){

		// 	// CSS

		// 	foreach($shortcode->getAssets('admin-css') as $handler => $css){

		// 		if($css === true){
		// 			wp_enqueue_style($handler);
		// 		}else{
		// 			$url = self::$paths->url->assets;
		// 			$url = AitShortcodesUtils::isExtUrl($css['file']) ? $css['file'] : $url . $css['file'];

		// 			wp_enqueue_style(
		// 				$handler,
		// 				$url,
		// 				isset($css['deps']) ? $css['deps'] : array(),
		// 				isset($css['ver']) ? $css['ver'] : false,
		// 				isset($style['media']) ? $style['media'] : 'all'
		// 			);
		// 		}
		// 	}

		// 	// JS

		// 	foreach($shortcode->getAssets('admin-js') as $handler => $js){

		// 		if($js === true){
		// 			wp_enqueue_script($handler);
		// 		}else{
		// 			$url = self::$paths->url->assets;

		// 			$url = AitShortcodesUtils::isExtUrl($js['file']) ? $js['file'] : $url . $js['file'];

		// 			wp_enqueue_script(
		// 				$handler,
		// 				$url,
		// 				isset($js['deps']) ? $js['deps'] : array(),
		// 				isset($js['ver']) ? $js['ver'] : false,
		// 				true // in the footer by default
		// 			);

		// 			if(isset($js['localize'])){
		// 				wp_localize_script($handler, AitShortcodesUtils::dash2class($handler), $js['localize']);
		// 			}
		// 		}
		// 	}
		// }
	}



	public static function autoload($class)
	{
		if(class_exists($class, false)) return;

		if(substr($class, 0, 8) == 'AitToolkit'){

			$file = self::$paths->dir->lib . "/{$class}.php";

			if(file_exists($file)){
				require_once $file;
				return;
			}

			$file = self::$paths->dir->root . "/{$class}.php";

			if(file_exists($file)){
				require_once $file;
				return;
			}else{
				throw new Exception("Unable to find '{$class}' in file '{$file}'.");
			}
		}

		if(substr($class, 0, 3) == 'Ait'){

			$file = self::$paths->dir->lib . "/{$class}.php";

			if(file_exists($file)){
				require_once $file;
				return;
			}

			if(substr($class, -3) == 'Cpt'){

				$id = AitToolkitUtils::class2id($class, 'Cpt');

				$file = self::$paths->dir->cpts . "/{$id}/{$class}.php";

				if(file_exists($file)){
					require_once $file;
					return;
				}else{
					throw new Exception("Unable to find '{$class}' in file '{$file}'.");
				}
			}
		}
	}
}
