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
 * iHRMIS Conversion Table Class
 *
 * This class use for converting number of minutes late
 * to the corresponding equivalent to leave credits.
 *
 * @package		iHRMIS
 * @subpackage	Models
 * @category	Helpers
 * @author		Manolito Isles
 * @link		http://charliesoft.net/hrmis/user_guide/models/conversion_table.html
 */

// --------------------------------------------------------------------
	
function budget_expenditures_options($e = '')
{
	//$ci &= get_instance();
	
	//$this->load->model('budget_expenditure_m');
		
	$options  = array();
	
	$b = new Budget_expenditure_m();
	
	$expenditures = $b->order_by('account_code')->get();
	
	$options[''] = '---ALL---';
	
	foreach($expenditures as $expenditure)
	{
		$options[$expenditure->id] = $expenditure->expenditures;
	}
	
	return $options;
	
}