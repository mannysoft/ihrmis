<form id="myform" method="post" action="" target="" enctype="multipart/form-data">
<table width="100%" border="0" cellpadding="2">
    <tr>
      <td align="right" class="type-one">&nbsp;</td>
      <td align="left" class="type-one"><strong>
        <input name="op" type="hidden" id="op" value="1" />
      </strong></td>
      <td align="left">&nbsp;</td>
    </tr>
    <tr>
      <td width="19%" align="right" class="type-one">Username: </td>
      <td width="43%" align="left" class="type-one"><input name="username" type="text" id="username" onkeyup="check_id_available(this.form)" value="<?php echo Input::get('username'); ?>" class="form-control"/>
      </td>
      <td align="left">&nbsp;</td>
    </tr>
    <tr>
      <td align="right" class="type-one">Department / Office:</td>
      <td align="left" class="type-one"><?php echo form_dropdown('office_id', $options, '', 'class="form-control"'); ?></td>
      <td align="left">&nbsp;</td>
    </tr>
    <tr>
      <td align="right" class="type-one">Last name: </td>
      <td align="left" class="type-one"><input name="lname" type="text" id="lname" value="<?php echo Input::get('lname'); ?>" class="form-control"/></td>
      <td align="left">&nbsp;</td>
    </tr>
    <tr>
      <td align="right" class="type-one">First name: </td>
      <td align="left" class="type-one"><input name="fname" type="text" id="fname" value="<?php echo Input::get('fname'); ?>" class="form-control"/></td>
      <td align="left">&nbsp;</td>
    </tr>
    <tr>
      <td align="right" class="type-one">Middle Name: </td>
      <td align="left" class="type-one"><input name="mname" type="text" id="mname" value="<?php echo Input::get('mname'); ?>" class="form-control"/></td>
      <td align="left">&nbsp;</td>
    </tr>
    <tr>
      <td align="right" class="type-one">Password:</td>
      <td align="left" class="type-one"><input name="password" type="password" id="password" class="form-control"/></td>
      <td width="38%" align="left">&nbsp;</td>
    </tr>
    <tr>
      <td align="right" class="type-one">Re - type password: </td>
      <td align="left" class="type-one"><input name="repassword" type="password" id="repassword" class="form-control"/></td>
      <td align="left">&nbsp;</td>
    </tr>
    <tr>
      <td align="right" class="type-one">Group:</td>
      <td align="left" class="type-one"><?php echo form_dropdown('group_id', $groups_options, $groups_selected, 'class="form-control"'); ?></td>
      <td align="left">&nbsp;</td>
    </tr>
    <tr>
      <td align="right" class="type-one">&nbsp;</td>
      <td align="left" class="type-one"><strong>
        <input type="submit" name="button2" id="button" value="Save" class="btn btn-primary"/>
        </strong><a href="<?php echo Request::root().'/users'?>">Cancel</a></td>
      <td align="left">&nbsp;</td>
    </tr>
</table>
<div></div>
</form>