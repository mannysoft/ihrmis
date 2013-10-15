<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_settings_add_item_sched_retirement_signatories extends CI_Migration {
	
	function up() 
	{			
		
		$retirement_signatory_prepared 				= '';
		$retirement_signatory_prepared_position 	= '';
		$retirement_signatory_approved 				= '';
		$retirement_signatory_approved_position 	= '';
		$retirement_signatory_certified				= '';
		$retirement_signatory_certified_position	= '';
		$retirement_signatory_attested				= '';
		$retirement_signatory_attested_position		= '';
		$retirement_signatory_availability			= '';
		$retirement_signatory_availability_position = '';
		$retirement_signatory_noted					= '';
		$retirement_signatory_noted_position		= '';
		
		// Do only if Province of Laguna
		$lgu_code = $this->Settings->get_selected_field( 'lgu_code' );
				
		if ($lgu_code == 'laguna_province')
		{
			$retirement_signatory_prepared 				= 'LEILANI M. SILAN';
			$retirement_signatory_prepared_position 	= 'Administrative Officer  V';
			$retirement_signatory_approved 				= 'JEORGE E.R. EJERCITO ESTREGAN';
			$retirement_signatory_approved_position 	= 'Governor';
			$retirement_signatory_certified				= 'NIDA A. REBENQUE';
			$retirement_signatory_certified_position	= "Asst. Prov'l HRMO";
			$retirement_signatory_attested				= 'EUGENIA R. MAGANO';
			$retirement_signatory_attested_position		= 'Provincial Human Resource Management Officer';
			$retirement_signatory_availability			= 'MARIETA V. JARA';
			$retirement_signatory_availability_position = 'Provincial Budget Officer';
			$retirement_signatory_noted					= 'EVELYN T. VILLANUEVA';
			$retirement_signatory_noted_position		= 'Provincial Accountant';
		}
		
		$data = array(
		   array(
				'name' 				=> 'retirement_signatory_prepared',
				'setting_value' 	=> $retirement_signatory_prepared,
				'settings_group'	=> 'leave',
				'description'		=> '.',
				),
		   array(
				'name' 				=> 'retirement_signatory_prepared_position',
				'setting_value' 	=> $retirement_signatory_prepared_position,
				'settings_group'	=> 'leave',
				'description'		=> '.',
				),
			array(
				'name' 				=> 'retirement_signatory_approved',
				'setting_value' 	=> $retirement_signatory_approved,
				'settings_group'	=> 'leave',
				'description'		=> '.',
				),
			array(
				'name' 				=> 'retirement_signatory_approved_position',
				'setting_value' 	=> $retirement_signatory_approved_position,
				'settings_group'	=> 'leave',
				'description'		=> '.',
				),
			array(
				'name' 				=> 'retirement_signatory_certified',
				'setting_value' 	=> $retirement_signatory_certified,
				'settings_group'	=> 'leave',
				'description'		=> '.',
				),
			array(
				'name' 				=> 'retirement_signatory_certified_position',
				'setting_value' 	=> $retirement_signatory_certified_position,
				'settings_group'	=> 'leave',
				'description'		=> '.',
				),
			array(
				'name' 				=> 'retirement_signatory_attested',
				'setting_value' 	=> $retirement_signatory_attested,
				'settings_group'	=> 'leave',
				'description'		=> '.',
				),
			array(
				'name' 				=> 'retirement_signatory_attested_position',
				'setting_value' 	=> $retirement_signatory_attested_position,
				'settings_group'	=> 'leave',
				'description'		=> '.',
				),
			array(
				'name' 				=> 'retirement_signatory_availability',
				'setting_value' 	=> $retirement_signatory_availability,
				'settings_group'	=> 'leave',
				'description'		=> '.',
				),
			array(
				'name' 				=> 'retirement_signatory_availability_position',
				'setting_value' 	=> $retirement_signatory_availability_position,
				'settings_group'	=> 'leave',
				'description'		=> '.',
				),
			array(
				'name' 				=> 'retirement_signatory_noted',
				'setting_value' 	=> $retirement_signatory_noted,
				'settings_group'	=> 'leave',
				'description'		=> '.',
				),
			array(
				'name' 				=> 'retirement_signatory_noted_position',
				'setting_value' 	=> $retirement_signatory_noted_position,
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
