<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_tax_table_remove_comma extends CI_Migration {
	
	function up() 
	{			
		
		//$data = array('bracket2' => 'REPLACE("bracket2", ",", "")');
		
		//$this->db->update('payroll_tax_table2', $data);
		$this->db->query("UPDATE ats_payroll_tax_table2 SET bracket2 = REPLACE(bracket2, ',', ''), 
															bracket3 = REPLACE(bracket3, ',', ''),
															bracket4 = REPLACE(bracket4, ',', ''),
															bracket5 = REPLACE(bracket5, ',', ''),
															bracket6 = REPLACE(bracket6, ',', ''),
															bracket7 = REPLACE(bracket7, ',', ''),
															bracket8 = REPLACE(bracket8, ',', '')
															
		
		");
	}

	function down() 
	{		
		return TRUE;
	}
}
