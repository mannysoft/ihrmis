<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_modify_office_add_office_location extends CI_Migration {
	
	function up() 
	{	
				
		$fields = array(
                        'office_location' => 
								array(
									'type' 		=> 'VARCHAR(8)',
									'NULL'		=> FALSE,
									'DEFAULT'	=> 'internal',
									'COMMENT' 	=> 'Tell if the office is inside or outside the city hall or capitol')
						);
		$this->dbforge->add_column('office', $fields, 'position');
	}

	function down() 
	{
		return TRUE;
		
	}
}
