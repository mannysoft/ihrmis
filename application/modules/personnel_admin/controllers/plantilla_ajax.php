<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Plantilla_ajax extends MX_Controller  
{
	// --------------------------------------------------------------------
	
	function __construct()
    {
        parent::__construct();
		//$this->load->model('options');
		//$this->output->enable_profiler(TRUE);
    }
	
	// --------------------------------------------------------------------
	
	function plantilla($office_id = '', $year = '2009' )
	{
		$data 			= array();
		
		
		$this->Employee->fields = array(
                                'id',
                                'employee_id',
                                'office_id',
                                'lname',
                                'fname',
                                'mname'
                                );
        
		$data['rows'] = $this->Employee->get_employee_list($this->session->userdata('office_id'), '');
		
		if ($office_id != '')
		{
			$data['rows'] = $this->Employee->get_employee_list($office_id, '');
		}
		
		//
		$data['year'] = $year;
		
		foreach ( $data['rows'] as $row)
		{
			$c = new Plantilla();
			
			$c->where('employee_id', $row['id']);
			$c->where('year', $year);
			$c->get();
			
			if ( $c->exists())// Do nothing
			{
				//echo 'cool';
			}
			else// Insert blank
			{
				$c->employee_id 	= $row['id'];
				$c->year 			= $year;
				//$c->type 			= 'balance';
				$c->save();
				//echo 'not cool';
			}
		}
		
		$this->load->view('ajax/plantilla', $data);
	}
	
	function edit_place($mode = '')
	{		
		if ($mode == 'plantilla')
		{
			$c = new Plantilla();
		
			$c->where('id', $this->input->post('rowid'));
			
			$c->get();
			
			$field = $this->input->post('colid');	
			$c->$field = $this->input->post('new');
			
			$c->save();
			
			exit;
		}
	}
	
}

/* End of file home.php */
/* Location: ./system/application/modules/home/controllers/home.php */