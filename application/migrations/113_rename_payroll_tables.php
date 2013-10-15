<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_rename_payroll_tables extends CI_Migration {
	
	function up() 
	{					
		//if ( $this->db->table_exists('deduction_agencies'))
		//{	
			$this->dbforge->rename_table('deduction_agencies', 'payroll_deduction_agencies');
		//}	
		//if ( $this->db->table_exists('deduction_informations'))
		//{	
			$this->dbforge->rename_table('deduction_informations', 'payroll_deduction_informations');
		//}	
		//if ( $this->db->table_exists('deduction_loans'))
		//{	
			$this->dbforge->rename_table('deduction_loans', 'payroll_deduction_loans');
		//}	
		//if ( $this->db->table_exists('deduction_optional'))
		//{	
			$this->dbforge->rename_table('deduction_optional', 'payroll_deduction_optional');
		//}		
	}

	function down() 
	{		
		
	}
}
