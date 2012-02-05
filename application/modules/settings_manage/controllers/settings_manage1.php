<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Settings_Manage extends MX_Controller {

	// --------------------------------------------------------------------
	
	function __construct()
    {
        parent::__construct();
		
		$this->load->model('options');
		
		//$this->output->enable_profiler(TRUE);
		
		header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
		header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
    }  
	
	// --------------------------------------------------------------------
	
	function salary_grade()
	{
		
		$data['page_name'] = '<b>Salary Grade</b>';
		$data['msg'] = '';
		
		$data['year_options'] 		= $this->options->year_options(2009, 2020);//2010 - 2020
		$data['year_selected'] 		= date('Y');
		
		if($this->input->post('year'))
		{
			$data['year_selected'] 		= $this->input->post('year');
		}
		
		$data['rows'] = $this->Salary_grade->get_salary_grade($data['year_selected']);
		
		$this->load->view('includes/header');
		
		$this->load->view('includes/menu', $data);
		$this->load->view('includes/body_top', $data);
		
		$this->load->view('salary_grade', $data);
		
		$this->load->view('includes/footer');
		
	}
	
	// --------------------------------------------------------------------
	
	function holiday($delete_id = '')
	{
		
		$data['page_name'] = '<b>Holiday</b>';
		$data['msg'] = '';
		
		//Months
		$data['month_options'] 		= $this->options->month_options();
		$data['month_selected'] 	= date('m');
		
		//day
		$data['days_options'] 		= $this->options->days_options();
		$data['days_selected'] 		= date('d');
		
		$data['year_options'] 		= $this->options->year_options(2009, 2020);//2010 - 2020
		$data['year_selected'] 		= date('Y');
		
		
		
		if ($delete_id)
		{
			$this->Holiday->delete_holiday($delete_id);
		}
		
		$data['rows'] 				= $this->Holiday->holiday_list($data['year_selected']);
		
		if($this->input->post('op'))
		{
			if ($this->input->post('add_date'))
			{
				if($this->input->post('description') != "" && 
					checkdate($this->input->post('month'), $this->input->post('day'), $this->input->post('year')))
				{	
					$info = array(
							'date' 					=> $this->input->post('year').'-'.$this->input->post('month').'-'.$this->input->post('day'),
							'description' 				=> $this->input->post('description'),
							);
					
					$this->Holiday->add_holiday($info);	
				}
			}
			
			
			
			
			$data['year_selected'] 		= $this->input->post('year_select');
			$data['rows'] 				= $this->Holiday->holiday_list($this->input->post('year_select'));
		}
		
		$this->load->view('includes/header');
		
		$this->load->view('includes/menu', $data);
		$this->load->view('includes/body_top', $data);
		
		$this->load->view('holiday', $data);
		
		$this->load->view('includes/footer');
		
	}
	
	// --------------------------------------------------------------------
	
	function schedule()
	{
		$data['page_name'] = '<b>Employee Schedule</b>';
		$data['msg'] = '';
		
		$dtr2 = $this->input->post('dtr2');
		
		   
		if ($dtr2)
		{
			$office_id 						= $this->input->post('office_id');
			$employee_id 					= $this->input->post('employee_id');
			
			$date 							= $this->input->post('date'); 
			$date2   						= $this->input->post('date2'); 
			
			
			// Use to view dtr
			$_GET['office_id']	 			= $this->input->post('office_id');
			$_GET['employee_id'] 			= $this->input->post('employee_id');
			$_GET['date']					= $this->input->post('date');
			$_GET['date2']					= $this->input->post('date2');
			$_GET['from_view_attendance']	= TRUE;
			
			// Generate the DTR
			echo modules::run("dtr_manage/dtr");
			?>
			<script src="<?php echo base_url();?>js/function.js"></script>
			<script>openBrWindow('<?php echo base_url()."dtr/archives/".$office_id.".pdf";?>','','scrollbars=yes,width=800,height=700')</script>
			<?php
		}
		
		
		$data['options'] 					= $this->options->office_options();
		$data['selected'] 					= $this->session->userdata('office_id');
		
		$data['date'] 						= date("Y-m-d");
		$data['date2'] 						= date("Y-m-d");
		
		$op = $this->input->post('op');
		
		if ($op == 1)
		{
			$this_only 						= $this->input->post('this_only');
			
			$data['selected'] 				= $this->input->post('office_id');
			
			if ($this_only)
			{
				$_POST['date2'] 			= $this->input->post('date');
			}
			
			if($this->input->post('employee_id') == 'Employee ID')
			{
				$_POST['employee_id'] 		= '';
			}
			
			$data['rows'] = $this->Schedule->get_office_schedule(
										 $this->input->post('office_id'), 
										 $this->input->post('date'), 
										 $this->input->post('date2'), 
										 $this->input->post('employee_id')
										 );
			
			if($this->input->post('employee_id') == '')
			{
				$_POST['employee_id'] = 'Employee ID';
			}
		
			$data['date'] = $this->input->post('date');
			$data['date2'] = $this->input->post('date2');
		}
		else
		{
			$data['rows'] = $this->Schedule->get_office_schedule($this->session->userdata('office_id'), $data['date'], $data['date']);
			
		}
		
		$total_employee = $this->Employee->num_rows;
		
		if(!$this->input->post('employee_id'))
		{
			$_POST['employee_id'] = 'Employee ID';
		}
		
		$this->load->view('includes/header');
		
		$this->load->view('includes/menu', $data);
		$this->load->view('includes/body_top', $data);
		
		$this->load->view('schedule', $data);
		
		$this->load->view('includes/footer');
		
	}
	
	function employee_sched($employee_id = '')
	{
		$data['page_name'] = '<b>Employee Schedule</b>';
		$data['msg'] = '';
		
		$data['options'] 			= $this->options->office_options();
		$data['selected'] 			= $this->session->userdata('office_id');
	
		//Months
		$data['month_options'] 		= $this->options->month_options();
		$data['month_selected'] 	= date('m');
		
		//Days
		$data['days_options'] 		= $this->options->days_options();
		$data['days_selected'] 		= date('d');
		
		$data['year_options'] 		= $this->options->year_options(2010, 2020);//2010 - 2020
		$data['year_selected'] 		= date('Y');
		
	
		$this->load->view('includes/header');
		
		$this->load->view('includes/menu', $data);
		$this->load->view('includes/body_top', $data);
		
		// Get employee info
		$this->Employee->fields = array('id', 'lname', 'fname', 'mname');
		
		$data['name'] = $this->Employee->get_employee_info($employee_id);
		
		//print_r($data['name']);
		
		$this->load->view('employee_sched', $data);
		
		$this->load->view('includes/footer');
	}
	
	// --------------------------------------------------------------------
	
	function add_sched()
	{
		echo '1';
		//echo $this->input->post('employee_id');
		//echo $this->input->post('date1');
		//echo $this->input->post('date2');
		
		//$_POST['date1'] = 
		
		$days = $this->Helps->get_days_in_between($this->input->post('date1'), $this->input->post('date2'));
		
		foreach ($days as $day)
		{
			echo $day." \n";
			
			// Check if there is schedule for this date
			
			// If there is no schedule insert the date to schedule
			
			
			// Else update
			
			
		}
		
		//print_r( $this->Helps->get_days_in_between($this->input->post('date1'), $this->input->post('date2'))   );
		
	}
	
	function audit_trail($delete_id = '')
	{
		
		$data['page_name'] = '<b>Audit Trail</b>';
		$data['msg'] = '';
		
		if ($delete_id)
		{	
			$this->Logs->delete_logs($delete_id);
		}
		
		if ($this->input->post('remove_selected') && $this->input->post('log'))
		{	
			$logs = $this->input->post('log');
			
			foreach ($logs as $log)
			{
				$this->Logs->delete_logs($log);
			}
		}
		
		if ($this->input->post('remove_all'))
		{	
			$this->Logs->delete_all_logs();
		}
		
		//Use for office listbox
		$data['options'] 			= $this->options->office_options();
		$data['selected'] 			= $this->session->userdata('office_id');
	
		$office_id					= $this->session->userdata('office_id');
	
		if ($this->input->post('op'))
		{
			$data['selected'] 	= $this->input->post('office_id');
			$office_id 			= $this->input->post('office_id');
		}
		
		$this->load->library('pagination');
		
		//$data['logs'] = $this->Logs->get_logs($office_id);
		
		$data['logs'] = $this->Logs->count_logs($office_id);
		
		$config['base_url'] = base_url().'settings_manage/audit_trail';
		$config['total_rows'] = $this->Logs->num_rows;
	    $config['per_page'] = '15';
	    $config['full_tag_open'] = '<p>';
	    $config['full_tag_close'] = '</p>';
		
		//echo $this->Logs->num_rows;
		
		$this->pagination->initialize($config);
		
		$data['logs'] = $this->Logs->get_logs( $office_id, $config['per_page'], $this->uri->segment(3));
		
		$this->pagination->initialize($config);
		
		$this->load->view('includes/header');
		
		$this->load->view('includes/menu', $data);
		$this->load->view('includes/body_top', $data);
		
		$this->load->view('audit_trail', $data);
		
		$this->load->view('includes/footer');
		
	}
	
	// --------------------------------------------------------------------
	
	function general_settings()
	{
		
		$data['page_name'] = '<b>General Settings</b>';
		$data['msg'] = '';
		
		if ($this->input->post('op'))
		{
			//We get all the POST data. $key is the field name
			//which is the name of settings in database table.
			//We update the settings table to a new value($val)
			foreach ($_POST as $key => $val)
			{
				$this->Settings->update_settings($key, $val);
			}
		}
		
		$data['settings'] = $this->Settings->get_settings();
		
		$this->load->view('includes/header');
		
		$this->load->view('includes/menu', $data);
		$this->load->view('includes/body_top', $data);
		
		$this->load->view('general_settings', $data);
		
		$this->load->view('includes/footer');
		
	}
	
	// --------------------------------------------------------------------
	
	function backup()
	{
		
		$data['page_name'] = '<b>Restore/ Back up</b>';
		$data['msg'] = '';
		
		$this->load->view('includes/header');
		
		$this->load->view('includes/menu', $data);
		$this->load->view('includes/body_top', $data);
		
		$this->load->view('backup', $data);
		
		$this->load->view('includes/footer');
		
	}
	
	// --------------------------------------------------------------------
	
	function offline_update()
	{
		
		$data['page_name'] = '<b>Offline Update </b>';
		$data['msg'] = '';
		
		$this->load->view('includes/header');
		
		$this->load->view('includes/menu', $data);
		$this->load->view('includes/body_top', $data);
		
		$this->load->view('offline_update', $data);
		
		$this->load->view('includes/footer');
		
	}
	
	// --------------------------------------------------------------------
	
	function backup_database()
	{
		// Load the DB utility class
		$this->load->dbutil();
		
		// Backup your entire database and assign it to a variable
		$backup =& $this->dbutil->backup(); 
		
		// Load the file helper and write the file to your server
		$this->load->helper('file');
		write_file('/dtr/'.date('Y-m-d').'.zip', $backup); 
		
		// Load the download helper and send the file to your desktop
		$this->load->helper('download');
		force_download(date('Y-m-d').'.zip', $backup); 
	}
	
	
}	