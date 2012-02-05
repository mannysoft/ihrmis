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
 * ATLMS Agency Class
 *
 * This class use for agency information
 *
 * @package		ATLMS
 * @subpackage	Models
 * @category	Models
 * @author		Manolito Isles
 * @link		http://charliesoft.com/atlms/user_guide/models/agency.html
 */
class Schema_version extends CI_Model {
	
	function __construct()
	{
		parent::__construct();
	}
	
	// ------------------------------------------------------------------------
	
	function get_version()
	{
		$version = 0;
		
		$this->db->select('version');
		
		$q = $this->db->get('schema_version');
		
		if ($q->num_rows() > 0)
		{
			foreach ($q->result_array() as $row)
			{
				$version = $row['version'];
			}
		}
		
		return $version;
		
		$q->free_result();	
	}
	
}

/* End of file agency.php */
/* Location: ./application/models/agency.php */