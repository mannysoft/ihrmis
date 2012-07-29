<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('current_work_dir'))
{
	function current_work_dir()
	{
		$cwd = explode(DIRECTORY_SEPARATOR, getcwd());
		
		$cwd = array_pop($cwd);
		
		return $cwd;
	}
}


/* End of file directory_helper.php */
/* Location: ./system/helpers/directory_helper.php */