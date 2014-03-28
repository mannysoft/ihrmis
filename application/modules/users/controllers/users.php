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
 * iHRMIS Users Class
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
class Users extends MX_Controller  {

	protected $user;
	
	// --------------------------------------------------------------------
	
	function __construct()
    {
        parent::__construct();
		
		$this->load->helper('security');
		
		$this->load->model('options');
		
		$this->user = new UserEloquent;
		
		//$this->output->enable_profiler(TRUE);
    }  
	
	// --------------------------------------------------------------------
	
	/**
	 * List all users
	 *
	 */
	function index()
	{
		$data['page_name'] = '<b>Manage Users</b>';
		
		$data['msg'] = '';
		
		// If form submit
		if(Input::get('op'))
		{
			$users = Input::get('user');
			
			if(is_array($users))
			{
				foreach($users as $user)
				{
					$stat = Input::get('action') == '0' ? 'Inactive' : 'Active';

					$u = $this->user->find($user);
					$u->stat = $stat;
					$u->save();
				}
			}	
		}
		
		$data['users'] = $this->user->with('office', 'group')->where('group_id', '!=', '1000')->get();
						
		$data['main_content'] = 'index';
		
		return View::make('includes/template', $data);
		
	}
	
	function add()
	{
		$data['page_name'] = '<b>Add User</b>';
		
		$data['msg'] = '';
		
		// Use for office listbox
		$data['options'] = $this->options->office_options();
		
		$data['selected'] = Session::get('office_id');
				
		// Groups options
		$data['groups_options'] = $this->options->group_options();
									
		$data['groups_selected'] = 3;
						
		// If form submit
		if(Input::get('op'))
		{
			// Encript password
			$password = do_hash(Input::get('password'), 'md5');
			
			$u = $this->user->fill(Input::all());
			$u->password = (Input::get('password') == '') ? '' : $password;
			$u->user_type 	= Input::get('group_id');
			
			if($u->save())
			{				
				Session::flash('msg', 'User has been saved!');
						
				return Redirect::to('users/', 'refresh');		
			}
			
			$data['errors'] = $u->errors;
			
		}
				
		$data['main_content'] = 'add';
		
		return View::make('includes/template', $data);
		
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Add and edit users information
	 *
	 */
	function save($id = '')
	{
		$data['page_name'] = '<b>Edit User</b>';
		
		$data['msg'] = '';
		
		//Use for office listbox
		$data['options'] = $this->options->office_options();
		
		$data['selected'] = Session::get('office_id');
		
		$u = $data['user'] = $this->user->find($id);
				
		// Groups options
		$data['groups_options'] = $this->options->group_options();
											
		if ( $u->exists())
		{
			$data['groups_selected'] = $u->group_id;
		}						
				
		// If form submit
		if(Input::get('op'))
		{
			// Update Data
			$u = $this->user->find($id);
			$u->fill(Input::all());
			$u->user_type 	= Input::get('group_id');
			
			if (Input::get('password') != '')
			{
				$u->password = do_hash(Input::get('password'), 'md5');
			}
		
			if($u->save())
			{
				Session::flash('msg', 'User has been saved!');
						
				return Redirect::to('users/', 'refresh');		
			}
			
			$data['errors'] = $u->errors;
														 		
		}
				
		$data['main_content'] = 'save';
		
		return View::make('includes/template', $data);
		
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Delete user
	 *
	 * @param int $id
	 */
	function delete($id = '')
	{		
		$this->user->find($id)->delete();
		
		Session::flash('msg', 'User has been deleted!');
		
		return Redirect::to('users/', 'refresh');
		
	}
	
	// --------------------------------------------------------------------
	
	function my_account()
	{
		$data['page_name'] = '<b>My Account</b>';
		
		$data['msg'] = '';
				
		if(Input::get('op'))
		{
			$hidden_password = Input::get('hidden_password');
			
			$new_pass 		= Input::get('new_pass');
			$re_new_pass 	= Input::get('re_new_pass');
			
			$this->form_validation->set_rules('password2', 'Current Password', 'required|callback_current_password');
			$this->form_validation->set_rules('new_pass', 'New Password', 'required|matches[re_new_pass]');
			$this->form_validation->set_rules('re_new_pass', 'Re - type new password', 'required');
			
			if ($this->form_validation->run($this) == TRUE)
			{
				$u = $this->user->find(Session::get('user_id'));
				$u->password = do_hash($re_new_pass, 'md5');
				$u->save();
			}
		}
				
		$data['user'] = $this->user->with('office', 'group')->find(Session::get('user_id'));
				
		$data['main_content'] = 'my_account';
		
		return View::make('includes/template', $data);
	}
	
	// --------------------------------------------------------------------
	
	function current_password($password2)
	{
		$current_password = $this->user->find(Session::get('user_id'))->password;
		
		// Encript password
		$password = do_hash($password2, 'md5');
		
		if ($current_password != $password)
		{
			$this->form_validation->set_message('current_password', 
												'Invalid Current Password!');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
}

/* End of file users.php */
/* Location: ./application/modules/users/controllers/users.php */