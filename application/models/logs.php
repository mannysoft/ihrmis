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
class Logs extends CI_Model {

	
	// --------------------------------------------------------------------
	
	public $num_rows = 0;
	public $office_id = '';
	public $username = '';
	public $module = '';
	public $date1 = '';
	public $date2 = '';
	
	// --------------------------------------------------------------------
	
	/**
	 * Constructor
	 *
	 * @return Logs
	 */
	function __construct()
	{
		parent::__construct();
		
		
	}
	
	// --------------------------------------------------------------------
	
	function add_logs($data)
	{
		$this->db->insert('logs', $data);
	}
	
	// --------------------------------------------------------------------
	
	function count_logs($office_id = '')
	{
		$this->db->like('office_id', $office_id);
		$this->db->from('logs');
		
		$this->num_rows = $this->db->count_all_results();
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Delete all logs
	 *
	 */
	function delete_all_logs()
	{
		$this->db->truncate('logs'); 

	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Delete selected logs
	 *
	 * @param int $id
	 */
	function delete_logs($id)
	{
		$this->db->delete('logs', array('id' => $id)); 
	}
	
	// --------------------------------------------------------------------
	
	
	/**
	 * Get logs by office
	 *
	 * @param int $office_id
	 * @param int $per_page
	 * @param int $off_set
	 * @return array
	 */
	function get_logs($office_id = '', $per_page = "", $off_set = "")
	{
		$data = array();
		
		if ($office_id != '' and ! $this->input->post('office_id'))
		{
			$this->db->where('office_id', $office_id);
		}
		
		if ($this->username != '')
		{
			$this->db->where('username', $this->username);
		}
		
		if ($this->module != '')
		{
			$this->db->where('module', $this->module);
		}
		
		if ($this->date1 != '' and $this->date2 != '')
		{
			$this->db->where('DATE(date) BETWEEN "'.$this->date1.'" and "'.$this->date2.'"');
		}
		
		$this->db->order_by('date', 'DESC');
		
		$this->db->limit($per_page, $off_set);
		
		$q = $this->db->get('logs');
		
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
	 * Insert to logs
	 *
	 * @param string $command
	 * @param varchar $employee_id_affected
	 */
	function insert_logs($module, $command, $details = '1', $employee_id_affected = '1')
	{
		
		$this->load->helper('date');
		
		$data = array(
               'module'					=> $module,
			   'username' 				=> $this->session->userdata('username'),
               'office_id' 				=> $this->session->userdata('office_id'),
               'command' 				=> $command,
               'details'				=> $details,
               'employee_id_affected' 	=> $employee_id_affected,
               //'date' 					=> date('Y-m-d h:i')
            );

		$this->db->insert('logs', $data);

	}
	
	// --------------------------------------------------------------------
	
	function is_log_exists($username, $office_id, $date)
	{
		$options = array(
			'username' 		=> $username, 
			'office_id' 	=> $office_id,
			'date' 			=> $date
			);
		
		$q = $this->db->get_where('logs', $options, 1);
		
		if ($q->num_rows() > 0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	
		//return $data;
		
		$q->free_result(); 
	}
}

/* End of file logs.php */
/* Location: ./application/models/logs.php */