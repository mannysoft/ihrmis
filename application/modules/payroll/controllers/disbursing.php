<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Disbursing extends MX_Controller {

	function __construct()
    {
        parent::__construct();
		
		$this->load->model('options');
		
		//$this->output->enable_profiler(TRUE);
    }
	
	// --------------------------------------------------------------------
	
	function index()
	{				
		$data['page_name'] = '<b>Disbursing Officers</b>';
		
		$data['msg'] = '';
		
		$d = new Disbursing_officer();
				
		$d->order_by('name');
		
		$data['rows'] = $d->get();
		
		$data['main_content'] = 'disbursing/index';
		
		$this->load->view('includes/template', $data);	
		
	}
	
	// --------------------------------------------------------------------
	
	function save( $id = '' )
	{		
		$data['page_name'] = '<b>Save Disbursing Officer</b>';
				
		$data['msg'] = '';
			
		$d = new Disbursing_officer();
		
		$data['row'] = $d->get_by_id( $id );
		
		if ( $this->input->post('op'))
		{
			$d->name 	= $this->input->post('name');
			
			$d->save();
			
			redirect(base_url().'payroll/disbursing', 'refresh');
			
		}
	
		$data['main_content'] = 'disbursing/save';
		
		$this->load->view('includes/template', $data);	
	}
	
	// --------------------------------------------------------------------
	
	function delete( $id = '' )
	{
		$d = new Disbursing_officer();
		
		$d->get_by_id( $id );
		
		$d->delete();
		
		redirect(base_url().'payroll/disbursing', 'refresh');
		
	}

}	