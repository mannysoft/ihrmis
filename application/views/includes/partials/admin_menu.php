<ul id="main_menu" class="main_menu_over"><!-- Main menu -->

<li class="menu_close"><a class="first_line" href="<?php echo base_url();?>home/home_page"><img src="<?php echo base_url();?>/images/classroom_classroom.png" alt=".:" width="22" height="22" class="little_icon"><br>
  Home</a></li>
 
 <?php if ( Session::get('user_type') == 1 || Session::get('user_type') == 2):?>
 
   <li class="menu_close"><a class="first_line" href="#"><img src="<?php echo base_url();?>images/admin_manager_view.png" width="22" height="22" class="little_icon"><br>
  User<br /> Management</a>
  <?php echo ul($user_management, $attributes);?>
  </li>
  
  
  
  <li class="menu_close"><a class="first_line" href="#"><img src="<?php echo base_url();?>/images/directory_listgroup.png" width="22" height="22" class="little_icon"><br>
  Employee<br /> Management</a>
  <?php echo ul($employee_management, $attributes);?>
  </li>
  
  <li class="menu_close"><a class="first_line" href="" onClick="return false;"><img src="<?php echo base_url();?>/images/certificate_certificate.png" alt=".:" width="22" height="22" class="little_icon"><br>
  Training<br /> Management</a>
  <?php echo ul($training_management, $attributes);?>
  </li>
  
  <?php endif; ?>
  
  <?php if ( Session::get('user_type') == 1 || Session::get('user_type') == 2 || Session::get('user_type') == 3):?>
  
  <li class="menu_close"><a class="first_line" href="" onClick="return false;"><img src="<?php echo base_url();?>/images/field_manager_field_list.png" alt=".:" width="22" height="22" class="little_icon"><br>
  DTR</a>
  <?php echo ul($dtr_management, $attributes);?>
  </li>
  
 <li class="menu_close"><a class="first_line" href="#" onClick="return false;"><img src="<?php echo base_url();?>/images/classevent_main.png" alt=".:" width="22" height="22" class="little_icon"><br>
      Attendance <br />Management</a>
	  <?php echo ul($attendance_management, $attributes);?>
 </li>

<li class="menu_close"><a class="first_line" href="#" onClick="return true;"><img src="<?php echo base_url();?>/images/calendar_main.png" alt=".:" width="22" height="22" class="little_icon"><br>
  Manual <br />Log</a>
  <?php echo ul($manual_management, $attributes);?>
  </li>

<?php endif;?>
 
 <?php if ( Session::get('user_type') == 1 || Session::get('user_type') == 2):?>
<!--View this if the user is administrator-->
  <li class="menu_close"><a class="first_line" href="<?php echo base_url();?>office_manage/view_offices" onClick="return true;"><img src="<?php echo base_url();?>/images/report_reportlist.png" alt=".:" width="22" height="22" class="little_icon"><br>
  Office<br /> Management</a></li>
<?php endif;?>
	 
  
<?php if ( Session::get('user_type') == 1 || Session::get('user_type') == 2 || Session::get('user_type') == 5):?>	  
<li class="menu_close"><a class="first_line" href="" onClick="return false;"><img src="<?php echo base_url();?>/images/manpage_manpage.png" alt=".:" width="22" height="22" class="little_icon"><br>
  Leave <br /> Management</a>
  <?php echo ul($leave_management, $attributes);?>
  </li>
 <?php endif;?>
 
 
 <!--
 <li class="menu_close" onMouseOver="adminOpenMenu(this, 'menu_open');" onMouseOut="adminCloseMenu(this, 'menu_close');"><a class="first_line" href="?q=22" onClick="return false;"><img src="<?php echo base_url();?>/images/payroll.jpg" alt=".:" width="22" height="22" class="little_icon"><br>
  Payroll<br /> Management</a>
  <?php echo ul($payroll_management, $attributes);?>
  </li>-->
 
 
 
 
 
 
 
 <li class="menu_close"><a class="first_line" href="" onClick="return false;"><img src="<?php echo base_url();?>/images/payroll.jpg" alt=".:" width="22" height="22" class="little_icon"><br>
  Payroll<br /> Management(under)</a><ul class="list_modules">
  
 <li class="menu_close"><a class="arrow_left" href="" onclick="return false;"><img class="menu_icon" src="<?php echo base_url();?>/images/blank.gif" alt=".:" />General Payroll</a>
  <ul>
  
  <li><a  href="<?php echo base_url();?>/Administration/add_user"><img class="menu_icon" src="<?php echo base_url();?>/images/blank.gif" alt=".:" />Monthly</a></li>
  <li><a  href="<?php echo base_url();?>/Administration/list_user"><img class="menu_icon" src="<?php echo base_url();?>/images/blank.gif" alt=".:" />Additional</a></li>
  </ul>
  </li>
  
  <li class="menu_close"><a class="arrow_left" href="" onclick="return false;"><img class="menu_icon" src="<?php echo base_url();?>/images/blank.gif" alt=".:" />Reports</a>
  <ul>
  
  <li><a  href="<?php echo base_url();?>Administration/add_user"><img class="menu_icon" src="<?php echo base_url();?>/images/blank.gif" alt=".:" />Payslip</a></li>
  <li><a  href="<?php echo base_url();?>Administration/list_user"><img class="menu_icon" src="<?php echo base_url();?>/images/blank.gif" alt=".:" />Salary Index</a></li>
  <li><a  href="<?php echo base_url();?>Administration/add_user"><img class="menu_icon" src="<?php echo base_url();?>/images/blank.gif" alt=".:" />Loan Balance</a></li>
  <li><a  href="<?php echo base_url();?>Administration/list_user"><img class="menu_icon" src="<?php echo base_url();?>/images/blank.gif" alt=".:" />Income Tax</a></li>
  <li><a  href="<?php echo base_url();?>Administration/list_user"><img class="menu_icon" src="<?php echo base_url();?>/images/blank.gif" alt=".:" />Signatory</a></li>
  </ul>
  </li>
  
  <li class="menu_close"><a class="arrow_left" href="" onclick="return false;"><img class="menu_icon" src="<?php echo base_url();?>/images/blank.gif" alt=".:" />Remittances</a>
  <ul>
  
  <li><a  href="<?php echo base_url();?>Administration/add_user"><img class="menu_icon" src="<?php echo base_url();?>/images/blank.gif" alt=".:" />Deductions Agency</a></li>
  <li><a  href="<?php echo base_url();?>Administration/list_user"><img class="menu_icon" src="<?php echo base_url();?>/images/blank.gif" alt=".:" />Premiums</a></li>
  <li><a  href="<?php echo base_url();?>Administration/add_user"><img class="menu_icon" src="<?php echo base_url();?>/images/blank.gif" alt=".:" />Loans</a></li>
  <li><a  href="<?php echo base_url();?>Administration/list_user"><img class="menu_icon" src="<?php echo base_url();?>/images/blank.gif" alt=".:" />Insurances</a></li>
  <li><a  href="<?php echo base_url();?>Administration/add_user"><img class="menu_icon" src="<?php echo base_url();?>/images/blank.gif" alt=".:" />Deductions Refund</a></li>
  <li><a  href="<?php echo base_url();?>Administration/list_user"><img class="menu_icon" src="<?php echo base_url();?>/images/blank.gif" alt=".:" />Philhealth Schedule</a></li>
  <li><a  href="<?php echo base_url();?>Administration/add_user"><img class="menu_icon" src="<?php echo base_url();?>/images/blank.gif" alt=".:" />Personal Additional Exemption</a></li>
  <li><a  href="<?php echo base_url();?>Administration/list_user"><img class="menu_icon" src="<?php echo base_url();?>/images/blank.gif" alt=".:" />Tax Table</a></li>
  </ul>
  </li>
  
  <li class="menu_close"><a class="arrow_left" href="" onclick="return false;"><img class="menu_icon" src="<?php echo base_url();?>/images/blank.gif" alt=".:" />Additional Compensation</a>
  <ul>
  
  <li><a  href="<?php echo base_url();?>/Administration/add_user"><img class="menu_icon" src="<?php echo base_url();?>/images/blank.gif" alt=".:" />Additional Compensation</a></li>
  <li><a  href="<?php echo base_url();?>/Administration/list_user"><img class="menu_icon" src="<?php echo base_url();?>/images/blank.gif" alt=".:" />Staff Entitlement</a></li>
  </ul>
  </li>
  
  <li class="menu_close"><a class="arrow_left" href="" onclick="return false;"><img class="menu_icon" src="<?php echo base_url();?>/images/blank.gif" alt=".:" />Deductions</a>
  <ul>
  
  <li><a  href="<?php echo base_url();?>payroll/deduction/agency"><img class="menu_icon" src="<?php echo base_url();?>/images/blank.gif" alt=".:" />Agency</a></li>
  <li><a  href="<?php echo base_url();?>payroll/deduction/information"><img class="menu_icon" src="<?php echo base_url();?>/images/blank.gif" alt=".:" />Deduction Information</a></li>
  <li><a  href="<?php echo base_url();?>payroll/deduction/optional"><img class="menu_icon" src="<?php echo base_url();?>/images/blank.gif" alt=".:" />Optional Contribution</a></li>
  <li><a  href="<?php echo base_url();?>payroll/deduction/loan"><img class="menu_icon" src="<?php echo base_url();?>/images/blank.gif" alt=".:" />Loan Schedules</a></li>
  <li><a  href="<?php echo base_url();?>payroll/deduction/tax"><img class="menu_icon" src="<?php echo base_url();?>/images/blank.gif" alt=".:" />Tax Exempt</a></li>
  </ul>
  </li>
  
  <li><a href="<?php echo base_url();?>/Settings_Manage/holiday"><img class="menu_icon" src="<?php echo base_url();?>/images/blank.gif" alt=".:">--</a></li>
   <li><a href="<?php echo base_url();?>/Settings_Manage/offline_update"><img class="menu_icon" src="<?php echo base_url();?>/images/blank.gif" alt=".:">--</a></li>
  </ul></li>
 
 
 
 
 
 
 
 
 
 
  <?php if ( Session::get('user_type') == 1 || Session::get('user_type') == 2):?>
  <li class="menu_close"><a class="first_line" href="" onClick="return false;"><img src="<?php echo base_url();?>/images/configuration_config.png" alt=".:" width="22" height="22" class="little_icon"><br>
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
<script>

$('.menu_close').mouseover(function(){

	adminOpenMenu(this, 'menu_open');
});

$('.menu_close').mouseout(function(){

	adminCloseMenu(this, 'menu_close');
});
</script>