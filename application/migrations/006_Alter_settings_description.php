<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Alter_settings_description extends CI_Migration {
	
	function up() 
	{	
		
		$fields = array(
                        'description' => array('type' => 'TEXT NOT NULL')
						);
						
		$this->dbforge->add_column('settings', $fields);

	}

	function down() 
	{
		
		
		$this->dbforge->drop_column('settings', 'description');
	}
}
