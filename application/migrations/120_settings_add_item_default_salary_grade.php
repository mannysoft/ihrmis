<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_settings_add_item_default_salary_grade extends CI_Migration {
	
	function up() 
	{					
		$data = array(
				'name' 				=> 'default_salary_grade_year',
				'setting_value' 	=> 2011,
				'settings_group'	=> 'general',
				'description'		=> 'the year to be use if needed to use the salary grade.',
				);
		
		$this->db->insert('settings', $data);
		

	}

	function down() 
	{		
		return TRUE;
	}
}
