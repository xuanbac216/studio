<?php


spl_autoload_register(function($class){
	$file = '';

	$filename = str_replace(array('Ait\\', '\\'), array('', '/'), $class);

	if(substr($filename, 0, 9) === 'SystemApi'){
		$file = __DIR__ . "/{$filename}.php";
	}

	if($file and file_exists($file)){
		require_once $file;
	}
});
