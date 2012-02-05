<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_access
{
	
	function roles( $params = '')
	{
		$ci = & get_instance();
		
		//echo $ci->session->userdata('username');
		
		if ( $ci->session->userdata('username') == '0001' )
		{
			//echo $ci->uri->segment(2);
			//echo 'You are not allowed to access this page!';
			//print_r($params);
			//exit;
		}
		//echo 'cool';
	}
}
