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
		
		return View::make('includes/template', $data);	
		
	}
	
	// --------------------------------------------------------------------
	
	function save( $id = '' )
	{		
		$data['page_name'] = '<b>Save Disbursing Officer</b>';
				
		$data['msg'] = '';
			
		$d = new Disbursing_officer();
		
		$data['row'] = $d->get_by_id( $id );
		
		if ( Input::get('op'))
		{
			$d->name 	= Input::get('name');
			
			$d->save();
			
			return Redirect::to('payroll/disbursing', 'refresh');
			
		}
	
		$data['main_content'] = 'disbursing/save';
		
		return View::make('includes/template', $data);	
	}
	
	// --------------------------------------------------------------------
	
	function delete( $id = '' )
	{
		$d = new Disbursing_officer();
		
		$d->get_by_id( $id );
		
		$d->delete();
		
		return Redirect::to('payroll/disbursing', 'refresh');
		
	}

}	