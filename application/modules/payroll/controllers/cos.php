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
		
		$this->office_id = (Input::get('office_id')) ? 
					  		Input::get('office_id') :
					 		Session::get('office_id');
							
		$this->period 	= 	Input::get('month').'-'.
							Input::get('period_from').'-'.
							Input::get('period_to').'-'.
							Input::get('year');
						
		$this->date1 	= 	Input::get('year').'-'.
							Input::get('month').'-'.
							Input::get('period_from');
					
		$this->date2 	= 	Input::get('year').'-'.
							Input::get('month').'-'.
							Input::get('period_to');			
		
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
		
		if (Input::get('op'))
		{
			$data['rows'] = $this->Employee->get_employee_list($this->office_id, '');
			
			$c = new Cos_status();
			$c->populate($data['rows']);
			
		}
		
		$data['main_content'] = 'cos/status';
		
		return View::make('includes/template', $data);
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
		
		if (Input::get('op'))
		{
			$data['rows'] = $this->Employee->get_employee_list($this->office_id, '');
			
			$data['period'] = $this->period;
			
			$data['count_working_days'] = $this->count_working_days;
			
			if (Input::get('print'))
			{
				$data['pop_up'] = 1;
				$data['pop_up_office_id'] 	= $this->office_id;
				$data['pop_up_period'] 		= $this->period;
			}
			
			$j = new Jo_days();
			$j->populate($data['rows'], $this->count_working_days, $this->period);
		}
		
		$data['main_content'] = 'cos/index';
		
		return View::make('includes/template', $data);
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
		
		return View::make('includes/template', $data);
		
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
		$data['month_selected'] 	= (Input::get('month')) ? Input::get('month') : date('m');
		
		// Period from
		$data['days_options'] 		= $this->options->days_options();
		
		$data['period_from_selected'] = (Input::get('period_from')) ? Input::get('period_from') : '01';
		
		// Period to
		$data['days_options'] 		= $this->options->days_options();
		$data['days_selected'] 		= (Input::get('period_to')) ? Input::get('period_to') : '15';
		
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
		
		if (Input::get('op'))
		{
			$data['rows'] = $this->Employee->get_employee_list($this->office_id, '');
						
			$data['period'] = $this->period;
			
			$data['count_working_days'] = $this->count_working_days;		
			
			if (Input::get('print'))
			{
				$data['pop_up'] = 1;
				$data['pop_up_office_id'] 	= $this->office_id;
				$data['pop_up_period'] 		= $this->period;
			}
			
			
			$j = new Jo_days();
			$j->populate($data['rows'], $this->count_working_days, $this->period);
		}
		
		$data['main_content'] = 'cos/jo';
		
		return View::make('includes/template', $data);
	}
	
	// --------------------------------------------------------------------
	
	function edit_place($mode = '')
	{
		if ($mode == 'rates')
		{
			$r = new Rates();
		
			$r->where('id', Input::get('rowid'));
			
			$r->get();
			
			if ( Input::get('colid') == 'rate_per_day' )
			{
				$r->rate_per_day = Input::get('new');
			}
			if ( Input::get('colid') == 'pagibig_amount' )
			{
				$r->pagibig_amount = Input::get('new');
			}		
			
			
			$r->save();
						
			exit;
		}
		
		if ($mode == 'jo_days')
		{
			$j = new Jo_days();
		
			$j->where('id', Input::get('rowid'));
			
			$j->get();
			
			if ( Input::get('colid') == 'hours' )
			{
				$j->hours = Input::get('new');
			}
			if ( Input::get('colid') == 'days' )
			{
				$j->days = Input::get('new');
			}
						
			$j->save();
						
			exit;
		}
		
		if ($mode == 'status')
		{
			$c = new Cos_status();
		
			$c->where('id', Input::get('rowid'));
			
			$c->get();
						
			$c->status = Input::get('new');
			
			$c->save();
						
			exit;
		}
	}
	
	// --------------------------------------------------------------------

}	