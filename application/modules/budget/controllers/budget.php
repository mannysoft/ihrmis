<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Integrated Human Resource Management Information System
 *
 * An Open Source Application Software use by Government agencies for  
 * management of employees Attendance, Leave Administration, Payroll, 
 * Personnel Training, Service Records, Performance, Recruitment,
 * Personnel Schedule(Plantilla) and more...
 *
 * @package		iHRMIS
 * @author		Manny Isles
 * @copyright	Copyright (c) 2008 - 2014, Charliesoft
 * @license		http://charliesoft.net/ihrmis/license
 * @link		http://charliesoft.net
 * @github	    http://github.com/mannysoft/ihrmis
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * iHRMIS Budget Class
 *
 * This class use for converting number of minutes late
 * to the corresponding equivalent to leave credits.
 *
 * @package		iHRMIS
 * @subpackage	Models
 * @category	Models
 * @author		Manny Isles
 * @link		http://charliesoft.net
 * @github	    http://github.com/mannysoft/ihrmis/hrmis/user_guide/models/conversion_table.html
 */
class Budget extends MX_Controller  {

	// --------------------------------------------------------------------
	
	function __construct()
    {
        parent::__construct();
		
		$this->load->helper('security');
		
		// Check if table exists, create if not
		$this->load->library('install_budget');
		$this->install_budget->install();
		
				
		//$this->output->enable_profiler(TRUE);
    }  
	
	// --------------------------------------------------------------------
	
	/**
	 * Enter description here...
	 *
	 */
	function index()
	{
		$data['page_name'] = '<b>Object of Expenditures</b>';
		
		$data['msg'] = '';
		
		$data['focus_field'] = 'keyword';
		
		$this->load->library('pagination');
		
		$b = new Budget_expenditure_m();
		
		$config['base_url'] = base_url().'budget/index';
		$config['total_rows'] = $b->get()->count();
		$config['per_page'] = '500';
		$config['full_tag_open'] = '<p>';
	    $config['full_tag_close'] = '</p>';
		
		$this->pagination->initialize($config);
		
		// How many related records we want to limit ourselves to
		$limit = $config['per_page'];
		
		// Set the offset for our paging
		$offset = $this->uri->segment(3);
		
		//$b->order_by('training_type');
		
		$data['expenditures'] = $b->get($limit, $offset);
		
		$data['page'] = $this->uri->segment(3);
				
		$data['main_content'] = 'index';
		
		return View::make('includes/template', $data);
		
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Enter description here...
	 *
	 */
	function save($id = '')
	{
		$data['page_name'] = '<b>Add Object of Expenditures</b>';
		
		if ($id != '')
		{
			$data['page_name'] = '<b>Edit Object of Expenditures</b>';
		}
		
		$data['msg'] = '';
		
		$data['focus_field'] = 'expenditures';
		
		$b = new Budget_expenditure_m();
		
		$data['expenditure'] = $b->get_by_id($id);
						
		//If form submit
		if(Input::get('op'))
		{	
			$this->form_validation->set_rules('expenditures', 'Expenditures', 'required');
			$this->form_validation->set_rules('account_code', 'Account Code', 'required');
			$this->form_validation->set_rules('year', 'Year', 'required');
			$this->form_validation->set_rules('budget_amount', 'Budget', 'required|numeric');
			
			if ($this->form_validation->run($this) == TRUE)
			{
				$b->expenditures	= Input::get('expenditures');
				$b->account_code	= Input::get('account_code');
				$b->year 			= Input::get('year');
				$b->budget_amount 	= Input::get('budget_amount');
				
				$b->save();
																					 
				Session::flash('msg', 'Object of Expenditures has been saved!');
						
				return Redirect::to('budget/', 'refresh');		
			}
					
		}
				
		$data['main_content'] = 'save';
		
		return View::make('includes/template', $data);
		
	}
	
	
	// --------------------------------------------------------------------
	
	/**
	 * Enter description here...
	 *
	 * @param unknown_type $username
	 */
	function delete($id = '')
	{
		$b = new Budget_expenditure_m();
		$b->get_by_id( $id )->delete();
				
		Session::flash('msg', 'User has been deleted!');
		
		return Redirect::to('budget/', 'refresh');
		
	}
	
	// --------------------------------------------------------------------
}

/* End of file users.php */
/* Location: ./application/modules/users/controllers/users.php */