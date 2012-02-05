<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_usergroup extends CI_Migration {
	
	function up() 
	{	
		//$this->migrations->verbose AND print "Adding user group...";
		
		$data[] = array('name' => 'Super System Administrator');
		$data[] = array('name' => 'System Administrator');
		$data[] = array('name' => 'Timekeeper');
		$data[] = array('name' => 'Official Business Encoder');
		$data[] = array('name' => 'Leave Manager');
		
		foreach ( $data as $array)
		{
			$this->db->insert('user_group', $array);
		}
		
		// Add column
		$fields = array(
                        'roles' => array('type' => 'TEXT NOT NULL')
		);
		$this->dbforge->add_column('user_group', $fields);

	}

	function down() 
	{
		$this->db->empty_table('user_group');
		$this->dbforge->drop_column('user_group', 'roles');
	}
}
