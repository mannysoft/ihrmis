<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_settings_add_item_encoded_leave_listing_order extends CI_Migration {
	
	function up() 
	{			
		// Do only if Province of Laguna
		$lgu_code = Setting::getField( 'lgu_code' );
		
		$order = 'DESC';
		
		if ($lgu_code == 'laguna_province')
		{
			$order = 'ASC';
		}
		
		$data = array(
				'name' 				=> 'encoded_leave_listing_order',
				'setting_value' 	=> $order,
				'settings_group'	=> 'leave',
				'description'		=> 'Display the encoded leave in file leave. ASC or DESC',
				);
		
		$this->db->insert('settings', $data);
		

	}

	function down() 
	{		
		$this->db->where('name', 'encoded_leave_listing_order');
		$this->db->delete('settings');	
	}
}
