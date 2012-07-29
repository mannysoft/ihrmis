<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	http://codeigniter.com/user_guide/general/hooks.html
|
*/
/*
// this is not active
$hook['pre_controller'] = array(
                                'class'    => 'User_access',
                                'function' => 'roles',
                                'filename' => 'User_access.php',
                                'filepath' => 'hooks',
                                'params'   => array()
                                );
			
// above is not active								
$hook['pre_controller'] = array(
                                'class'    => 'User_access',
                                'function' => 'is_logged',
                                'filename' => 'User_access.php',
                                'filepath' => 'hooks',
                                'params'   => array()
                                );	
								
								$hook['pre_controller'] = array();		
								
								*/
								$hook['pre_controller'][] = array(
                                'class'    => 'User_access',
                                'function' => 'roles',
                                'filename' => 'User_access.php',
                                'filepath' => 'hooks',
                                'params'   => array()
                                );	
								$hook['pre_controller'][] = array(
                                'class'    => 'Migrate',
                                'function' => '__construct',
                                'filename' => 'migrate.php',
                                'filepath' => 'controllers',
                                'params'   => array()
                                );					

/* End of file hooks.php */
/* Location: ./application/config/hooks.php */