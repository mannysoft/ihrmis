<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Input {

	public static function get($field, $default = '')
	{
		$input = Illuminate\Http\Request::createFromGlobals();
		
		return $input->get($field, $default);
	}
	
	public static function all()
	{
		$input = Illuminate\Http\Request::createFromGlobals();
		
		return $input->all();
	}
	
	public static function only()
	{
		$args = "'".implode("','", func_get_args())."'";
		
		//return func_get_args();
		
		$input = Illuminate\Http\Request::createFromGlobals();
		//echo $args;
		return $input->only($args);
	}
	
	public static function except($field)
	{
		$input = Illuminate\Http\Request::createFromGlobals();
		
		return $input->except($field);
	}
	
	public static function file($field)
	{
		$input = Illuminate\Http\Request::createFromGlobals();
		
		return $input->file($field);
	}
	
	
}