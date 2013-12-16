<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Redirect {

	public function __construct()
	{
		parent::__construct();
	}
	
	public static function to($param)
    {
        redirect(base_url().$param, 'refresh');
    }
	
}