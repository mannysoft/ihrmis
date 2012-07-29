<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_drop_multiple_tables extends CI_Migration {
	
	function up() 
	{	
		
		$this->db->set_dbprefix('hris_');
		
		$this->dbforge->drop_table('campus');
	
		$this->dbforge->drop_table('college');
	
		$this->dbforge->drop_table('cluster');
	
		$this->dbforge->drop_table('department');
	
		$this->dbforge->drop_table('educ');
	
		$this->dbforge->drop_table('position');
	
		$this->dbforge->drop_table('profile2');
	
		$this->dbforge->drop_table('prof_back_up');
	
		$this->dbforge->drop_table('service_record');
		
		$this->dbforge->drop_table('specialization');
		
		$this->db->set_dbprefix('ats_');
		
		$this->dbforge->drop_table('settings2');
		
		$this->dbforge->drop_table('user_menu');
		
		$this->dbforge->drop_table('user_roles');

	}

	function down() 
	{
		return TRUE;		
	}
}
