<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Integrated Human Resource Management Information System
 *
 * An Open Source Application Software use by Government agencies for  
 * management of employees Attendance, Leave Administration, Payroll, 
 * Personnel Training, Service Records, Performance, Recruitment,
 * Personnel Schedule(Plantilla) and more...
 *
 * @package		iHRMIS
 * @author		Manny Isles
 * @copyright	Copyright (c) 2008 - 2014, Charliesoft
 * @license		http://charliesoft.net/ihrmis/license
 * @link		http://charliesoft.net
 * @github	    http://github.com/mannysoft/ihrmis
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * iHRMIS Conversion Table Class
 *
 * This class use for converting number of minutes late
 * to the corresponding equivalent to leave credits.
 *
 * @package		iHRMIS
 * @subpackage	Models
 * @category	Models
 * @author		Manny Isles
 * @link		http://charliesoft.net
 * @github	    http://github.com/mannysoft/ihrmis/hrmis/user_guide/models/conversion_table.html
 */
class Login extends MX_Controller  
{

	// --------------------------------------------------------------------
	
	function __construct()
    {
        parent::__construct();
		//$this->output->enable_profiler(TRUE);
	
    }  
	
	// --------------------------------------------------------------------
	
	function index()
	{
		if(Session::get('username'))
		{
			return Redirect::to('home/home_page', 'refresh');
		}
		redirect('login/show_login', 'refresh');
	}
	
	// --------------------------------------------------------------------
	
	function show_login()
	{
		$data = array();
		
		$data['system_message'] = '';
		
		if (Input::get('op'))
		{
			$username = Input::get('username');
			$password = Input::get('password');
					
			if (($username=="")||($password==""))
			{
				$data['system_message'] = 'Please complete the fields!';
			}	
			else 
			{
				// Encript password
				$password = do_hash($password, 'md5');
				
				$u = new User_m();
				
				$u->where('username', $username);
				$u->where('password', $password);
				$u->where('stat', 'Active');
				$u->get();
				
				// Check if the user exists			
				if ($u->exists())
				{
					// Lets check if the idle function is enable
					// Seconds before logout if user is idle
					$seconds_user_idle = Setting::getField('seconds_user_idle');
					
					if ($seconds_user_idle != '')
					{
						unset($this->session->sess_expiration);
						$this->session->sess_expiration = $seconds_user_idle;
						
						$this->load->library('session');
					}
					
													
					$session_data = array(
									'username'	=> $u->username, 
									'lname' 	=> $u->lname,
									'office_id' => $u->office_id,
									'group_id'	=> $u->group_id,
									'user_type' => $u->user_type
									);
		
					Session::put($session_data);					
					
					redirect('home/home_page', 'refresh');
				}
				else
				{
					$data['system_message'] = 'Invalid username or password!';
				}
				
			}
			
		}
	
		return View::make('login', $data);
	}
	
	// --------------------------------------------------------------------
	
	function log_out()
	{
		Session::flush();
		redirect('login/show_login', 'refresh');
	}
	
}

/* End of file login.php */
/* Location: ./system/application/modules/login/controllers/login.php */