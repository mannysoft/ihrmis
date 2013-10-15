<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_modify_employee_add_date_retired extends CI_Migration {
	
	function up() 
	{	
				
		$fields = array(
                        'date_retired' => 
								array(
									'type' 		=> 'DATE',
									'NULL'		=> TRUE,
									'COMMENT' 	=> 'tell when the employee retired.')
						);
		$this->dbforge->add_column('employee', $fields, 'dependents');
	}

	function down() 
	{
		return TRUE;
		
	}
}
