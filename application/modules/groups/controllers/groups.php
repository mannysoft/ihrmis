<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Integrated Human Resource Management Information System
 *
 * An Application Software use by Government agencies for management
 * of employees Attendance, Leave Administration, Payroll, Personnel
 * Training, Service Records, Performance, Recruitment and more...
 *
 * @package		iHRMIS
 * @author		Manolito Isles
 * @copyright	Copyright (c) 2008 - 2013, Charliesoft
 * @license		http://charliesoft.net/ihrmis/license
 * @link		http://charliesoft.net
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * iHRMIS Conversion Table Class
 *
 * This class use for converting number of minutes late
 * to the corresponding equivalent to leave credits.
 *
 * @package		iHRMIS
 * @subpackage	Models
 * @category	Models
 * @author		Manolito Isles
 * @link		http://charliesoft.net/hrmis/user_guide/models/conversion_table.html
 */
class Groups extends MX_Controller {

	// --------------------------------------------------------------------
	
	function __construct()
    {
        parent::__construct();
		
		$this->load->model('options');
		
		//$this->output->enable_profiler(TRUE);
    }  
	
	// --------------------------------------------------------------------
	
	function index()
	{
		$data['page_name'] = '<b>Groups</b>';
		
		$data['msg'] = '';
		
		$this->load->library('pagination');
		
		$s = new Group_m();
		
		$config['base_url'] = base_url().'groups/index';
		$config['total_rows'] = $s->count();
		$config['per_page'] = '15';
		$config['full_tag_open'] = '<p>';
	    $config['full_tag_close'] = '</p>';
		
		$this->pagination->initialize($config);
		
		// How many related records we want to limit ourselves to
		$limit = $config['per_page'];
		
		// Set the offset for our paging
		$offset = $this->uri->segment(3);
		
		$s->order_by('name');
		
		$data['rows'] = $s->get($limit, $offset);
		
		$data['page'] = $this->uri->segment(3);
				
		$data['main_content'] = 'index';
		
		$this->load->view('includes/template', $data);
	
	}
	
	// --------------------------------------------------------------------
	
	function save( $id = '' )
	{		
		$data['page_name'] 	= '<b>Groups</b>';
		$data['legend'] 	= '<b>Add</b>';
		$data['focus_field'] 	= '';
		
		if ( $id != '' )
		{
			$data['legend'] 	= '<b>Edit</b>';
		}
		
		$data['msg'] = '';
			
		$s = new Group_m();
		
		$data['row'] = $s->get_by_id( $id );
				
		
		if ( $this->input->post('op'))
		{
			$this->form_validation->set_rules('name', 'Name', 'required');
			$this->form_validation->set_rules('description', 'Description', 'required');
						
			if ($this->form_validation->run($this) == TRUE)
			{
				$s->name 				= $this->input->post('name');
				$s->description 		= $this->input->post('description');
				$s->percent_discount 	= $this->input->post('percent_discount');
				$s->amount_discount 	= $this->input->post('amount_discount');
				$s->save();
				
				redirect(base_url().'groups', 'refresh');
			}
		}
	
		$data['main_content'] = 'save';
		
		$this->load->view('includes/template', $data);	
	}
	
	// --------------------------------------------------------------------
	
	function delete( $id = '' )
	{
		$p = new Student_m();
		
		$p->get_by_id( $id );
		
		$p->delete();
		
		redirect(base_url().'students', 'refresh');
		
	}
}	

/* End of file groups.php */
/* Location: ./system/application/modules/groups/controllers/groups.php */