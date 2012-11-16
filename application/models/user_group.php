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
 * @category	Models
 * @author		Manolito Isles
 * @link		http://charliesoft.net/hrmis/user_guide/models/conversion_table.html
 */
class User_group extends CI_Model {

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
	
	
	function get_groups()
	{
		$data = array();
		
		//$this->db->where('id', $id);
		$q = $this->db->get('user_group');
		
		if ($q->num_rows() > 0)
		{
			foreach ($q->result_array() as $row)
			{
				$data[] = $row;
			}
		}
		
		return $data;
		
		$q->free_result();
	}
	
	
	function add_user_group($data)
	{
		$this->db->insert('user_group', $data);
	}
	
	
	function get_user_group_data( $id )
	{
		$data = array();
		
		$this->db->where('id', $id);
		$q = $this->db->get('user_group', 1);
		
		if ($q->num_rows() > 0)
		{
			foreach ($q->result_array() as $row)
			{
				$data = $row;
			}
		}
		
		return $data;
		
		$q->free_result();
	}
	
	function update_user_group( $data, $id )
	{
		$this->db->where('id', $id);
		$this->db->update('user_group', $data);
	}
	
	
	function delete_user_group( $id )
	{
		$this->db->where('id', $id);
		$this->db->delete('user_group');
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