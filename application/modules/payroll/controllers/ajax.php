<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax extends MX_Controller {

	// --------------------------------------------------------------------
	
	function __construct()
    {
        parent::__construct();
		
		header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
		header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
		//$this->output->enable_profiler(TRUE);
    }  
	
	// --------------------------------------------------------------------
	
	function edit_place($mode = '')
	{
		
		if ($mode == 'tax_exempt')
		{
			$e = new Employee_m();
		
			$e->where('id', $this->input->post('rowid'));
			
			$e->get();
			
			if ( $this->input->post('colid') == 'tax_status' )
			{
				$e->tax_status = $this->input->post('new');
			}
			if ( $this->input->post('colid') == 'dependents' )
			{
				$e->dependents = $this->input->post('new');
			}
			
			$e->save();
			
			exit;
		}
		
	}
	
	// --------------------------------------------------------------------
	
	function tax($office_id = '')
	{
		//echo 'ee';
		$data 			= array();
		
		
		$this->Employee->fields = array(
                                'id',
                                'employee_id',
                                'office_id',
                                'lname',
                                'fname',
                                'mname',
								'tax_status',
								'dependents',
                                );
        
		$data['rows'] = $this->Employee->get_employee_list($this->session->userdata('office_id'), '');
		
		if ($office_id != '')
		{
			$data['rows'] = $this->Employee->get_employee_list($office_id, '');
		}
		
		$this->load->view('ajax/tax', $data);
	}
	
	// --------------------------------------------------------------------
	
}	