<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_modify_leave_card_column_period extends CI_Migration {
	
	
	function up() 
	{	
		
		$fields = array(
                        'period' => array(
                                                       'name' => 'period',
                                                       'type' => 'VARCHAR (32) NOT NULL',
                                             ),
		);
		
		$this->dbforge->modify_column('leave_card', $fields);

	}

	function down() 
	{
		$fields = array(
                        'period' => array(
                                                       'name' => 'period',
                                                       'type' => 'DATE NOT NULL',
                                             ),
		);
		
		$this->dbforge->modify_column('leave_card', $fields);
	}
}
