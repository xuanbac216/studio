<?php

/*
 * AIT Toolkit WordPress Plugin
 *
 * Copyright (c) 2013, Affinity Information Technology, s.r.o. (http://ait-themes.com)
 */




class AitToolkitUtils
{

	public static function loadRawConfig($file)
	{
		if(!class_exists('NNeon', false))
			require_once dirname(__FILE__) . '/NNeon.php';

		if(file_exists($file)){
			$content = @file_get_contents($file);

			if($content === false){
				trigger_error("Config file '{$filename}' is unreadable.", E_USER_WARNING);
				return array();
			}

			$config = (array) NNeon::decode($content);

			return $config;

		}else{
			trigger_error("Config file '{$file}' does not exist.");
			return array();
		}
	}



	public static function isAjax()
	{
		return (defined('DOING_AJAX') and DOING_AJAX === true);
	}



	/**
	 * Checks if given url is absolute url
	 * @param  string  $url Absolute URL to http resource
	 * @return boolean
	 */
	public static function isAbsUrl($url)
	{
		$url = trim($url);
		return (self::startsWith('http', $url) or self::startsWith('//', $url));
	}



	/**
	 * Checks if given url points to external resource.
	 * @param  string  $url Absolute URL to http resource
	 * @return boolean
	 */
	public static function isExtUrl($url)
	{
		$url = trim($url);
		$parts = parse_url($url);
		return ((self::startsWith('http', $url) or self::startsWith('//', $url)) and !(isset($parts['host']) and self::contains(site_url(), $parts['host'])));
	}



	/**
	 * Starts the $haystack string with the prefix $needle?
	 * @param  string
	 * @param  string
	 * @return bool
	 */
	public static function startsWith($needle, $haystack)
	{
		return strncmp($haystack, $needle, strlen($needle)) === 0;
	}



	/**
	 * Does $haystack contain $needle?
	 * @param  string
	 * @param  string
	 * @return bool
	 */
	public static function contains($haystack, $needle)
	{
		return strpos($haystack, $needle) !== FALSE;
	}



	/**
	 * Ends the $haystack string with the suffix $needle?
	 * @param  string
	 * @param  string
	 * @return bool
	 */
	public static function endsWith($needle, $haystack)
	{
		return strlen($needle) === 0 || substr($haystack, -strlen($needle)) === $needle;
	}



	/**
	 * Creates classname from id, e.g. parallax-portfolio -> AitParallaxPortfolioElement
	 * @param  string $id     Id in with dashes
	 * @param  string $suffix Classname suffix, e.g. 'Element', 'OptionType'
	 * @param  string $prefix Classname prefix, default 'Ait'
	 * @return string         Full classname
	 */
	public static function id2class($id,  $suffix, $prefix = 'Ait')
	{
		return $prefix . ucfirst(self::dash2camel($id)) . ucfirst($suffix);
	}



	/**
	 * Reverse operation of id2classname method
	 * @param  string $classname Classname suffix, e.g. 'Element', 'OptionType'
	 * @param  string $suffix Classname suffix, e.g. 'Element', 'OptionType'
	 * @param  string $prefix Classname prefix, default 'Ait'
	 * @return string         Id with dashes
	 */
	public static function class2id($classname, $suffix, $prefix = 'Ait')
	{
		return self::camel2dash(substr($classname, strlen($prefix), -strlen($suffix)));
	}



	/**
	 * dash-separated -> camelCase.
	 * @param  string
	 * @return string
	 */
	public static function dash2camel($s)
	{
		$s = strtolower($s);
		$s = preg_replace('#([.-])(?=[a-z])#', '$1 ', $s);
		$s = ucwords($s);
		$s = strtolower($s[0]) . substr($s, 1);
		$s = str_replace('- ', '', $s);
		return $s;
	}



	/**
	 * camelCaseAction name -> dash-separated.
	 * @param  string
	 * @return string
	 */
	public static function camel2dash($s)
	{
		$s = preg_replace('#(.)(?=[A-Z])#', '$1-', $s);
		$s = strtolower($s);
		$s = rawurlencode($s);
		return $s;
	}



 	/**
	 * dash-sepeated -> ClassName
	 * @param  string $s
	 * @return string
	 */
	public static function dash2class($s)
	{
		return ucfirst(self::dash2camel($s));
	}



	/**
	 * underscore_sepeated -> ClassName
	 * @param  string $s
	 * @return string
	 */
	public static function _2class($s)
	{
		$s = strtolower($s);
		$s = preg_replace('#([._])(?=[a-z])#', '$1 ', $s);
		$s = ucwords($s);
		$s = strtolower($s[0]) . substr($s, 1);
		$s = str_replace('_ ', '', $s);
		return ucfirst($s);
	}



	/**
	 * Converts to web safe characters [a-z0-9-] text.
	 * @param  string  UTF-8 encoding
	 * @param  string  allowed characters
	 * @param  bool
	 * @return string
	 */
	public static function webalize($s, $charlist = NULL, $lower = TRUE)
	{
		$s = preg_replace('#[^\x09\x0A\x0D\x20-\x7E\xA0-\x{2FF}\x{370}-\x{10FFFF}]#u', '', $s);
		$s = strtr($s, '`\'"^~', "\x01\x02\x03\x04\x05");
		if (ICONV_IMPL === 'glibc') {
			$s = @iconv('UTF-8', 'WINDOWS-1250//TRANSLIT', $s); // intentionally @
			$s = strtr($s, "\xa5\xa3\xbc\x8c\xa7\x8a\xaa\x8d\x8f\x8e\xaf\xb9\xb3\xbe\x9c\x9a\xba\x9d\x9f\x9e"
				. "\xbf\xc0\xc1\xc2\xc3\xc4\xc5\xc6\xc7\xc8\xc9\xca\xcb\xcc\xcd\xce\xcf\xd0\xd1\xd2\xd3"
				. "\xd4\xd5\xd6\xd7\xd8\xd9\xda\xdb\xdc\xdd\xde\xdf\xe0\xe1\xe2\xe3\xe4\xe5\xe6\xe7\xe8"
				. "\xe9\xea\xeb\xec\xed\xee\xef\xf0\xf1\xf2\xf3\xf4\xf5\xf6\xf8\xf9\xfa\xfb\xfc\xfd\xfe",
				"ALLSSSSTZZZallssstzzzRAAAALCCCEEEEIIDDNNOOOOxRUUUUYTsraaaalccceeeeiiddnnooooruuuuyt");
		} else {
			$s = @iconv('UTF-8', 'ASCII//TRANSLIT', $s); // intentionally @
		}
		$s = str_replace(array('`', "'", '"', '^', '~'), '', $s);
		$s = strtr($s, "\x01\x02\x03\x04\x05", '`\'"^~');

		if ($lower) {
			$s = strtolower($s);
		}
		$s = preg_replace('#[^a-z0-9' . preg_quote($charlist, '#') . ']+#i', '-', $s);
		$s = trim($s, '-');
		return $s;
	}

}