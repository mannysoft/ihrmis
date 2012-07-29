<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_permissions_process_users extends CI_Migration {
	
	function up() 
	{			
		$lgu_code = $this->Settings->get_selected_field( 'lgu_code' );
				
		if ($lgu_code == 'marinduque_province')
		{
			$u = new User_m();
			$u->where('group_id !=', 1000);
			$users = $u->get();
			
			foreach ($users as $user)
			{
				//echo $user->user_type;
				//echo $user->group_id;
				
				// Lets update the 
				$us = new User_m();
				$us->get_by_id($user->id);
				$us->group_id = $user->user_type;
				$us->save();
				
				// Lets assign permission
				if ($user->group_id == 5 ) // leave
				{
					$p = new Permission_m();
					$p->where('group_id', $user->group_id);
					$p->where('module', 'attendance')->get();
					$p->group_id = $user->group_id;
					$p->module	 = 'attendance';
					$p->roles 	= json_encode(array('view_attendance', 'dtr'));
					$p->save();
					
					$p = new Permission_m();
					$p->where('group_id', $user->group_id);
					$p->where('module', 'leave_manage')->get();
					$p->group_id = $user->group_id;
					$p->module	 = 'leave_manage';
					$p->roles 	= json_encode(array('file_leave', 'leave_apps', 'reports'));
					$p->save();
					
					$p = new Permission_m();
					$p->where('group_id', $user->group_id);
					$p->where('module', 'manual_manage')->get();
					$p->group_id = $user->group_id;
					$p->module	 = 'manual_manage';
					$p->roles 	= json_encode(array('cto', 'cto_apps'));
					$p->save();
					
				}
				if ($user->group_id == 3 ) // leave
				{
					$p = new Permission_m();
					$p->where('group_id', $user->group_id);
					$p->where('module', 'attendance')->get();
					$p->group_id = $user->group_id;
					$p->module	 = 'attendance';
					$p->roles 	= json_encode(array('view_attendance', 'dtr', 'jo', 'double_entries', 
													'view_absences', 'view_late', 'view_ob', 'view_tardiness', 
													'view_ten_tardiness'));
					$p->save();
					
					$p = new Permission_m();
					$p->where('group_id', $user->group_id);
					$p->where('module', 'manual_manage')->get();
					$p->group_id = $user->group_id;
					$p->module	 = 'manual_manage';
					$p->roles 	= json_encode(array('login', 'cto', 'cto_apps', 'cto_forward_balance', 'office_pass'));
					$p->save();
					
				}
				
			}
			
			
			if ( $this->db->table_exists('groups'))
			{
				$g = new Group_m();
				$g->get();
				
				// We will populate only if the groups
				// table is empty
				if ( ! $g->exists() )
				{
					$this->db->order_by('id'); 
				
					$q = $this->db->get('user_group');
					
					if ($q->num_rows() > 0)
					{
						foreach ($q->result_array() as $row)
						{
							$g = new Group_m();
							
							$g->name = $row['name'];
							$g->description = $row['description'];
							$g->save();
							
						}
					}
				}
				
			}
		}
		
	}

	function down() 
	{		
		
	}
}
