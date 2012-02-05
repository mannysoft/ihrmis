<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Attendance Tracking and Leave Management System
 *
 * An Application Software use by Government agencies for management
 * of employees Attendance and Leave Administration.
 *
 * @package		ATLMS
 * @author		Manolito Isles
 * @copyright	Copyright (c) 2008 - 2012, Charliesoft
 * @license		http://charliesoft.com/atlms/user_guide/license.html
 * @link		http://charliesoft.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * ATLMS Conversion Table Class
 *
 * This class use for converting number of minutes late
 * to the corresponding equivalent to leave credits.
 *
 * @package		ATLMS
 * @subpackage	Models
 * @category	Models
 * @author		Manolito Isles
 * @link		http://charliesoft.com/atlms/user_guide/models/conversion_table.html
 */
class Schedule_detail extends DataMapper{ 

	// --------------------------------------------------------------------
	var $has_one = array("schedule");
	
	function __construct()
	{
		parent::__construct();
	}

}

/* End of file schedule.php */
/* Location: ./application/models/schedule.php */