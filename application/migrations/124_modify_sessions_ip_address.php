<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_modify_sessions_ip_address extends CI_Migration {
	
	function up() 
	{	
				
		$fields = array(
                        'ip_address ' => 
								array(
									'type' 		=> 'VARCHAR(45)',
									'NULL'		=> FALSE,
									'DEFAULT' 	=> '0',
									
									)
						);
		$this->dbforge->modify_column('sessions', $fields);
	}

	function down() 
	{
		return TRUE;
		
	}
}
