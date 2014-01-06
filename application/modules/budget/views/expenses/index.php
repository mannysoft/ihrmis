<?php if (validation_errors()): ?>
<div class="clean-red"><?php echo validation_errors(); ?><?php echo Session::flashData('msg');?></div>
<?php elseif (Session::flashData('msg')): ?>
<div class="clean-green"><?php echo validation_errors(); ?><?php echo Session::flashData('msg');?></div>
<?php else: ?>
<?php endif; ?>
<form id="budget_expenses" method="post" action="<?php echo base_url();?>budget/expenses" target="" enctype="multipart/form-data">
<table width="100%" border="0">
  <tr>
    <td width="88%">Filter:<?php $js = 'id = "budget_expenditure_id"';
	echo form_dropdown(
	'budget_expenditure_id', 
	budget_expenditures_options(), 
	Input::get('budget_expenditure_id') ? Input::get('budget_expenditure_id') : $id, 
	$js);?>
    
    <?php //if ($from_budget != ''):?>
    	<?php echo anchor(base_url().'budget/', 'Back to Expenditures');?>
	<?php //endif;?>
      <div id="added"></div></td>
    <td width="1%">&nbsp;</td>
    <td width="11%"><a href="<?php echo base_url();?>budget/expenses/save/0/<?php echo Input::get('budget_expenditure_id') ? Input::get('budget_expenditure_id') : $id?>">Add</a> </td>
  </tr>
</table>
<table width="100%" border="0" class="type-one">
      <tr class="type-one-header">
        <th width="2%" scope="col"><input name="checkall" type="checkbox" id="checkall" onClick="select_all('user', '1');" value="1"/></th>
        <th width="30%" scope="col"><strong>Date</strong></th>
        <th width="20%" scope="col"><strong>Description</strong></th>
        <th width="26%" scope="col"><strong>Amount</strong></th>
        <th width="22%" scope="col"><strong>Action</strong></th>
  </tr>
  	<?php $total_amount = 0;?>
	  <?php foreach( $expenses as $row ): ?>
      	<?php 
		$total_amount += $row->amount;
		?>
		 <?php $bg 	= $this->Helps->set_line_colors();?>
		<tr bgcolor="<?php echo $bg;?>" onmouseover="this.bgColor = '<?php echo $this->config->item('mouseover_linecolor')?>';" 
    onmouseout ="this.bgColor = '<?php echo $bg;?>';">
        <td bgcolor=""><input name="user[]" type="checkbox" value="<?php echo $row->id;?>" ONCLICK="highlightRow(this,'#ABC7E9');"/></td>
		<td bgcolor=""><?php echo $row->date;?></td>
        <td bgcolor=""><strong><?php echo $row->description;?></strong></td>
        <td align="right" bgcolor=""><?php echo number_format($row->amount, 2);?></td>
        <td bgcolor=""><?php //if(Session::get('user_type')==1){?>
          <a href="<?php echo base_url();?>budget/expenses/save/<?php echo $row->id;?>">Edit</a> | 
		  <a href="#" onclick="delete_user('<?php echo $row->username;?>','Delete?', '<?php echo base_url();?>budget/expenses/delete/<?php echo $row->id;?>')">Delete</a>
        </td>
        </tr>
		<?php endforeach;?>
      <tr>
        <td colspan="2"><?php echo $this->pagination->create_links(); ?><input name="op" type="hidden" id="op" value="1" /></td>
        <td>&nbsp;</td>
        <td align="right">Total -&gt; <?php echo number_format($total_amount, 2); ?></td>
        <td>&nbsp;</td>
    </tr>
</table>
</form>
<script>
$('#budget_expenditure_id').change(function(){

	$('#budget_expenses').submit();
});

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