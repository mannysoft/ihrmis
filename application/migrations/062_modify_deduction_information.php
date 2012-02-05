<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_modify_deduction_information extends CI_Migration {
	
	function up() 
	{	
		//$this->migrations->verbose AND print "modify_deduction_information...";
		
		$fields = array(
                        'agency' => array(
                                                         'name' => 'deduction_agency_id',
                                                         'type' => 'INT (11) NOT NULL',
                                                ),
		);
		
		$this->dbforge->modify_column('deduction_informations', $fields);

	}

	function down() 
	{
		//$this->migrations->verbose AND print "modifying pds_education_background table columns...";
		
		$fields = array(
                        'deduction_agency_id' => array(
                                                         'name' => 'agency',
                                                         'type' => 'INT (11) NOT NULL',
                                                ),
		);
		
		$this->dbforge->modify_column('deduction_informations', $fields);
		
	}
}
