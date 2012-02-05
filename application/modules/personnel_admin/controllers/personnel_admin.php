<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Personnel_admin extends MX_Controller  
{
	// --------------------------------------------------------------------
	
	function __construct()
    {
        parent::__construct();
		$this->load->model('options');
		//$this->output->enable_profiler(TRUE);
    }  
	
	// --------------------------------------------------------------------
	
	function assets($employee_id = '')
	{
		
		$data['page_name'] 			= '<b>Assets and Liabilities</b>';
		$data['msg'] 				= '';
		
		
		if ( $this->input->post('employee_id'))
		{
			$employee_id = $this->input->post('employee_id');
		}
		
		$e = new Employee_m();
		
		$data['employee'] 			= $e->get_by_id ($employee_id);
		
		$data['selected'] = $e->office_id;
		
		//Use for office listbox
		$data['options'] = $this->options->office_options();
		
		$data['employee_id'] 		= $employee_id;
		
		$data['main_content'] 		= 'assets';
		
		$this->load->view('includes/template', $data);
		
	}
	
	// --------------------------------------------------------------------
	
	function assets_spouse( $employee_id = '' )
	{
		$data['page_name'] 			= '<b>Assets and Liabilities</b>';
		
		$data['section_name'] 		= '<b>Spouse Information</b>';
		
		$data['msg'] 				= '';
		
		$e = new Employee_m();
		
		$data['employee'] 			= $e->get_by_id ($employee_id);
		
		if ( $this->input->post('op'))
		{
			$a = new Asset_info();
			
			$a->where( 'employee_id',  $employee_id )->get();
			
			$a->employee_id			= $employee_id;
			$a->s_lname 				= $this->input->post('s_lname');
			$a->s_fname 				= $this->input->post('s_fname');
			$a->s_mname 				= $this->input->post('s_mname');
			$a->s_office 				= $this->input->post('s_office');
			$a->s_position 				= $this->input->post('s_position');
			
			$a->save();	
						
			$data['msg'] = $data['section_name'].' has been saved!';
						
		}
				
		$a = new Asset_info();
		
		$data['info'] = $a->get_by_employee_id($employee_id);
		
		$data['selected'] = $e->office_id;
		
		//Use for office listbox
		$data['options'] = $this->options->office_options();
		
		$data['employee_id'] 		= $employee_id;
		
		$data['main_content'] = 'assets_spouse';
		
		$this->load->view('includes/template', $data);
		
	}
	
	// --------------------------------------------------------------------
	
	function assets_unmarried( $employee_id = '' )
	{
		$data['page_name'] 			= '<b>Assets and Liabilities</b>';
		
		$data['section_name'] 		= '<b>Unmarried Children below 18 years of age</b>';
		
		$data['msg'] 				= '';
		
		$e = new Employee_m();
		
		$data['employee'] 			= $e->get_by_id ($employee_id);
		
		if ( $this->input->post('op'))
		{
			$unmarried = new Asset_unmarried();
			
			$unmarried->where( 'employee_id',  $employee_id )->get();
			
			$unmarried->delete_all();
			
			$names 					= $this->input->post('name');
			$birth_date 			= $this->input->post('birth_date');
			
			$i = 0;
			
			foreach ($names as $name)
			{
				if ($name != "")
				{
					$unmarried = new Asset_unmarried();
					
					$unmarried->employee_id				= $employee_id;
					$unmarried->name 					= $names[$i];
					$unmarried->birth_date 				= $birth_date[$i];
					
					$unmarried->save();	
						
				}
				
				$i++;
			}
			
			
			$data['msg'] = 'Unmarried Children below 18 years of age has been saved!';
						
		}
				
		$a = new Asset_unmarried();
		$a->order_by('birth_date');
		
		$data['childs'] = $a->get_by_employee_id($employee_id);
		
		$data['selected'] = $e->office_id;
		
		//Use for office listbox
		$data['options'] = $this->options->office_options();
		
		$data['employee_id'] 		= $employee_id;
		
		$data['main_content'] = 'assets_unmarried';
		
		$this->load->view('includes/template', $data);
		
	}
	
	// --------------------------------------------------------------------
	
	function assets_real_properties( $employee_id = '' )
	{
		$data['page_name'] 			= '<b>Assets and Liabilities</b>';
		
		$data['section_name'] 		= '<b>Real Properties</b>';
		
		$data['msg'] 				= '';
		
		$e = new Employee_m();
		
		$data['employee'] 			= $e->get_by_id ($employee_id);
		
		if ( $this->input->post('op'))
		{
			$a = new Asset_property();
			
			$a->where( 'employee_id',  $employee_id )->get();
			
			$a->delete_all();
			
			$kinds 				= $this->input->post('kind');
			$location 			= $this->input->post('location');
			$year_acquired 		= $this->input->post('year_acquired');
			$mode_acquisition 	= $this->input->post('mode_acquisition');
			$nature_property 	= $this->input->post('nature_property');
			$assessed_value 	= $this->input->post('assessed_value');
			$market_value 		= $this->input->post('market_value');
			$land_cost 			= $this->input->post('land_cost');
			$improvement_cost 	= $this->input->post('improvement_cost');
			
			$i = 0;
			
			foreach ($kinds as $kind)
			{
				if ($kind != "")
				{
					$a = new Asset_property();
					
					$a->employee_id				= $employee_id;
					$a->kind 					= $kinds[$i];
					$a->location 				= $location[$i];
					$a->year_acquired 			= $year_acquired[$i];
					$a->mode_acquisition 		= $mode_acquisition[$i];
					$a->nature_property 		= $nature_property[$i];
					$a->assessed_value 			= $assessed_value[$i];
					$a->market_value 			= $market_value[$i];
					$a->land_cost 				= $land_cost[$i];
					$a->improvement_cost 		= $improvement_cost[$i];
					
					$a->save();	
						
				}
				
				$i++;
			}
			
			
			$data['msg'] = 'Real Properties has been saved!';
						
		}
				
		$a = new Asset_property();
		$a->order_by('year_acquired', 'DESC');
		
		$data['properties'] = $a->get_by_employee_id($employee_id);
		
		$data['selected'] = $e->office_id;
		
		//Use for office listbox
		$data['options'] = $this->options->office_options();
		
		$data['employee_id'] 		= $employee_id;
		
		$data['main_content'] = 'assets_real_properties';
		
		$this->load->view('includes/template', $data);
		
	}
	
	// --------------------------------------------------------------------
	
	function assets_personals( $employee_id = '' )
	{
		$data['page_name'] 			= '<b>Assets and Liabilities</b>';
		
		$data['section_name'] 		= '<b>Personal and other Properties</b>';
		
		$data['msg'] 				= '';
		
		$e = new Employee_m();
		
		$data['employee'] 			= $e->get_by_id ($employee_id);
		
		if ( $this->input->post('op'))
		{
			$a = new Asset_personal();
			
			$a->where( 'employee_id',  $employee_id )->get();
			
			$a->delete_all();
			
			$kinds 				= $this->input->post('kind');
			$year_acquired 		= $this->input->post('year_acquired');
			$acquisition_cost 	= $this->input->post('acquisition_cost');
		
			
			$i = 0;
			
			foreach ($kinds as $kind)
			{
				if ($kind != "")
				{
					$a = new Asset_personal();
					
					$a->employee_id				= $employee_id;
					$a->kind 					= $kinds[$i];
					$a->year_acquired 			= $year_acquired[$i];
					$a->acquisition_cost 		= $acquisition_cost[$i];
					
					$a->save();	
						
				}
				
				$i++;
			}
			
			
			$data['msg'] = 'Personal and other Properties has been saved!';
						
		}
				
		$a = new Asset_personal();
		$a->order_by('year_acquired', 'DESC');
		
		$data['properties'] = $a->get_by_employee_id($employee_id);
		
		$data['selected'] = $e->office_id;
		
		//Use for office listbox
		$data['options'] = $this->options->office_options();
		
		$data['employee_id'] 		= $employee_id;
		
		$data['main_content'] = 'assets_personals';
		
		$this->load->view('includes/template', $data);
		
	}
	
	// --------------------------------------------------------------------
	
	function assets_liabilities( $employee_id = '' )
	{
		$data['page_name'] 			= '<b>Assets and Liabilities</b>';
		
		$data['section_name'] 		= '<b>LIABILITIES (Loans, Mortgages, etc.)</b>';
		
		$data['msg'] 				= '';
		
		$e = new Employee_m();
		
		$data['employee'] 			= $e->get_by_id ($employee_id);
		
		if ( $this->input->post('op'))
		{
			$a = new Asset_liability();
			
			$a->where( 'employee_id',  $employee_id )->get();
			
			$a->delete_all();
			
			$natures 			= $this->input->post('nature');
			$name_creditors 	= $this->input->post('name_creditors');
			$amount 			= $this->input->post('amount');
		
			
			$i = 0;
			
			foreach ($natures as $nature)
			{
				if ($nature != "")
				{
					$a = new Asset_liability();
					
					$a->employee_id		= $employee_id;
					$a->nature 			= $natures[$i];
					$a->name_creditors 	= $name_creditors[$i];
					$a->amount 			= $amount[$i];
					
					$a->save();	
						
				}
				
				$i++;
			}
			
			
			$data['msg'] = $data['section_name'].' has been saved!';
						
		}
				
		$a = new Asset_liability();
		$a->order_by('nature');
		
		$data['liabilities'] = $a->get_by_employee_id($employee_id);
		
		$data['selected'] = $e->office_id;
		
		//Use for office listbox
		$data['options'] = $this->options->office_options();
		
		$data['employee_id'] 		= $employee_id;
		
		$data['main_content'] = 'assets_liabilities';
		
		$this->load->view('includes/template', $data);
		
	}
	
	// --------------------------------------------------------------------
	
	function assets_business_interests( $employee_id = '' )
	{
		$data['page_name'] 			= '<b>Assets and Liabilities</b>';
		
		$data['section_name'] 		= '<b>BUSINESS INTERESTS AND FINANCIAL CONNECTIONS</b>';
		
		$data['msg'] 				= '';
		
		$e = new Employee_m();
		
		$data['employee'] 			= $e->get_by_id ($employee_id);
		
		if ( $this->input->post('op'))
		{
			$a = new Asset_business_interest();
			
			$a->where( 'employee_id',  $employee_id )->get();
			
			$a->delete_all();
			
			$names 				= $this->input->post('name');
			$company 			= $this->input->post('company');
			$address 			= $this->input->post('address');
			$nature_business 	= $this->input->post('nature_business');
			$date_acquisition 	= $this->input->post('date_acquisition');
		
			
			$i = 0;
			
			foreach ($names as $name)
			{
				if ($name != "")
				{
					$a = new Asset_business_interest();
					
					$a->employee_id			= $employee_id;
					$a->name 				= $names[$i];
					$a->company 			= $company[$i];
					$a->address 			= $address[$i];
					$a->nature_business 	= $nature_business[$i];
					$a->date_acquisition 	= $date_acquisition[$i];
					
					$a->save();	
						
				}
				
				$i++;
			}
			
			
			$data['msg'] = $data['section_name'].' has been saved!';
						
		}
				
		$a = new Asset_business_interest();
		$a->order_by('name');
		
		$data['interests'] = $a->get_by_employee_id($employee_id);
		
		$data['selected'] = $e->office_id;
		
		//Use for office listbox
		$data['options'] = $this->options->office_options();
		
		$data['employee_id'] 		= $employee_id;
		
		$data['main_content'] = 'assets_business_interests';
		
		$this->load->view('includes/template', $data);
		
	}
	
	// --------------------------------------------------------------------
	
	function assets_relatives( $employee_id = '' )
	{
		$data['page_name'] 			= '<b>Assets and Liabilities</b>';
		
		$data['section_name'] 		= '<b>IDENTIFICATION OF RELATIVES IN THE GOVERNMENT SERVICE</b>';
		
		$data['msg'] 				= '';
		
		$e = new Employee_m();
		
		$data['employee'] 			= $e->get_by_id ($employee_id);
		
		if ( $this->input->post('op'))
		{
			$a = new Asset_relative();
			
			$a->where( 'employee_id',  $employee_id )->get();
			
			$a->delete_all();
			
			$names 			= $this->input->post('name');
			$position 		= $this->input->post('position');
			$relationship 	= $this->input->post('relationship');
			$name_address 	= $this->input->post('name_address');
		
			
			$i = 0;
			
			foreach ($names as $name)
			{
				if ($name != "")
				{
					$a = new Asset_relative();
					
					$a->employee_id			= $employee_id;
					$a->name 				= $names[$i];
					$a->position 			= $position[$i];
					$a->relationship 			= $relationship[$i];
					$a->name_address 	= $name_address[$i];
					
					$a->save();	
						
				}
				
				$i++;
			}
			
			
			$data['msg'] = $data['section_name'].' has been saved!';
						
		}
				
		$a = new Asset_relative();
		$a->order_by('name');
		
		$data['relatives'] = $a->get_by_employee_id($employee_id);
		
		$data['selected'] = $e->office_id;
		
		//Use for office listbox
		$data['options'] = $this->options->office_options();
		
		$data['employee_id'] 		= $employee_id;
		
		$data['main_content'] = 'assets_relatives';
		
		$this->load->view('includes/template', $data);
		
	}
	
	// --------------------------------------------------------------------
	
	function assets_other_info( $employee_id = '' )
	{
		$data['page_name'] 			= '<b>Assets and Liabilities</b>';
		
		$data['section_name'] 		= '<b>Other Info</b>';
		
		$data['msg'] 				= '';
		
		$e = new Employee_m();
		
		$data['employee'] 			= $e->get_by_id ($employee_id);
		
		if ( $this->input->post('op'))
		{
			$a = new Asset_info();
			
			$a->where( 'employee_id',  $employee_id )->get();
			
			$a->employee_id			= $employee_id;
			$a->s_tin 				= $this->input->post('s_tin');
			$a->s_cc_no 			= $this->input->post('s_cc_no');
			$a->s_issue_at 			= $this->input->post('s_issue_at');
			$a->s_issue_date 		= $this->input->post('s_issue_date');
			
			$a->tin 				= $this->input->post('tin');
			$a->cc_no 				= $this->input->post('cc_no');
			$a->issue_at 			= $this->input->post('issue_at');
			$a->issue_date 			= $this->input->post('issue_date');
			
			$a->save();	
						
			$data['msg'] = $data['section_name'].' has been saved!';
						
		}
				
		$a = new Asset_info();
		
		$data['info'] = $a->get_by_employee_id($employee_id);
		
		$data['selected'] = $e->office_id;
		
		//Use for office listbox
		$data['options'] = $this->options->office_options();
		
		$data['employee_id'] 		= $employee_id;
		
		$data['main_content'] = 'assets_other_info';
		
		$this->load->view('includes/template', $data);
		
	}
	
	// --------------------------------------------------------------------
	
	function plantilla($office_id = '')
	{
		
		$data['page_name'] 			= '<b>Plantilla of Personnel</b>';
		$data['msg'] 				= '';
				
		$data['error_msg'] = '';
		
		//Use for office listbox
		$data['options'] 			= $this->options->office_options();
		$data['selected'] 			= $this->session->userdata('office_id');
		
		//Months
		$data['month_options'] 		= $this->options->month_options();
		$data['month_selected'] 	= date('m');
		
		//days
		$data['days_options'] 		= $this->options->days_options();
		$data['days_selected'] 		= date('d');
		
		
		$data['year_options'] 		= $this->options->year_options(2009, 2020);//2010 - 2020
		$data['year_selected'] 		= date('Y');
		
		if($this->input->post('op'))
		{
			$is_employee_id_exists = $this->Employee->is_employee_id_exists($this->input->post('employee_id'));
		
			if($is_employee_id_exists == FALSE)
			{
				$data['error_msg'] = 'Invalid Employee No.';
			}
			
			$date_cutoff = $this->input->post('year2').'-'.
						   $this->input->post('month2').'-'.
						   $this->input->post('day2');
			
			$forwarded_note = 'Bal. forwarded as of '.
							$this->input->post('month2').'-'.
							$this->input->post('day2').'-'.
							$this->input->post('year2');
			
			$data['msg'] = $this->Forwarded_leave->add_forwarded_leave( $this->input->post('employee_id'), 
																 		$this->input->post('vacation'), 
																 		$this->input->post('sick'),
																 		$forwarded_note,
																		$date_cutoff
																		);
			
			// Remove balance forwarded
			$this->Leave_card->delete_balance_forwarded($this->input->post('employee_id'));
			
			// Delete all entry less than the date forwarded
			$this->Leave_card->delete_less_forwarded($this->input->post('employee_id'), $date_cutoff);
					
			// Put to leave card			
			$info = array(
						"employee_id"	=> $this->input->post('employee_id'),
						"particulars"	=> $forwarded_note,
						"v_balance" 	=> $this->input->post('vacation'),
						"s_balance" 	=> $this->input->post('sick'),
						"date"			=> $this->input->post('year2').'-'.
										   $this->input->post('month2').'-'.
										   $this->input->post('day2')
						);
						
			$this->Leave_card->add_leave_card($info);				
		}
				
		$data['main_content'] = 'plantilla/plantilla';
		
		$this->load->view('includes/template', $data);
		
	}
	
	function index()
	{
		$data = array();
		
		$data['msg'] = '';
		
		$data['bread_crumbs'] = 'Home / Maintenance / ';
		
		$data['page_name'] = 'Personnel Administration';
		
		$this->load->view('includes/header');
		
		$this->load->view('includes/menu', $data);
		$this->load->view('includes/body_top', $data);
		
		$this->load->view('index', $data);
		
		$this->load->view('includes/footer');
	}
	
	
	function employee_positions()
	{
		$data = array();
		
		$data['msg'] = '';
		
		$data['bread_crumbs'] = 'Home / Maintenance / Personnel Administration / ';
		
		$data['page_name'] = 'Employee Positions';
		
		$this->load->view('includes/header');
		
		$this->load->view('includes/menu', $data);
		$this->load->view('includes/body_top', $data);
		
		
		$p = new Position();
		
		$this->load->library('pagination');
		
		$config['base_url'] = base_url().'personnel_administration/employee_positions/';
		$config['total_rows'] = $p->get()->count();
		$config['per_page'] = '15';
		
		$this->pagination->initialize($config);
		
		
		
		
		// How many related records we want to limit ourselves to
		$limit = $config['per_page'];
		
		// The page we're looking at
		//$page = $this->uri->segment(3);
		
		// Set the offset for our paging
		//$offset = $page * $limit;
		$offset = $this->uri->segment(3);
		
		// Get all positions
		$p = new Position();
		$p->order_by('name');
		
		$data['positions'] = $p->get($limit, $offset);
		
		$this->load->view('employee_positions', $data);
		
		$this->load->view('includes/footer');
	}
	
	function salary_adjustment()
	{
		$data = array();
		
		$data['msg'] = '';
		
		$data['bread_crumbs'] = 'Home / Maintenance / Personnel Administration / ';
		
		$data['page_name'] = 'Salary Adjustment';
		
		$this->load->view('includes/header');
		
		$this->load->view('includes/menu', $data);
		$this->load->view('includes/body_top', $data);
		
		
		$p = new Position();
		
		$this->load->library('pagination');
		
		$config['base_url'] = base_url().'personnel_administration/employee_positions/';
		$config['total_rows'] = $p->get()->count();
		$config['per_page'] = '15';
		
		$this->pagination->initialize($config);
		
		
		
		
		// How many related records we want to limit ourselves to
		$limit = $config['per_page'];
		
		// The page we're looking at
		//$page = $this->uri->segment(3);
		
		// Set the offset for our paging
		//$offset = $page * $limit;
		$offset = $this->uri->segment(3);
		
		// Get all positions
		$p = new Position();
		$p->order_by('name');
		
		$data['positions'] = $p->get($limit, $offset);
		
		$this->load->view('employee_positions', $data);
		
		$this->load->view('includes/footer');
	}
}

/* End of file home.php */
/* Location: ./system/application/modules/home/controllers/home.php */