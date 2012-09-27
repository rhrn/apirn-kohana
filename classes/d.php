<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Debug tools
 */
class D {

	private static $out;

	public static $enable = true;

	public static function v($x, $return = false) {

		self::$out = '';

		if (!empty($x)) {
			self::$out .= print_r ($x, true);
		} else {
			self::$out .= var_export ($x, true);
		}

		return self::out($return);
	}

	public static function cl($cl, $return = false) {

		self::$out = '';

		$name = get_class($cl);
		self::$out .= $name;
		self::$out .= print_r(get_class_vars($name), true);
		self::$out .= $name;
		self::$out .= print_r(get_class_methods($cl), true);

		return self::out($return);

	}

	private static function out($return) {

		if (self::$enable) {
			self::$out = '<pre>' . self::$out . '</pre>';
			if ($return) {
				return self::$out;
			} else {
				echo self::$out;
			}
		}
	}

}
