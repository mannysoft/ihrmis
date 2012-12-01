<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_leave_earn_sched_set_done extends CI_Migration {
	
	function up() 
	{							
		
		$lgu_code = $this->Settings->get_selected_field( 'lgu_code' );
		
		// Do only if bataraza		
		if ($lgu_code == 'bataraza')
		{
			$data = array(
				'done' 		=> 1,
				'done2' 	=> 1,
				);
			$this->db->where('year <=', 2012);
			$this->db->update('leave_earn_sched', $data);
		}
		
		$this->db->where('year <=', 2011);
		$this->db->delete('leave_earn_sched');
		
		return TRUE;
		
	}

	function down() 
	{		
		return TRUE;
	}
}
