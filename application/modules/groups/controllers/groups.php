<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Integrated Human Resource Management Information System 3.0dev
 *
 * An Open Source Application Software use by Government agencies for  
 * management of employees Attendance, Leave Administration, Payroll, 
 * Personnel Training, Service Records, Performance, Recruitment,
 * Personnel Schedule(Plantilla) and more...
 *
 * @package		iHRMIS
 * @author		Manny Isles
 * @copyright	Copyright (c) 2008 - 2014, Isles Technologies
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
class Groups extends MX_Controller {

	protected $group;
	
	// --------------------------------------------------------------------
	
	function __construct()
    {
        parent::__construct();
		
		$this->load->model('options');
		
		$this->group = new GroupEloquent;
		
		//$this->output->enable_profiler(TRUE);
    }  
	
	// --------------------------------------------------------------------
	
	function index()
	{
		$data['page_name'] = '<b>Groups</b>';
		
		$data['msg'] = '';
		
		$data['rows'] = $this->group->orderBy('name')->get();
			
		$data['main_content'] = 'index';
		
		return View::make('includes/template', $data);
	
	}
	
	function add()
	{
		$data['page_name'] 	= '<b>Groups</b>';
		$data['legend'] 	= '<b>Add</b>';
		$data['focus_field'] 	= 'name';
		
		$data['msg'] = '';
						
		// If form submit
		if(Input::get('op'))
		{			
			$g = $this->group->fill(Input::all());
			
			if($g->save())
			{				
				Session::flash('msg', 'Group has been saved!');
						
				return Redirect::to('groups', 'refresh');
			}
			
			$data['errors'] = $g->errors;
		}
				
		$data['main_content'] = 'add';
		
		return View::make('includes/template', $data);
		
	}
	
	// --------------------------------------------------------------------
	
	function save( $id = '' )
	{		
		$data['page_name'] 	= '<b>Groups</b>';
		
		$data['focus_field'] 	= '';
		
		$data['legend'] 	= '<b>Edit</b>';
		
		$data['msg'] = '';
					
		$data['row'] = $g = $this->group->find( $id );
				
		if ( Input::get('op'))
		{
			$g->fill(Input::all());
			
			if($g->save())
			{				
				Session::flash('msg', 'Group has been saved!');
						
				return Redirect::to('groups', 'refresh');
			}
			
			$data['errors'] = $g->errors;
		}
	
		$data['main_content'] = 'save';
		
		return View::make('includes/template', $data);	
	}
	
	// --------------------------------------------------------------------
}	

/* End of file groups.php */
/* Location: ./system/application/modules/groups/controllers/groups.php */