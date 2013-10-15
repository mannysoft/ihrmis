<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_populate_groups_table_if_empty extends CI_Migration {
	
	function up() 
	{			
		if ( $this->db->table_exists('groups'))
		{			
			$g = new Group_m();
			$g->get();
			
			// Return if the groups table has data on it
			if ($g->exists())
			{
				return;
			}
			
			$this->db->order_by('id'); 
			
			$q = $this->db->get('user_group');
			
			if ($q->num_rows() > 0)
			{
				foreach ($q->result_array() as $row)
				{
					$g = new Group_m();
					
					$g->name 		= $row['name'];
					$g->description = $row['description'];
					$g->save();
					
				}
			}

		}

	}

	function down() 
	{		
		
	}
}
