<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_insert_leave_type_rural_service extends CI_Migration {
	
	function up() 
	{	
			$data = array(
				'id' 			=> '23',
				'code' 			=> 'RUR. Service',
				'leave_name' 	=> 'Rural Service',
				);
		
			$this->db->insert('leave_type', $data);

	}

	function down() 
	{
		$this->db->where('id', '23');
		$this->db->delete('leave_type');
	}
}
