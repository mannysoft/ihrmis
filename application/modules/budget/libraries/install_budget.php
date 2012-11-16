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
 * @author		Manolito Isles
 * @copyright	Copyright (c) 2008 - 2013, Charliesoft
 * @license		http://charliesoft.net/ihrmis/license
 * @link		http://charliesoft.net
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * iHRMIS Compensatory Timeoff Class
 *
 * This class use for processing compensatory timeoff applications.
 *
 * @package		iHRMIS
 * @subpackage	Libraries
 * @category	Leave
 * @author		Manolito Isles
 * @link		http://charliesoft.net/hrmis/user_guide/libraries/cto.html
 */
class Install_budget {

   	public $employee_id = '';
	public $ci			= '';	
   
    // ------------------------------------------------------------------------
   
    function __construct($params = array())
    {
        if (count($params) > 0)
		{
			$this->initialize($params);
		}
    }
	
	// ------------------------------------------------------------------------
	
	/**
	 * Initialize Preferences
	 *
	 * @access	public
	 * @param	array	initialization parameters
	 * @return	void
	 */
	function initialize($params = array())
	{
		if (count($params) > 0)
		{
			foreach ($params as $key => $val)
			{
				if (isset($this->$key))
				{
					$this->$key = $val;
				}
			}
		}
		
	}
	
	// ------------------------------------------------------------------------
	
	function install()
	{
		$ci = & get_instance();
		
		$ci->load->dbforge();
		
		if ( ! $ci->db->table_exists('budget_expenditures'))
		{	
			// Setup Keys
			$ci->dbforge->add_key('id', TRUE);
			
			$ci->dbforge->add_field(array(
				'id' => array('type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, 'auto_increment' => TRUE),
				'expenditures' => array('type' => 'VARCHAR', 'constraint' => 64),
				'office_id' => array('type' => 'INT', 'constraint' => '11', 'null' => TRUE),
				'year' => array('type' => 'INT', 'constraint' => '4', 'null' => FALSE),
				'budget_amount' => array('type' => 'DOUBLE', 'null' => FALSE),
				'account_code' => array('type' => 'VARCHAR', 'constraint' => '8', 'null' => FALSE),
				
			));
			
			$ci->dbforge->create_table('budget_expenditures', TRUE);
		}
		
		if ( ! $ci->db->table_exists('budget_expenses'))
		{	
			// Setup Keys
			$ci->dbforge->add_key('id', TRUE);
			
			$ci->dbforge->add_field(array(
				'id' => array('type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, 'auto_increment' => TRUE),
				'description' => array('type' => 'VARCHAR', 'constraint' => 128),
				'budget_expenditure_id' => array('type' => 'INT', 'constraint' => '11', 'null' => FALSE),
				'date' => array('type' => 'DATE', 'null' => TRUE),
				'amount' => array('type' => 'DOUBLE', 'null' => FALSE),				
		
			));
			
			$ci->dbforge->create_table('budget_expenses', TRUE);
		}
	}
	
}
