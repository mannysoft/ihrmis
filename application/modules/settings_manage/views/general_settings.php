<?php

$checked = 'checked="checked"';

$minutes_tardy_am_only1 = ($settings['minutes_tardy_am_only'] == 1) ? $checked : '';
$minutes_tardy_am_only2 = ($settings['minutes_tardy_am_only'] == 0) ? $checked : '';


$undertime_tardi1 = ($settings['undertime_tardi'] == 1) ? $checked : '';
$undertime_tardi2 = ($settings['undertime_tardi'] == 0) ? $checked : '';


$leave_order_chrono1 = ($settings['leave_order_chrono'] == 1) ? $checked : '';
$leave_order_chrono2 = ($settings['leave_order_chrono'] == 0) ? $checked : '';


$hospital_view_leave_days1 = ($settings['hospital_view_leave_days'] == 1) ? $checked : '';
$hospital_view_leave_days2 = ($settings['hospital_view_leave_days'] == 0) ? $checked : '';


$tardy_autodeduct1 = ($settings['tardy_autodeduct'] == 'yes') ? $checked : '';
$tardy_autodeduct2 = ($settings['tardy_autodeduct'] == 'no') ? $checked : '';


$allow_encode_digit_undertime1 = ($settings['allow_encode_digit_undertime'] == 'yes') ? $checked : '';
$allow_encode_digit_undertime2 = ($settings['allow_encode_digit_undertime'] == 'no') ? $checked : '';


$show_perform_leave_earnings_now1 = ($settings['show_perform_leave_earnings_now'] == 'yes') ? $checked : '';
$show_perform_leave_earnings_now2 = ($settings['show_perform_leave_earnings_now'] == 'no') ? $checked : '';

$show_calendar1 = ($settings['show_calendar'] == 'yes') ? $checked : '';
$show_calendar2 = ($settings['show_calendar'] == 'no') ? $checked : '';


$auto_sixty_days1 = ($settings['auto_sixty_days'] == 'yes') ? $checked : '';
$auto_sixty_days2 = ($settings['auto_sixty_days'] == 'no') ? $checked : '';

$auto_seven_days1 = ($settings['auto_seven_days'] == 'yes') ? $checked : '';
$auto_seven_days2 = ($settings['auto_seven_days'] == 'no') ? $checked : '';


$allow_monetize_using_vl_sl1 = ($settings['allow_monetize_using_vl_sl'] == 'yes') ? $checked : '';
$allow_monetize_using_vl_sl2 = ($settings['allow_monetize_using_vl_sl'] == 'no') ? $checked : '';

$encoded_leave_listing_order1 = ($settings['encoded_leave_listing_order'] == 'ASC') ? $checked : '';
$encoded_leave_listing_order2 = ($settings['encoded_leave_listing_order'] == 'DESC') ? $checked : '';

$auto_deduct_forced_leave1 = ($settings['auto_deduct_forced_leave'] == 'yes') ? $checked : '';
$auto_deduct_forced_leave2 = ($settings['auto_deduct_forced_leave'] == 'no') ? $checked : '';

$auto_deduct_mc_vl1 = ($settings['auto_deduct_mc_vl'] == 'yes') ? $checked : '';
$auto_deduct_mc_vl2 = ($settings['auto_deduct_mc_vl'] == 'no') ? $checked : '';

$show_leave_credits_leave_apps1 = ($settings['show_leave_credits_leave_apps'] == 'yes') ? $checked : '';
$show_leave_credits_leave_apps2 = ($settings['show_leave_credits_leave_apps'] == 'no') ? $checked : '';

$enable_add_day_encode_tardy1 = ($settings['enable_add_day_encode_tardy'] == 'yes') ? $checked : '';
$enable_add_day_encode_tardy2 = ($settings['enable_add_day_encode_tardy'] == 'no') ? $checked : '';


$enable_add_earn_menu1 = ($settings['enable_add_earn_menu'] == 'yes') ? $checked : '';
$enable_add_earn_menu2 = ($settings['enable_add_earn_menu'] == 'no') ? $checked : '';






$overwrite_logs1 = ($settings['overwrite_logs'] == 1) ? $checked : '';
$overwrite_logs2 = ($settings['overwrite_logs'] == 0) ? $checked : '';

$print_office_head_in_dtr1 = ($settings['print_office_head_in_dtr'] == 1) ? $checked : '';
$print_office_head_in_dtr2 = ($settings['print_office_head_in_dtr'] == 0) ? $checked : '';


$print_overtime_in_dtr1 = ($settings['print_overtime_in_dtr'] == 1) ? $checked : '';
$print_overtime_in_dtr2 = ($settings['print_overtime_in_dtr'] == 0) ? $checked : '';

$allow_45mins1 = ($settings['allow_45mins'] == 'yes') ? $checked : '';
$allow_45mins2 = ($settings['allow_45mins'] == 'no') ? $checked : '';

$show_incomplete_logs1 = ($settings['show_incomplete_logs'] == 'yes') ? $checked : '';
$show_incomplete_logs2 = ($settings['show_incomplete_logs'] == 'no') ? $checked : '';

$accept_late_ob1 = ($settings['accept_late_ob'] == 'yes') ? $checked : '';
$accept_late_ob2 = ($settings['accept_late_ob'] == 'no') ? $checked : '';

$show_employee_number_dtr1 = ($settings['show_employee_number_dtr'] == 'yes') ? $checked : '';
$show_employee_number_dtr2 = ($settings['show_employee_number_dtr'] == 'no') ? $checked : '';





$allow_forty_hours1 = ($settings['allow_forty_hours'] == 1) ? $checked : '';
$allow_forty_hours2 = ($settings['allow_forty_hours'] == 0) ? $checked : '';


$auto_generate_employee_id1 = ($settings['auto_generate_employee_id'] == 'yes') ? $checked : '';
$auto_generate_employee_id2 = ($settings['auto_generate_employee_id'] == 'no') ? $checked : '';


$enable_id_maker1 = ($settings['enable_id_maker'] == 'yes') ? $checked : '';
$enable_id_maker2 = ($settings['enable_id_maker'] == 'no') ? $checked : '';


$leave_earn1 = ($settings['leave_earn'] == 15) ? $checked : '';
$leave_earn2 = ($settings['leave_earn'] != 15) ? $checked : '';


?>

<?php if (validation_errors()): ?>
<div class="clean-red"><?php echo validation_errors(); ?></div><br />
<?php elseif (Session::flashData('msg') || $msg != ''): ?>
<div class="clean-green"><?php echo Session::flashData('msg');?><?php echo $msg;?></div><br />
<?php else: ?>
<?php endif; ?>

<?php if ($this->config->item('active_apps') != ''): ?>
<form method="post" action="">
<table width="100%" border="0">
  <tr>
    <td width="33%">&nbsp;</td>
    <td width="54%">&nbsp;</td>
    <td width="4%">&nbsp;</td>
    <td width="4%">&nbsp;</td>
    <td width="5%">&nbsp;</td>
  </tr>
  <tr>
    <td align="right"><strong>Statement Of Leave Prepared By:</strong></td>
    <td><input name="statement_prepared" type="text" id="statement_prepared" value="<?php echo $settings['statement_prepared'];?>" size="40" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right"><strong>Position:</strong></td>
    <td><input name="statement_prepared_position" type="text" id="statement_prepared_position" value="<?php echo $settings['statement_prepared_position'];?>" size="40" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right"><strong>Statement Of Leave Certified By:</strong></td>
    <td><input name="statement_certified" type="text" id="statement_certified" value="<?php echo $settings['statement_certified'];?>" size="40" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right"><strong>Position:</strong></td>
    <td><input name="statement_certified_position" type="text" id="statement_certified_position" value="<?php echo $settings['statement_certified_position'];?>" size="40" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="35%" align="right"><strong>Service Record Prepared By:</strong></td>
    <td width="63%"><input name="sr_prepared" type="text" id="sr_prepared" value="<?php echo $settings['sr_prepared'];?>" size="40" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right"><strong>Position:</strong></td>
    <td><input name="sr_prepared_position" type="text" id="sr_prepared_position" value="<?php echo $settings['sr_prepared_position'];?>" size="40" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right"><strong>Service Record Certified By:</strong></td>
    <td><input name="sr_certified" type="text" id="sr_certified" value="<?php echo $settings['sr_certified'];?>" size="40" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right"><strong>Position:</strong></td>
    <td><input name="sr_certified_position" type="text" id="sr_certified_position" value="<?php echo $settings['sr_certified_position'];?>" size="40" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="35%" align="right"><strong>Training Record Prepared By:</strong></td>
    <td width="63%"><input name="training_prepared" type="text" id="training_prepared" value="<?php echo $settings['training_prepared'];?>" size="40" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right"><strong>Position:</strong></td>
    <td><input name="training_prepared_position" type="text" id="training_prepared_position" value="<?php echo $settings['training_prepared_position'];?>" size="40" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right"><strong>Training Record Certified By:</strong></td>
    <td><input name="training_certified" type="text" id="training_certified" value="<?php echo $settings['training_certified'];?>" size="40" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right"><strong>Position:</strong></td>
    <td><input name="training_certified_position" type="text" id="training_certified_position" value="<?php echo $settings['training_certified_position'];?>" size="40" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right"><strong>CTO Certification Officer:</strong></td>
    <td><input name="cto_certification" type="text" id="cto_certification" value="<?php echo $settings['cto_certification'];?>" size="40" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right"><strong>Position:</strong></td>
    <td><input name="cto_certification_position" type="text" id="cto_certification_position" value="<?php echo $settings['cto_certification_position'];?>" size="40" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">Service Record Heading</td>
    <td><input name="republic" type="text" id="republic" value="<?php echo $settings['republic'];?>" size="40" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">LGU</td>
    <td><input name="lgu_name" type="text" id="lgu_name" value="<?php echo $settings['lgu_name'];?>" size="40" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">LGU Office:</td>
    <td><input name="lgu_office" type="text" id="lgu_office" value="<?php echo $settings['lgu_office'];?>" size="40" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">LGU Address:</td>
    <td><input name="lgu_address" type="text" id="lgu_address" value="<?php echo $settings['lgu_address'];?>" size="40" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right"><strong>Leave Earning:</strong></td>
    <td><input name="leave_earn" type="radio" value="15" id="radio2" <?php echo $leave_earn1;?>/>
    <label for="radio2">15th and 30th of the month</label>
    (0.625)<br />
    <input name="leave_earn" type="radio" id="radio3" value="30" <?php echo $leave_earn2;?>/>
    <label for="radio3">30th of the month(1.25)</label></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right"><strong>Footer/Agency:</strong></td>
    <td><input name="system_name" type="text" id="system_name" value="<?php echo $settings['system_name'];?>" size="40" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><input name="op" type="hidden" id="op" value="1" /></td>
    <td><input type="submit" name="Submit2" value="Save" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>

<?php else: ?>
<table width="100%" border="0">
  <tr>
    <td><a href="#" tab="general" class="click">General</a> | <a href="#" tab="users" class="click">Users</a> | <a href="#" tab="employees" class="click">Employees</a> | <a href="#" tab="attendance" class="click">Attendance</a> | <a href="#" tab="leave" class="click">Leave</a> | <a href="#" tab="payroll" class="click">Payroll</a> | <a href="#" tab="signatories" class="click">Signatories</a></td>
    <td>&nbsp;</td>
    <td><input name="active_tab" type="hidden" id="active_tab" 
    value="<?php echo (Input::get('active_tabs')) ? Input::get('active_tabs'): 'general'?>" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

<script>

$(document).ready(function(){
	
	$('.settings_tab').hide('fast');
	
	var active_tab = $('#active_tab').val();
	
	$('#'+active_tab).show('slow');
	
});

$('.click').click(function(){

	var tab = $(this).attr("tab");
	
	$('.settings_tab').hide('slow');
	
	$('#active_tab').val(tab);
	
	$('#'+tab).show('slow');
	
});
</script>

<div id="general" class="settings_tab">
<form action="" method="post">
<table width="100%" border="0" cellpadding="5" cellspacing="5" class="type-one">
  <tr class="type-one-header">
    <th width="21%">General</th>
    <th width="72%">&nbsp;</th>
    <th width="7%"><input name="active_tabs" type="hidden" id="active_tabs" value="general" /></th>
  </tr>
  <tr>
    <td><input name="op" type="hidden" id="op" value="1" /></td>
    <td>
	<?php 
	$u = new User_m();
	$u->get_by_username(Session::get('username'));
	?>
    <?php if ($u->group_id == '1000'):?>
    <?php echo ' LGU Code: '.form_input('lgu_code', $settings['lgu_code']);?>
    <?php endif;?>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">Footer/Agency</td>
    <td><input name="system_name" type="text" id="system_name" value="<?php echo $settings['system_name'];?>" size="40" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">Service Record Heading</td>
    <td><input name="republic" type="text" id="republic" value="<?php echo $settings['republic'];?>" size="40" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">LGU</td>
    <td><input name="lgu_name" type="text" id="lgu_name" value="<?php echo $settings['lgu_name'];?>" size="40" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">LGU Office:</td>
    <td><input name="lgu_office" type="text" id="lgu_office" value="<?php echo $settings['lgu_office'];?>" size="40" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">LGU Address:</td>
    <td><input name="lgu_address" type="text" id="lgu_address" value="<?php echo $settings['lgu_address'];?>" size="40" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">Default salary grade year:</td>
    <td><input name="default_salary_grade_year" type="text" id="default_salary_grade_year" value="<?php echo $settings['default_salary_grade_year'];?>" size="20" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">Proposed salary grade year:</td>
    <td><input name="proposed_salary_grade_year" type="text" id="proposed_salary_grade_year" value="<?php echo $settings['proposed_salary_grade_year'];?>" size="20" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="button" id="button" value="Save" /></td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>
</div>

<div id="users" class="settings_tab">
<form action="" method="post">
<table width="100%" border="0" cellpadding="5" cellspacing="5" class="type-one">
  <tr class="type-one-header">
    <th width="30%">Users</th>
    <th width="64%">&nbsp;</th>
    <th width="6%"><input name="active_tabs" type="hidden" id="active_tabs" value="users" /></th>
  </tr>
  <tr>
    <td align="right"><input name="op" type="hidden" id="op" value="1" />
      Session Expiration in seconds:</td>
    <td><input name="seconds_user_idle" type="text" id="seconds_user_idle" value="<?php echo $settings['seconds_user_idle'];?>" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="button5" id="button5" value="Save" /></td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>
</div>

<div id="employees" class="settings_tab">
<form action="" method="post">
<table width="100%" border="0" cellpadding="5" cellspacing="5" class="type-one">
  <tr class="type-one-header">
    <th width="30%">Employees</th>
    <th width="27%">&nbsp;</th>
    <th width="43%"><input name="active_tabs" type="hidden" id="active_tabs" value="employees" /></th>
  </tr>
  <tr>
    <td><input name="op" type="hidden" id="op" value="1" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">Auto Generate Employee No.:</td>
    <td><input name="auto_generate_employee_id" type="radio" value="yes" id="radiobutton" <?php echo $auto_generate_employee_id1;?>/>
      <label>Yes</label>
      <input name="auto_generate_employee_id" type="radio" value="no" <?php echo $auto_generate_employee_id2;?> />
      <label>No</label>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">Enable ID Maker:</td>
    <td><input name="enable_id_maker" type="radio" value="yes" id="radiobutton" <?php echo $enable_id_maker1;?>/>
      <label>Yes</label>
      <input name="enable_id_maker" type="radio" value="no" <?php echo $enable_id_maker2;?> />
      <label>No</label>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">Service Record Entries First Page:</td>
    <td><input name="service_record_entries_first_page" type="text" id="service_record_entries_first_page" value="<?php echo $settings['service_record_entries_first_page'];?>" size="20" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">Service Record Entries Second Page:</td>
    <td><input name="service_record_entries_second_page" type="text" id="service_record_entries_second_page" value="<?php echo $settings['service_record_entries_second_page'];?>" size="20" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">Service Record Entries Third Page:</td>
    <td><input name="service_record_entries_3rd_page" type="text" id="service_record_entries_3rd_page" value="<?php echo $settings['service_record_entries_3rd_page'];?>" size="20" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">Service Record Entries Fourth Page:</td>
    <td><input name="service_record_entries_4th_page" type="text" id="service_record_entries_4th_page" value="<?php echo $settings['service_record_entries_4th_page'];?>" size="20" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="button2" id="button2" value="Save" /></td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>
</div>


<div id="attendance" class="settings_tab">
<form action="" method="post">
<table width="100%" border="0" cellpadding="5" cellspacing="5" class="type-one">
  <tr class="type-one-header">
    <th width="28%">Attendance</th>
    <th width="45%">&nbsp;</th>
    <th width="27%"><input name="active_tabs" type="hidden" id="active_tabs" value="attendance" /></th>
  </tr>
  <tr>
    <td><input name="op" type="hidden" id="op" value="1" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">Time Interval</td>
    <td><input name="time_interval" type="text" id="time_interval" value="<?php echo $settings['time_interval'];?>" size="30" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">Minutes before Tardy: </td>
    <td><input name="minutes_tardy" type="text" id="minutes_tardy" value="<?php echo $settings['minutes_tardy'];?>" size="3" />
      AM Only <input name="minutes_tardy_am_only" type="radio" value="1" id="radiobutton" <?php echo $minutes_tardy_am_only1;?>/>
    <label>Yes</label>
    <input name="minutes_tardy_am_only" type="radio" id="radio" value="0" <?php echo $minutes_tardy_am_only2;?> />
    <label>No</label></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">Mark undertime as tardiness: </td>
    <td><input name="undertime_tardi" type="radio" value="1" id="radiobutton" <?php echo $undertime_tardi1;?>/>
      <label>Yes</label>
      <input name="undertime_tardi" type="radio" id="radio" value="0" <?php echo $undertime_tardi2;?> />
      <label>No</label></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">Auto deduct Tardiness to leave credits:</td>
    <td><input name="tardy_autodeduct" type="radio" value="yes" id="hospital_view_leave_days1" <?php echo $tardy_autodeduct1;?>/>
    <label>Yes</label>
    <input name="tardy_autodeduct" type="radio" value="no" id="hospital_view_leave_days2" <?php echo $tardy_autodeduct2;?> />
    <label>No</label>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">Allow 40 hrs a week:</td>
    <td><input name="allow_forty_hours" type="radio" value="1" id="radiobutton" <?php echo $allow_forty_hours1;?>/>
    <label>Yes</label>
    <input name="allow_forty_hours" type="radio" value="0" <?php echo $allow_forty_hours2;?> />
    <label>No</label>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">Print Office Head in DTR</td>
    <td><input name="print_office_head_in_dtr" type="radio" value="1" id="radiobutton" <?php echo $print_office_head_in_dtr1;?>/>
      <label>Yes</label>
      <input name="print_office_head_in_dtr" type="radio" id="radio" value="0" <?php echo $print_office_head_in_dtr2;?> />
      <label>No</label>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">Print overtime summary:</td>
    <td><input name="print_overtime_in_dtr" type="radio" value="1" id="radiobutton" <?php echo $print_overtime_in_dtr1;?>/>
    <label>Yes</label>
    <input name="print_overtime_in_dtr" type="radio" id="radio" value="0" <?php echo $print_overtime_in_dtr2;?> />
    <label>No</label></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">12:45PM in PM IN</td>
    <td><input name="allow_45mins" type="radio" value="yes" <?php echo $allow_45mins1;?>/>
    <label>Yes</label>
    <input name="allow_45mins" type="radio" value="no" <?php echo $allow_45mins2;?> />
    <label>No</label>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">DTR and Leave Inquiry seconds to close: </td>
    <td><input name="view_dtr_leave_time" type="text" id="view_dtr_leave_time" value="<?php echo $settings['view_dtr_leave_time'];?>" size="5" /> 
    seconds </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">Minutes Before log again in AM: </td>
    <td><input name="minutes_before_log_again_in_am" type="text" id="minutes_before_log_again_in_am" value="<?php echo $settings['minutes_before_log_again_in_am'];?>" size="5" /> 
    minutes </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">Show Incomplete Logs in View attendance:</td>
    <td><input name="show_incomplete_logs" type="radio" value="yes" id="radiobutton" <?php echo $show_incomplete_logs1;?>/>
    <label>Yes</label>
    <input name="show_incomplete_logs" type="radio" id="radio" value="no" <?php echo $show_incomplete_logs2;?> />
    <label>No</label></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">Accept Late OB:</td>
    <td><input name="accept_late_ob" type="radio" value="yes" id="radiobutton" <?php echo $accept_late_ob1;?>/>
        <label>Yes</label>
        <input name="accept_late_ob" type="radio" id="radio" value="no" <?php echo $accept_late_ob2;?> />
        <label>No</label></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">End Am Out:</td>
    <td><input name="end_am_out" type="text" id="end_am_out" value="<?php echo $settings['end_am_out'];?>" size="5" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">Start PM In</td>
    <td><input name="start_pm_in" type="text" id="start_pm_in" value="<?php echo $settings['start_pm_in'];?>" size="5" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">Minutes between Logs:</td>
    <td><input name="minutes_between_logs" type="text" id="minutes_between_logs" value="<?php echo $settings['minutes_between_logs'];?>" size="5" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">Show the employee number in the printable DTR:</td>
    <td><input name="show_employee_number_dtr" type="radio" value="yes" id="radiobutton" <?php echo $show_employee_number_dtr1;?>/>
      <label>Yes</label>
      <input name="show_employee_number_dtr" type="radio" id="radio" value="no" <?php echo $show_employee_number_dtr2;?> />
      <label>No</label></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="button3" id="button3" value="Save" /></td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>
</div>


<div id="leave" class="settings_tab">
<form action="" method="post">
<table width="100%" border="0" cellpadding="5" cellspacing="5" class="type-one">
  <tr class="type-one-header">
    <th width="28%">Leave</th>
    <th width="27%"><input name="active_tabs" type="hidden" id="active_tabs" value="leave" /></th>
    <th width="16%">&nbsp;</th>
    <th width="29%">&nbsp;</th>
  </tr>
  <tr>
    <td><input name="op" type="hidden" id="op" value="1" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">Leave Earnings: </td>
    <td><input name="leave_earn" type="radio" value="15" id="radio2" <?php echo $leave_earn1;?>/>
    <label for="radio2">15th and 30th of the month</label>
    (0.625)<br />
    <input name="leave_earn" type="radio" id="radio3" value="30" <?php echo $leave_earn2;?>/>
    <label for="radio3">30th of the month(1.25)</label></td>
    <td align="right">Printing of Leave Card:<br />
      (Leave blank if all data)</td>
    <td><input name="leave_card_print_period_from" type="text" id="leave_card_print_period_from" value="<?php echo $settings['leave_card_print_period_from'];?>" size="15" /> 
      to <br />
      <input name="leave_card_print_period_to" type="text" id="leave_card_print_period_to" value="<?php echo $settings['leave_card_print_period_to'];?>" size="15" /></td>
  </tr>
  <tr>
    <td align="right">Leave Order Chronological</td>
    <td><input name="leave_order_chrono" type="radio" value="1" id="leave_order_chrono1" <?php echo $leave_order_chrono1;?>/>
    <label>Yes</label>
    <input name="leave_order_chrono" type="radio" value="0" id="leave_order_chrono2" <?php echo $leave_order_chrono2;?> />
    <label>No</label>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">Allow change of number of days in leave application:</td>
    <td><input name="hospital_view_leave_days" type="radio" value="1" id="hospital_view_leave_days1" <?php echo $hospital_view_leave_days1;?>/>
    <label>Yes</label>
    <input name="hospital_view_leave_days" type="radio" value="0" id="hospital_view_leave_days2" <?php echo $hospital_view_leave_days2;?> />
    <label>No</label></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">Allow Encode of digits in encoding of undertime:</td>
    <td><input name="allow_encode_digit_undertime" type="radio" value="yes" <?php echo $allow_encode_digit_undertime1;?>/>
    <label>Yes</label>
    <input name="allow_encode_digit_undertime" type="radio" value="no" <?php echo $allow_encode_digit_undertime2;?> />
    <label>No</label></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">Show Perform Leave Earnings Now Link:</td>
    <td><input name="show_perform_leave_earnings_now" type="radio" value="yes" <?php echo $show_perform_leave_earnings_now1;?>/>
    <label>Yes</label>
    <input name="show_perform_leave_earnings_now" type="radio" value="no" <?php echo $show_perform_leave_earnings_now2;?> />
    <label>No</label></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">Show Calendar:</td>
    <td><input name="show_calendar" type="radio" value="yes" <?php echo $show_calendar1;?>/>
    <label>Yes</label>
    <input name="show_calendar" type="radio" value="no" <?php echo $show_calendar2;?> />
    <label>No</label></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">Auto 60 days if leave is maternity leave:</td>
    <td><input name="auto_sixty_days" type="radio" value="yes" <?php echo $auto_sixty_days1;?>/>
    <label>Yes</label>
    <input name="auto_sixty_days" type="radio" value="no" <?php echo $auto_sixty_days2;?> />
    <label>No</label></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">Auto 7 days if leave is paternity leave:</td>
    <td><input name="auto_seven_days" type="radio" value="yes" <?php echo $auto_seven_days1;?>/>
    <label>Yes</label>
    <input name="auto_seven_days" type="radio" value="no" <?php echo $auto_seven_days2;?> />
    <label>No</label></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">Allow Monetization deduction against both VL and SL:</td>
    <td><input name="allow_monetize_using_vl_sl" type="radio" value="yes" <?php echo $allow_monetize_using_vl_sl1;?>/>
    <label>Yes</label>
    <input name="allow_monetize_using_vl_sl" type="radio" value="no" <?php echo $allow_monetize_using_vl_sl2;?> />
    <label>No</label></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">Encoded leave card listing order:</td>
    <td><input name="encoded_leave_listing_order" type="radio" value="ASC" <?php echo $encoded_leave_listing_order1;?>/>
      <label>Ascending</label>
      <input name="encoded_leave_listing_order" type="radio" value="DESC" <?php echo $encoded_leave_listing_order2;?> />
      <label>Descending</label></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">Auto deduct forced leave every end of the year:</td>
    <td><input name="auto_deduct_forced_leave" type="radio" value="yes" <?php echo $auto_deduct_forced_leave1;?>/>
      <label>Yes</label>
      <input name="auto_deduct_forced_leave" type="radio" value="no" <?php echo $auto_deduct_forced_leave2;?> />
      <label>No</label></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">Auto deduct VL/SL if MC excess 3 days:</td>
    <td><input name="auto_deduct_mc_vl" type="radio" value="yes" <?php echo $auto_deduct_mc_vl1;?>/>
      <label>Yes</label>
      <input name="auto_deduct_mc_vl" type="radio" value="no" <?php echo $auto_deduct_mc_vl2;?> />
      <label>No</label></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">Show Leave balance in leave apps page:</td>
    <td><input name="show_leave_credits_leave_apps" type="radio" value="yes" <?php echo $show_leave_credits_leave_apps1;?>/>
      <label>Yes</label>
      <input name="show_leave_credits_leave_apps" type="radio" value="no" <?php echo $show_leave_credits_leave_apps2;?> />
      <label>No</label></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">Show the day textbox in adding of tardiness:</td>
    <td><input name="enable_add_day_encode_tardy" type="radio" value="yes" <?php echo $enable_add_day_encode_tardy1;?>/>
      <label>Yes</label>
      <input name="enable_add_day_encode_tardy" type="radio" value="no" <?php echo $enable_add_day_encode_tardy2;?> />
      <label>No</label></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">Show add earn menu:</td>
    <td><input name="enable_add_earn_menu" type="radio" value="yes" <?php echo $enable_add_earn_menu1;?>/>
      <label>Yes</label>
      <input name="enable_add_earn_menu" type="radio" value="no" <?php echo $enable_add_earn_menu2;?> />
      <label>No</label></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="button4" id="button4" value="Save" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>
</div>


<div id="payroll" class="settings_tab">
<form action="" method="post">
<table width="100%" border="0" cellpadding="5" cellspacing="5" class="type-one">
  <tr class="type-one-header">
    <th width="28%">Payroll</th>
    <th width="27%"><input name="active_tabs" type="hidden" id="active_tabs" value="payroll" /></th>
    <th width="16%">&nbsp;</th>
    <th width="29%">&nbsp;</th>
  </tr>
  <tr>
    <td><input name="op" type="hidden" id="op" value="1" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">Chief Accountant/Head, Accounting Unit:</td>
    <td><input name="agency_accountant" type="text" id="agency_accountant" value="<?php echo $settings['agency_accountant'];?>" size="30" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">Position:</td>
    <td><input name="agency_accountant_position" type="text" id="agency_accountant_position" value="<?php echo $settings['agency_accountant_position'];?>" size="30" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">Head of Office:</td>
    <td><input name="head_of_office" type="text" id="head_of_office" value="<?php echo $settings['head_of_office'];?>" size="30" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">Position</td>
    <td><input name="head_of_office_position" type="text" id="head_of_office_position" value="<?php echo $settings['head_of_office_position'];?>" size="30" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="button4" id="button4" value="Save" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>
</div>


<div id="signatories" class="settings_tab">
<form action="" method="post">
  <table width="100%" border="0" cellpadding="5" cellspacing="5" class="type-one">
    <tr class="type-one-header">
    <th width="22%">Signatories</th>
    <th width="21%">&nbsp;</th>
    <th width="5%">&nbsp;</th>
    <th width="29%">&nbsp;</th>
    <th width="23%"><input name="active_tabs" type="hidden" id="active_tabs" value="signatories" /></th>
  </tr>
  <tr>
    <td><input name="op" type="hidden" id="op" value="1" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">SCHEDULE OF RETIREMENT PAY AND COMMUTATION OF LEAVE CREDITS</td>
    </tr>
  <tr>
    <td width="22%" align="right"><strong>Statement Of Leave Prepared By:</strong></td>
    <td width="21%"><input name="statement_prepared" type="text" id="statement_prepared" value="<?php echo $settings['statement_prepared'];?>" size="30" /></td>
    <td>&nbsp;</td>
    <td align="right"><strong>Prepared By:</strong></td>
    <td><input name="retirement_signatory_prepared" type="text" id="retirement_signatory_prepared" value="<?php echo $settings['retirement_signatory_prepared'];?>" size="30" /></td>
    </tr>
  <tr>
    <td align="right"><strong>Position:</strong></td>
    <td><input name="statement_prepared_position" type="text" id="statement_prepared_position" value="<?php echo $settings['statement_prepared_position'];?>" size="30" /></td>
    <td>&nbsp;</td>
    <td align="right"><strong>Position:</strong></td>
    <td><input name="retirement_signatory_prepared_position" type="text" id="retirement_signatory_prepared_position" value="<?php echo $settings['retirement_signatory_prepared_position'];?>" size="30" /></td>
    </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td align="right"><strong>Statement Of Leave Certified By:</strong></td>
    <td><input name="statement_certified" type="text" id="statement_certified" value="<?php echo $settings['statement_certified'];?>" size="30" /></td>
    <td>&nbsp;</td>
    <td width="29%" align="right"><strong>Approved By:</strong></td>
    <td width="23%"><input name="retirement_signatory_approved" type="text" id="retirement_signatory_approved" value="<?php echo $settings['retirement_signatory_approved'];?>" size="30" /></td>
    </tr>
  <tr>
    <td align="right"><strong>Position:</strong></td>
    <td><input name="statement_certified_position" type="text" id="statement_certified_position" value="<?php echo $settings['statement_certified_position'];?>" size="30" /></td>
    <td>&nbsp;</td>
    <td align="right"><strong>Position:</strong></td>
    <td><input name="retirement_signatory_approved_position" type="text" id="retirement_signatory_approved_position" value="<?php echo $settings['retirement_signatory_approved_position'];?>" size="30" /></td>
    </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td align="right"><strong>Notice of Leave Balance:</strong></td>
    <td><input name="notice_leave_balance" type="text" id="notice_leave_balance" value="<?php echo $settings['notice_leave_balance'];?>" size="30" /></td>
    <td>&nbsp;</td>
    <td align="right"><strong>Certified Correct By:</strong></td>
    <td><input name="retirement_signatory_certified" type="text" id="retirement_signatory_certified" value="<?php echo $settings['retirement_signatory_certified'];?>" size="30" /></td>
    </tr>
  <tr>
    <td align="right"><strong>Position:</strong></td>
    <td><input name="notice_leave_balance_position" type="text" id="notice_leave_balance_position" value="<?php echo $settings['notice_leave_balance_position'];?>" size="30" /></td>
    <td>&nbsp;</td>
    <td align="right"><strong>Position:</strong></td>
    <td><input name="retirement_signatory_certified_position" type="text" id="retirement_signatory_certified_position" value="<?php echo $settings['retirement_signatory_certified_position'];?>" size="30" /></td>
    </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td align="right"><strong>Notice of Leave Balance Noted By:</strong></td>
    <td><input name="notice_leave_balance_noted" type="text" id="notice_leave_balance_noted" value="<?php echo $settings['notice_leave_balance_noted'];?>" size="30" /></td>
    <td>&nbsp;</td>
    <td align="right"><strong>Attested:</strong></td>
    <td><input name="retirement_signatory_attested" type="text" id="retirement_signatory_attested" value="<?php echo $settings['retirement_signatory_attested'];?>" size="30" /></td>
    </tr>
  <tr>
    <td align="right"><strong>Position:</strong></td>
    <td><input name="notice_leave_balance_noted_position" type="text" id="notice_leave_balance_noted_position" value="<?php echo $settings['notice_leave_balance_noted_position'];?>" size="30" /></td>
    <td>&nbsp;</td>
    <td align="right"><strong>Position:</strong></td>
    <td><input name="retirement_signatory_attested_position" type="text" id="retirement_signatory_attested_position" value="<?php echo $settings['retirement_signatory_attested_position'];?>" size="30" /></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td width="22%" align="right"><strong>Service Record Prepared By:</strong></td>
    <td width="21%"><input name="sr_prepared" type="text" id="sr_prepared" value="<?php echo $settings['sr_prepared'];?>" size="30" /></td>
    <td>&nbsp;</td>
    <td align="right"><strong>AVAILABILITY OF APPROPRIATION:</strong></td>
    <td><input name="retirement_signatory_availability" type="text" id="retirement_signatory_availability" value="<?php echo $settings['retirement_signatory_availability'];?>" size="30" /></td>
    </tr>
  <tr>
    <td align="right"><strong>Position:</strong></td>
    <td><input name="sr_prepared_position" type="text" id="sr_prepared_position" value="<?php echo $settings['sr_prepared_position'];?>" size="30" /></td>
    <td>&nbsp;</td>
    <td align="right"><strong>Position:</strong></td>
    <td><input name="retirement_signatory_availability_position" type="text" id="retirement_signatory_availability_position" value="<?php echo $settings['retirement_signatory_availability_position'];?>" size="30" /></td>
    </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td align="right"><strong>Service Record Certified By:</strong></td>
    <td><input name="sr_certified" type="text" id="sr_certified" value="<?php echo $settings['sr_certified'];?>" size="30" /></td>
    <td>&nbsp;</td>
    <td align="right"><strong>Noted:</strong></td>
    <td><input name="retirement_signatory_noted" type="text" id="retirement_signatory_noted" value="<?php echo $settings['retirement_signatory_noted'];?>" size="30" /></td>
    </tr>
  <tr>
    <td align="right"><strong>Position:</strong></td>
    <td><input name="sr_certified_position" type="text" id="sr_certified_position" value="<?php echo $settings['sr_certified_position'];?>" size="30" /></td>
    <td>&nbsp;</td>
    <td align="right"><strong>Position:</strong></td>
    <td><input name="retirement_signatory_noted_position" type="text" id="retirement_signatory_noted_position" value="<?php echo $settings['retirement_signatory_noted_position'];?>" size="30" /></td>
    </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="22%" align="right"><strong>Training Record Prepared By:</strong></td>
    <td width="21%"><input name="training_prepared" type="text" id="training_prepared" value="<?php echo $settings['training_prepared'];?>" size="30" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right"><strong>Position:</strong></td>
    <td><input name="training_prepared_position" type="text" id="training_prepared_position" value="<?php echo $settings['training_prepared_position'];?>" size="30" /></td>
    <td>&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right"><strong>Training Record Certified By:</strong></td>
    <td><input name="training_certified" type="text" id="training_certified" value="<?php echo $settings['training_certified'];?>" size="30" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right"><strong>Position:</strong></td>
    <td><input name="training_certified_position2" type="text" id="training_certified_position2" value="<?php echo $settings['training_certified_position'];?>" size="30" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right"><strong>CTO Certification Officer:</strong></td>
    <td><input name="cto_certification" type="text" id="cto_certification" value="<?php echo $settings['cto_certification'];?>" size="30" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right"><strong>Position:</strong></td>
    <td><input name="cto_certification_position" type="text" id="cto_certification_position" value="<?php echo $settings['cto_certification_position'];?>" size="30" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right"><strong>Computation of Money Value Prepared by:</strong></td>
    <td><input name="money_value_signatory_prepared" type="text" id="money_value_signatory_prepared" value="<?php echo $settings['money_value_signatory_prepared'];?>" size="30" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right"><strong>Position:</strong></td>
    <td><input name="money_value_signatory_prepared_position" type="text" id="money_value_signatory_prepared_position" value="<?php echo $settings['money_value_signatory_prepared_position'];?>" size="30" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right"><strong>Computation of Money Value Certified by:</strong></td>
    <td><input name="money_value_signatory_certified" type="text" id="money_value_signatory_certified" value="<?php echo $settings['money_value_signatory_certified'];?>" size="30" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right"><strong>Position:</strong></td>
    <td><input name="money_value_signatory_certified_position" type="text" id="money_value_signatory_certified_position" value="<?php echo $settings['money_value_signatory_certified_position'];?>" size="30" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right"><strong>Authority of the Mayor:</strong></td>
    <td><input name="authority_of_mayor" type="text" id="authority_of_mayor" value="<?php echo $settings['authority_of_mayor'];?>" size="30" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">Final Approval of Leave Application</td>
    <td><input name="final_approval_leave_application" type="text" id="final_approval_leave_application" value="<?php echo $settings['final_approval_leave_application'];?>" size="30" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td><input name="final_approval_leave_application_designation" type="text" id="final_approval_leave_application_designation" value="<?php echo $settings['final_approval_leave_application_designation'];?>" size="30" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="button4" id="button4" value="Save" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>
</div>
<?php endif; ?>