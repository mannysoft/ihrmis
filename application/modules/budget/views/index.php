<?php if (validation_errors()): ?>
<div class="clean-red"><?php echo validation_errors(); ?><?php echo Session::flashData('msg');?></div>
<?php elseif (Session::flashData('msg')): ?>
<div class="clean-green"><?php echo validation_errors(); ?><?php echo Session::flashData('msg');?></div>
<?php else: ?>
<?php endif; ?>
<form id="myform" method="post" action="" target="" enctype="multipart/form-data">
<table width="100%" border="0">
  <tr>
    <td width="88%"><strong>Enter keyword:</strong>
      <input name="keyword" type="text" id="keyword" class="ilaw" onfocus="this.style.margin = '0'; this.style.borderWidth = '2px'; this.style.backgroundColor = '#FFFFFF';" onblur="this.style.margin = '1px'; this.style.borderWidth = '1px'; this.style.backgroundColor = '#E9F0F5';"/>
      <input name="search_button" type="submit" id="search_button" value="Search" class="button"/>
      <div id="added"></div></td>
    <td width="1%">&nbsp;</td>
    <td width="11%"><a href="<?php echo base_url();?>budget/save">Add</a> </td>
  </tr>
</table>
<table width="100%" border="0" class="type-one">
      <tr class="type-one-header">
        <th width="2%" scope="col"><input name="checkall" type="checkbox" id="checkall" onClick="select_all('user', '1');" value="1"/></th>
        <th width="22%" scope="col"><strong>Expenditures</strong></th>
        <th width="5%" scope="col"><strong>Account Code</strong></th>
        <th width="9%" scope="col"><strong>Year</strong></th>
        <th width="15%" scope="col"><strong>Budget</strong></th>
        <th width="13%" scope="col">Expenses</th>
        <th width="13%" scope="col">Balance</th>
        <th width="21%" scope="col"><strong>Action</strong></th>
  </tr>
  	<?php $b = new Budget_expenses_m();
	$total_budget = 0;
	$total_expenses = 0;
	$total_balance = 0;
	
	?>
	  <?php foreach( $expenditures as $row ): ?>
      	<?php
		$b->select_sum('amount');
		$b->get_by_budget_expenditure_id($row->id);
		
		$total_budget += $row->budget_amount;
		$total_expenses += $b->amount;
		
		$balance = $row->budget_amount - $b->amount;
		
		$total_balance += $balance;
		?>
		 <?php $bg 	= $this->Helps->set_line_colors();?>
		<tr bgcolor="<?php echo $bg;?>" onmouseover="this.bgColor = '<?php echo $this->config->item('mouseover_linecolor')?>';" 
    onmouseout ="this.bgColor = '<?php echo $bg;?>';">
        <td bgcolor=""><input name="user[]" type="checkbox" value="<?php echo $row->id;?>" ONCLICK="highlightRow(this,'#ABC7E9');"/></td>
		<td bgcolor=""><?php echo $row->expenditures;?></td>
        <td align="center" bgcolor=""><?php echo $row->account_code;?></td>
        <td bgcolor=""><?php echo $row->year;?></td>
        <td align="right" bgcolor=""><?php echo number_format($row->budget_amount, 2);?></td>
        <td align="right" bgcolor=""><a href="<?php echo base_url().'budget/expenses/index/'.$row->id.'/1';?>"><?php echo number_format($b->amount, 2);?></a></td>
        <td align="right" bgcolor=""><?php echo number_format($balance, 2);?></td>
        <td bgcolor=""><?php //if(Session::get('user_type')==1){?>
          <a href="<?php echo base_url();?>budget/save/<?php echo $row->id;?>">Edit</a> | 
		  <a href="#" onclick="delete_user('<?php echo $row->username;?>','Delete?', '<?php echo base_url();?>budget/delete/<?php echo $row->id;?>')">Delete</a>
        </td>
        </tr>
		<?php endforeach;?>
      <tr>
        <td colspan="2"><?php echo $this->pagination->create_links(); ?><input name="op" type="hidden" id="op" value="1" /></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td align="right"><b><?php echo number_format($total_budget, 2);?></b></td>
        <td align="right"><b><?php echo number_format($total_expenses, 2);?></b></td>
        <td align="right"><b><?php echo number_format($total_balance, 2);?></b></td>
        <td>&nbsp;</td>
    </tr>
</table>
</form>
<script>
function delete_user(delete_id, msg, url)
{
	var answer = confirm(msg)
	
	if (!answer)
	{
		return false;
	}
	//alert(url)
	window.location = url
}
</script>