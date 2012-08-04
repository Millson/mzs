<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Util
{
	public function make_slug($str, $default = null, $max_length = 200)
	{
		$CI = & get_instance();

		$str = str_replace(array("'", ":", "\\", "/", '"'), "", $str);
		$str = str_replace(array("+", ",", ' ', '，', ' ', ".", "?", "=", "&", "!", "<", ">", "(", ")", "[", "]", "{", "}"), "-", $str);
		$str = trim($str, '-');
		$str = empty($str) ? $default : $str;

		return function_exists('mb_get_info') ? mb_strimwidth($str, 0, 128, '', $CI->config->item("charset")) : substr($str, 0, $max_length);
	}
}

/* End of file Util.php */
/* Position: ./app/libraries/Util.php */
