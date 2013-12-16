<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class View {

	public function __construct()
	{
		parent::__construct();
	}
	
	public static function make($view, $data = array())
    {
        $ci =& get_instance();
        
        $ci->load->view($view, $data);
		
    }
	
}