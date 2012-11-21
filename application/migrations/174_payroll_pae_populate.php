<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_payroll_pae_populate extends CI_Migration {
	
	function up() 
	{			
		$data = array(
  array('id' => '1','tax_status' => 'Head of the Family','description' => 'For head of the family','effectivity_date' => '2012-12-01','effectivity_date_to' => 'present','exemption' => '50000'),
  array('id' => '2','tax_status' => 'Married','description' => 'For each employed married individual','effectivity_date' => '2012-12-01','effectivity_date_to' => 'present','exemption' => '50000'),
  array('id' => '3','tax_status' => 'Single','description' => 'For single individual','effectivity_date' => '2012-12-01','effectivity_date_to' => 'present','exemption' => '50000'),
);

		// Lets truncate the table first
		$this->db->truncate('payroll_pae'); 

		$this->db->insert_batch('payroll_pae', $data); 
	}

	function down() 
	{		
		return TRUE;
	}
}
