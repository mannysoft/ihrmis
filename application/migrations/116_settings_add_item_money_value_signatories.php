<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_settings_add_item_money_value_signatories extends CI_Migration {
	
	function up() 
	{			
		$money_value_signatory_prepared 			= '';
		$money_value_signatory_prepared_position 	= '';
		$money_value_signatory_certified 			= '';
		$money_value_signatory_certified_position 	= '';
		
		// Do only if Province of Laguna
		$lgu_code = $this->Settings->get_selected_field( 'lgu_code' );
				
		if ($lgu_code == 'laguna_province')
		{
			$money_value_signatory_prepared 			= 'LEILANI M. SILAN';
			$money_value_signatory_prepared_position 	= 'HRMO III';
			$money_value_signatory_certified 			= 'NIDA A. REBENQUE';
			$money_value_signatory_certified_position 	= 'Asst. Provincial HRMO';
		}
		
		$data = array(
		   array(
				'name' 				=> 'money_value_signatory_prepared',
				'setting_value' 	=> $money_value_signatory_prepared,
				'settings_group'	=> 'leave',
				'description'		=> '.',
				),
		   array(
				'name' 				=> 'money_value_signatory_prepared_position',
				'setting_value' 	=> $money_value_signatory_prepared_position,
				'settings_group'	=> 'leave',
				'description'		=> '.',
				),
			array(
				'name' 				=> 'money_value_signatory_certified',
				'setting_value' 	=> $money_value_signatory_certified,
				'settings_group'	=> 'leave',
				'description'		=> '.',
				),
			array(
				'name' 				=> 'money_value_signatory_certified_position',
				'setting_value' 	=> $money_value_signatory_certified_position,
				'settings_group'	=> 'leave',
				'description'		=> '.',
				)		
				
		);
				
		$this->db->insert_batch('settings', $data);
		
		
		

	}

	function down() 
	{		
		return TRUE;
	}
}
