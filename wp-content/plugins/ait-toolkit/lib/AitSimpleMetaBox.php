<?php

/*
 * AIT Toolkit WordPress Plugin
 *
 * Copyright (c) 2013, Affinity Information Technology, s.r.o. (http://ait-themes.com)
 */




class AitSimpleMetaBox
{

	/**
	 * Metabox internal ID
	 * @var int
	 */
	protected $internalId;

	/**
	 * Metabox public humand readable ID used in public APIs
	 * @var int
	 */
	protected $id;

	/**
	 * Metabox configuration params
	 * @var array
	 */
	protected $params;

	/**
	 * Meta key
	 * @var string
	 */
	protected $metaKey;

	/**
	 * Controls Renderer
	 * @var AitFormControlsRenderer
	 */
	protected $controls;

	/**
	 * Control key for HTML template mode
	 * @var string
	 */
	protected $metaboxControlKey = '';

	/**
	 * Control subkey for HTML template mode
	 * @var string
	 */
	protected $metaboxControlSubKey = '';

	protected $isClone = false;

	protected $cloneData;

	/** @internal */
	protected $storage = array();



	/**
	 * Constrcutor
	 * @param array $params Metabox configration params
	 */
	public function __construct($id, $internalId, $params)
	{
		if(is_numeric($internalId))
			wp_die('ID of metabox is not set or is numeric - must be alpha numeric string.');

		$this->id = $id;
		$this->internalId = $internalId;

		$defaultParams = array(
			'id'             => '',
			'title'          => __('Custom Meta Box', 'ait-toolkit'),
			'metaKey'        => '',
			'renderCallback' => '',
			'saveCallback'   => '',
			'config'         => '',
			'js'             => '',
			'css'            => '',
			'types'          => array('page'),
			'context'        => 'advanced', //('normal', 'advanced', or 'side').
			'priority'       => 'default', // ('high', 'core', 'default' or 'low')
			'args'           => array(),
		);

		$this->params = (object) array_merge($defaultParams, $params);

		$this->metaKey = !empty($this->params->metaKey) ? $this->params->metaKey : "_{$this->internalId}"; // underscore cause invisibility of meta key in custom fields

		add_action('add_meta_boxes', array($this,'init'));
		add_action('save_post', array($this,'save'));
	}



	public function init()
	{
		foreach ($this->params->types as $type){
			add_meta_box(
				$this->internalId . '-metabox',
				$this->params->title,
				array($this, 'render'),
				$type,
				$this->params->context,
				$this->params->priority,
				$this->params->args
			);
		}
	}



	public function render($post, $metabox)
	{
		if(!empty($this->params->css) and file_exists($this->params->css)){ ?>
		<style>
			<?php echo file_get_contents($this->css); ?>
		</style>
		<?php
		}

		if(!empty($this->params->js) and file_exists($this->params->js)){ ?>
		<script>
			<?php echo file_get_contents($this->params->js); ?>
		</script>
		<?php
		}

		$this->renderControls($post, $metabox);

		$this->nonceField();
	}



	protected function renderControls($post, $metabox)
	{
		$defaults = $this->getConfigDefaults();
		$meta = $this->getPostMeta();
		$values = array_replace_recursive($defaults, $meta);

		$config = $this->getRawConfig();

		foreach($config as $key => $params){
			if($params instanceof NNeonEntity) continue;

			$value = isset($values[$key]) ? $values[$key] : '';
			$label = isset($params['label']) ? $params['label'] : '';

			?><div class="ait-opt"><?php

			switch($params['type']){
				case 'clone':

					$this->isClone = true;
					foreach($value as $i => $row){
						foreach($row as $k => $v){
							$this->cloneData = (object) array('key' => $k, 'value' => $v, 'index' => $i);

							$l = isset($params['items'][$k]['label']) ? $params['items'][$k]['label'] : '';
							$p = isset($params['items'][$k]) ? $params['items'][$k] : array();

							?><div class="ait-opt-clone"><?php
							$this->renderControl($key, $p, $l, $v);
							?></div><?php
 						}
					}

					break;
				default:
					$this->renderControl($key, $params, $label, $value);
			}

			?></div><?php
		}
	}


	public function renderControl($key, $params, $label, $value)
	{
		switch($params['type']){
			case 'textarea':
				$this->control($key);
				$this->label($label);
				printf('<textarea id="%s" name="%s">%s</textarea>', $this->getHtmlId(), $this->getHtmlName(), esc_textarea($this->getValue($value)));
				break;

			case 'select':
				$o = '';
				$this->control($key);
				$this->label($label);

				foreach($params['default'] as $k => $v){
					$o .= sprintf('<option value="%s">%s</options>', esc_attr($k), esc_html($v));
				}
				printf('<select id="%s" name="%s">%s</select>', $this->getHtmlId(), $this->getHtmlName(), $o);
				break;

			case 'radio':
				$this->control($key);
				$this->label($label, true);
				foreach($params['default'] as $k => $v){
					printf('<input type="radio" id="%s" name="%s" value="%s" %s>', $this->getHtmlId($k), $this->getHtmlName(), esc_attr($k), checked($k, $value, false));
					$this->label($v, false, $k);
				}
				break;

			default:
				$this->control($key);
				$this->label($label);
				printf('<input type="text" id="%s" name="%s" value="%s">', $this->getHtmlId(), $this->getHtmlName(), esc_attr($this->getValue($value)));
		}
	}


	public function getId()
	{
		return $this->id;
	}



	public function getInternalId()
	{
		return $this->internalId;
	}



	public function getPostMetaKey()
	{
		return $this->metaKey;
	}



	public function getRawConfig()
	{
		if(!isset($this->storage['raw-config']))
			$this->storage['raw-config'] = AitToolkitUtils::loadRawConfig($this->params->config);

		return $this->storage['raw-config'];
	}



	protected function processConfig()
	{
		$rawConfig = $this->getRawConfig();

		$defaults = array();

		foreach($rawConfig as $optionKey => $val){
			if($val instanceof NNeonEntity) continue;
			if(isset($val['default'])){

				if($val['type'] == 'select'){
					if(isset($val['selected']) and $val['selected']){
						$defaults[$optionKey] = $val['selected'];
					}else{
						$defaults[$optionKey] = key(array_shift($val['default']));
					}

				}elseif($val['type'] == 'radio'){
					if(isset($val['checked']) and $val['checked']){
						$defaults[$optionKey] = $val['checked'];
					}else{
						$defaults[$optionKey] = key(array_shift($val['default']));
					}
				}else{
					$defaults[$optionKey] = $val['default'];
				}

			}else{
				$defaults[$optionKey] = '';
			}
		}

		return $defaults;
	}



	public function getConfigDefaults()
	{
		if(!isset($this->storage['defaults'])){
			$this->storage['defaults'] = $this->processConfig();
		}

		return $this->storage['defaults'];
	}



	public function getPostMeta($postId = 0)
	{
		if(!$postId){
			global $post;
			$postId = $post->ID;
		}

		if(!isset($this->storage['meta' . $postId])){
			$meta = get_post_meta($postId, $this->metaKey, true);

			if($meta !== ''){
				$this->storage['meta' . $postId] = $meta;
			}else{
				$this->storage['meta' . $postId] = array();
			}
		}

		return $this->storage['meta' . $postId];

	}



	public function nonceField()
	{
		wp_nonce_field($this->internalId, $this->metaKey . '_nonce');
	}



	public function verifyNonce()
	{
		$nonce = isset($_POST[$this->metaKey . '_nonce']) ? $_POST[$this->metaKey . '_nonce'] : null;

		return wp_verify_nonce($nonce, $this->internalId);
	}



	public function save($postId, $post = '')
	{
		if(!is_object($post))
			$post = get_post();

		if(!empty($this->params->saveCallback) and  is_callable($this->params->saveCallback)){

			call_user_func_array($this->params->saveCallback, array($postId, $post, $this));

		}else{
			$realPostId = isset($_POST['post_ID']) ? $_POST['post_ID'] : null;

			if(defined('DOING_AUTOSAVE') AND DOING_AUTOSAVE)
				return $postId;

			if(!$this->verifyNonce())
				return $postId;

			if($_POST['post_type'] == 'page')
				if(!current_user_can('edit_page', $postId))
					return $postId;
			else
				if(!current_user_can('edit_post', $postId))
					return $postId;

			$data = isset($_POST[$this->metaKey]) ? $_POST[$this->metaKey] : null;

			if (is_null($data))
				delete_post_meta($postId, $this->metaKey);
			else
				update_post_meta($postId, $this->metaKey, $data);

			return $postId;
		}
	}



	// ==========================================================
	// Helper methods for HTML template mode
	// ----------------------------------------------------------

	/**
	 * Sets control key and subkey
	 * @param  string $key    Key of control, will be used in id, name attribute
	 * @param  string $subKey
	 * @return void
	 */
	public function control($key, $subKey = null)
	{
		$this->metaboxControlKey = $key;
		$this->metaboxControlSubKey = $subKey;
	}



	/**
	 * Gets id of control
	 * @return string
	 */
	public function getHtmlId($subkey = '')
	{
		if(!$subkey)
			$subkey = $this->metaboxControlSubKey;

		$clone = '';
		if($this->isClone){
			$clone = $this->cloneData->index . $this->cloneData->key;
		}
		return $this->metaKey . $this->metaboxControlKey . $subkey . $clone;
	}



	/**
	 * Prints id attribute
	 */
	public function id()
	{
		echo ' id="' . $this->getHtmlId() . '"';
	}



	/**
	 * Gets name of control
	 * @return string
	 */
	public function getHtmlName()
	{
		$n = "{$this->metaKey}[{$this->metaboxControlKey}]";

		if($this->metaboxControlSubKey)
			$n .= "[$this->metaboxControlSubKey]";

		if($this->isClone){
			$n .= "[{$this->cloneData->index}][{$this->cloneData->key}]";
		}

		return $n;
	}



	/**
	 * Prints name attribute of control
	 */
	public function name()
	{
		echo ' name="' . $this->getHtmlName() . '"';
	}



	/**
	 * Gets value of control
	 * @param  mix  $default Default value if there is no value
	 * @param  boolean $escape  If value is string should it be escaped?
	 * @return mix
	 */
	public function getValue($default = '')
	{
		$v = $this->getPostMeta();

		$k = &$this->metaboxControlKey;

		if(!$this->isClone){
			if(isset($v[$k]))
				return $v[$k];
		}else{
			$d = &$this->cloneData;

			if(isset($v[$k][$d->index][$d->key]))
				return $v[$k][$d->index][$d->key];
		}

		return $default;
	}



	/**
	 * Prints value attribute of control
	 * @param  string  $default
	 * @param  boolean $escape
	 */
	public function value($default = '')
	{
		echo ' value="' . esc_attr($this->getValue($default)) . '"';
	}



	/**
	 * Prints <label> element for control
	 * @param  string $text Label text
	 */
	public function label($text = 'Label', $special = false, $subkey = '')
	{
		if($special)
			echo '<span>' . esc_html($text) . '</span>';
		else
			echo '<label for="' . $this->getHtmlId($subkey) .  '">' . esc_html($text) . '</label>';
	}
}
