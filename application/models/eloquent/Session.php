<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Session {

	public function __construct()
	{
		parent::__construct();
	}
	
	public static function get($key)
    {
        $ci =& get_instance();
        
        return $ci->session->userdata($key);
    }

    public static function put($key, $value = '')
    {
        $ci =& get_instance();
        
        if (is_array($key)) 
        {
        	$ci->session->set_userdata($key);
        }
        else
        {
        	$ci->session->set_userdata($key, $value);
        }
    }

    public static function forget($key)
    {
        $ci =& get_instance();
        
        $ci->session->unset_userdata($key);
    }

    public static function flash($key, $value = '')
    {
        $ci =& get_instance();
        
        $ci->session->set_flashdata($key, $value);
    }

    public static function flashData($key)
    {
        $ci =& get_instance();
        
        return $ci->session->flashdata($key);
    }

    public static function flush()
    {
        $ci =& get_instance();
        
        $ci->session->sess_destroy();
    }

	
}