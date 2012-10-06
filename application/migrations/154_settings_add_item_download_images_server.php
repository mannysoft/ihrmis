<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_settings_add_item_download_images_server extends CI_Migration {
	
	function up() 
	{							
		// Do only if Puerto
		$lgu_code = $this->Settings->get_selected_field( 'lgu_code' );
		
		$download_images_server = 'no';
		
		if ($lgu_code == 'marinduque_province')
		{
			$download_images_server = 'yes';
		}
		
		$data = array(
				'name' 				=> 'download_images_server',
				'setting_value' 	=> $download_images_server,
				'settings_group'	=> 'attendance',
				'description'		=> 'whether to auto download images from server to client',
				);
		
		$this->db->insert('settings', $data);
	}

	function down() 
	{		
		return TRUE;
	}
}
