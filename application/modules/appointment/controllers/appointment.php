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
 * iHRMIS Conversion Table Class
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
class Appointment extends MX_Controller {

	// --------------------------------------------------------------------
	
	function __construct()
    {
        parent::__construct();
		
		$this->load->model('options');
		
		//$this->output->enable_profiler(TRUE);
    }  
	
	function issued()
	{
		$data['page_name'] = '<b>Appointment Issued</b>';
		
		$data['msg'] = '';
		
		$this->load->library('pagination');
		
		$apointment = new Appointment_issued_m();
		
		$config['base_url'] = base_url().'training_manage/type';
		$config['total_rows'] = $apointment->get()->count();
		$config['per_page'] = '15';
		$this->config->load('pagination', TRUE);
		
		$pagination = $this->config->item('pagination');
		
		// We will merge the config file of pagination
		$config = array_merge($config, $pagination);
		
		$this->pagination->initialize($config);
		
		// How many related records we want to limit ourselves to
		$limit = $config['per_page'];
		
		// Set the offset for our paging
		$offset = $this->uri->segment(3);
		
		$apointment->order_by('id');
		
		$data['rows'] = $apointment->get($limit, $offset);
		
		$data['page'] = $this->uri->segment(3);
				
		$data['main_content'] = 'issued';
		
		return View::make('includes/template', $data);
		
	}
	
	// --------------------------------------------------------------------
	
}	

/* End of file office_manage.php */
/* Location: ./system/application/modules/appointment/controllers/appointment.php */