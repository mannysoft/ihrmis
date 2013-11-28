<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_permissions_populate_quezon extends CI_Migration {
	
	function up() 
	{			
		$agency = Setting::getField( 'system_name' );
		
		if ($agency == 'Provincial Government of Quezon')
		{
			$ats_permissions = array(
			  array('id' => '1','group_id' => '1','module' => 'users','roles' => '["index","save","delete","my_account"]'),
			  array('id' => '2','group_id' => '1','module' => 'groups','roles' => '["save","delete"]'),
			  array('id' => '3','group_id' => '1','module' => 'permissions','roles' => '["save","delete","group"]'),
			  array('id' => '4','group_id' => '1','module' => 'employees','roles' => '["index","add_employee","edit_employee","delete_employee","add_cart","remove_cart","id_request"]'),
			  array('id' => '5','group_id' => '1','module' => 'pds','roles' => '["personal_info","employee_profile","family","education","examination","work","voluntary_work","trainings","other_info","position_details","service_record","scanned_docs","reports","pds_print_preview","sr_print_preview","training_preview"]'),
			  array('id' => '6','group_id' => '1','module' => 'personnel','roles' => '["assets","assets_spouse","assets_unmarried","assets_real_properties","assets_personals","assets_liabilities","assets_business_interests","assets_relatives","assets_other_info","personnel_schedule"]'),
			  array('id' => '7','group_id' => '1','module' => 'training_manage','roles' => '["type","type_save","type_delete","course","course_save","course_delete","event","event_save","evenr_delete","attendance","attendance_save","attendance_delete","contact_type","contact_type_save","contact_type_delete","contact_info","contact_info_save","contact_info_delete"]'),
			  array('id' => '8','group_id' => '1','module' => 'attendance','roles' => '["view_attendance","dtr","schedules","employee_schedule","jo","double_entries","view_absences","view_late","view_ob","view_tardiness","view_ten_tardiness"]'),
			  array('id' => '9','group_id' => '1','module' => 'manual_manage','roles' => '["login","cto","cto_apps","cto_forward_balance","office_pass"]'),
			  array('id' => '10','group_id' => '1','module' => 'office_manage','roles' => '["view_offices","add_office","edit_office","divisions"]'),
			  array('id' => '11','group_id' => '1','module' => 'leave_manage','roles' => '["records","leave_card","cancel_leave","file_leave","encode_leave_card","leave_apps","forwarded","undertime","cancel_undertime","wop","stop_earnings","reports","perform_leave_earnings","settings"]'),
			  array('id' => '12','group_id' => '1','module' => 'settings_manage','roles' => '["salary_grade","holiday","audit_trail","general_settings","backup","offline_update"]'),
			  array('id' => '23','group_id' => '6','module' => 'leave_manage','roles' => '["records","leave_card","cancel_leave","file_leave","encode_leave_card","leave_apps","forwarded","undertime","cancel_undertime","wop","stop_earnings","perform_leave_earnings","settings"]'),
			  array('id' => '32','group_id' => '3','module' => 'attendance','roles' => '["view_attendance","dtr","jo","double_entries","view_absences","view_late","view_ob","view_tardiness","view_ten_tardiness"]'),
			  array('id' => '40','group_id' => '7','module' => 'employees','roles' => '["index","add_employee","edit_employee","delete_employee","add_cart","remove_cart","id_request"]'),
			  array('id' => '41','group_id' => '7','module' => 'pds','roles' => '["personal_info","employee_profile","family","education","examination","work","voluntary_work","trainings","other_info","position_details","service_record","scanned_docs","reports","pds_print_preview","sr_print_preview","training_preview"]'),
			  array('id' => '42','group_id' => '7','module' => 'personnel','roles' => '["assets","assets_spouse","assets_unmarried","assets_real_properties","assets_personals","assets_liabilities","assets_business_interests","assets_relatives","assets_other_info","personnel_schedule"]'),
			  array('id' => '43','group_id' => '7','module' => 'training_manage','roles' => '["type","type_save","type_delete","course","course_save","course_delete","event","event_save","evenr_delete","attendance","attendance_save","attendance_delete","contact_type","contact_type_save","contact_type_delete","contact_info","contact_info_save","contact_info_delete"]'),
			  array('id' => '52','group_id' => '2','module' => 'employees','roles' => '["index","add_employee","edit_employee","delete_employee","add_cart","remove_cart","id_request"]'),
			  array('id' => '53','group_id' => '2','module' => 'pds','roles' => '["personal_info","employee_profile","family","education","examination","work","voluntary_work","trainings","other_info","position_details","service_record","scanned_docs","reports","pds_print_preview","sr_print_preview","training_preview"]'),
			  array('id' => '54','group_id' => '2','module' => 'personnel','roles' => '["assets","assets_spouse","assets_unmarried","assets_real_properties","assets_personals","assets_liabilities","assets_business_interests","assets_relatives","assets_other_info","personnel_schedule"]'),
			  array('id' => '55','group_id' => '2','module' => 'training_manage','roles' => '["type","type_save","type_delete","course","course_save","course_delete","event","event_save","evenr_delete","attendance","attendance_save","attendance_delete","contact_type","contact_type_save","contact_type_delete","contact_info","contact_info_save","contact_info_delete"]'),
			  array('id' => '56','group_id' => '2','module' => 'attendance','roles' => '["dtr"]'),
			  array('id' => '57','group_id' => '2','module' => 'manual_manage','roles' => '["office_pass"]'),
			  array('id' => '58','group_id' => '2','module' => 'office_manage','roles' => '["view_offices","add_office","edit_office","divisions"]'),
			  array('id' => '65','group_id' => '7','module' => 'manual_manage','roles' => '["login"]'),
			  array('id' => '72','group_id' => '6','module' => 'employees','roles' => '["index","add_employee","edit_employee","delete_employee","add_cart","remove_cart","id_request"]'),
			  array('id' => '73','group_id' => '6','module' => 'pds','roles' => '["personal_info","employee_profile","family","education","examination","work","voluntary_work","trainings","other_info","position_details","service_record","scanned_docs","reports","pds_print_preview","sr_print_preview","training_preview"]'),
			  array('id' => '74','group_id' => '6','module' => 'personnel','roles' => '["assets","assets_spouse","assets_unmarried","assets_real_properties","assets_personals","assets_liabilities","assets_business_interests","assets_relatives","assets_other_info","personnel_schedule"]'),
			  array('id' => '75','group_id' => '6','module' => 'training_manage','roles' => '["type","type_save","type_delete","course","course_save","course_delete","event","event_save","evenr_delete","attendance","attendance_save","attendance_delete","contact_type","contact_type_save","contact_type_delete","contact_info","contact_info_save","contact_info_delete"]'),
			  array('id' => '76','group_id' => '6','module' => 'attendance','roles' => '["view_attendance","dtr","jo","double_entries","view_absences","view_late","view_ob","view_tardiness","view_ten_tardiness"]'),
			  array('id' => '79','group_id' => '6','module' => 'settings_manage','roles' => '["salary_grade","holiday","schedules","employee_schedule","audit_trail","general_settings","backup","offline_update"]'),
			  array('id' => '90','group_id' => '5','module' => 'leave_manage','roles' => '["records","leave_card","cancel_leave","file_leave","leave_apps","reports"]'),
			  array('id' => '91','group_id' => '1','module' => 'appointment','roles' => '["issued"]'),
			  array('id' => '100','group_id' => '9','module' => 'attendance','roles' => '["view_attendance","view_attendance_only","dtr","jo","double_entries","view_absences","view_late","view_ob","view_tardiness","view_ten_tardiness"]'),
			  array('id' => '101','group_id' => '9','module' => 'manual_manage','roles' => '["login","cto","cto_apps","cto_forward_balance","office_pass"]')
			);


		$this->db->insert_batch('permissions', $ats_permissions); 
		}
	}

	function down() 
	{		
		return TRUE;
	}
}
