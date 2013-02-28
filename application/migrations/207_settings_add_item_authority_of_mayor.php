<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_settings_add_item_authority_of_mayor extends CI_Migration {
	
	function up() 
	{					
		$data = array(
				'name' 				=> 'authority_of_mayor',
				'setting_value' 	=> '',
				'settings_group'	=> 'signatories',
				'description'		=> 'The signatories in the authority of the Mayor.',
				);
		
		$this->db->insert('settings', $data);
	}

	function down() 
	{		
		return TRUE;
	}
}
