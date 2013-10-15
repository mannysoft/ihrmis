<?php 
$this->load->view('includes/header');

if ($this->config->item('active_apps') == 'leave_only' )
{
	$this->load->view('includes/menu_leave');
}
else if ($this->config->item('active_apps') == 'ats_only')
{
	$this->load->view('includes/menu_ats');
}
else if ($this->config->item('active_apps') == 'hris')
{
	$this->load->view('includes/menu_hris');
}
else
{
	$lgu_code = $this->Settings->get_selected_field( 'lgu_code' );
				
	if ($lgu_code == 'marinduque_province')
	{
		// We need to check the access of each user
		if ( $this->session->userdata('user_type') == 1 || $this->session->userdata('user_type') == 2)
		{
			$this->load->view('includes/menu');
		}
		else
		{
			$this->load->view('includes/menu_mrdq');
		}
	}
	else
	{
		$this->load->view('includes/menu');
	}
	
	
	
	
	
}


$this->load->view('includes/body_top');

$this->load->view($main_content); // This is the main content

$this->load->view('includes/footer');
?>