<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_employee_add_columns_assistant_dept_head extends CI_Migration {
	
	function up() 
	{	
		$fields = array(
                        'assistant_dept_head' => array('type' => 'INT',
														'constraint' => '2',
														'null' => FALSE)
);
		$this->dbforge->add_column('employee', $fields, 'position');
		
	}

	function down() 
	{
		
		$this->dbforge->drop_column('employee', 'assistant_dept_head');
		
		
	}
}
