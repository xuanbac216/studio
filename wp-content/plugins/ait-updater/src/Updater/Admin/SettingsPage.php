<?php

namespace Ait\Updater\Admin;

use Ait\Updater\ThemesAndPluginsDetector as Detector;


class SettingsPage
{
	protected $updater;

	private static $instance;

	private $pageHookname;

	protected $settings = array();

	protected static $pageSlug = 'ait-updater-settings';



	public function run($updater)
	{
		$this->updater = $updater;

		if(is_multisite()){
			add_action('network_admin_menu', array($this, 'onNetworkAdminMenuCallback'), 12);
		}else{
			add_action('admin_menu', array($this, 'onAdminMenuCallback'), 12);
		}

		if(self::shouldRun()){
			add_action('admin_init', array($this, 'onAdminInitCallback'));
		}

	}



	public function onAdminMenuCallback()
	{
        if(!defined('AIT_SKELETON_VERSION')){
            $this->pageHookname = add_menu_page(
                sprintf(_x('%s Settings', 'AIT Updater', 'ait-updater'), 'AIT Updater'),
                'AIT Updater',
                'manage_options',
                self::$pageSlug,
                array($this, 'render'),
                'dashicons-admin-generic'
            );
		}else{
            $this->pageHookname = add_submenu_page(
                'ait-theme-options',
                sprintf(_x('%s Settings', 'AIT Updater', 'ait-updater'), 'AIT Updater'),
                'AIT Updater',
                'manage_options',
                self::$pageSlug,
                array($this, 'render'),
                'dashicons-admin-generic'
            );
        }

		add_action('load-' . $this->pageHookname, array($this, 'onPageLoadCallback'));
	}



	public function onNetworkAdminMenuCallback()
	{
		$this->pageHookname = add_menu_page(
			sprintf(_x('%s Settings', 'AIT Updater', 'ait-updater'), 'AIT Updater'),
			'AIT Updater',
			'manage_options',
			self::$pageSlug,
			array($this, 'render'),
			'dashicons-admin-generic'
		);

		add_action('load-' . $this->pageHookname, array($this, 'onPageLoadCallback'));
	}



	public function onAdminInitCallback()
	{
		$this->initSettings();
		$this->registerSettings();

		add_action('admin_head-' . $this->pageHookname, array($this, 'printStyles'));
		add_action('admin_head-' . $this->pageHookname, array($this, 'printScripts'));
	}



	protected function initSettings()
	{
		$this->settings = array();

		$this->settings['api_credentials'] = array(
			'title' => '<img style="vertical-align:bottom;" height="24px" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAIAAAD8GO2jAAAABnRSTlMAAAAAAABupgeRAAAACXBIWXMAAA7EAAAOxAGVKw4bAAAEKUlEQVR42uVWXUxbZRj+3q/nrH8ra0s7KTAFQg3/7VaQLcroqjO6CnEwyS68MpFde4WJXOIdMfHKGAl6AZq4MJK5RaRxP2YxK5EMNlKGdMhfQ0+7cmoLbek553u9wAAuK8Iy4oXf3ck57/PkPc/zPu8HFovFaDQCAHneBxHj8Tg9IHRCCAAYjUZ6QOhbHJQc8PlfEyAqhCgEANkuX3F7gFEYxxMkVJFAxW3Jp3vtnLvlPY7jbl2/krh1lTBl/wSIauerFSfd9ooqWZYfzUxP37wmBx8AAelEs8Vx6teBL5Ap5tMtf8qM3h7Gp1lGlZ+fnwudNrfWvfGuzVaoZNYR8YjVpi6rjkgKCT1ab27L/HI1M31vI7oirizKJ9x06i5B3GsHQEimsr6gqiESDk18+XU2ugIAfMGxly5cyjve9HhhBoGilP17hqQsAiAQ2IfIjKVLqhji0nA/iwkcpSoAJiz98eN3lMBaRYNuPlB49gJ3tIiz2GxvXTwUnqeytA8NkOezeeZ0Ik7EyM7GcP5hOr2eMb1guvZVxnK09ZPPeF5148You3mF5phZLpcABBFUT9YgoYRSggwURfzhmyHfZQSgqTVK6f7mAGTpUCKm0x8BSyEhuMXK2Wu0aq02HiGKTIBqi0vzyiqQ53eJsxwuAkplSW+vLa57ZW01urEaYZTqqlxlb19MZiX282WQstr2S+WOelNxCTqbk4FxyKEB2O32nDZtPFv3essxs4mnSIDKCgkK0YBvCCbupG0lGk87DvQCU/jWD+LLc4fv38Gn+YjbJWqZ3ze5HEy436mudciyHJiaWPhpiKxGkFIEQERCkBBgjGHuVM7dwbZlFRkoQeQY4160F1bWLd3zs3hEd/7DUmMelTYE3iB8+zlNr+1Hgyf0AKAAit6gO/d+dvaBytOeDfymTPlTmcx6LBob/Z5mM88cdjs60egT4UW4f5dW1CsaPd1IrwfGN8f++cQ1L0YsOt2pj3t18Sgff7zXrfnvGvzDWkwBqmKMUHowCweoipC9o/9HK1OtVu98NJvNHMc9M8F2ZVtbW0dHR2dnp9frTSaToih2dXUpiiIIQk9Pz/Ly8u5AlW+eP2wtWIuGk9EVW9VxRZIe+oZTYmyb4MyZMyqVqra21ul0ulyugYEBn88XCoUaGxv7+vpGRkY8Hg8hJBgM2u12k8k0ODjY3t7u8/m8Xm93d7eu4XRs/vf80peLnSc31pNqvUFrzN8m4DiupqZGEISmpiZCyPj4+OLiYnV19ebb/v5+j8dTVFTk9/t5np+ZmSGEOBwOURQFQQgEAgaD4fqnH+32i0wmU29v7+TkpMvlSqVS0WjUarWOjY0lEolkMhkKhURRHB0dtVqtc3NzmyXhcNjtdi8sLBgMhtnZ2Zy+Ky8vP7jrKSKqKKUajebgru9/AVc83I8ViiPzAAAAAElFTkSuQmCC"> ' .
				__('AitThemes.Club API Credentials', 'ait-updater'),
			// 'description' => array($this, 'renderClubCredentialsDescription'),
			'fields' => array(
				'username' => array(
					'label' => __('Username', 'ait-updater'),
					'type' => 'text',
					'description' => __('Username which you are using to login to AitThemes.club.', 'ait-updater'),
				),
				'api_key' => array(
					'label' => __('API Key', 'ait-updater'),
					'type' => 'text',
					/* translators: Those %s are opening and closing html tags, wrapping that text between them */
					'description' => sprintf(__('You can get your API key in your %saccount on AitThemes.club%s.', 'ait-updater'), '<strong><a href="https://system.ait-themes.club/account/api" target="_blank">', '</strong></a>'),
					'validation_error_msg' => $this->updater->getErrorMessage('invalid_api_key'),
				),
			),
		);

		if(Detector::isThereAnyThemeforestThemes()){
			$this->settings['envato_api_credentials'] = array(
				'title' => '<img style="vertical-align:bottom;" height="24px" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAABmJLR0QA/wD/AP+gvaeTAAAACXBIWXMAAABIAAAASABGyWs+AAACYUlEQVRYw+3XT4hNYRjH8Q9mmhl/mhlKjCnyX4yIkCKkpkYWdnaKZEWz8G9jyNbCwpaiLFgrm1FjVsjGsEFKSJIymdTIzBiL99xx5p1z7ty5c2Tjtzn3POfP7/s+53nf97n8Y80o+oWX7+8tvbc2Of7EaFdHz98BSAyhCeuxBRvQmkB04xoGsyCmBZAa7S5cxDbMjW77geO4DTHEzGma1+IY7mBfhjnUJwBNWe+pCiAxr8cZXMXiSR7Ziu2FAKRGfhoXckYdazbaU89XB5B6+CjOJ1moVDtlfIaKAVLmu4WCmzPF5K3EsjhYU8asGR24h4Hk0gJ0mfybZ6kZ6/CsbAYS8xqcw6kI8jD2VGFe8lobZXM8QOrCAZzEK/QnsUXClJtVJQAsF609WTXQhE6hct9gNInvR9s0zAmfri4TICqyHcnvr8mxBgfl1MwU1CyaOVkZaE/dVLq+RFhMpquG3AwkmodNUcpgNVoKAKiNPWOARqHYSmoTim6VqS06efrlT01lAtRFRpsT89YCzGFQ6A9yAYYxlDpvEeZ+NQtPlvqF7XlMcVUPCJW/NBXrxEhBAO+TLORmYAAvo1gj5hcE0GeSGhjBw/imgvQNjxnfFY0BpILdwgpYtJ7geRzMWoje4lbBWRjEDXwvC5DKwnX0FghwV9jWK25KP+OsiQVZjXpxSVT9uQApwqdCN9tXpfEoHuAE3mWNnjL/C1K74xqh+TwkbNGVqB83cQWf8szLAkQQDUI/cERoLhea2JgM4SN6EvNHGMozrgggA6RO6Go2YoWwv//CF7zGC3zA8GTG/1XSb/xmhFssFUHGAAAAJXRFWHRjcmVhdGUtZGF0ZQAyMDEzLTA2LTEzVDAwOjA4OjU5LTA0OjAwhBzi4QAAACV0RVh0bW9kaWZ5LWRhdGUAMjAxMy0wNi0xM1QwMDowODo1OS0wNDowMNutlNUAAAAZdEVYdFNvZnR3YXJlAEFkb2JlIEltYWdlUmVhZHlxyWU8AAAAAElFTkSuQmCC"> ' .
					__('Envato API Credentials', 'ait-updater'),
				// 'description' => array($this, 'renderEnvatoCredentialsDescription'),
				'fields' => array(
					'envato_username' => array(
						'label' => __('Marketplace Username', 'ait-updater'),
						'type' => 'text',
						'description' => __('Username which you are using to login to ThemeForest.', 'ait-updater'),
					),
					'envato_api_key' => array(
						'label' => __('Secret API Key', 'ait-updater'),
						'type' => 'text',
						/* translators: Those %s are opening and closing html tags, wrapping that text between them */
						'description' => __('You can get your API key <strong>on ThemeForest</strong> in <strong>Your Account -&gt; Settings -&gt; API Keys</strong>.', 'ait-updater'),
						'validation_error_msg' => $this->updater->getErrorMessage('invalid_envato_api_key'),
					),
				),
			);
		}

		$this->settings['backup'] = array(
			'title' => __('Backup', 'ait-updater'),
			'fields' => array(
				'do_backup' => array(
					'label' => __('Do backup', 'ait-updater'),
					'type' => 'checkbox',
					'callback' => array($this, 'renderDoBackupField'),
				),
			),
		);
	}



	public function onPageLoadCallback()
	{
		$this->processFormRequest();
	}



	protected function processFormRequest()
	{
		if(isset($_POST['option_page']) and isset($_POST['action'])){

			check_admin_referer($_POST['option_page'] . '-options' );

			$options = $_POST[$_POST['option_page']];

			$this->updater->updateOptions($options);

			if(!count(get_settings_errors())){
				add_settings_error($this->updater->getOptionsKey(), 'settings_updated', __('Settings saved.', 'ait-updater'), 'updated');
			}
			set_transient('settings_errors', get_settings_errors(), 30);

			$goback = add_query_arg('settings-updated', 'true',  wp_get_referer());
			wp_redirect(esc_url_raw($goback));
			exit;
		}
	}



	protected function registerSettings()
	{
		register_setting(
			$this->updater->getOptionsKey(),
			$this->updater->getOptionsKey(),
			array($this->updater, 'validateOptions')
		);

		foreach($this->settings as $sectionName => $section){
			add_settings_section(
				$sectionName,
				$section['title'],
				array($this, 'renderSectionCallback'),
				self::$pageSlug
			);
			foreach($section['fields'] as $fieldname => $field){
				$this->settings[$sectionName]['fields'][$fieldname]['section'] = $sectionName;
				$this->settings[$sectionName]['fields'][$fieldname]['name'] = $fieldname;
				add_settings_field(
					$fieldname,
					$field['label'],
					array($this, 'renderFieldCallback'),
					self::$pageSlug,
					$sectionName,
					array(
						'label_for' => $fieldname,
						'_field' => array_merge(array('section' => $sectionName, 'name' => $fieldname), $field),
					)
				);
			}
		}
	}



	public function renderSectionCallback($section)
	{
		$settings = $this->settings[$section['id']];
		if(isset($settings['description'])){
			if(is_callable($settings['description'])){
				call_user_func($settings['description']);
			}elseif(is_string($settings['description'])){
				echo $settings['description'];
			}
		}
	}



	public function renderFieldCallback($args)
	{
		$_f = $args['_field'];
		$field = $this->settings[$_f['section']]['fields'][$_f['name']];

		if(!empty($field['callback'])){
			call_user_func($field['callback'], (object) $field);
		}else{
			$method = 'render' . ucfirst($field['type']) . 'Field';
			call_user_func(array($this, $method), (object) $field);
		}
	}



	public function renderTextField($field)
	{
		$nameAttr = $this->updater->getOptionsKey() . "[{$field->name}]";
		?>
		<input type="text" name="<?php echo $nameAttr ?>" id="<?php echo $field->name ?>" class="regular-text code" value="<?php echo $this->updater->getOption($field->name) ?>">
		<div id="<?php echo $field->name ?>-error-msg" class="hidden ait-updater-error-msg"><?php echo $this->updater->getErrorMessage("invalid_{$field->name}", false) ?></div>

		<?php if(!empty($field->description)): ?>
			<p class="description">
				<?php echo $field->description ?>
			</p>
		<?php endif;
	}



	public function renderDoBackupField($field)
	{
		$nameAttr = $this->updater->getOptionsKey() . "[{$field->name}]";
		?>
		<?php if(!class_exists('\ZipArchive')): ?>
		<p class="description">
			<?php _e('PHP ZipArchive class for making zip files from PHP is not available, therefore backup option and backuping old versions is not available for you. Please contact server admin.', 'ait-updater') ?>
		</p>
		<?php else: ?>
		<p class="description">
				<input type="checkbox" name="<?php echo $nameAttr ?>" id="<?php echo $field->name ?>"  <?php checked(1, $this->updater->getOption($field->name)) ?> value="1">
				<?php printf(__('Whether to do backup of old version plugin or theme before update. Backups will be stored in %s.', 'ait-updater'), '' . str_replace(ABSPATH, '', $this->updater->path('backups')) . '</small>' ) ?>
		</p>
		<?php $oldBackups = glob($this->updater->path('backups') . '/ait-*.zip' ) ?>
		<?php if(!empty($oldBackups)): ?>
		<h4><?php _e('List of old backups', 'ait-updater') ?></h4>
		<pre><?php foreach($oldBackups as $file): ?><a href="<?php echo esc_url($this->updater->url('backups') . '/' . basename($file)) ?>"><?php printf(basename($file)) ?></a><br><?php endforeach ?></pre>
		<?php endif ?>
		<?php
		endif;
	}



	public function render()
	{
		?>
		<div class="wrap">
		<h2><?php printf(_x('%s Settings', 'AIT Updater', 'ait-updater'), 'AIT Updater') ?></h2>
		<?php settings_errors() ?>
		<form method="post">
		<?php
			settings_fields($this->updater->getOptionsKey());
			do_settings_sections(self::$pageSlug);
			submit_button();
		?>
		</form>
		</div>
		<?php
	}



	protected function renderClubCredentialsDescription()
	{
		$aitThemes = Detector::getAitClubThemes();
		$aitPlugins = array_keys(Detector::getAitPluginsExceptPrepackedAndFree());

		if(!empty($aitThemes) or !empty($aitPlugins)){
			echo '<p>' . __('You need to enter credentials to receive updates for these installed AitThemes.Club products:', 'ait-updater') . '</p>';
		}else{
			echo '<p class="description">' . __('You don\'t have any products from AitThemes.Club. You don\'t need to enter credentials here.', 'ait-updater') . '</p>';
		}

		if(!empty($aitThemes)){
			$themes = wp_get_themes();
			$themeList = array();
			foreach($aitThemes as $theme => $v){
				if(isset($themes[$theme])){
					$themeList[] = sprintf('<strong title="wp-content/themes/%s">%s</strong>', $theme, $themes[$theme]->Name);
				}
			}
			echo '<p>' . sprintf(__('Themes: %s', 'ait-updater'), implode(', ', $themeList)) . '</p>';
		}

		if(!empty($aitPlugins)){
			$plugins = get_plugins();
			$pluginList = array();
			foreach($plugins as $basename => $data){
				$dirname = dirname($basename);
				if(in_array($dirname, $aitPlugins)){
					$pluginList[] = sprintf('<strong title="wp-content/plugins/%s">%s</strong>', $dirname, $data['Name']);
				}
			}
			echo '<p>' . sprintf(__('Plugins: %s', 'ait-updater'), implode(', ', $pluginList)) . '</p>';
		}
	}



	protected function renderEnvatoCredentialsDescription()
	{
		$aitThemes = Detector::getAitThemeforestThemes();

		if(!empty($aitThemes)){
			echo '<p>' . __('You need to enter credentials to receive updates for these installed ThemeForest products:', 'ait-updater') . '</p>';
			$themeList = array();
			$themes = wp_get_themes();
			foreach($aitThemes as $theme => $v){
				if(isset($themes[$theme])){
					$themeList[] = sprintf('<strong title="wp-content/themes/%s">%s</strong>', $theme, $themes[$theme]->Name);
				}
			}
			echo '<p>' . sprintf(__('Themes: %s', 'ait-updater'), implode(', ', $themeList)) . '</p>';
		}
	}



	public function printStyles()
	{
		?>
		<style>
			input.ait-field-ok, input.ait-field-ok:focus {
			    color: #4CAF50;
			    border-color: #8BC34A;
			    box-shadow: 0 0 2px #8BC34A;
			}
			input.ait-field-ok + b {
				color: #4CAF50;
			}
			input.ait-field-error, input.ait-field-error:focus {
			    color: #d54e21;
			    border-color: #d54e21;
		        box-shadow: 0 0 2px #d54e21;
			}
			.ait-updater-error-msg {
				color: #d54e21;
				padding: 0.4em 0;
				opacity: 1;
				transition: all 0.2s;
				line-height: inherit;
			}
			.ait-updater-error-msg.hidden{
				opacity: 0;
				display: block;
				line-height: 0;
				transition: all 0.2s;
			}
		</style>
		<?php
	}



	public function printScripts()
	{
		?>
		<script>
			jQuery(function($){
				var $inputs = $('input[type="text"]');

				var delay = (function(){
					var timer = 0;
					return function(callback, ms){
						clearTimeout (timer);
						timer = setTimeout(callback, ms);
					};
				})();

				var showError = function($input){
					var $msg = $input.next('.ait-updater-error-msg');
					$input.removeClass('ait-field-ok');
					$input.addClass('ait-field-error');
					$input.next('b').remove();
					$msg.removeClass('hidden');
				};

				var hideError = function($input){
					var $msg = $input.next('.ait-updater-error-msg');
					$input.removeClass('ait-field-error');
					$input.addClass('ait-field-ok');
					if($input.next('b').length == 0){
						$input.after('<b> ✓</b>');
					}
					$msg.addClass('hidden');
				};

				var checkKey = function($input){
					var id = $input.attr('id');
					var key = $input.val();
					if(id.indexOf('api_key') > -1){
						if(id == 'api_key'){
							key.length != 64 ? showError($input) : hideError($input);
						}
						if(id == 'envato_api_key'){
							key.length != 32 ? showError($input) : hideError($input);
						}
					}
				}

				$inputs.on('keyup', function(){
					var $input = $(this);
					delay(function(){
						checkKey($input);
					}, 250);
				});

				$inputs.each(function(){
					checkKey($(this));
				});
			});
		</script>
		<?php
	}



	public static function shouldRun()
	{
		return(isset($_GET['page']) and $_GET['page'] === self::$pageSlug);
	}



	public static function getPageSlug()
	{
		return self::$pageSlug;
	}



	public static function getInstance()
	{
		if(!self::$instance){
			self::$instance = new self;
		}

		return self::$instance;
	}


}
