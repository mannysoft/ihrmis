<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Alter_settings_setting_value extends CI_Migration {
	
	function up() 
	{	
		
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
		
		$fields = array(
                        'setting_value' => array(
                                                         'name' => 'setting_value',
                                                         'type' => 'VARCHAR (256)',
                                                ),
						);
		$this->dbforge->modify_column('settings', $fields);
	}
}
