<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*
|--------------------------------------------------------------------------
| Control the Users Permissions
|--------------------------------------------------------------------------
|
| Description here....
| Description here....
|
*/
$config['permissions'] = array(
								'users' => array(
												'name' 	=> 'Users',	
												'roles' => array(
															'index' 		=> 'Manage Users', 
															'save' 			=> 'Add/Edit Users', 
															'delete' 		=> 'Delete Users',
															'my_account' 	=> 'Change Password',
															),
												),
												
								'groups' => array(
												'name' 	=> 'Groups',	
												'roles' => array(
															'save' 		=> 'Add/Edit Group', 
															'delete' 	=> 'Delete Group',
															),
												),
												
								'permissions' => array(
												'name' 	=> 'Permissions',	
												'roles' => array(
															'save' 		=> 'Add/Edit Permissions', 
															'delete' 	=> 'Delete Permissions',
															'group' 	=> 'Groups', 
															),
												),				
												
								'employees' => array(
												'name' 	=> 'Employees',	
												'roles' => array(
															'index' 			=> 'Manage Employees', 
															'add_employee' 		=> 'Add Employees', 
															'edit_employee' 	=> 'Edit Employees', 
															'delete_employee' 	=> 'Delete Employees',
															'add_cart' 			=> 'Add Employees to ID Maker',
															'remove_cart' 		=> 'Remove Employees to ID Maker',
															'id_request' 		=> 'ID Request',
															),
												),
												
								'appointment' => array(
												'name' 	=> 'Appointment Management',	
												'roles' => array(
															'issued' 			=> 'Appointment Issued', 
															//'add_employee' 		=> 'Add Employees', 
															//'edit_employee' 	=> 'Edit Employees', 
															),
												),				
												
								'pds' => array(
												'name' 	=> 'Personal Data Sheet',	
												'roles' => array(
															'personal_info' 		=> 'Personal Information', 
															'employee_profile' 		=> 'Employee Profile', 
															'family' 				=> 'Family Background', 
															'education' 			=> 'Education Background',
															'examination' 			=> 'Examinations',
															'work' 					=> 'Work Experiences',
															'voluntary_work' 		=> 'Voluntary Work',
															'trainings' 			=> 'Trainings',
															'other_info' 			=> 'Other Information',
															'position_details' 		=> 'Position Details',
															'service_record' 		=> 'Service Records',
															'scanned_docs' 			=> 'Scanned Documents',
															'reports' 				=> 'Reports',
															'pds_print_preview'		=> 'PDS Print Preview',
															'sr_print_preview'		=> 'Service Record Print Preview',
															'training_preview'		=> 'Training Record Print Preview',
															),
												),	
												
								'personnel' => array(
												'name' 	=> 'Assets and Liabilities',	
												'roles' => array(
															'assets' 					=> 'Manage Assets and Liabilities', 
															'assets_spouse' 			=> 'Spouse', 
															'assets_unmarried' 			=> 'Unmarried Children below 18 years of age', 
															'assets_real_properties' 	=> 'ASSETS - a. Real Properties', 
															'assets_personals' 			=> 'ASSETS - b. Personal and other Properties', 
															'assets_liabilities' 		=> 'LIABILITIES (Loans, Mortgages, etc.)',
															'assets_business_interests' => 'BUSINESS INTERESTS AND FINANCIAL CONNECTIONS',
															'assets_relatives' 			=> 'IDENTIFICATION OF RELATIVES IN THE GOVERNMENT SERVICE',
															'assets_other_info' 		=> 'Other Info',
															
															'personnel_schedule' 		=> 'Personnel Schedule',
															
															),
												),											
												
								
								'training_manage' => array(
												'name' 	=> 'Training Management',	
												'roles' => array(
															'employees' 			=> 'Employee\'s Record', 
															'type' 					=> 'Manage Training Type', 
															'type_save' 			=> 'Add/Edit  Training Type',
															'type_delete' 			=> 'Delete Training Type', 
															'course' 				=> 'Manage Training Course', 
															'course_save' 			=> 'Add/Edit  Training Course',
															'course_delete' 		=> 'Delete Training Course', 
															'event' 				=> 'Manage Training Event', 
															'event_save' 			=> 'Add/Edit  Training Event',
															'evenr_delete' 			=> 'Delete Training Event', 
															'attendance' 			=> 'Manage Training Attendance', 
															'attendance_save' 		=> 'Add/Edit  Training Attendance',
															'attendance_delete' 	=> 'Delete Training Attendance', 
															'contact_type' 			=> 'Manage Training Contact Type', 
															'contact_type_save' 	=> 'Add/Edit  Training Contact Type',
															'contact_type_delete' 	=> 'Delete Training Contact Type', 
															'contact_info' 			=> 'Manage Training Contact Info', 
															'contact_info_save' 	=> 'Add/Edit  Training Contact Info',
															'contact_info_delete' 	=> 'Delete Training Contact Info', 
															),
												),		
												
								'attendance' => array(
												'name' 	=> 'Attendance Management',	
												'roles' => array(
															'view_attendance' 		=> 'View Attendance',
															'view_attendance_only' 	=> 'View Attendance ONLY(No EDIT)', 
															'dtr' 					=> 'View/Print DTR', 
															'schedules' 			=> 'Schedules', 
															'employee_schedule' 	=> 'Employee Schedules',
															'jo' 					=> 'Job Order',
															'double_entries' 		=> 'Double Entries', 
															'view_absences' 		=> 'View Absences', 
															'view_late' 			=> 'View Late/Undertime', 
															'view_ob' 				=> 'View Official Business', 
															'view_tardiness' 		=> 'View Tardiness', 
															'view_ten_tardiness' 	=> 'View 10x Tardiness', 
															),
												),
												
								'manual_manage' => array(
												'name' 	=> 'Manual Log',	
												'roles' => array(
															'login' 				=> 'Manual Login/Logout', 
															'cto' 					=> 'Compensatory Time off', 
															'cto_apps' 				=> 'CTO Applications',
															'cto_forward_balance' 	=> 'CTO Forward Balance', 
															'office_pass' 			=> 'Office Pass/ Pass Slip', 
															),
												),
												
								'office_manage' => array(
												'name' 	=> 'Office Management',	
												'roles' => array(
															'view_offices' 				=> 'Manage Offices', 
															'add_office' 				=> 'Add Office', 
															'edit_office' 				=> 'Edit Office', 
															'divisions' 				=> 'Manage Divisions',
															//'cto_forward_balance' 	=> 'CTO Forward Balance', 
															//'office_pass' 			=> 'Office Pass/ Pass Slip', 
															),
												),			
												
								'leave_manage' => array(
												'name' 	=> 'Leave Management',	
												'roles' => array(
															'records' 					=> 'Leave Card/Certifications', 
															'leave_card'				=> 'View Leave Card', 
															'cancel_leave' 				=> 'Cancel Leave', 
															'file_leave' 				=> 'File Leave', 
															'encode_leave_card' 		=> 'Encode Leave Card', 
															'leave_apps' 				=> 'Leave Applications', 
															'forwarded' 				=> 'Leave Forward',
															'undertime' 				=> 'Encode Tardy/Undertime', 
															'cancel_undertime' 			=> 'Cancel Tardy/Undertime', 
															'wop' 						=> 'Leave WOP', 
															'stop_earnings' 			=> 'Stop Leave Earnings', 
															'reports'					=> 'Terminal Leave/Certification',
															'perform_leave_earnings'	=> 'Perform Leave Earnings',
															'settings' 					=> 'Settings', 
															),
												),
												
								'payroll' => array(
												'name' 	=> 'Payroll Management',	
												'roles' => array(
															'monthly' 					=> 'Monthly Payroll', 
															'additional'				=> 'Additional Payroll', 
															'report' 					=> 'Reports', 
															),
												),				
												
								'settings_manage' => array(
												'name' 	=> 'Settings',	
												'roles' => array(
															'salary_grade' 			=> 'Salary Grade', 
															'holiday' 				=> 'Holiday', 
															'audit_trail' 			=> 'Audit Trail', 
															'general_settings' 		=> 'General Settings', 
															'backup' 				=> 'Back up / Restore Database', 
															'offline_update' 		=> 'Offline Software Update', 
															),
												),				
												
																																											
															
												
												
							);

/* End of file migration.php */
/* Location: ./application/config/migration.php */