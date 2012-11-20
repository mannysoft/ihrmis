<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Integrated Human Resource Management Information System
 *
 * An Open source Application Software use by Government agencies for 
 * management of employees Attendance, Leave Administration, Payroll, 
 * Personnel Training, Service Records, Performance, Recruitment,
 * Personnel Schedule(Plantilla) and more...
 *
 * @package		iHRMIS
 * @author		Manny Isles
 * @copyright	Copyright (c) 2008 - 2013, Charliesoft
 * @license		http://charliesoft.net/ihrmis/license
 * @link		http://charliesoft.net
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
 * @link		http://charliesoft.net/hrmis/user_guide/models/conversion_table.html
 */
class Users extends MX_Controller  {

	// --------------------------------------------------------------------
	
	function __construct()
    {
        parent::__construct();
		
		$this->load->helper('security');
		
		$this->load->model('options');
		
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
				
		//if form submit
		if($this->input->post('op'))
		{
			$users = $office_id	= $this->input->post('user');
			
			if(is_array($users))
			{
				foreach($users as $user)
				{
					//deactivate
					if($this->input->post('action') == 0)
					{
						$this->User->update_user(array('stat' => 'Inactive'), $user);
					}
					
					//if activate
					if($this->input->post('action') == 1)
					{
						$this->User->update_user(array('stat' => 'Active'), $user);
					}
				}
			}	
		}
		
		$u = new User_m();
		
		$u->where('group_id !=', '1000');
				
		$data['users'] = $u->get();
						
		$data['main_content'] = 'index';
		
		$this->load->view('includes/template', $data);
		
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Add and edit users information
	 *
	 */
	function save($id = '')
	{
		$data['page_name'] = '<b>Add User</b>';
		
		if ($id != '')
		{
			$data['page_name'] = '<b>Edit User</b>';
		}
		
		$data['msg'] = '';
		
		//Use for office listbox
		$data['options'] = $this->options->office_options();
		
		$data['selected'] = $this->session->userdata('office_id');
		
		$u = new User_m();
		
		$data['user'] = $u->get_by_id($id);
		
		// Groups options
		$data['groups_options'] = $this->options->group_options();
									
		$data['groups_selected'] = 3;
		
		if ( $u->exists())
		{
			$data['groups_selected'] = $u->group_id;
		}						
				
		//If form submit
		if($this->input->post('op'))
		{
			//http://codeigniter.com/forums/viewthread/161740/#776966
			//solved the callback functions problem
			$this->form_validation->set_rules('username', 'Username', 'required|min_length[4]|max_length[12]');
			
			// If add check the if username exists
			if ($id == '')
			{
				$this->form_validation->set_rules('username', 'Username','required|min_length[4]|max_length[12]|callback_username_check');
				$this->form_validation->set_rules('password', 'Password', 'required|matches[repassword]');
			}
			
			$this->form_validation->set_rules('lname', 'Last Name', 'required');
			$this->form_validation->set_rules('fname', 'First Name', 'required');
			
			
			if ($this->form_validation->run($this) == TRUE)
			{
				//Encript password
				$password = do_hash($this->input->post('password'), 'md5');
				
				if ($u->password == $password)
				{
					$password = $u->password;
				}
				
				$u->username	= $this->input->post('username');
				$u->lname		= $this->input->post('lname');
				$u->fname 		= $this->input->post('fname');
				$u->mname 		= $this->input->post('middle');
				$u->password 	= $password;
				$u->office_id 	= $this->input->post('office_id');
				$u->group_id 	= $this->input->post('group_id');
				$u->user_type 	= $this->input->post('group_id');
				$u->stat		= 'Active';
				
				$u->save();
							
				$user = $this->User->get_user_data($this->input->post('username'));
														 
				$this->session->set_flashdata('msg', 'User has been saved!');
						
				redirect(base_url().'users/', 'refresh');		
			}
					
		}
				
		$data['main_content'] = 'save';
		
		$this->load->view('includes/template', $data);
		
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Delete user
	 *
	 * @param int $id
	 */
	function delete($id = '')
	{
		$u = new User_m();
		$u->get_by_id( $id )->delete();
				
		$this->session->set_flashdata('msg', 'User has been deleted!');
		
		redirect(base_url().'users/', 'refresh');
		
	}
	
	// --------------------------------------------------------------------
	
	function my_account()
	{
		$data['page_name'] = '<b>My Account</b>';
		
		$data['msg'] = '';
		
		$username = $this->session->userdata('username');
		
		
		$op = $this->input->post('op');
		
		if($op == 1)
		{
			
			$hidden_password = $this->input->post('hidden_password');
			
			$new_pass 		= $this->input->post('new_pass');
			$re_new_pass 	= $this->input->post('re_new_pass');
			
			$this->form_validation->set_rules('password2', 'Current Password', 'required|callback_current_password');
			$this->form_validation->set_rules('new_pass', 'New Password', 'required|matches[re_new_pass]');
			$this->form_validation->set_rules('re_new_pass', 'Re - type new password', 'required');
			
			if ($this->form_validation->run($this) == TRUE)
			{
				$this->User->update_user_pass(do_hash($re_new_pass, 'md5'), $username);
			}
		}
		
		$user = $this->User->get_user_data($username);

		$data['office_name'] = $this->Office->get_office_name($user['office_id']);
		
		$data['user_type']   = $this->User_type->get_user_type($user['user_type']);
		
		$data['user'] = $user;
				
		$data['main_content'] = 'my_account';
		
		$this->load->view('includes/template', $data);
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Check if the username exist
	 *
	 * @param string $username
	 * @return boolean
	 */
	function username_check($username)
	{
		$is_username_exists = $this->User->is_username_exists($username);
		
		if ($is_username_exists == TRUE)
		{
			$this->form_validation->set_message('username_check', 
												'The Username exists! Please enter another username.');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
	// --------------------------------------------------------------------
	
	function current_password($password2)
	{
		$current_password = $this->User->get_current_password($this->session->userdata('username'));
		
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