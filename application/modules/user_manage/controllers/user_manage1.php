<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_manage extends MX_Controller  {

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
	 * Enter description here...
	 *
	 */
	function add_user()
	{
		$data['page_name'] = '<b>Add User</b>';
		$data['msg'] = '';
		
		//Use for office listbox
		$data['options'] = $this->options->office_options();
		
		$data['selected'] = $this->session->userdata('office_id');
		
		//User type options
		$data['user_type_options'] = $this->options->user_type();
									
		$data['user_type_selected'] = 3;	
		
		$this->load->view('includes/header');
		
		$this->load->view('includes/menu', $data);
		$this->load->view('includes/body_top', $data);						
				
		$op = $this->input->post('op');
		
		//If form submit
		if($op == 1)
		{
			//http://codeigniter.com/forums/viewthread/161740/#776966
			//solved the callback functions problem
			$this->form_validation->set_rules('username', 'Username', 'required|min_length[4]|max_length[12]|callback_username_check');
			$this->form_validation->set_rules('last', 'Last Name', 'required');
			$this->form_validation->set_rules('first', 'First Name', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required|matches[repassword]');
			$this->form_validation->set_rules('user_type', 'User Type', 'required');
			
			if ($this->form_validation->run($this) == FALSE)
			{
				$data['selected'] 			= $this->input->post('office_id');
				$data['user_type_selected'] = $this->input->post('user_type');		
			}
			else
			{
				//Encript password
				$password = do_hash($this->input->post('password'), 'md5');
				
				$info = array(
				'username' 				=> $this->input->post('username'),
				'lname' 				=> $this->input->post('last'),
				'fname' 				=> $this->input->post('first'),
				'mname' 				=> $this->input->post('middle'),
				'password' 				=> $password,
				'office_id' 			=> $this->input->post('office_id'),
				'stat'					=> 'Active',
				'user_type'				=> $this->input->post('user_type')
				);
			
				$this->User->add_user($info);
				
				$user = $this->User->get_user_data($this->input->post('username'));
				
				$this->Logs->insert_logs($this->session->userdata('username'), 
										 $this->session->userdata('office_id'), 
										 'ADD USER', 
										 'Add new user ('.$user['username'].')', 
										 '');
										 
				$this->session->set_flashdata('msg', 'New User added!');
						
				redirect(base_url().'index.php/user_manage/list_user', 'refresh');		
			}
					
		}
				
		$this->load->view('add_user', $data);
		
		$this->load->view('includes/footer');
		
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Enter description here...
	 *
	 */
	function list_user()
	{
		$data['page_name'] = '<b>User List</b>';
		
		$data['msg'] = '';
		
		$op = $this->input->post('op');
		
		$this->load->view('includes/header');
		
		$this->load->view('includes/menu', $data);
		$this->load->view('includes/body_top', $data);
		
		//if form submit
		if($op == 1)
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
		
		$this->User->fields = array(
									'user.user_id',
									'user.group_id',
									'user.username',
									'user.fname',
									'user.lname',
									'user.mname',
									'user.stat',
									'office.office_name',
									'user_type.name'
									);
		
		$data['users'] = $this->User->get_users();
				
		$this->load->view('list_user', $data);
		
		$this->load->view('includes/footer');
		
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Enter description here...
	 *
	 * @param unknown_type $username
	 */
	function edit_user($username)
	{	
		$data['page_name'] = '<b>Edit User</b>';
		
		$data['msg'] = '';
		
		$data['username'] = $username;
		
		$user = $this->User->get_user_data($username);
		
		//Use for office listbox
		$data['options'] = $this->options->office_options();
		$data['selected'] = $user['office_id'];
		
		//User type options
		$data['user_type_options'] = $this->options->user_type();
									
		$data['user_type_selected'] = $user['user_type'];
		
		$data['lname'] = $user['lname'];
		$data['fname'] = $user['fname'];
		$data['mname'] = $user['mname'];
		$data['password'] = $user['password'];
		$data['user_id'] = $user['user_id'];
		
		
		$this->load->view('includes/header');
		
		$this->load->view('includes/menu', $data);
		$this->load->view('includes/body_top', $data);
		
		$op = $this->input->post('op');
		
		if($op == 1)
		{
			// Encript password
			$password = do_hash($this->input->post('password'), 'md5');
			
			// If the password has not been changed
			if ($user['password'] == $this->input->post('password'))
			{
				$password = $user['password'];
			}
			
			$data = array(
				'username' 	=> $this->input->post('username'),
				'lname' 	=> $this->input->post('last'),
				'fname' 	=> $this->input->post('first'),
				'mname' 	=> $this->input->post('middle'),
				'office_id' => $this->input->post('office_id'),
				'password' 	=> $password,
				'user_type' => $this->input->post('user_type')
				);
			
			$this->User->update_user($data, $this->input->post('user_id'));
			
			$this->Logs->insert_logs($this->session->userdata('username'), 
									 $this->session->userdata('office_id'), 
									 'EDIT USER', 'Edit user ('.$this->input->post('username').')', 
									 '');
			$this->session->set_flashdata('msg', 'User updated!');
			
			redirect(base_url().'index.php/user_manage/list_user', 'refresh');
			
		}
				
		
		$this->load->view('edit_user', $data);
		
		$this->load->view('includes/footer');
		
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Enter description here...
	 *
	 * @param unknown_type $username
	 */
	function delete_user($username)
	{
		$this->User->delete_user($username);
	
		$this->Logs->insert_logs($this->session->userdata('username'), 
								 $this->session->userdata('office_id'), 
								 'DELETE USER', 
								 'DELETE user ('.$username.')', 
								 '');
		$this->session->set_flashdata('msg', 'User deleted!');
		
		redirect(base_url().'index.php/user_manage/list_user', 'refresh');
		
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Show all user groups
	 *
	 */
	function user_group()
	{
		$data['page_name'] = '<b>User Group</b>';
		
		$data['msg'] = '';
		
		$this->load->view('includes/header');
		
		$this->load->view('includes/menu', $data);
		$this->load->view('includes/body_top', $data);
		
		$data['groups'] = $this->User_group->get_groups();
				
		$data['main_content'] = 'user_group';
		
		$this->load->view('includes/template', $data);
		
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Add new user group
	 *
	 */
	function add_user_group()
	{
		$data['page_name'] = '<b>Add User Group</b>';
		$data['msg'] = '';
			
		$op = $this->input->post('op');
		
		//If form submit
		if($op == 1)
		{
			//http://codeigniter.com/forums/viewthread/161740/#776966
			//solved the callback functions problem
			$this->form_validation->set_rules('name', 'Name', 'required');
			
			if ($this->form_validation->run($this) == FALSE)
			{
						
			}
			else
			{
				
				
				$info = array(
				'name' 				=> $this->input->post('name'),
				'description' 		=> $this->input->post('description')
				);
				
				
				
				$this->User_group->add_user_group($info);
								
				$this->Logs->insert_logs($this->session->userdata('username'), 
										 $this->session->userdata('office_id'), 
										 'ADD USER GROUP', 
										 'Add new user group('.$this->input->post('name').')', 
										 '');
						
				redirect(base_url().'user_manage/user_group', 'refresh');		
			}
					
		}		
		
		$data['main_content'] = 'add_user_group';
		
		$this->load->view('includes/template', $data);
		
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Edit user group
	 *
	 * @param int $id
	 */
	function edit_user_group($id)
	{	
		$data['page_name'] = '<b>Edit User Group</b>';
		
		$data['msg'] = '';
		
		$data['user_group'] = $this->User_group->get_user_group_data($id);
				
		if($this->input->post('op') == 1)
		{
	
			$data = array(
				'name' 			=> $this->input->post('name'),
				'description' 	=> $this->input->post('description')
				);
			
			$this->User_group->update_user_group($data, $id);
			
			$this->Logs->insert_logs($this->session->userdata('username'), 
									 $this->session->userdata('office_id'), 
									 'EDIT USER GROUP', 'Edit user group('.$this->input->post('name').')', 
									 '');
			
			redirect(base_url().'user_manage/user_group', 'refresh');
			
		}
				
		$data['main_content'] = 'edit_user_group';
		
		$this->load->view('includes/template', $data);
		
	}
	
	// --------------------------------------------------------------------
	// To do: check if the user group has registered user with 
	// this group. if true then dont delete the group
	// delete first the user before the user group
	
	function delete_user_group( $id = '')
	{
		$this->User_group->delete_user_group( $id );
		redirect(base_url().'user_manage/user_group', 'refresh');
	}
	
	// --------------------------------------------------------------------
	
	function my_account()
	{
		$data['page_name'] = '<b>My Account</b>';
		
		$data['msg'] = '';
		
		$username = $this->session->userdata('username');
		
		$this->load->view('includes/header');
		
		$this->load->view('includes/menu', $data);
		$this->load->view('includes/body_top', $data);
		
		$op = $this->input->post('op');
		
		if($op == 1)
		{
			
			$hidden_password = $this->input->post('hidden_password');
			
			$new_pass 		= $this->input->post('new_pass');
			$re_new_pass 	= $this->input->post('re_new_pass');
			
			$this->form_validation->set_rules('password2', 'Current Password', 'required|callback_current_password');
			$this->form_validation->set_rules('new_pass', 'New Password', 'required|matches[re_new_pass]');
			$this->form_validation->set_rules('re_new_pass', 'Re - type new password', 'required');
			
			if ($this->form_validation->run($this) == FALSE)
			{
				
			}
			else
			{
				$this->User->update_user_pass(do_hash($re_new_pass, 'md5'), $username);
			}
		}
		
		$user = $this->User->get_user_data($username);

		$data['office_name'] = $this->Office->get_office_name($user['office_id']);
		
		$data['user_type']   = $this->User_type->get_user_type($user['user_type']);
		
		$data['user'] = $user;
				
		
		
		$this->load->view('my_account', $data);
		
		$this->load->view('includes/footer');
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

/* End of file user_manage.php */
/* Location: ./application/modules/user_manage/controllers/user_manage.php */