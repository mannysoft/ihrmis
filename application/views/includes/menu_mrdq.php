<?php

 
$class_menu_close = '';

$base = '<a href="'.base_url().'';
$image = '<img class="menu_icon" src="'.base_url().'images/blank.gif">';

//http://codeigniter.com/user_guide/helpers/html_helper.html#ol_and_ul

$attributes = array('class' => 'list_modules');

if ( $this->session->userdata('user_type') == 5)
{
	$attendance_management = array(
						$base.'attendance/view_attendance">'.$image.'View Attendance</a>',
						$base.'attendance/dtr">'.$image.'View/Print DTR</a>',
						//$base.'attendance/jo">'.$image.'Contractual / Job Order</a>',
						//$base.'attendance/double_entries">'.$image.'Double Entries</a>',
						//$base.'attendance/view_absences">'.$image.'View Absences</a>',
						//$base.'attendance/view_late">'.$image.'View Late / Undertime</a>',
						//$base.'attendance/view_ob">'.$image.'View Official Business</a>',
						//$base.'attendance/view_tardiness">'.$image.'View Tardiness</a>',
						//$base.'attendance/view_ten_tardiness">'.$image.'View 10x Tardiness</a>'
            			);
						
	$leave_management = 	array(
						//$base.'leave_manage/records">'.$image.'Leave Card/Certification</a>',
						$base.'leave_manage/file_leave">'.$image.'File Leave</a>',
						//$base.'leave_manage/encode_leave_card">'.$image.'Encode Leave Card</a>',
						$base.'leave_manage/leave_apps">'.$image.'Leave Application</a>',
						//$base.'leave_manage/forwarded">'.$image.'Leave Forwarded</a>',
						//$base.'leave_manage/undertime">'.$image.'Encode Tardy/Undertime</a>',
						//$base.'leave_manage/wop">'.$image.'Leave WOP</a>',
						//$base.'leave_manage/stop_earning">'.$image.'Stop Leave Earnings</a>',
						//$base.'leave_manage/settings">'.$image.'Settings</a>',
            			);		
						
						
	$manual_management = 	array(
						//$base.'manual_manage/ob">'.$image.'Official Business</a>',
						//$base.'manual_manage/login">'.$image.'Manual Login/ Logout</a>',
						$base.'manual_manage/cto">'.$image.'Compensatory Time off</a>',
						$base.'manual_manage/cto_apps">'.$image.'CTO Applications</a>',
						//$base.'manual_manage/cto_forward_balance">'.$image.'CTO Forward Balance</a>',
						//$base.'manual_manage/office_pass">'.$image.'Office Pass/ Pass Slip</a>'
            			);									
						
} 

if ( $this->session->userdata('user_type') == 3)
{
	$attendance_management = array(
						$base.'attendance/view_attendance">'.$image.'View Attendance</a>',
						$base.'attendance/dtr">'.$image.'View/Print DTR</a>',
						$base.'attendance/jo">'.$image.'Contractual / Job Order</a>',
						$base.'attendance/double_entries">'.$image.'Double Entries</a>',
						$base.'attendance/view_absences">'.$image.'View Absences</a>',
						$base.'attendance/view_late">'.$image.'View Late / Undertime</a>',
						$base.'attendance/view_ob">'.$image.'View Official Business</a>',
						$base.'attendance/view_tardiness">'.$image.'View Tardiness</a>',
						$base.'attendance/view_ten_tardiness">'.$image.'View 10x Tardiness</a>'
            			);
						
	$leave_management = 	array(
						//$base.'leave_manage/records">'.$image.'Leave Card/Certification</a>',
						$base.'leave_manage/file_leave">'.$image.'File Leave</a>',
						//$base.'leave_manage/encode_leave_card">'.$image.'Encode Leave Card</a>',
						$base.'leave_manage/leave_apps">'.$image.'Leave Application</a>',
						//$base.'leave_manage/forwarded">'.$image.'Leave Forwarded</a>',
						//$base.'leave_manage/undertime">'.$image.'Encode Tardy/Undertime</a>',
						//$base.'leave_manage/wop">'.$image.'Leave WOP</a>',
						//$base.'leave_manage/stop_earning">'.$image.'Stop Leave Earnings</a>',
						//$base.'leave_manage/settings">'.$image.'Settings</a>',
            			);		
						
						
	$manual_management = 	array(
						//$base.'manual_manage/ob">'.$image.'Official Business</a>',
						$base.'manual_manage/login">'.$image.'Manual Login/ Logout</a>',
						$base.'manual_manage/cto">'.$image.'Compensatory Time off</a>',
						$base.'manual_manage/cto_apps">'.$image.'CTO Applications</a>',
						$base.'manual_manage/cto_forward_balance">'.$image.'CTO Forward Balance</a>',
						$base.'manual_manage/office_pass">'.$image.'Office Pass/ Pass Slip</a>'
            			);									
						
} 			

				

?>
<ul id="main_menu" class="main_menu_over"><!-- Main menu -->

<li class="menu_close"><a class="first_line" href="<?php echo base_url();?>home/home_page"><img src="<?php echo base_url();?>/images/classroom_classroom.png" alt=".:" width="22" height="22" class="little_icon"><br>
  Home</a></li>
  		
	<li class="menu_close"><a class="first_line" href="#" onClick="return false;"><img src="<?php echo base_url();?>/images/classevent_main.png" alt=".:" width="22" height="22" class="little_icon"><br>
      Attendance <br />Management</a>
	  <?php echo ul($attendance_management, $attributes);?>
 </li>
	

<li class="menu_close"><a class="first_line" href="#" onClick="return true;"><img src="<?php echo base_url();?>/images/calendar_main.png" alt=".:" width="22" height="22" class="little_icon"><br>
  Manual <br />Log</a>
  <?php echo ul($manual_management, $attributes);?>
  </li>


<li class="menu_close"><a class="first_line" href="?q=13" onClick="return false;"><img src="<?php echo base_url();?>/images/manpage_manpage.png" alt=".:" width="22" height="22" class="little_icon"><br>
  Leave <br /> Management</a>
  <?php echo ul($leave_management, $attributes);?>
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
&nbsp;&nbsp;&nbsp;Welcome, <a href="<?php echo base_url();?>users/my_account/"><?php echo $this->session->userdata('fname').' '.$this->session->userdata('username');?></a>&nbsp;<a href="<?php echo base_url();?>login/log_out">Logout</a> | <a href="#" id="check_updates">Check for updates</a><!--| <a href="#" onclick="bug_show_form2('<?php echo $this->session->userdata('username');?>')">Report Bugs</a>--> 
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