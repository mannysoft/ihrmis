<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cos extends MX_Controller {

	public $office_id = '';
	
	function __construct()
    {
        parent::__construct();
		
		$this->load->model('options');
		
		$this->office_id = ($this->input->post('office_id')) ? 
					  		$this->input->post('office_id') :
					 		$this->session->userdata('office_id');
				
		$this->output->enable_profiler(TRUE);
    }
	
	function index()
	{
		echo 'loan don';
	}
	
	// --------------------------------------------------------------------
	
	function rates()
	{
		$data['page_name'] = '<b>Employee Rates</b>';
		
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
			
			$period = 	$this->input->post('month').'-'.
						$this->input->post('period_from').'-'.
						$this->input->post('period_to').'-'.
						$this->input->post('year');
						
			$data['period'] = $period;			
			
			if ($this->input->post('print'))
			{
				$data['pop_up'] = 1;
				$data['pop_up_office_id'] = $this->office_id;
				$data['pop_up_period'] = $period;
			}
			
			if ($this->input->post('number_days') != '')
			{
				$j = new Jo_days();
				$j->populate($data['rows'], $this->input->post('number_days'), $period);
			}
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
						
			$j->days = $this->input->post('new');
			
			$j->save();
						
			exit;
		}
	}
	
	// --------------------------------------------------------------------

}	