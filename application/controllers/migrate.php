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
 * @copyright	Copyright (c) 2008 - 2012, Charliesoft
 * @license		http://charliesoft.net/hrmis/user_guide/license.html
 * @link		http://charliesoft.net
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
 * @author		Manolito Isles
 * @link		http://charliesoft.net/hrmis/user_guide/models/agency.html
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
				
		//if ( ! $this->migration->version('052'))
		if ( ! $this->migration->latest())
		{
			
			show_error($this->migration->error_string());
			exit;
		}
		
		//exit;
				
	}
}
