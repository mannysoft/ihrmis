<?php if (validation_errors()): ?>
<div class="clean-red"><?php echo validation_errors(); ?><?php echo Session::flashData('msg');?></div>
<?php elseif (Session::flashData('msg')): ?>
<div class="clean-green"><?php echo validation_errors(); ?><?php echo Session::flashData('msg');?></div>
<?php else: ?>
<?php endif; ?>
<form id="myform" method="post" action="" target="" enctype="multipart/form-data">
<table width="100%" border="0" cellpadding="2">
    <tr>
      <td align="right" class="type-one">&nbsp;</td>
      <td align="left" class="type-one"><strong>
        <input name="op" type="hidden" id="op" value="1" />
      </strong></td>
      <td width="54%" align="left">&nbsp;</td>
    </tr>
    <tr>
      <td width="14%" align="right" class="type-one">Expenditure: </td>
      <td width="32%" align="left" class="type-one"><input name="expenditures" type="text" class="ilaw" id="expenditures" onfocus="this.style.margin = '0'; this.style.borderWidth = '2px'; this.style.backgroundColor = '#FFFFFF';" onblur="this.style.margin = '1px'; this.style.borderWidth = '1px'; this.style.backgroundColor = '#E9F0F5';" onkeyup="check_id_available(this.form)" value="<?php echo set_value('expenditures', $expenditure->expenditures); ?>" size="35"/>
      </td>
      <td align="left">&nbsp;</td>
    </tr>
    <tr>
      <td align="right" class="type-one">Account Code: </td>
      <td align="left" class="type-one"><input name="account_code" type="text" id="account_code" value="<?php echo set_value('account_code', $expenditure->account_code); ?>" size="35" class="ilaw" onfocus="this.style.margin = '0'; this.style.borderWidth = '2px'; this.style.backgroundColor = '#FFFFFF';" onblur="this.style.margin = '1px'; this.style.borderWidth = '1px'; this.style.backgroundColor = '#E9F0F5';"/></td>
      <td align="left">&nbsp;</td>
    </tr>
    <tr>
      <td align="right" class="type-one">Year: </td>
      <td align="left" class="type-one"><input name="year" type="text" id="year" value="<?php echo set_value('year', $expenditure->year); ?>" size="35" class="ilaw" onfocus="this.style.margin = '0'; this.style.borderWidth = '2px'; this.style.backgroundColor = '#FFFFFF';" onblur="this.style.margin = '1px'; this.style.borderWidth = '1px'; this.style.backgroundColor = '#E9F0F5';"/></td>
      <td align="left">&nbsp;</td>
    </tr>
    <tr>
      <td align="right" class="type-one">Budget: </td>
      <td align="left" class="type-one"><input name="budget_amount" type="text" id="budget_amount" value="<?php echo set_value('budget_amount', $expenditure->budget_amount); ?>" size="35" class="ilaw" onfocus="this.style.margin = '0'; this.style.borderWidth = '2px'; this.style.backgroundColor = '#FFFFFF';" onblur="this.style.margin = '1px'; this.style.borderWidth = '1px'; this.style.backgroundColor = '#E9F0F5';"/></td>
      <td align="left">&nbsp;</td>
    </tr>
    <tr>
      <td align="right" class="type-one">&nbsp;</td>
      <td align="left" class="type-one"><strong>
        <input type="submit" name="button2" id="button" value="Save"/>
        </strong><a href="<?=base_url().'budget'?>">Cancel</a></td>
      <td align="left">&nbsp;</td>
    </tr>
</table>
<div></div>
</form>