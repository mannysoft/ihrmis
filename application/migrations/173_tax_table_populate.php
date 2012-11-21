<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_tax_table_populate extends CI_Migration {
	
	function up() 
	{			
		$data = array(
  array('id' => '1','start_range' => '0','end_range' => '10000','fix_amount' => '0','percentage' => '5','over_limit' => '0'),
  array('id' => '2','start_range' => '10000','end_range' => '30000','fix_amount' => '500','percentage' => '10','over_limit' => '10000'),
  array('id' => '3','start_range' => '30000','end_range' => '70000','fix_amount' => '2500','percentage' => '15','over_limit' => '30000'),
  array('id' => '4','start_range' => '70000','end_range' => '140000','fix_amount' => '8500','percentage' => '20','over_limit' => '70000'),
  array('id' => '5','start_range' => '140000','end_range' => '250000','fix_amount' => '22500','percentage' => '25','over_limit' => '140000'),
  array('id' => '6','start_range' => '250000','end_range' => '500000','fix_amount' => '50000','percentage' => '30','over_limit' => '250000'),
  array('id' => '7','start_range' => '500000','end_range' => '0','fix_amount' => '125000','percentage' => '34','over_limit' => '500000')
);

		// Lets truncate the table first
		$this->db->truncate('payroll_tax_table'); 

		$this->db->insert_batch('payroll_tax_table', $data); 
	}

	function down() 
	{		
		return TRUE;
	}
}
