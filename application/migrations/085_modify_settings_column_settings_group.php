<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_modify_settings_column_settings_group extends CI_Migration {
	
	
	function up() 
	{	
		
		$fields = array(
                        'settings_group_id' => array(
                                                         'name' => 'settings_group',
                                                         'type' => 'VARCHAR (32) NOT NULL',
                                                ),
		);
		
		$this->dbforge->modify_column('settings', $fields);

	}

	function down() 
	{
		
		//$fields = array(
                        //'deduction_agency_id' => array(
                                                         //'name' => 'agency',
                                                        // 'type' => 'INT (11) NOT NULL',
                                               // ),
		//);
		
		//$this->dbforge->modify_column('deduction_informations', $fields);
		
	}
}
