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
class Office extends CI_Model {

	// --------------------------------------------------------------------
	
	var $num_rows = 0;
	var $fields = array();
	
	// --------------------------------------------------------------------
	
	/**
	 * Constructor
	 *
	 * @return Office
	 */
	function __construct()
	{
		parent::__construct();
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Add new office
	 *
	 * @param unknown_type $office_name
	 */
	function add_office($data)
	{
		$this->db->insert('office', $data); 
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Delete office
	 *
	 * @param int $office_id
	 */
	function delete_office($office_id)
	{
		$this->db->delete('office', array('office_id' => $office_id)); 
	}
	
	// --------------------------------------------------------------------
	
	function get_office_info($office_id)
	{
		$data = array('office_head' => '', 'position' => '');
		
		$this->db->limit(1);
		
		$this->db->where('office_id', $office_id);
		
		$q = $this->db->get('office');
		
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
	
	// --------------------------------------------------------------------
	
	/**
	 * get office name
	 *
	 * @param int $id
	 * @return string
	 */
	function get_office_name($id)
	{
		$data = array();
		
		$this->db->limit(1);
		
		$this->db->select('office_name');
		$this->db->where('office_id', $id);
		
		$q = $this->db->get('office');
		
		if ($q->num_rows() > 0)
		{
			foreach ($q->result_array() as $row)
			{
				$data = $row['office_name'];
			}
		}
		
		return $data;
		
		$q->free_result();
	
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Get all offices
	 *
	 * @param unknown_type $limit
	 * @return array
	 */
	function get_offices( $per_page = "", $off_set = "" )
	{
		$data = array();
		
		$this->db->select($this->fields);
		
		$this->db->order_by('office_name');
		if ( $per_page != '' or $off_set != '' )
		{
			$this->db->limit($per_page, $off_set);
		}
		$q = $this->db->get('office');
		
		$this->num_rows = $q->num_rows();
		
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
	
	// --------------------------------------------------------------------
	
	/**
	 * Tells whether an office is compensatory or not
	 *
	 * @param int $office_id
	 * @return string
	 */
	function is_compensatory($office_id)
	{
		$data = array();
		
		$this->db->select('compensatory');
		$this->db->where('office_id', $office_id);
		$this->db->limit(1);
		$q = $this->db->get('office');
		
		if ($q->num_rows() > 0)
		{
			foreach ($q->result_array() as $row)
			{
				$data = $row['compensatory'];
			}
		}
		
		return $data;
		
		$q->free_result();
	
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Tells whether an office exists
	 *
	 * @param string $office_name
	 * @return boolean
	 */
	function is_office_exists($office_name)
	{

		$this->db->select('office_id');
		$this->db->where('office_name', $office_name);
		$q = $this->db->get('office');
		
		if ($q->num_rows() > 0)
		{
			return TRUE;
		}
		
		else
		{
			return FALSE;	
		}
		
		$q->free_result();
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Update office name
	 *
	 * @param string $office_name
	 * @param int $office_id
	 */
	function update_office($data, $office_id)
	{
		$this->db->where('office_id', $office_id);
		$this->db->update('office', $data); 
	}
}

/* End of file office.php */
/* Location: ./application/models/office.php */