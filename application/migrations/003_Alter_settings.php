<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Alter_settings extends CI_Migration {
	
	function up() 
	{	
		//$this->migrations->verbose AND print "Altering table settings...";
		
		$fields = array(
                        'setting_value' => array(
                                                      'name' => 'setting_value',
                                                      'type' => 'TEXT',
                                                ),
						);
		$this->dbforge->modify_column('settings', $fields);
		


	}

	function down() 
	{
		//$this->migrations->verbose AND print "Altering table settings...";
		
		$fields = array(
                        'setting_value' => array(
                                                         'name' => 'setting_value',
                                                         'type' => 'VARCHAR (256)',
                                                ),
						);
		$this->dbforge->modify_column('settings', $fields);
	}
}
