<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Integrated Human Resource Management Information System
 *
 * An Open source Application Software use by Government agencies for 
 * management of employees Attendance, Leave Administration, Payroll, 
 * Personnel Training, Service Records, Performance, Recruitment,
 * Personnel Schedule(Plantilla) and more...
 *
 * @package		iHRMIS
 * @author		Manny Isles
 * @copyright	Copyright (c) 2008 - 2013, Charliesoft
 * @license		http://charliesoft.net/ihrmis/license
 * @link		http://charliesoft.net
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * iHRMIS Users Class
 *
 * This class use for converting number of minutes late
 * to the corresponding equivalent to leave credits.
 *
 * @package		iHRMIS
 * @subpackage	Models
 * @category	Models
 * @author		Manny Isles
 * @link		http://charliesoft.net/hrmis/user_guide/models/conversion_table.html
 */
class Expenses extends MX_Controller  {

	// --------------------------------------------------------------------
	
	function __construct()
    {
        parent::__construct();
		
		$this->load->helper('security');
		$this->load->helper('budget_options');
				
		//$this->output->enable_profiler(TRUE);
    }  
	
	// --------------------------------------------------------------------
	
	/**
	 * Enter description here...
	 *
	 */
	function index( $id = '', $from_budget = '')
	{
		$data['page_name'] = '<b>Expenses</b>';
		
		$data['msg'] = '';
		
		$data['id'] = '';
		
		$data['from_budget'] = $from_budget;
		
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
		
		$e = new Budget_expenses_m();
		
		if($this->input->post('op'))
		{
			if ( $this->input->post('budget_expenditure_id') != 0)
			{
				$e->where('budget_expenditure_id', $this->input->post('budget_expenditure_id'));
			}	
		}
		
		// If the id is from url
		if($id != '')
		{
			$e->where('budget_expenditure_id', $id);
			$data['id'] = $id;
		}
		
		$e->order_by('date');
		
		$data['expenses'] = $e->get();
		
		$data['page'] = $this->uri->segment(3);
				
		$data['main_content'] = 'expenses/index';
		
		$this->load->view('includes/template', $data);
		
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Enter description here...
	 *
	 */
	function save($id = '', $budget_expenditure_id = '')
	{
		$data['page_name'] = '<b>Add Expenses</b>';
		
		if ($id != '')
		{
			$data['page_name'] = '<b>Edit Expenses</b>';
		}
		
		$data['msg'] = '';
		
		$e = new Budget_expenses_m();
		
		$data['expense'] = $e->get_by_id($id);
		
		if ($budget_expenditure_id != '')
		{
			$_POST['budget_expenditure_id'] = $budget_expenditure_id;
		}
						
		//If form submit
		if($this->input->post('op'))
		{	
			$this->form_validation->set_rules('budget_expenditure_id', 'Object of Expenditure', 'required');
			$this->form_validation->set_rules('date', 'Date', 'required');
			$this->form_validation->set_rules('description', 'Description', 'required');
			$this->form_validation->set_rules('amount', 'Amount', 'required');
			
			if ($this->form_validation->run($this) == TRUE)
			{
				$e->budget_expenditure_id	= $this->input->post('budget_expenditure_id');
				$e->date					= $this->input->post('date');
				$e->description 			= $this->input->post('description');
				$e->amount 					= $this->input->post('amount');
				
				$e->save();
																					 
				$this->session->set_flashdata('msg', 'Expenses has been saved!');
						
				redirect(base_url().'budget/expenses/index/'.$this->input->post('budget_expenditure_id'), 'refresh');		
			}
					
		}
				
		$data['main_content'] = 'expenses/save';
		
		$this->load->view('includes/template', $data);
		
	}
	
	
	// --------------------------------------------------------------------
	
	/**
	 * Enter description here...
	 *
	 * @param unknown_type $username
	 */
	function delete($id = '')
	{
		$e = new Budget_expenses_m();
		$e->get_by_id( $id )->delete();
				
		$this->session->set_flashdata('msg', 'User has been deleted!');
		
		redirect(base_url().'budget/expenses/', 'refresh');
		
	}
	
	// --------------------------------------------------------------------
}

/* End of file users.php */
/* Location: ./application/modules/users/controllers/users.php */