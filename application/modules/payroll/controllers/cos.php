<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cos extends MX_Controller {

	public $office_id = '';
	public $period = '';
	public $date1 = '';
	public $date2 = '';
	
	function __construct()
    {
        parent::__construct();
		
		$this->load->model('options');
		
		$this->office_id = ($this->input->post('office_id')) ? 
					  		$this->input->post('office_id') :
					 		$this->session->userdata('office_id');
							
		$this->period 	= 	$this->input->post('month').'-'.
							$this->input->post('period_from').'-'.
							$this->input->post('period_to').'-'.
							$this->input->post('year');
						
		$this->date1 	= 	$this->input->post('year').'-'.
							$this->input->post('month').'-'.
							$this->input->post('period_from');
					
		$this->date2 	= 	$this->input->post('year').'-'.
							$this->input->post('month').'-'.
							$this->input->post('period_to');			
		
		$this->count_working_days = $this->Holiday->count_working_days($this->date1, $this->date2);
		
		$this->load->library('tax');		
				
		$this->output->enable_profiler(TRUE);
    }
	
	// --------------------------------------------------------------------
	
	function status()
	{
		$data['pop_up'] = 0;
		
		$data['page_name'] = '<b>Contract of Service Status</b>';
		$data['msg'] = '';
		
		$data['error_msg'] = '';
		
		// Use for office listbox
		$data['options'] 			= $this->options->office_options();
		$data['selected'] 			= $this->office_id;
		
		$this->Employee->fields = array(
                                'id',
                                'employee_id',
                                'office_id',
                                'lname',
                                'fname',
                                'mname',
								'position',
								'tax_status',
								'dependents'
                                );
								
		$this->Employee->employment_type = 3;						
        
		
		$data['rows'] = array();
		
		$data['pop_up_office_id'] = $this->office_id;
		
		if ($this->input->post('op'))
		{
			$data['rows'] = $this->Employee->get_employee_list($this->office_id, '');
			
			$c = new Cos_status();
			$c->populate($data['rows']);
			
		}
		
		$data['main_content'] = 'cos/status';
		
		$this->load->view('includes/template', $data);
	}
	
	// --------------------------------------------------------------------
	
	function index()
	{		
		$data['pop_up'] = 0;
		
		$data['page_name'] = '<b>Contract of Service Payroll</b>';
		$data['msg'] = '';
		
		$data['error_msg'] = '';
								
		$this->Employee->fields = array(
                                'id',
                                'employee_id',
                                'office_id',
                                'lname',
                                'fname',
                                'mname',
								'position',
								'salary_grade',
								'step',
								'tax_status',
								'dependents'
                                );
								
		$this->Employee->employment_type = 3;						
        
		
		$data['rows'] = array();
		
		$data['pop_up_office_id'] = $this->office_id;
		$data['pop_up_period'] = 1;
		
		if ($this->input->post('op'))
		{
			$data['rows'] = $this->Employee->get_employee_list($this->office_id, '');
			
			$data['period'] = $this->period;
			
			$data['count_working_days'] = $this->count_working_days;
			
			if ($this->input->post('print'))
			{
				$data['pop_up'] = 1;
				$data['pop_up_office_id'] 	= $this->office_id;
				$data['pop_up_period'] 		= $this->period;
			}
			
			$j = new Jo_days();
			$j->populate($data['rows'], $this->count_working_days, $this->period);
		}
		
		$data['main_content'] = 'cos/index';
		
		$this->load->view('includes/template', $data);
	}
	
	// --------------------------------------------------------------------
	
	function rates()
	{
		$data['page_name'] = '<b>Job Order Employee Rates</b>';
		
		$data['msg'] = '';
		
		$data['error_msg'] = '';
		
		$this->Employee->employment_type = '4';
		
		$this->Employee->fields = array(
                                'id',
                                'employee_id',
                                'office_id',
                                'lname',
                                'fname',
                                'mname'
                                );
        
		
		$data['rows'] = $this->Employee->get_employee_list($this->office_id, '');
		
		$r = new Rates();
		
		$r->populate($data['rows']);
		
		$data['main_content'] = 'cos/rates';
		
		$this->load->view('includes/template', $data);
		
	}
	
	// --------------------------------------------------------------------
	
	function jo()
	{

		$data['pop_up'] = 0;
		
		$data['page_name'] = '<b>Daily Wage Payroll - Job Order</b>';
		$data['msg'] = '';
		
		$data['error_msg'] = '';
		
		// Use for office listbox
		$data['options'] 			= $this->options->office_options();
		$data['selected'] 			= $this->office_id;
		
			// Months
		$data['month_options'] 		= $this->options->month_options();
		$data['month_selected'] 	= ($this->input->post('month')) ? $this->input->post('month') : date('m');
		
		// Period from
		$data['days_options'] 		= $this->options->days_options();
		
		$data['period_from_selected'] = ($this->input->post('period_from')) ? $this->input->post('period_from') : '01';
		
		// Period to
		$data['days_options'] 		= $this->options->days_options();
		$data['days_selected'] 		= ($this->input->post('period_to')) ? $this->input->post('period_to') : '15';
		
		$data['year_options'] 		= $this->options->year_options(2009, 2020);//2010 - 2020
		$data['year_selected'] 		= date('Y');
		
		$this->Employee->fields = array(
                                'id',
                                'employee_id',
                                'office_id',
                                'lname',
                                'fname',
                                'mname',
								'tax_status',
								'dependents'
                                );
								
		$this->Employee->employment_type = 4;						
        
		
		$data['rows'] = array();
		
		$data['pop_up_office_id'] = $this->office_id;
		$data['pop_up_period'] = 1;
		
		if ($this->input->post('op'))
		{
			$data['rows'] = $this->Employee->get_employee_list($this->office_id, '');
						
			$data['period'] = $this->period;
			
			$data['count_working_days'] = $this->count_working_days;		
			
			if ($this->input->post('print'))
			{
				$data['pop_up'] = 1;
				$data['pop_up_office_id'] 	= $this->office_id;
				$data['pop_up_period'] 		= $this->period;
			}
			
			
			$j = new Jo_days();
			$j->populate($data['rows'], $this->count_working_days, $this->period);
		}
		
		$data['main_content'] = 'cos/jo';
		
		$this->load->view('includes/template', $data);
	}
	
	// --------------------------------------------------------------------
	
	function edit_place($mode = '')
	{
		if ($mode == 'rates')
		{
			$r = new Rates();
		
			$r->where('id', $this->input->post('rowid'));
			
			$r->get();
						
			$r->rate_per_day = $this->input->post('new');
			
			$r->save();
						
			exit;
		}
		
		if ($mode == 'jo_days')
		{
			$j = new Jo_days();
		
			$j->where('id', $this->input->post('rowid'));
			
			$j->get();
			
			if ( $this->input->post('colid') == 'hours' )
			{
				$j->hours = $this->input->post('new');
			}
			if ( $this->input->post('colid') == 'days' )
			{
				$j->days = $this->input->post('new');
			}
						
			$j->save();
						
			exit;
		}
		
		if ($mode == 'status')
		{
			$c = new Cos_status();
		
			$c->where('id', $this->input->post('rowid'));
			
			$c->get();
						
			$c->status = $this->input->post('new');
			
			$c->save();
						
			exit;
		}
	}
	
	// --------------------------------------------------------------------

}	