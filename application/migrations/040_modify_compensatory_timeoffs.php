<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_modify_compensatory_timeoffs extends CI_Migration {
	
	function up() 
	{	
		
		$fields = array(
                        'days' => array(
                                                         'name' => 'days',
                                                         'type' => 'VARCHAR( 8 ) NOT NULL',
                                                ),
					);
					
		$this->dbforge->modify_column('compensatory_timeoffs', $fields);
		
	}

	function down() 
	{
		$fields = array(
                        'days' => array(
                                                         'name' => 'days',
                                                         'type' => 'VARCHAR( 3 ) NOT NULL',
                                                ),
					);
					
		$this->dbforge->modify_column('compensatory_timeoffs', $fields);
	}
}
