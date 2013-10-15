<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_rename_user_table extends CI_Migration {
	
	function up() 
	{			
		if ( $this->db->table_exists('user'))
		{	
			$this->dbforge->rename_table('user', 'users');
			
			// Rename column user_id to id
			$fields = array(
                        'user_id' => array(
									'name' => 'id',
									'type' => 'INT', 
									'constraint' => 11, 
									'unsigned' => TRUE, 
									'auto_increment' => TRUE
                                                
											)
			);
			
			$this->dbforge->modify_column('users', $fields);
		}

	}

	function down() 
	{		
		if ( $this->db->table_exists('users'))
		{
			$this->dbforge->rename_table('users', 'user');
			
			// Rename column user_id to id
			$fields = array(
                        'id' => array(
									'name' => 'user_id',
									'type' => 'INT', 
									'constraint' => 11, 
									'unsigned' => TRUE, 
									'auto_increment' => TRUE
                                                ),
			);
		}
		
	}
}
