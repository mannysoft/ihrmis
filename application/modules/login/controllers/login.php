<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

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
		if($this->session->userdata('username'))
		{
			redirect(base_url().'home/home_page', 'refresh');
		}
		redirect('login/show_login', 'refresh');
	}
	
	// --------------------------------------------------------------------
	
	function is_user_logged($isUserLogged = FALSE)
	{
		if ($isUserLogged == FALSE)
		{
			redirect('login/show_login', 'refresh');
		}
	}
	
	// --------------------------------------------------------------------
	
	function show_login()
	{
		$data = array();
		
		$data['system_message'] = '';
		
		if (isset($_POST['op']))
		{
			$username = addslashes($_POST['username']);
			$password = addslashes($_POST['password']);
			
			if (($username=="")||($password==""))
			{
				$data['system_message'] = 'Please complete the fields!';
			}	
			else 
			{
				$data = $this->User->validate_user($username, $password);
				
				if ($data['system_message'] == 'valid')
				{
					redirect('home/home_page', 'refresh');
				}
				else
				{
					$data['system_message'] = 'Invalid username or password!';
				}
				
			}
			
		}
	
		$this->load->view('login', $data);
	}
	
	// --------------------------------------------------------------------
	
	function log_out()
	{
		$this->session->sess_destroy();
		redirect('login/show_login', 'refresh');
	}
	
}

/* End of file login.php */
/* Location: ./system/application/modules/login/controllers/login.php */