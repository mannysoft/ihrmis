<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_access
{
	public $user_access = array();
	public $permissions = array();
	public $ci = '';
	
	// ------------------------------------------------------------------------
	
	function __construct()
	{
		$this->ci =& get_instance();
		
		$u = new User_m();
		$u->get_by_username($this->ci->session->userdata('username'));
		
		$p = new Permission_m();
		$this->permissions = $p->get_by_group_id($u->group_id);
		
		//echo $this->ci->db->last_query();
	}
	
	// ------------------------------------------------------------------------
	
	function is_logged()
	{
		$module = $this->ci->uri->segment(1);
		
		if ($module == 'login' or $module == '' or $module == 'utility')
		{
			return TRUE;
		}
		
		if( ! $this->ci->session->userdata('username'))
		{
			redirect(base_url(), 'refresh');
		}

	}
	
	// ------------------------------------------------------------------------
	
	function roles( $params = '')
	{	
		$u = new User_m();
		$u->get_by_username($this->ci->session->userdata('username'));
				
		// If super-admin-man
		// I guess all access granted
		if ($u->group_id == '1000')
		{
			return TRUE;
		}
		
		$lgu_code = $this->ci->Settings->get_selected_field( 'lgu_code' );
				
		if ($lgu_code == 'marinduque_province')
		{
			if ($u->group_id == 1 or $u->group_id == 2)
			{
				return TRUE;
			}
		}
		
		if ($lgu_code == 'bataraza')
		{
			if ($u->group_id == 1 or $u->group_id == 2)
			{
				return TRUE;
			}
		}
		
		if (($u->group_id == 1 or $u->group_id == 2) )
		{
			return TRUE;
		}
		
		$has_access = FALSE;
		
		$error = 'You are not allowed to access this section! 
		<br> This action has been reported!<br><br>
						<a href="'.base_url().'home/home_page">Home Page</a>';
		
		$users_methods_access = array();
		
		$module = $this->ci->uri->segment(1);
		
		$module_method = $this->ci->uri->segment(2);
		
		foreach ( $this->permissions as $permission)
		{
			if ( $permission->module == $module)
			{
				$has_access = TRUE;
				
				$users_methods_access = json_decode($permission->roles);
				
				// If personnel and the method is 
				// We should allow the execution of 'plantilla_ajax'
				if ($module == 'personnel' and (in_array('personnel_schedule', $users_methods_access)))
				{
					return TRUE;
				}
								
				
				if ($users_methods_access == NULL)
				{
					$users_methods_access = array();
				}
			}
		}
		
		// If home page or login ofcourse all users has access
		if ( $module == 'home' or 
			 $module == 'login' or 
			 $module == 'ajax' or 
			 $module == 'migrate' or 
			 $module == 'utility' or 
			 $module == 'json' or
			 $module == 'reports' or
			 $module == FALSE
			 )
		{			
			// Hey lets exit we dont need to disallow access to this classes
			return TRUE;
			
			
		}
		
		// If not logged in
		if ( ! $this->ci->session->userdata('username') )
		{
			redirect('login/show_login');
		}
		
		// Lets check if the user has access to module
		if ($has_access == FALSE)
		{
			//log_message('error', 'Some variable did not contain a value.');
			show_error($error);
			exit;
		}
		
		// Lets check if the user has access in modules methods
		if ($module_method != '')
		{
			if ( ! in_array($module_method, $users_methods_access)  )
			{
				show_error($error);
				exit;				
				
			}
		}
						
	}
	
	// ------------------------------------------------------------------------
	
	function print_user_access()
	{
		if ($this->ci->input->is_ajax_request())
		{
			return;
		}
		
		return;
		
		$u = new User_m();
		$u->get_by_username($this->ci->session->userdata('username'));
		$u->get();
		
		$p = new Permission_m();
		$permissions = $p->get_by_group_id($u->group_id);
		
		foreach ( $this->permissions as $permission)
		{
			echo '<br>'.$permission->module;
			
			$methods = json_decode($permission->roles);
			
			$i = 0;
			
			if (is_array($methods))
			{
				foreach ($methods as $method)
				{
					if ($i ==0)
					{
						echo '<br>----';
						$i ++;
					}
					echo $method.', ';
				}
			}
			
			
			//print_r($methods);
			
		}
		
		//print_r( $this->user_access);	
		
		
	}
}
