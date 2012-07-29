<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_settings_add_item_auto_deduct_forced_leave extends CI_Migration {
	
	function up() 
	{			
		// Do only if Province of Laguna
		$lgu_code = $this->Settings->get_selected_field( 'lgu_code' );
		
		$auto = 'no';
		
		if ($lgu_code == 'laguna_province')
		{
			$auto = 'yes';
		}
		
		$data = array(
				'name' 				=> 'auto_deduct_forced_leave',
				'setting_value' 	=> $auto,
				'settings_group'	=> 'leave',
				'description'		=> 'Set if auto deduct the forced leave every end of the year.',
				);
		
		$this->db->insert('settings', $data);
		

	}

	function down() 
	{		
		$this->db->where('name', 'auto_deduct_forced_leave');
		$this->db->delete('settings');	
	}
}
