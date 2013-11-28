<?php if (validation_errors()): ?>
<div class="clean-red"><?php echo validation_errors(); ?><?php echo $this->session->flashdata('msg');?></div>
<?php elseif ($this->session->flashdata('msg')): ?>
<div class="clean-green"><?php echo validation_errors(); ?><?php echo $this->session->flashdata('msg');?></div>
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
      <td width="14%" align="right" class="type-one">Object of Expenditure: </td>
      <td width="32%" align="left" class="type-one">
	  <?php echo form_dropdown(
	  						'budget_expenditure_id', 
							budget_expenditures_options(), 
							Input::get('budget_expenditure_id') ? Input::get('budget_expenditure_id') : $expense->budget_expenditure_id
							);?></td>
      <td align="left">&nbsp;</td>
    </tr>
    <tr>
      <td align="right" class="type-one">Date: </td>
      <td align="left" class="type-one"><input name="date" type="text" id="date" value="<?php echo $expense->date; ?>" size="35" class="ilaw" onfocus="this.style.margin = '0'; this.style.borderWidth = '2px'; this.style.backgroundColor = '#FFFFFF';" onblur="this.style.margin = '1px'; this.style.borderWidth = '1px'; this.style.backgroundColor = '#E9F0F5';"/></td>
      <td align="left">&nbsp;</td>
    </tr>
    <tr>
      <td align="right" class="type-one">Description: </td>
      <td align="left" class="type-one"><input name="description" type="text" id="description" value="<?php echo $expense->description; ?>" size="35" class="ilaw" onfocus="this.style.margin = '0'; this.style.borderWidth = '2px'; this.style.backgroundColor = '#FFFFFF';" onblur="this.style.margin = '1px'; this.style.borderWidth = '1px'; this.style.backgroundColor = '#E9F0F5';"/></td>
      <td align="left">&nbsp;</td>
    </tr>
    <tr>
      <td align="right" class="type-one">Amount: </td>
      <td align="left" class="type-one"><input name="amount" type="text" id="amount" value="<?php echo $expense->amount; ?>" size="35" class="ilaw" onfocus="this.style.margin = '0'; this.style.borderWidth = '2px'; this.style.backgroundColor = '#FFFFFF';" onblur="this.style.margin = '1px'; this.style.borderWidth = '1px'; this.style.backgroundColor = '#E9F0F5';"/></td>
      <td align="left">&nbsp;</td>
    </tr>
    <tr>
      <td align="right" class="type-one">&nbsp;</td>
      <td align="left" class="type-one"><strong>
        <input type="submit" name="button2" id="button" value="Save"/>
        </strong><a href="<?=base_url().'budget/expenses/index/'; echo Input::get('budget_expenditure_id') ? Input::get('budget_expenditure_id') : $expense->budget_expenditure_id?>">Cancel</a></td>
      <td align="left">&nbsp;</td>
    </tr>
</table>
<div></div>
</form>