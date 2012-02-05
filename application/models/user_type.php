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
class User_type extends CI_Model {

	// --------------------------------------------------------------------
	
	/**
	 * Constructor
	 *
	 * @return User_type
	 */
	function __construct()
	{
		parent::__construct();
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Get the user type of a user
	 *
	 * @param int $id
	 * @return string
	 */
	function get_user_type($id)
	{
		$user_type = '';
		
		$this->db->where('id', $id);
		$q = $this->db->get('user_type');
		
		if ($q->num_rows() > 0)
		{
			foreach ($q->result_array() as $row)
			{
				$user_type = $row['name'];
			}
		}
		
		return $user_type;
		
		$q->free_result();
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Get selected field in user info
	 *
	 * @param string $field
	 * @param int $id
	 * @return string
	 */
	function select($field, $id)
	{
		if($field == '')
		{
			$field = '*';
		}
		
		$this->db->select($field);
		$this->db->where('id', $id);
		$q = $this->db->get('user_type', 1);
		
		if ($q->num_rows() > 0)
		{
			foreach ($q->result_array() as $row)
			{
				$user_type = $row[$field];	
			}
		}
		
		return $user_type;
		
		$q->free_result();
		
	}
	
}

/* End of file user_type.php */
/* Location: ./application/models/user_type.php */