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
 * iHRMIS Migrate Class
 *
 * This class use for migrating database.
 *
 * @package		iHRMIS
 * @subpackage	Controllers
 * @category	Utilities
 * @author		Manny Isles
 * @link		http://charliesoft.net
 * @github	    http://github.com/mannysoft/ihrmis/hrmis/user_guide/models/agency.html
 */

class Migrate extends MX_Controller{
	
	function __construct()
	{		
		//table schema_version involve here
		
		parent::__construct();
		
		// As of iHRMIS 2.0
		// We need to check if migrations table exists
		// If not exists rename the 'schema_version' table to 'migrations'
		// We have changed the migrations library from third party to
		// built in to CI Lib
		if ( ! $this->db->table_exists('migrations'))
		{
			if ( $this->db->table_exists('schema_version'))
			{	
				$this->load->dbforge();
				
				$this->dbforge->rename_table('schema_version', 'migrations');
			}
		}
	
		$this->load->library('migration');
				
		//if ( ! $this->migration->version('070'))
		if ( ! $this->migration->latest())
		{
			
			show_error($this->migration->error_string());
			exit;
		}
		
		//exit;
				
	}
}
