<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_all_tables_add_column extends CI_Migration {
	
	function up() 
	{			
		$tables = $this->db->list_tables();

		foreach ($tables as $table)
		{
		   $fields = array(
                        'created_at' => array('type' => 'datetime', 'null' => FALSE),
						'updated_at' => array('type' => 'datetime', 'null' => FALSE),
						'deleted_at' => array('type' => 'datetime', 'null' => FALSE),
						);
			$this->dbforge->add_column(str_replace('ats_','', $table), $fields);
		}
	}

	function down() 
	{		
		return TRUE;
	}
}
