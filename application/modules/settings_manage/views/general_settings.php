<?php
if ($settings['enable_download'] == 1)
{
	$checked = 'checked="checked"';
}
else
{
	$checked = '';
}

$minutes_tardy_am_only1 = '';
$minutes_tardy_am_only2 = '';
if ( $settings['minutes_tardy_am_only'] == 1)
{
	$minutes_tardy_am_only1 = 'checked="checked"';
}
else
{
	$minutes_tardy_am_only2 = 'checked="checked"';
}


$undertime_tardi1 = '';
$undertime_tardi2 = '';

if ($settings['undertime_tardi'] == 1)
{
	$undertime_tardi1 = 'checked="checked"';
}
else
{
	$undertime_tardi2 = 'checked="checked"';
}
$leave_order_chrono1 = '';
$leave_order_chrono2 = '';
if ($settings['leave_order_chrono'] == 1)
{
	$leave_order_chrono1 = 'checked="checked"';
}
else
{
	$leave_order_chrono2 = 'checked="checked"';
}

$hospital_view_leave_days1 = '';
$hospital_view_leave_days2 = '';
if ($settings['hospital_view_leave_days'] == 1)
{
	$hospital_view_leave_days1 = 'checked="checked"';
}
else
{
	$hospital_view_leave_days2 = 'checked="checked"';
}



$overwrite_logs1 = '';
$overwrite_logs2 = '';

if ($settings['overwrite_logs'] == 1)
{
	$overwrite_logs1 = 'checked="checked"';
}
else
{
	$overwrite_logs2 = 'checked="checked"';
}

$print_office_head_in_dtr1 = '';
$print_office_head_in_dtr2 = '';

if ($settings['print_office_head_in_dtr'] == 1)
{
	$print_office_head_in_dtr1 = 'checked="checked"';
}
else
{
	$print_office_head_in_dtr2 = 'checked="checked"';
}

$print_overtime_in_dtr1 = '';
$print_overtime_in_dtr2 = '';

if ($settings['print_overtime_in_dtr'] == 1)
{
	$print_overtime_in_dtr1 = 'checked="checked"';
}
else
{
	$print_overtime_in_dtr2 = 'checked="checked"';
}

$allow_forty_hours1 = '';
$allow_forty_hours2 = '';

if ($settings['allow_forty_hours'] == 1)
{
	$allow_forty_hours1 = 'checked="checked"';
}
else
{
	$allow_forty_hours2 = 'checked="checked"';
}


$leave_earn1 = '';
$leave_earn2 = '';

if ($settings['leave_earn'] == 15)
{
	$leave_earn1 = 'checked="checked"';
}
else
{
	$leave_earn2 = 'checked="checked"';
}
?>

<?php if (validation_errors()): ?>
<div class="clean-red"><?php echo validation_errors(); ?></div><br />
<?php elseif ($this->session->flashdata('msg') || $msg != ''): ?>
<div class="clean-green"><?php echo $this->session->flashdata('msg');?><?php echo $msg;?></div><br />
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

<form method="post" action="">
<table width="100%" border="0">
  <tr>
    <td width="15%">&nbsp;</td>
    <td width="38%">&nbsp;</td>
    <td width="12%">&nbsp;</td>
    <td width="19%">&nbsp;</td>
    <td width="13%">&nbsp;</td>
    <td width="3%">&nbsp;</td>
  </tr>
  <?php
  
   ?>
  <tr>
    <td align="right" bgcolor="#CCCCCC">Time Interval: </td>
    <td><input name="time_interval" type="text" id="time_interval" value="<?php echo $settings['time_interval'];?>" size="30" /></td>
    <td bgcolor="#CCCCCC">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right" bgcolor="#CCCCCC">Minutes before Tardy: </td>
    <td><input name="minutes_tardy" type="text" id="minutes_tardy" value="<?php echo $settings['minutes_tardy'];?>" size="3" />
      AM Only <input name="minutes_tardy_am_only" type="radio" value="1" id="radiobutton" <?php echo $minutes_tardy_am_only1;?>/>
    <label>Yes</label>
    <input name="minutes_tardy_am_only" type="radio" id="radio" value="0" <?php echo $minutes_tardy_am_only2;?> />
    <label>No</label></td>
    <td align="right" bgcolor="#CCCCCC">Time Format: </td>
    <td><input name="time_format" type="text" id="time_format" value="<?php echo $settings['time_format'];?>" size="5" /> 
    hour </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right" bgcolor="#CCCCCC">Footer/Agency:</td>
    <td><input name="system_name" type="text" id="system_name" value="<?php echo $settings['system_name'];?>" size="30" /></td>
    <td align="right" bgcolor="#CCCCCC">Mark undertime as tardiness: </td>
    <td><input name="undertime_tardi" type="radio" value="1" id="radiobutton" <?php echo $undertime_tardi1;?>/>
    <label>Yes</label>
    <input name="undertime_tardi" type="radio" id="radio" value="0" <?php echo $undertime_tardi2;?> />
    <label>No</label></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right" bgcolor="#CCCCCC">License:</td>
    <td><input name="license" type="text" id="license" value="<?php echo $settings['license'];?>" size="30" /></td>
    <td rowspan="2" align="right" bgcolor="#CCCCCC">Dont compute Tardiness on this dates: </td>
    <td rowspan="2"><select name="dont_compute" size="4" id="dont_compute">
      <option value="2010-05-13,PM">2010-05-13, PM</option>
      </select>
    </td>
    <td rowspan="2">(yyyy-mm-dd) comma separated </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right" bgcolor="#CCCCCC">Updates Server: </td>
    <td><input name="update_server" type="text" id="update_server" value="<?php echo $settings['update_server'];?>" size="30" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right" bgcolor="#CCCCCC">Enable Download logs From mannysoft server: </td>
    <td><input name="enable_download" type="checkbox" id="enable_download" value="1" <?php echo $checked;?> />
    (mannysoft.com)</td>
    <td align="right" bgcolor="#CCCCCC">Leave Earnings: </td>
    <td><input name="leave_earn" type="radio" value="15" id="radio2" <?php echo $leave_earn1;?>/>
    <label for="radio2">15th and 30th of the month</label>
    (0.625)<br />
    <input name="leave_earn" type="radio" id="radio3" value="30" <?php echo $leave_earn2;?>/>
    <label for="radio3">30th of the month(1.25)</label></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right" bgcolor="#CCCCCC">Client/Server:</td>
    <td><input name="client" type="text" id="client" value="<?php echo $settings['client'];?>" size="30" /></td>
    <td bgcolor="#CCCCCC">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right" bgcolor="#CCCCCC">FTP Host: </td>
    <td><input name="ftp_host" type="text" id="ftp_host" value="<?php echo $settings['ftp_host'];?>" size="30" /></td>
    <td align="right" bgcolor="#CCCCCC">Leave Order Chronological</td>
    <td><input name="leave_order_chrono" type="radio" value="1" id="leave_order_chrono1" <?php echo $leave_order_chrono1;?>/>
    <label>Yes</label>
    <input name="leave_order_chrono" type="radio" value="0" id="leave_order_chrono2" <?php echo $leave_order_chrono2;?> />
    <label>No</label>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right" bgcolor="#CCCCCC">FTP Username: </td>
    <td><input name="ftp_user" type="text" id="ftp_user" value="<?php echo $settings['ftp_user'];?>" size="30" /></td>
    <td align="right" bgcolor="#CCCCCC">Allow change of number of days in leave application:</td>
    <td><input name="hospital_view_leave_days" type="radio" value="1" id="hospital_view_leave_days1" <?php echo $hospital_view_leave_days1;?>/>
    <label>Yes</label>
    <input name="hospital_view_leave_days" type="radio" value="0" id="hospital_view_leave_days2" <?php echo $hospital_view_leave_days2;?> />
    <label>No</label></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right" bgcolor="#CCCCCC">FTP Password: </td>
    <td><input name="ftp_pass" type="password" id="ftp_pass" value="<?php echo $settings['ftp_pass'];?>" size="30" /></td>
    <td bgcolor="#CCCCCC">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right" bgcolor="#CCCCCC">FTP Folder: </td>
    <td><input name="ftp_folder" type="text" id="ftp_folder" value="<?php echo $settings['ftp_folder'];?>" size="30" /></td>
    <td bgcolor="#CCCCCC">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><hr /></td>
    <td bgcolor="#CCCCCC">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right" bgcolor="#CCCCCC">Mannysoft SQL:</td>
    <td><input name="mannysoft_sql" type="text" id="mannysoft_sql" value="<?php echo $settings['mannysoft_sql'];?>" size="30" /></td>
    <td align="right" bgcolor="#CCCCCC">Certification:</td>
    <td><input name="certification_no" type="text" id="certification_no" value="<?php echo $settings['certification_no'];?>" size="2" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right" bgcolor="#CCCCCC">Mannysoft Username: </td>
    <td><input name="mannysoft_username" type="text" id="mannysoft_username" value="<?php echo $settings['mannysoft_username'];?>" size="30" /></td>
    <td align="right" bgcolor="#CCCCCC">Leave Statement: </td>
    <td><input name="statement_no" type="text" id="statement_no" value="<?php echo $settings['statement_no'];?>" size="2" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right" bgcolor="#CCCCCC">Mannysoft Password: </td>
    <td><input name="mannysoft_password" type="password" id="mannysoft_password" value="<?php echo $settings['mannysoft_password'];?>" size="30" /></td>
    <td bgcolor="#CCCCCC">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right" bgcolor="#CCCCCC">Mannysoft Database: </td>
    <td><input name="mannysoft_db" type="text" id="mannysoft_db" value="<?php echo $settings['mannysoft_db'];?>" size="30" /></td>
    <td bgcolor="#CCCCCC"><strong>DTR</strong></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
    <td align="right" bgcolor="#CCCCCC">Allow 40 hrs a week:</td>
    <td><input name="allow_forty_hours" type="radio" value="1" id="radiobutton" <?php echo $allow_forty_hours1;?>/>
    <label>Yes</label>
    <input name="allow_forty_hours" type="radio" value="0" <?php echo $allow_forty_hours2;?> />
    <label>No</label>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right"><input name="op" type="hidden" id="op" value="1" /></td>
    <td>&nbsp;</td>
    <td bgcolor="#CCCCCC">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
    <td align="right" bgcolor="#CCCCCC">Overwrite existing logs in manual log: </td>
    <td><input name="overwrite_logs" type="radio" value="1" id="radiobutton" <?php echo $overwrite_logs1;?>/>
    <label>Yes</label>
    <input name="overwrite_logs" type="radio" id="radio" value="0" <?php echo $overwrite_logs2;?> />
    <label>No</label></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td bgcolor="#CCCCCC">Print Office Head in DTR</td>
    <td><input name="print_office_head_in_dtr" type="radio" value="1" id="radiobutton" <?php echo $print_office_head_in_dtr1;?>/>
    <label>Yes</label>
    <input name="print_office_head_in_dtr" type="radio" id="radio" value="0" <?php echo $print_office_head_in_dtr2;?> />
    <label>No</label>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="right" bgcolor="#CCCCCC">Print overtime summary:</td>
    <td><input name="print_overtime_in_dtr" type="radio" value="1" id="radiobutton" <?php echo $print_overtime_in_dtr1;?>/>
    <label>Yes</label>
    <input name="print_overtime_in_dtr" type="radio" id="radio" value="0" <?php echo $print_overtime_in_dtr2;?> />
    <label>No</label></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<fieldset><legend>Signatories</legend>
<table width="100%" border="0">
  <tr>
    <td width="35%" align="right"><strong>Statement Of Leave Prepared By:</strong></td>
    <td width="63%"><input name="statement_prepared" type="text" id="statement_prepared" value="<?php echo $settings['statement_prepared'];?>" size="40" /></td>
    <td width="2%">&nbsp;</td>
  </tr>
  <tr>
    <td align="right"><strong>Position:</strong></td>
    <td><input name="statement_prepared_position" type="text" id="statement_prepared_position" value="<?php echo $settings['statement_prepared_position'];?>" size="40" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right"><strong>Statement Of Leave Certified By:</strong></td>
    <td><input name="statement_certified" type="text" id="statement_certified" value="<?php echo $settings['statement_certified'];?>" size="40" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right"><strong>Position:</strong></td>
    <td><input name="statement_certified_position" type="text" id="statement_certified_position" value="<?php echo $settings['statement_certified_position'];?>" size="40" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right"><strong>Notice of Leave Balance:</strong></td>
    <td><input name="notice_leave_balance" type="text" id="notice_leave_balance" value="<?php echo $settings['notice_leave_balance'];?>" size="40" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right"><strong>Position:</strong></td>
    <td><input name="notice_leave_balance_position" type="text" id="notice_leave_balance_position" value="<?php echo $settings['notice_leave_balance_position'];?>" size="40" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right"><strong>Notice of Leave Balance Noted By:</strong></td>
    <td><input name="notice_leave_balance_noted" type="text" id="notice_leave_balance_noted" value="<?php echo $settings['notice_leave_balance_noted'];?>" size="40" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right"><strong>Position:</strong></td>
    <td><input name="notice_leave_balance_noted_position" type="text" id="notice_leave_balance_noted_position" value="<?php echo $settings['notice_leave_balance_noted_position'];?>" size="40" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="35%" align="right"><strong>Service Record Prepared By:</strong></td>
    <td width="63%"><input name="sr_prepared" type="text" id="sr_prepared" value="<?php echo $settings['sr_prepared'];?>" size="40" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right"><strong>Position:</strong></td>
    <td><input name="sr_prepared_position" type="text" id="sr_prepared_position" value="<?php echo $settings['sr_prepared_position'];?>" size="40" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right"><strong>Service Record Certified By:</strong></td>
    <td><input name="sr_certified" type="text" id="sr_certified" value="<?php echo $settings['sr_certified'];?>" size="40" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right"><strong>Position:</strong></td>
    <td><input name="sr_certified_position" type="text" id="sr_certified_position" value="<?php echo $settings['sr_certified_position'];?>" size="40" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="35%" align="right"><strong>Training Record Prepared By:</strong></td>
    <td width="63%"><input name="training_prepared" type="text" id="training_prepared" value="<?php echo $settings['training_prepared'];?>" size="40" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right"><strong>Position:</strong></td>
    <td><input name="training_prepared_position" type="text" id="training_prepared_position" value="<?php echo $settings['training_prepared_position'];?>" size="40" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right"><strong>Training Record Certified By:</strong></td>
    <td><input name="training_certified" type="text" id="training_certified" value="<?php echo $settings['training_certified'];?>" size="40" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right"><strong>Position:</strong></td>
    <td><input name="training_certified_position" type="text" id="training_certified_position" value="<?php echo $settings['training_certified_position'];?>" size="40" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right"><strong>CTO Certification Officer:</strong></td>
    <td><input name="cto_certification" type="text" id="cto_certification" value="<?php echo $settings['cto_certification'];?>" size="40" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right"><strong>Position:</strong></td>
    <td><input name="cto_certification_position" type="text" id="cto_certification_position" value="<?php echo $settings['cto_certification_position'];?>" size="40" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
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
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</fieldset>
<table width="100%" border="0">
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="Submit" value="Save" /></td>
    <td>&nbsp;</td>
  </tr>
</table>


</form>

<?php endif; ?>