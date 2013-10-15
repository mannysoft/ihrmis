<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_insert_leave_type_centennial_leave extends CI_Migration {
	
	function up() 
	{	
			$data = array(
				'id' 			=> '22',
				'code' 			=> 'CENT. LEAVE',
				'leave_name' 	=> 'Centennial Leave',
				);
		
			$this->db->insert('leave_type', $data);

	}

	function down() 
	{
		$this->db->where('id', '22');
		$this->db->delete('leave_type');
	}
}
