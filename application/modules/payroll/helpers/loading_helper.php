<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


if ( ! function_exists('loading_image'))
{
	function loading_image()
	{
		return '<p align="center"><img  src="'.base_url().'images/winbox_throbber.gif" align="absmiddle"/></p>';
	}
}

/* End of file loading_helper.php */
/* Location: ./application/modules/payroll_deductions/loading_helper.php */