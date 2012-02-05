<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Compensatory_timeoff extends DataMapper{

	var $table  = 'compensatory_timeoffs';
	// --------------------------------------------------------------------
	
	var $fields 		= array();
	var $office_id 		= '';
	var $num_rows 		= 0;
	
	function __construct()
	{
		parent::__construct();
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Get all leave applications
	 *
	 * @param int $approved
	 * @return array
	 */
	function get_cto_apps($per_page = "", $off_set = "", $approved = '')
	{
		$data = array();
		
		$this->db->select($this->fields);
		
		if ( $approved != '')
		{
			$this->db->where('approved', $approved);
		}
		
		if ( $this->office_id != '')
		{
			$this->db->where('office_id', $this->office_id);
		}
		
		$this->db->where('type', 'spent');
		
		$this->db->order_by('id', 'desc');
		
		if ( $per_page != '' and $off_set != '' )
		{
			$this->db->limit($per_page, $off_set);
		}
		
		$q = $this->db->get('compensatory_timeoffs');
		
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
	 * Search leave applications
	 *
	 * @param int $tracking_no
	 * @return array
	 */
	function search_cto_apps($tracking_no = '')
	{
		$data = array();
		
		$this->db->select($this->fields);
		
		if ($tracking_no != '')
		{
			 $this->db->where('id', $tracking_no);
		}	 
		
		if ( $this->office_id != '')
		{
			$this->db->where('office_id', $this->office_id);
		}
		
		$this->db->where('type', 'spent');
		
		//$this->db->order_by('date_encode');
		
		$q = $this->db->get('compensatory_timeoffs');
		
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
	
	
	function get_cto_apps_info($tracking_no)
	{
		$this->db->select($this->fields);
		
		$data = array();
		
		$this->db->where('id', $tracking_no);
		$q = $this->db->get('compensatory_timeoffs');
		
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
	
	function set_approved($id = '')
	{
		$data = array('status' => 'active');
		$this->db->where('id', $id);
		$this->db->update('compensatory_timeoffs', $data);
	}
	
}

/* End of file user.php */
/* Location: ./application/models/pages.php */