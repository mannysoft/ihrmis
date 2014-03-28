<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_office_query1 extends CI_Migration {
	
	function up() 
	{			
		$this->db->query('UPDATE ats_office SET id=office_id');
	}

	function down() 
	{		
		return TRUE;
	}
}
