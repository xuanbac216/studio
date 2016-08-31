<?php

/*
 * AIT Shortcodes WordPress Plugin
 *
 * Copyright (c) 2013, Affinity Information Technology, s.r.o. (http://ait-themes.com)
 */



class AitShortcodesUtils
{


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
	 * dash-separated -> camelCase.
	 * @param  string
	 * @return string
	 */
	public static function dash2class($s)
	{
		$s = strtolower($s);
		$s = preg_replace('#([.-])(?=[a-z])#', '$1 ', $s);
		$s = ucwords($s);
		$s = strtolower($s[0]) . substr($s, 1);
		$s = str_replace('- ', '', $s);
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