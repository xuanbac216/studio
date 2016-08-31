<?php

/*
 * AIT Shortcodes WordPress Plugin
 *
 * Copyright (c) 2013, Affinity Information Technology, s.r.o. (http://ait-themes.com)
 */


/**
 * Base Shortcode class
 */
class AitShortcode
{
	/**
	 * ID, name of shortcode
	 * @var string
	 */
	protected $name;

	/**
	 * Title
	 * @var string
	 */
	protected $title = '';

	/**
	 * Shortcode attributes
	 * @var array
	 */
	protected $attrs = array();

	/**
	 * Options for Ait controls renderer in the shortcode generator
	 * @var array
	 */
	protected $options = array();

	/**
	 * Absolute path to shortcode template. If templete doesn't exist it is false
	 * @var string|false
	 */
	protected $template = '';

	/**
	 * Flag whether shortcode is using template or overrided render method
	 * @var bool
	 */
	protected $templateName = '';

	/**
	 * Part of path to templete file. Just for informative purposes and as helper var
	 * @var string
	 */
	protected $templateFile;

	/**
	 * Type of shortcode, can be single, closed, self-closing
	 * @var string
	 */
	protected $type = 'single';

	/**
	 * How many is shortcode rendered on page
	 * @var int
	 */
	protected $renderCounter = 0;

	/**
	 * Assets for shortcode
	 * @var array
	 */
	protected $assets = array(
		'css'       => array(),
		'js'        => array(),
		'admin-js'  => array(),
		'admin-css' => array(),
	);

	/**
	 * Paths
	 * @var stdClass
	 */
	protected $paths;

	/**
	 * Paths of Ait Theme structure
	 * @var stdClass
	 */
	protected $aitThemePaths;

	/**
	 * Flag whether shortcode is configured from theme
	 * @var boolean
	 */
	protected $isFromAitTheme = false;

	/**
	 * Is this shortcode child of another one?
	 * @var boolean
	 */
	protected $isChild = false;

	/**
	 * Additional params for configuration of shortcode
	 * @var array
	 */
	protected $params = array();

	/** @internal **/
	protected $ocache = array();



	public function __construct($name, $config, $isFromAitTheme = false)
	{
		$this->name = $name;
		$this->title = isset($config['title']) ? $config['title'] : $this->name;
		$this->isFromAitTheme = $isFromAitTheme;

		if(isset($config['configuration']['type']))
			$this->type = $config['configuration']['type'];

		if(isset($config['configuration']['is-child']))
			$this->isChild = $config['configuration']['is-child'];

		if(isset($config['attrs']))
			$this->attrs = $config['attrs'];

		if(isset($config['options']))
			$this->options['options'] = $config['options'];

		if(isset($config['configuration']['assets']))
			$this->assets = array_merge($this->assets, $config['configuration']['assets']);

		$this->paths = $config['paths'];

		if(!empty($config['ait-theme-paths']))
			$this->aitThemePaths = (object) $config['ait-theme-paths'];

		$t = isset($config['configuration']['template']) ? $config['configuration']['template'] : false;

		if($t and $t !== $this->name)
			$this->templateName = $t;
		else
			$this->templateName = $this->name;

		$this->params = array_diff_key(
			$config['configuration'],
			array(
				'class'    => true,
				'is-child' => true,
				'type'     => true,
				'assets'   => true,
				'template' => true,
			)
		);

		$this->init();
	}



	protected function init()
	{
		// to be overriden in extending class
	}



	public function __get($name)
	{
		$method = 'get' . ucfirst($name);

		if(method_exists($this, $method))
			return $this->$method();

		return null;
	}



	public function isChild()
	{
		return $this->isChild;
	}



	public function getName()
	{
		return $this->name;
	}



	public function getType()
	{
		return $this->type;
	}



	public function getTitle()
	{
		return $this->title;
	}



	public function getAttrs()
	{
		return $this->attrs;
	}



	public function getOptions()
	{
		return $this->options;
	}



	public function getAssets($type = null)
	{
		if($type)
			return $this->assets[$type];

		return $this->assets;
	}



	public function getScPrefix()
	{
		return "ait-sc-";
	}



	public function getHtmlId()
	{
		return "ait-sc-{$this->name}-{$this->renderCounter}";
	}



	public function getHtmlIdPrefix()
	{
		return "ait-sc-{$this->name}-";
	}



	public function getHtmlClass()
	{
		return "ait-sc-" . $this->name;
	}



	public function getTemplate()
	{
		if(isset($this->ocache['template']))
			return $this->ocache['template'];

		$t = "/{$this->templateName}.php";

		if($this->aitThemePaths){
			if(file_exists($this->aitThemePaths->dir->child . $t)){
				$this->template = $this->aitThemePaths->dir->child . $t;
			}elseif(file_exists($this->aitThemePaths->dir->parent . $t)){
				$this->template = $this->aitThemePaths->dir->parent . $t;
			}
		}

		if(!$this->template){
			if(file_exists($this->paths->dir->templates . "/$t"))
				$this->template = $this->paths->dir->templates . "/$t";
			else
				return false;
		}

		$this->ocache['template'] = $this->template;

		return $this->template;
	}




	final protected function content($content)
	{
		return apply_filters('ait-shortcode-content', $content, $this->name);
	}



	/**
	 * Handler function for add_shortcode()
	 * @param  array $attrs     An associative array of attributes
	 * @param  string $content The enclosed content (if the shortcode is used in its enclosing form)
	 * @param  string $shortcode     the shortcode tag
	 */
	public function prepareRender($attrs, $content, $shortcode)
	{
		$attrs = shortcode_atts($this->attrs , $attrs);

		if($this->renderCounter == 0)
			$this->enqueueJs();

		$this->renderCounter++;

		return $this->render((object) $attrs, $content, $shortcode);
	}



	/**
	 * Shortcode render.
	 * Can be overrided if shortcode no needs template,
	 * and generating output can be done in this method.
	 *
	 * @param  stdClass $attrs        Attributes of shortcode
	 * @param  string|null $content   Content of paired shortcode
	 * @param  string $shortcode      Shortcode name
	 * @return string                 Result of shortcode
	 */
	public function render($attrs, $content, $shortcode)
	{
		if(!$this->getTemplate()){
			return
				"<p style='color:red;'>" .
					sprintf(
						"Template file for shortcode '%s' does not exist.",
						"<strong><code>{$shortcode}</code></strong>"
					) .
				"</p>";
		}else{
			ob_start();
			$this->renderTemplate($attrs, $content, $shortcode);
			return ob_get_clean();
		}
	}



	/**
	 * Template "renderer".
	 * Can be overrided if templete needs some prepared data.
	 * Some programming should not be done in template, so do it in this method,
	 * and pass data to template.
	 *
	 * @param  stdClass $attrs        Attributes of shortcode
	 * @param  string|null $content   Content of paired shortcode
	 * @param  string $shortcode      Shortcode name
	 * @return string                 Result of shortcode
	 */
	protected function renderTemplate($attrs, $content, $shortcode)
	{
		include $this->getTemplate();
	}



	/**
	 * Simple version of wp_localize_script(), just for shortcode templates
	 * @param  string $objectName Name for the created JS object.
	 *                            This is passed directly so it should be qualified JS variable /[a-zA-Z0-9_]+/
	 * @param  stdClass $attrs     Attributes of shortcode
	 * @return void
	 */
	protected function attrs2js($objectName, $attrs)
	{
		echo "var {$objectName} = " . json_encode($attrs) . ";\n";
	}



	protected function enqueueJs()
	{
		foreach($this->assets['js'] as $handler => $js){

			if($js === true or wp_script_is($handler, 'registered') or wp_script_is($handler, 'enqueued')){
				wp_enqueue_script($handler);
			}else{
				if(!wp_script_is($handler, 'registered') or !wp_script_is($handler, 'enqueued')){
					$url = $this->paths->url->assets;

					if(AitShortcodesUtils::isExtUrl($js['file']))
						$url = $js['file'];
					else
						$url = $url . $js['file'];

					wp_enqueue_script(
						$handler,
						$url,
						isset($js['deps']) ? $js['deps'] : array(),
						isset($js['ver']) ? $js['ver'] : false,
						true // in the footer by default
					);
				}
			}
		}
	}

}
