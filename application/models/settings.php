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
class Settings extends CI_Model {

	// --------------------------------------------------------------------
	
	var $minutes_tardy;
	
	// --------------------------------------------------------------------
	
	/**
	 * Constructor
	 *
	 * @return Settings
	 */
	function __construct()
	{
		parent::__construct();
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Get single field
	 *
	 * @param string $table_field
	 * @return unknown
	 */
	function get_selected_field($table_field = '')
	{
		$field_value = '';
		
		$this->db->select('setting_value');
		$this->db->where('name', $table_field);
		$q = $this->db->get('settings');
		
		if ($q->num_rows() > 0)
		{
			foreach ($q->result_array() as $row)
			{
				$field_value = $row['setting_value'];	
			}
		}
		
		return $field_value;
		
		$q->free_result();
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Get all the settings value
	 *
	 * @return array
	 */
	function get_settings()
	{
		$data = array();
		
		$this->db->select(array('name', 'setting_value'));
		
		$q = $this->db->get('settings');
		
		if ($q->num_rows() > 0)
		{
			foreach ($q->result_array() as $row)
			{
				$data[$row['name']] = $row['setting_value'];	
			}
		}
		
		return $data;
		
		$q->free_result();
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Get version
	 *
	 */
	function get_version()
	{
		$data = array();
		
		$this->db->select('version');
		$q = $this->db->get('settings');
		
		if ($q->num_rows() > 0)
		{
			foreach ($q->result_array() as $row)
			{
				$version  = $row['version'];
			}
		}
		
		return $version;
		
		$q->free_result();
		
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Update the settings
	 *
	 * @param string $name
	 * @param mixed $value
	 */
	function update_settings($name, $value)
	{
		$this->db->where('name', $name);
		$this->db->update('settings', array('setting_value' => $value));
	}
	
}

/* End of file settings.php */
/* Location: ./application/models/settings.php */