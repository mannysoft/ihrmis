<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Request {

	public static function root()
	{
		return rtrim(base_url(), '/');
	}
}