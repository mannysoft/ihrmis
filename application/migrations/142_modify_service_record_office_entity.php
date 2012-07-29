<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_modify_service_record_office_entity extends CI_Migration {
	
	function up() 
	{	
				
		$fields = array(
                        'office_entity' => 
								array(
									'type' 		=> 'VARCHAR(128)',
									'NULL'		=> FALSE,
									)
						);
		$this->dbforge->modify_column('service_record', $fields);
	}

	function down() 
	{
		return TRUE;
		
	}
}
