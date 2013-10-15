<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_modify_dedution_information_add_line_no extends CI_Migration {
	
	function up() 
	{	
				
		$fields = array(
                        'line_no' => 
								array(
									'type' 		=> 'INT',
									'NULL'		=> FALSE,
									'DEFAULT'	=> 1,
									'COMMENT' 	=> 'tell what line number in heading in printing payroll.')
						);
		$this->dbforge->add_column('payroll_deduction_informations', $fields, 'report_order');
	}

	function down() 
	{
		return TRUE;
		
	}
}
