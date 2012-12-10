<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_settings_add_item_proposed_salary_grade_year extends CI_Migration {
	
	function up() 
	{					
		$data = array(
				'name' 				=> 'proposed_salary_grade_year',
				'setting_value' 	=> '2011',
				'settings_group'	=> 'general',
				'description'		=> 'Proposed Salary Grade Year',
				);
		
		$this->db->insert('settings', $data);

	}

	function down() 
	{		
		return TRUE;
	}
}
