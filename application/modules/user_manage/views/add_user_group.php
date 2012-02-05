<form id="myform" method="post" action="" target="" enctype="multipart/form-data">
<table width="100%" border="0" cellpadding="2">
    <tr>
      <td align="right" class="type-one">&nbsp;</td>
      <td align="left" class="type-one"><?php echo $msg;?><?php echo validation_errors(); ?><strong>
        <input name="op" type="hidden" id="op" value="1" />
      </strong></td>
      <td width="54%" align="left">&nbsp;</td>
    </tr>
    <tr>
      <td width="14%" align="right" class="type-one">Name: </td>
      <td width="32%" align="left" class="type-one"><input name="name" type="text" class="ilaw" id="name" onfocus="this.style.margin = '0'; this.style.borderWidth = '2px'; this.style.backgroundColor = '#FFFFFF';" onblur="this.style.margin = '1px'; this.style.borderWidth = '1px'; this.style.backgroundColor = '#E9F0F5';" onkeyup="check_id_available(this.form)" value="<?php echo set_value('name'); ?>" size="35"/>
      </td>
      <td align="left">&nbsp;</td>
    </tr>
    <tr>
      <td align="right" class="type-one">Description: </td>
      <td align="left" class="type-one"><input name="description" type="text" id="description" value="<?php echo set_value('description'); ?>" size="35" class="ilaw" onfocus="this.style.margin = '0'; this.style.borderWidth = '2px'; this.style.backgroundColor = '#FFFFFF';" onblur="this.style.margin = '1px'; this.style.borderWidth = '1px'; this.style.backgroundColor = '#E9F0F5';"/></td>
      <td align="left">&nbsp;</td>
    </tr>
    <tr>
      <td align="right" class="type-one">&nbsp;</td>
      <td align="left" class="type-one"><strong>
        <input type="submit" name="button2" id="button" value="Add" class="button"/>
        </strong></td>
      <td align="left">&nbsp;</td>
    </tr>
</table>
<fieldset>
  <legend>User Management</legend>
  <table width="100%" border="0">
    <tr>
      <td width="23%">&nbsp;</td>
      <td width="67%"><input type="checkbox" class="checkall_users" id="checkall_users"><label for="checkall_users"> Check all</label></td>
      <td width="10%"></td>
    </tr>
    <tr>
      <td>List Users</td>
      <td><input name="list_user" type="checkbox" id="list_user" value="list_user" class="users" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>Add Users</td>
      <td><input name="add_user" type="checkbox" id="add_user" value="add_user" class="users" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>Edit User</td>
      <td><input name="edit_user" type="checkbox" id="edit_user" value="edit_user" class="users"/></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>Delete Users</td>
      <td><input name="delete_user" type="checkbox" id="delete_user" value="delete_user" class="users"/></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
  <p>&nbsp;</p>
</fieldset>
<fieldset>
  <legend>Employee Management</legend>
  <table width="100%" border="0">
    <tr>
      <td width="23%">&nbsp;</td>
      <td width="67%"><input type="checkbox" class="checkall_employees" id="checkall_employees"><label for="checkall_employees"> Check all</label></td>
      <td width="10%">&nbsp;</td>
    </tr>
    <tr>
      <td>View Employees</td>
      <td><input name="list_employee" type="checkbox" id="list_employee" value="list_employee" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>Add  Employees</td>
      <td><input name="add_employee" type="checkbox" id="add_employee" value="add_employee" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>Edit Employees</td>
      <td><input name="edit_employee" type="checkbox" id="edit_employee" value="edit_employee" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>Delete Employees</td>
      <td><input name="delete_employee" type="checkbox" id="delete_employee" value="delete_employee" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
  <p>&nbsp;</p>
</fieldset>


<fieldset>
  <legend>DTR</legend>
  <table width="100%" border="0">
    <tr>
      <td width="23%">&nbsp;</td>
      <td width="67%"><input type="checkbox" class="checkall_dtr" id="checkall_dtr"><label for="checkall_dtr"> Check all</label></td>
      <td width="10%">&nbsp;</td>
    </tr>
    <tr>
      <td>View DTR</td>
      <td><input name="view_dtr" type="checkbox" id="view_dtr" value="1" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
  <p>&nbsp;</p>
</fieldset>








<fieldset>
  <legend>Attendance Management</legend>
  <table width="100%" border="0">
    <tr>
      <td width="23%">&nbsp;</td>
      <td width="67%"><input type="checkbox" class="checkall_attendance" id="checkall_attendance"><label for="checkall_attendance"> Check all</label></td>
      <td width="10%">&nbsp;</td>
    </tr>
    <tr>
      <td>View Attendance</td>
      <td><input name="view_attendance" type="checkbox" id="view_attendance" value="1" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>Edit  Attendance</td>
      <td><input name="edit_attendance" type="checkbox" id="edit_attendance" value="1" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>View Absences</td>
      <td><input name="view_absences" type="checkbox" id="view_absences" value="1" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>View Late / Undertime</td>
      <td><input name="edit_late" type="checkbox" id="edit_late" value="1" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>View Official Business</td>
      <td><input name="view_ob" type="checkbox" id="view_ob" value="1" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>View Tardiness</td>
      <td><input name="view_tardiness" type="checkbox" id="edit_employees3" value="1" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>View Ten Times Tardiness</td>
      <td><input name="view_ten_tardiness" type="checkbox" id="delete_employees3" value="1" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
  <p>&nbsp;</p>
</fieldset>



<fieldset>
  <legend>Manual Log</legend>
  <table width="100%" border="0">
    <tr>
      <td width="23%">&nbsp;</td>
      <td width="67%"><input type="checkbox" class="checkall_manual" id="checkall_manual"><label for="checkall_manual"> Check all</label></td>
      <td width="10%">&nbsp;</td>
    </tr>
    <tr>
      <td>Official Business</td>
      <td><input name="ob" type="checkbox" id="ob" value="1" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>Manual Login / Logout</td>
      <td><input name="login" type="checkbox" id="login" value="1" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>Compensatory Time off</td>
      <td><input name="cto" type="checkbox" id="cto" value="1" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>Office Pass</td>
      <td><input name="office_pass" type="checkbox" id="office_pass" value="1" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
  <p>&nbsp;</p>
</fieldset>



<fieldset>
  <legend>Office Management
  </legend>
  <table width="100%" border="0">
    <tr>
      <td width="23%">&nbsp;</td>
      <td width="67%"><input type="checkbox" class="checkall_office" id="checkall_office"><label for="checkall_office"> Check all</label></td>
      <td width="10%">&nbsp;</td>
    </tr>
    <tr>
      <td>View Offices</td>
      <td><input name="view_offices" type="checkbox" id="view_offices" value="1" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>Modify Offices</td>
      <td><input name="modify_offices" type="checkbox" id="modify_offices" value="1" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
  <p>&nbsp;</p>
</fieldset>



<fieldset>
  <legend>Leave Management
  </legend>
  <table width="100%" border="0">
    <tr>
      <td width="23%">&nbsp;</td>
      <td width="67%"><input type="checkbox" class="checkall_leave" id="checkall_leave"><label for="checkall_leave"> Check all</label></td>
      <td width="10%">&nbsp;</td>
    </tr>
    <tr>
      <td>View Leave Records</td>
      <td><input name="leave_records" type="checkbox" id="leave_records" value="1" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>Cancel  Leave</td>
      <td><input name="cancel_leave" type="checkbox" id="cancel_leave" value="1" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>Encode Leave Applications</td>
      <td><input name="encode_leave" type="checkbox" id="encode_leave" value="1" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>Approve Leave Applications</td>
      <td><input name="approve_leave" type="checkbox" id="approve_leave" value="1" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>Encode Leave Forward</td>
      <td><input name="encode_leave_forward" type="checkbox" id="encode_leave_forward" value="1" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>View Leave w/out Pay</td>
      <td><input name="view_wop" type="checkbox" id="view_wop" value="1" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>Stop Leave Earnings</td>
      <td><input name="stop_earnings" type="checkbox" id="stop_earnings" value="1" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
  <p>&nbsp;</p>
</fieldset>


<fieldset>
  <legend>Settings
  </legend>
  <table width="100%" border="0">
    <tr>
      <td width="23%">&nbsp;</td>
      <td width="67%"><input type="checkbox" class="checkall_settings" id="checkall_settings"><label for="checkall_settings"> Check all</label></td>
      <td width="10%">&nbsp;</td>
    </tr>
    <tr>
      <td>Salary Grade</td>
      <td><input name="salary_grade" type="checkbox" id="salary_grade" value="1" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>Holiday</td>
      <td><input name="holiday" type="checkbox" id="holiday" value="1" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>Employee Schedule</td>
      <td><input name="employee_schedule" type="checkbox" id="employee_schedule" value="1" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>Audit Trail</td>
      <td><input name="audit_trail" type="checkbox" id="audit_trail" value="1" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>General Settings</td>
      <td><input name="general_settings" type="checkbox" id="general_settings" value="1" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>Backup</td>
      <td><input name="backup" type="checkbox" id="backup" value="1" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>Offline Update</td>
      <td><input name="offline_update" type="checkbox" id="offline_update" value="1" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
  <p>&nbsp;</p>
</fieldset>



<div></div>
</form>
<script>
$(function () { // this line makes sure this code runs on page load
	
	$('.checkall_users').click(function () {
		$(this).parents('fieldset:eq(0)').find(':checkbox').attr('checked', this.checked);
	});
	
	$('.checkall_employees').click(function () {
		$(this).parents('fieldset:eq(0)').find(':checkbox').attr('checked', this.checked);
	});
	
	$('.checkall_dtr').click(function () {
		$(this).parents('fieldset:eq(0)').find(':checkbox').attr('checked', this.checked);
	});
	
	$('.checkall_attendance').click(function () {
		$(this).parents('fieldset:eq(0)').find(':checkbox').attr('checked', this.checked);
	});
	
	$('.checkall_manual').click(function () {
		$(this).parents('fieldset:eq(0)').find(':checkbox').attr('checked', this.checked);
	});
	
	$('.checkall_office').click(function () {
		$(this).parents('fieldset:eq(0)').find(':checkbox').attr('checked', this.checked);
	});
	
	$('.checkall_leave').click(function () {
		$(this).parents('fieldset:eq(0)').find(':checkbox').attr('checked', this.checked);
	});
	
	$('.checkall_settings').click(function () {
		$(this).parents('fieldset:eq(0)').find(':checkbox').attr('checked', this.checked);
	});
});
</script>