<?php

 
$class_menu_close = '';

$base = '<a href="'.base_url().'';
$image = '<img class="menu_icon" src="'.base_url().'images/blank.gif">';

//http://codeigniter.com/user_guide/helpers/html_helper.html#ol_and_ul

$attributes = array('class' => 'list_modules');

$user_management = array(
						'users' 		=> $base.'users">'.$image.'Manage Users</a>',
						'groups' 		=> $base.'groups">'.$image.'Groups</a>',
						'permissions' 	=> $base.'permissions">'.$image.'Permissions</a>',
            			);

$employee_management = array(
						//$base.'employees/add_employee">'.$image.'Add Employee</a>',
						$base.'employees">'.$image.'Manage Employees</a>',
            			);
						
$dtr_management = 		array(
						$base.'dtr_manage/dtr">'.$image.'DTR</a>',
						$base.'dtr_manage/jo">'.$image.'Contractual / Job Order</a>',
						$base.'dtr_manage/double_entries">'.$image.'Double Entries</a>'
            			);
						
$attendance_management = array(
						$base.'attendance/view_attendance">'.$image.'View Attendance</a>',
						$base.'attendance/dtr">'.$image.'View/Print DTR</a>',
						$base.'attendance/schedules">'.$image.'Schedules</a>',
						$base.'attendance/employee_schedule">'.$image.'Employee Schedule</a>',
						$base.'attendance/double_entries">'.$image.'Double Entries</a>',
            			);
						
$add_earn = '';

$enable_add_earn_menu = Setting::getField('enable_add_earn_menu');

if ($enable_add_earn_menu == 'yes')
{
	$add_earn = $base.'leave_manage/add_earning">'.$image.'Add earning</a>';

}
					
$leave_management = 	array(
						$base.'leave_manage/file_leave">'.$image.'File Leave</a>',
            			);
															
						
$settings_management =  array(
						$base.'settings_manage/holiday">'.$image.'Holiday</a>',					
						$base.'settings_manage/audit_trail">'.$image.'Audit Trail</a>',
						$base.'settings_manage/general_settings">'.$image.'General Settings</a>',
            			);																							
?>
<ul id="main_menu" class="main_menu_over"><!-- Main menu -->

<li class="menu_close"><a class="first_line" href="<?php echo base_url();?>home/home_page"><img src="<?php echo base_url();?>/images/classroom_classroom.png" alt=".:" width="22" height="22" class="little_icon"><br>
  Home</a></li>
 
 
           <li class="menu_close"><a class="first_line" href="#"><img src="<?php echo base_url();?>images/admin_manager_view.png" width="22" height="22" class="little_icon"><br>
          Users<br /></a>
          <?php echo ul($user_management, $attributes);?>
          </li>
      
          <li class="menu_close"><a class="first_line" href="#"><img src="<?php echo base_url();?>/images/directory_listgroup.png" width="22" height="22" class="little_icon"><br>
          Employees<br /> </a>
          <?php echo ul($employee_management, $attributes);?>
          </li>
            		
	<li class="menu_close"><a class="first_line" href="#" onClick="return false;"><img src="<?php echo base_url();?>/images/classevent_main.png" alt=".:" width="22" height="22" class="little_icon"><br>
      Attendance <br />Management</a>
	  <?php echo ul($attendance_management, $attributes);?>
 </li>
	
  <li class="menu_close"><a class="first_line" href="<?php echo base_url();?>office_manage/view_offices" onClick="return true;"><img src="<?php echo base_url();?>/images/report_reportlist.png" alt=".:" width="22" height="22" class="little_icon"><br>
  Office<br /> Management</a></li>

	
<li class="menu_close"><a class="first_line" href="?q=13" onClick="return false;"><img src="<?php echo base_url();?>/images/manpage_manpage.png" alt=".:" width="22" height="22" class="little_icon"><br>
  Leave <br /> Management</a>
  <?php echo ul($leave_management, $attributes);?>
  </li>

  <li class="menu_close"><a class="first_line" href="?q=22" onClick="return false;"><img src="<?php echo base_url();?>/images/configuration_config.png" alt=".:" width="22" height="22" class="little_icon"><br>
  Settings</a>
  <?php echo ul($settings_management, $attributes);?>
  </li>
  
  
  
  
  
  </ul>
  <br />
  <br />
  <br />
  <br />
  <br />
  <br />
  <br />
  <br />
&nbsp;&nbsp;&nbsp;Welcome, <a href="<?php echo base_url();?>users/my_account/"><?php echo Session::get('fname').' '.Session::get('username');?></a>&nbsp;<a href="<?php echo base_url();?>login/log_out">Logout</a> | <a href="#" id="check_updates">Check for updates</a><!--| <a href="#" onclick="bug_show_form2('<?php echo Session::get('username');?>')">Report Bugs</a>--> 
<div id="updates_out"></div>

<script>
$('#check_updates').click(function(){

	$('#updates_out').html("Connecting...");
	$('#updates_out').html("");
	//$('#updates_out').load('<?php echo base_url();?>Client_services/check_updates/' + 12);
		
});
</script>

<?php $show_perform_leave_earnings_now = Setting::getField( 'show_perform_leave_earnings_now' );?>

<?php if($show_perform_leave_earnings_now == 'yes'):?>

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
<?php endif;?>
<script>

$('.menu_close').mouseover(function(){

	adminOpenMenu(this, 'menu_open');
});

$('.menu_close').mouseout(function(){

	adminCloseMenu(this, 'menu_close');
});
</script>