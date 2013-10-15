<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_employee_add_columns_birth_date extends CI_Migration {
	
	function up() 
	{	
		$field = array('birth_date' => array('type' => 'DATE', 'null' =>false));	
		
		$this->dbforge->add_column('employee', $field, 'post_grad');
		
		$field = array('res_address' => array('type' => 'DATE', 'null' =>false));	
		
		$this->dbforge->add_column('employee', $field, 'birth_date');
		
		if (  $this->db->table_exists('pds_personal_info') )
		{	
			//$this->migrations->verbose AND print "copying data...";
			
			$q = $this->db->get('pds_personal_info');
		
			if ($q->num_rows() > 0)
			{
				foreach ($q->result_array() as $row)
				{
					$data = array(
							'birth_date' => $row['birth_date'],
							'res_address' => $row['res_address']
							);
					
					$this->db->where('employee_id', $row['employee_id']);
					
					$this->db->update('employee', $data);
				}
			}
		}
		

	}

	function down() 
	{
		
		$this->dbforge->drop_column('employee', 'birth_date');
		$this->dbforge->drop_column('employee', 'res_address');
		
		
	}
}
