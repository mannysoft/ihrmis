<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Integrated Human Resource Management Information System
 *
 * An Open Source Application Software use by Government agencies for  
 * management of employees Attendance, Leave Administration, Payroll, 
 * Personnel Training, Service Records, Performance, Recruitment,
 * Personnel Schedule(Plantilla) and more...
 *
 * @package		iHRMIS
 * @author		Manny Isles
 * @copyright	Copyright (c) 2008 - 2013, Charliesoft
 * @license		http://charliesoft.net/ihrmis/license
 * @link		http://charliesoft.net
 * @github	    http://github.com/mannysoft/ihrmis
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
 * @author		Manny Isles
 * @link		http://charliesoft.net
 * @github	    http://github.com/mannysoft/ihrmis/hrmis/user_guide/models/conversion_table.html
 */
class User extends CI_Model{

	public $fields = array();
	
	// --------------------------------------------------------------------
	
	/**
	 * Constructor
	 *
	 * @return User
	 */
	function __construct()
	{
		parent::__construct();
		
		$this->load->helper('security');
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Add new user
	 *
	 * @param unknown_type $info
	 * @return unknown
	 */
	function add_user($data)
	{
		$this->db->insert('users', $data);
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Delete user
	 *
	 * @param varchar $username
	 */
	function delete_user($username)
	{
		$this->db->delete('users', array('username' => $username)); 
	}
	
	// --------------------------------------------------------------------
	
	function get_current_password($username)
	{
		$current_password = '';
		
		$this->db->select($this->fields);
		$this->db->where('username', $username);
		$this->db->limit(1);
		$q = $this->db->get('users');
		
		if ($q->num_rows() > 0)
		{
			foreach ($q->result_array() as $row)
			{
				$current_password = $row['password'];
			}
		}
		
		return $current_password;
		
		$q->free_result();
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Get the maximum user
	 *
	 * @return varchar
	 */
	function get_max_user()
	{
		$max_user = '';
		
		$this->db->select_max('username', 'max_user');
		$q = $this->db->get('users');
		
		if ($q->num_rows() > 0)
		{
			foreach ($q->result_array() as $row)
			{
				$max_user = $row['max_user'] + 1;
			}
		}
		
		return $max_user;
		
		$q->free_result();
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * THE FUNCTIONS BELOW ARE FOR TIMEKEEPER
	 * Get the data of a user
	 *
	 * @param varchar $username
	 * @return array
	 */
	function get_user_data($username)
	{
		$data = array();
		
		$this->db->where('username', $username);
		$this->db->limit(1);
		$q = $this->db->get('users');
		
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
	 * Get users
	 *
	 * @param array $fields
	 * @return array
	 */
	function get_users($fields = array())
	{
		$data = array();
		
		$this->db->select($this->fields);
		$this->db->from('users');
		$this->db->join('office', 'office.office_id = user.office_id');
		$this->db->join('user_type', 'user_type.id = user.user_type');
		$this->db->order_by('lname');
		$q = $this->db->get();
		
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
	 * Check if username exists
	 *
	 * @param string $username
	 * @return boolean
	 */
	function is_username_exists($username)
	{
		$this->db->select('username');
		$this->db->where('username', $username);
		$q = $this->db->get('users');
		
		
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
	 * Tells whether a user is valid or not
	 *
	 * @param varchar $username
	 * @param varchar $password
	 * @return boolean
	 */
	function is_valid_user($username, $password)
	{
		$this->db->where('username', $username);
		$this->db->where('password', $password);
		$this->db->where('stat', 1);
		
		$q = $this->db->get('users');
		
		
		
		if ($q->num_rows() > 0)
		{
			return TRUE;
		}
		else 
		{
			return FALSE;
		}
		
		return $data;
		
		$q->free_result();
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Update or edit user account
	 *
	 * @param array $data
	 * @param int $user_id
	 */
	function update_user($data, $id = '')
	{
		$this->db->where('id', $id);
		$this->db->update('users', $data); 
	}
	
	// --------------------------------------------------------------------
	
	function update_user_pass($pass, $username)
	{
		$data = array('password' => $pass);
		
		$this->db->where('username', $username);
		$this->db->update('users', $data); 
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Validate the username and password
	 *
	 * @param mixed $username
	 * @param mixed $password
	 * @return array
	 */
	function validate_user($username, $password)
	{
		$data = array();
		
		$data['system_message'] = '';
		
		//Encript password
		$password = do_hash($password, 'md5');
		
		$options = array('username' => $username, 'password' => $password, 'stat' => 'Active');
		$q = $this->db->get_where('users', $options, 1);
			
		if ($q->num_rows() > 0)
		{
			$row = $q->row();
			
			$fname 		= $row->fname;
			$lname 		= $row->lname;
			$mname 		= $row->mname;
			$user_type 	= $row->user_type;
				
			$username = $username;
				
			$session_data = array(
							'username'	=> $row->username, 
							'lname' 	=> $row->lname,
							'office_id' => $row->office_id,
							'user_type' => $row->user_type
							);

			$this->session->set_userdata($session_data);
				
			$data['system_message'] = 'valid';
				
		}
			
		return $data;
	}
	
	// --------------------------------------------------------------------
	
}

/* End of file user.php */
/* Location: ./application/models/user.php */