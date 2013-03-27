<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_pds_training_update_dates extends CI_Migration {
	
	function up() 
	{					
		$fields = array(
                        'date_from' => array('type' => 'VARCHAR(32)', 'null' => FALSE),
						'date_to' => array('type' => 'VARCHAR(32)', 'null' => FALSE)
		);
		
		$this->dbforge->modify_column('pds_training', $fields);
		
		$this->db->query('UPDATE ats_pds_training SET date_from = DATE_FORMAT( date_from,  "%m-%d-%Y" ), date_to = DATE_FORMAT( date_to,  "%m-%d-%Y" )');
	}

	function down() 
	{		
		return TRUE;
	}
}
