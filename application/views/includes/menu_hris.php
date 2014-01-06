<?php

 
$class_menu_close = '';

$base = '<a href="'.base_url().'';
$image = '<img class="menu_icon" src="'.base_url().'images/blank.gif">';

//http://codeigniter.com/user_guide/helpers/html_helper.html#ol_and_ul

$attributes = array('class' => 'list_modules');

$user_management = array(
						'add_user' 		=> $base.'user_manage/add_user">'.$image.'Add User</a>',
						'list_user' 	=> $base.'user_manage/list_user">'.$image.'List User</a>',
						'user_group' 	=> $base.'user_manage/user_group">'.$image.'User Group</a>'
            			);

$employee_management = array(
						$base.'employee_manage/add_employee">'.$image.'Add Employee</a>',
						$base.'employee_manage/list_employee">'.$image.'List Employee</a>',
						$base.'personnel_admin/assets">'.$image.'Assets and Liabilities</a>',
						$base.'pds/reports">'.$image.'Reports</a>'
            			);
						
$training_management = array(
						$base.'training_manage/course">'.$image.'Training Course</a>',
						$base.'training_manage/event">'.$image.'Training Event</a>',
						$base.'training_manage/attendance">'.$image.'Training Attendance</a>',
						$base.'training_manage/type">'.$image.'Training Type</a>',
						$base.'training_manage/contact_info">'.$image.'Training Contact Info</a>',
						$base.'training_manage/contact_type">'.$image.'Training Contact Type</a>'
            			);						

$dtr_management = 		array(
						$base.'dtr_manage/dtr">'.$image.'DTR</a>',
						$base.'dtr_manage/jo">'.$image.'Contractual / Job Order</a>'
            			);
						
$attendance_management = array(
						$base.'attendance_manage/view_attendance">'.$image.'View Attendance</a>',
						$base.'attendance_manage/view_absences">'.$image.'View Absences</a>',
						$base.'attendance_manage/view_late">'.$image.'View Late / Undertime</a>',
						$base.'attendance_manage/view_ob">'.$image.'View Official Business</a>',
						$base.'attendance_manage/view_tardiness">'.$image.'View Tardiness</a>',
						$base.'attendance_manage/view_ten_tardiness">'.$image.'View 10x Tardiness</a>'
            			);
						
$manual_management = 	array(
						$base.'manual_manage/ob">'.$image.'Official Business</a>',
						$base.'manual_manage/login">'.$image.'Manual Login/ Logout</a>',
						$base.'manual_manage/cto">'.$image.'Compensatory Time off</a>',
						$base.'manual_manage/office_pass">'.$image.'Office Pass</a>'
            			);					
						
$leave_management = 	array(
						$base.'leave_manage/records">'.$image.'Leave Card/Certification</a>',
						$base.'leave_manage/file_leave">'.$image.'File Leave</a>',
						$base.'leave_manage/leave_apps">'.$image.'Leave Application</a>',
						$base.'leave_manage/forwarded">'.$image.'Leave Forwarded</a>',
						$base.'leave_manage/undertime">'.$image.'Encode Tardy/Undertime</a>',
						$base.'leave_manage/wop">'.$image.'Leave WOP</a>',
						$base.'leave_manage/stop_earning">'.$image.'Stop Leave Earnings</a>',
						$base.'leave_manage/settings">'.$image.'Settings</a>',
            			);
						
if ( Session::get('user_type') == 5)
{
	$leave_management = array(
						$base.'leave_manage/file_leave">'.$image.'File Leave</a>',
						$base.'leave_manage/leave_apps">'.$image.'Leave Application</a>'
            			);

}						
						
$settings_management =  array(
						$base.'settings_manage/salary_grade">'.$image.'Salary Grade</a>',
						$base.'settings_manage/audit_trail">'.$image.'Audit Trail</a>',
						$base.'settings_manage/general_settings">'.$image.'General Settings</a>'
            			);																								
?>
<ul id="main_menu" class="main_menu_over"><!-- Main menu -->

<li class="menu_close" onMouseOver="adminOpenMenu(this, 'menu_open');" onMouseOut="adminCloseMenu(this, 'menu_close');"><a class="first_line" href="<?php echo base_url();?>home/home_page" onClick="return true;"><img src="<?php echo base_url();?>/images/classroom_classroom.png" alt=".:" width="22" height="22" class="little_icon"><br>
  Home</a></li>
 
 <?php if ( Session::get('user_type') == 1 || Session::get('user_type') == 2):?>
 
   <li class="menu_close" onMouseOver="adminOpenMenu(this, 'menu_open');" onMouseOut="adminCloseMenu(this, 'menu_close');"><a class="first_line" href="#" onClick="return false;"><img src="<?php echo base_url();?>images/admin_manager_view.png" alt=".:" width="22" height="22" class="little_icon"><br>
  User<br /> Management</a>
  <?php echo ul($user_management, $attributes);?>
  </li>
  
  
  
  <li class="menu_close" onMouseOver="adminOpenMenu(this, 'menu_open');" onMouseOut="adminCloseMenu(this, 'menu_close');"><a class="first_line" href="index.php?q=9" onClick="return false;"><img src="<?php echo base_url();?>/images/directory_listgroup.png" alt=".:" width="22" height="22" class="little_icon"><br>
  Employee<br /> Management</a>
  <?php echo ul($employee_management, $attributes);?>
  </li>
  
  <li class="menu_close" onMouseOver="adminOpenMenu(this, 'menu_open');" onMouseOut="adminCloseMenu(this, 'menu_close');"><a class="first_line" href="index.php?q=9" onClick="return false;"><img src="<?php echo base_url();?>/images/certificate_certificate.png" alt=".:" width="22" height="22" class="little_icon"><br>
  Training<br /> Management</a>
  <?php echo ul($training_management, $attributes);?>
  </li>
  
  <?php endif; ?>
  
 <?php if ( Session::get('user_type') == 1 || Session::get('user_type') == 2):?>
<!--View this if the user is administrator-->
  <li class="menu_close" onMouseOver="adminOpenMenu(this, 'menu_open');" onMouseOut="adminCloseMenu(this, 'menu_close');"><a class="first_line" href="<?php echo base_url();?>office_manage/view_offices" onClick="return true;"><img src="<?php echo base_url();?>/images/report_reportlist.png" alt=".:" width="22" height="22" class="little_icon"><br>
  Office<br /> Management</a></li>
<?php endif;?>
	 
   
  <?php if ( Session::get('user_type') == 1 || Session::get('user_type') == 2):?>
  <li class="menu_close" onMouseOver="adminOpenMenu(this, 'menu_open');" onMouseOut="adminCloseMenu(this, 'menu_close');"><a class="first_line" href="index.php?q=22" onClick="return false;"><img src="<?php echo base_url();?>/images/configuration_config.png" alt=".:" width="22" height="22" class="little_icon"><br>
  Settings</a>
  <?php echo ul($settings_management, $attributes);?>
  </li>
  
  <?php endif; ?>
  
  </ul>
Welcome, <a href="<?php echo base_url();?>user_manage/my_account/"><?php echo Session::get('fname').' '.Session::get('username');?></a>&nbsp;<a href="<?php echo base_url();?>login/log_out">Logout</a> | <a href="#" id="check_updates">Check for updates</a> | <a href="#" onclick="bug_show_form2('<?php echo Session::get('username');?>')">Report Bugs</a>
<div id="updates_out"></div>

<script>
$('#check_updates').click(function(){

	$('#updates_out').html("Connecting...");
	$('#updates_out').load('<?php echo base_url();?>Client_services/check_updates/' + 12);
		
});
</script>
<?php
$is_earned_missed = $this->Leave_earn_sched->is_earned_missed(date('m'), date('Y'));

if($is_earned_missed != '')
{
	?>
	<div class="clean-red">
    <?php 
	echo 'It seems that you didn\'t performed<br> ';
	echo 'the leave earnings for '.$this->Helps->get_month_name($is_earned_missed['month']).', '.$is_earned_missed['year'].'!<br>';
	echo '<a href="'.base_url().'leave_manage/perform_leave_earnings/'.
	$is_earned_missed['month'].'/'.$is_earned_missed['year'].'/'.$is_earned_missed['leave_earn'].'">Perform leave earnings Now!</a>';
	?>
    </div>
	<?php
	
	
}
?>