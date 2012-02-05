<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Attendance_Manage extends MX_Controller {

	// --------------------------------------------------------------------
	
	function __construct()
    {
        parent::__construct();
		
		$this->load->model('options');
		
		//$this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
		//$this->output->enable_profiler(TRUE);
    }  
	
	// --------------------------------------------------------------------
	
	function view_attendance()
	{
		$data['page_name'] = '<b>View Attendance</b>';
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
			
			$office_id 						= $this->input->post('office_id');// added 2011-02-14
			?>
			<script src="<?php echo base_url();?>js/function.js"></script>
			<script>openBrWindow('<?php echo base_url()."dtr/archives/".$office_id.".pdf";?>','','scrollbars=yes,width=800,height=700')</script>
			<?php
		}
		
		
		
		$data['options'] 					= $this->options->office_options();
		$data['selected'] 					= $this->session->userdata('office_id');
		
		// Added 1.11.2012
		if ( $this->session->userdata('user_type') == 5)
  		{
			$office_name 		= $this->Office->get_office_name($this->session->userdata('office_id'));
			$data['options'] 	= array($this->session->userdata('office_id') => $office_name);
		}
		//end add
		
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
			
			$data['rows'] = $this->Dtr->get_office_dtr(
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
			$data['rows'] = $this->Dtr->get_office_dtr(
										$this->session->userdata('office_id'), 
										$data['date'], 
										$data['date']
										);
			
		}
		$total_employee = $this->Employee->num_rows;
		
		if(!$this->input->post('employee_id'))
		{
			$_POST['employee_id'] = 'Employee ID';
		}
				
		$data['main_content'] = 'view_attendance';
		
		$this->load->view('includes/template', $data);
		
	}
	
	// --------------------------------------------------------------------
	
	function view_absences()
	{
		$data['page_name'] 			= '<b>List of Absences</b>';
		$data['msg'] = '';
		
		$data['options'] 			= $this->options->office_options();
		$data['selected'] 			= $this->session->userdata('office_id');
		
		$data['date'] 				= date("Y-m-d");
		
		$data['rows']				= $this->Dtr->get_absences(
													$this->session->userdata('office_id'), 
													$data['date']
													);
		
		if($this->input->post('op'))
		{
			$data['date'] 			= $this->input->post('date2');
			
			$data['selected'] 		= $this->input->post('office_id');
			
			$data['rows'] 			= $this->Dtr->get_absences(
													$this->input->post('office_id'), 
													$data['date']
													);
		}
				
		$data['main_content'] = 'view_absences';
		
		$this->load->view('includes/template', $data);
		
	}
	
	// --------------------------------------------------------------------
	
	function view_late()
	{
		$data['page_name'] = '<b>View Late/Undertime</b>';
		$data['msg'] = '';
		
		$data['options'] 			= $this->options->office_options();
		$data['selected'] 			= $this->session->userdata('office_id');
		
		$data['date'] = date("Y-m-d");
	  
		$is_log_pm = FALSE;

		$data['rows'] = $this->Dtr->get_late_employee(
											$this->session->userdata('office_id'), 
											$data['date'], 
											$is_log_pm
											);
		
		if($this->input->post('op'))
		{
			$data['date'] 		= $this->input->post('date2');
			
			$data['selected'] 	= $this->input->post('office_id');
			
			$data['rows'] = $this->Dtr->get_late_employee($this->input->post('office_id'), $data['date'], $is_log_pm);
		}
				
		$data['main_content'] = 'view_late';
		
		$this->load->view('includes/template', $data);
		
	}
	
	// --------------------------------------------------------------------
	
	function view_ob()
	{
		$data['page_name'] = '<b>View Official Business</b>';
		$data['msg'] = '';
		
		$data['options'] 			= $this->options->office_options();
		$data['selected'] 			= $this->session->userdata('office_id');
		
		$data['date'] 				= date("Y-m-d");
	  
		$is_log_pm 					= FALSE;
		
		$this->Dtr->fields 			= array(
											'employee_id',
											'manual_log_id'
											);
		
		$data['rows'] 				= $this->Dtr->get_ob_employee($this->session->userdata('office_id'), $data['date']);
		
		if($this->input->post('op'))
		{
			$data['date'] 			= $this->input->post('date2');
			
			$data['selected'] 		= $this->input->post('office_id');
			
			$data['rows'] 			= $this->Dtr->get_ob_employee($this->input->post('office_id'), $data['date']);
		}
		
		$data['main_content'] = 'view_ob';
		
		$this->load->view('includes/template', $data);
		
	}
	
	// --------------------------------------------------------------------
	
	function view_tardiness()
	{
		$data['page_name'] 			= '<b>Tardiness</b>';
		$data['msg'] 				= '';
		
		$data['options'] 			= $this->options->office_options();
		$data['selected'] 			= $this->session->userdata('office_id');
		
		$data['month_options'] 		= $this->options->month_options();
		$data['month_selected'] 	= date('m');
		
		$data['year_options'] 		= $this->options->year_options(2009, 2020);//2010 - 2020
		$data['year_selected'] 		= date('Y');
		
		$data['date'] 				= date("Y-m-d");

		$data['month1'] 			= date('m');
		$data['year1'] 				= date('Y');
		
		$data['rows'] 				=  $this->Tardiness->get_employees_with_tardy(
																	$data['month1'], 
																	$data['year1'], 
																	$this->session->userdata('office_id')
																	);
		
		if(isset($_POST['month']))
		{
			$data['month1'] 		= $this->input->post('month');
			$data['year1'] 			= $this->input->post('year');
			
			$data['rows']			= $this->Tardiness->get_employees_with_tardy(
																	$data['month1'], 
																	$data['year1'], 
																	$this->input->post('office_id')
																	);
																		
			$data['selected'] 		= $this->input->post('office_id');	
			
			$data['month_selected'] = $this->input->post('month');	
			
			$data['year_selected'] 	= $this->input->post('year');								
		}
		
		if ($this->input->post('print') || $this->input->post('print2'))
		{
			//Create the report
			modules::run("reports/report_tardiness");//Although there is no parameter for the module call
													 //We can use the POST variable ready available.
			//Pop up window open here.
			?>
			<script src="<?php echo base_url();?>js/function.js"></script>
            <script>openBrWindow('<?php echo base_url()."dtr/reports/report_tardiness.pdf";?>','','scrollbars=yes,width=800,height=700')</script>
			<?php
		}
				
		$data['main_content'] = 'view_tardiness';
		
		$this->load->view('includes/template', $data);
		
	}
	
	// --------------------------------------------------------------------
	
	function view_ten_tardiness()
	{
		$data['page_name'] = '<b>View 10x Tardiness</b>';
		
		$data['msg'] = '';
		
		$data['options'] 			= $this->options->office_options();
		$data['selected'] 			= $this->session->userdata('office_id');
		
		$data['year_options'] 		= $this->options->year_options(2009, 2020);//2010 - 2020
		$data['year_selected'] 		= date('Y');
		
		$data['date'] = date("Y-m-d");

		$data['month1'] = date('m');
		$data['month2'] = date('m');
		$data['year1'] 	= date('Y');
		
		$data['m1'] = 'Jan';
		$data['m2'] = 'Feb';
		$data['m3'] = 'March';
		$data['m4'] = 'Apr';
		$data['m5'] = 'May';
		$data['m6'] = 'Jun';
		
		$data['mo1'] = '01';
		$data['mo2'] = '02';
		$data['mo3'] = '03';
		$data['mo4'] = '04';
		$data['mo5'] = '05';
		$data['mo6'] = '06';
		
		$all_tardiness = $this->input->post('all_tardiness');
		
		if ($all_tardiness)
		{
			$this->Tardiness->all_tardiness = TRUE;
		}
		
		$data['office_id'] = $this->session->userdata('office_id');
		
		if ($this->input->post('op'))
		{
			$data['year_selected'] 	= $this->input->post('year');
			
			// Just implement to set the selected month dropdown
			$this->form_validation->set_rules('month1', 'Month');
			$this->form_validation->set_rules('month2', 'Month');
			$this->form_validation->run();
		}
		
		if($this->input->post('month1'))
		{
			$data['month1'] 	= $this->input->post('month1');
			$data['month2'] 	= $this->input->post('month2');
			$data['year1'] 		= $this->input->post('year');
			$data['office_id'] 	= $this->input->post('office_id');
			
			if ($data['month1'] == '01' && $data['month2'] == '06')
			{
				$data['m1'] = 'Jan';
				$data['m2'] = 'Feb';
				$data['m3'] = 'March';
				$data['m4'] = 'Apr';
				$data['m5'] = 'May';
				$data['m6'] = 'Jun';
				
				$data['mo1'] = '01';
				$data['mo2'] = '02';
				$data['mo3'] = '03';
				$data['mo4'] = '04';
				$data['mo5'] = '05';
				$data['mo6'] = '06';
				
				$this->Tardiness->sem = 1;
				
				$data['employees'] 	=  $this->Tardiness->get_employees_ten_tardy(
																		 $data['month1'], 
																		 $data['month2'], 
																		 $data['year1']
																		 );
		
				$data['offices'] 	=  $this->Tardiness->offices_tardy;
			}
			
			if ($data['month1'] == '07' && $data['month2'] == '12')
			{
				$data['m1'] = 'Jul';
				$data['m2'] = 'Aug';
				$data['m3'] = 'Sep';
				$data['m4'] = 'Oct';
				$data['m5'] = 'Nov';
				$data['m6'] = 'Dec';
				
				$data['mo1'] = '07';
				$data['mo2'] = '08';
				$data['mo3'] = '09';
				$data['mo4'] = '10';
				$data['mo5'] = '11';
				$data['mo6'] = '12';
				
				
				
				// We need to get the data from first sem first
				// so we need to change the month
				$data['employees'] 	=  $this->Tardiness->get_employees_ten_tardy(
																		 '01', 
																		 '06', 
																		 $data['year1']
																		 );
				// Employees with 2 10 times tardy from first sem
				$tardy_employees = $this->Tardiness->employees;
				
				//echo '<pre>';											 
				//print_r($this->Tardiness->employees);	
				//echo '</pre>';			
		
												 
				$this->Tardiness->sem = 2;
																 
				$data['employees'] 	=  $this->Tardiness->get_employees_ten_tardy(
																		 $data['month1'], 
																		 $data['month2'], 
																		 $data['year1']
																		 );	
																		 
				// Employees with 2 10 times tardy from second sem												 
				$tardy_employees2 = $this->Tardiness->employees;
																		 
				//echo '<pre>';											 
				//print_r($this->Tardiness->employees);
				//echo '</pre>';
				
				
				
				foreach ($tardy_employees as $tardy_employee)
				{
					if (in_array($tardy_employee, $tardy_employees2))
					{
						//echo $tardy_employee.'<br>';
						
						$second_offenders[] = $tardy_employee;
					}
					
				}
												 												 
				echo modules::run("reports/ten_tardiness_second", $second_offenders);
				
				// Pop up window open here.
				?>
				<script src="<?php echo base_url();?>js/function.js"></script>
				<script>openBrWindow('<?php echo base_url()."dtr/reports/ten_tardiness_second.pdf";?>','','scrollbars=yes,width=800,height=700')</script>
				<?php
				
				$data['offices'] 	=  $this->Tardiness->offices_tardy;
			}
			
			
		}

		//Print memo
		if ($this->input->post('memo'))
		{
			$offices = $this->input->post('offices');
			
			$year1 = $this->input->post('year');
			
			if ($this->input->post('month1') == '01' && $this->input->post('month2') == '06')
			{
				$sem = 1;
			}
			
			if ($this->input->post('month1') == '07' && $this->input->post('month2') == '12')
			{
				$sem = 2;
			}
			
			
			if($offices)
			{
				// Create the report
				modules::run("reports/ten_tardiness", $sem);
													
				// Pop up window open here.
				?>
				<script src="<?php echo base_url();?>js/function.js"></script>
				<script>openBrWindow('<?php echo base_url()."dtr/reports/ten_tardiness.pdf";?>','','scrollbars=yes,width=800,height=700')</script>
				<?php
			}
		}
		
		// All offices tardiness
		if ($this->input->post('print') || $this->input->post('print2'))
		{
			// Create the report
			modules::run("reports/all_office_tardiness");
			
			// Pop up window open here.
			?>
			<script src="<?php echo base_url();?>js/function.js"></script>
			<script>openBrWindow('<?php echo base_url()."dtr/reports/all_office_tardiness.pdf";?>','','scrollbars=yes,width=800,height=700')</script>
			<?php
		}
				
		$data['main_content'] = 'view_ten_tardiness';
		
		$this->load->view('includes/template', $data);
		
	}
	
	
}

/* End of file attendance_manage.php */
/* Location: ./application/modules/attendance_manage/controllers/attendance_manage.php */