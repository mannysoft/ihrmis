<?php 
$this->load->view('includes/header');

if ($this->config->item('active_apps') == 'leave_only' )
{
	$this->load->view('includes/menu_leave');
}
else if ($this->config->item('active_apps') == 'hris')
{
	$this->load->view('includes/menu_hris');
}
else
{
	$this->load->view('includes/menu');
	
	// We need to check the access of each user
	if ( $this->session->userdata('user_type') == 1 || $this->session->userdata('user_type') == 2)
	{
		//$this->load->view('includes/partials/admin_menu');
	}
	
}


$this->load->view('includes/body_top');

$this->load->view($main_content); // This is the main content

$this->load->view('includes/footer');
?>