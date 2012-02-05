<table width="100%" border="0" class="type-one">
<tr class="type-one-header">
<th width="11%" bgcolor="#D6D6D6"><strong>Employee No. </strong></th>
<th width="21%" bgcolor="#D6D6D6"><strong>Employee Name </strong></th>
<th width="23%" bgcolor="#D6D6D6"><strong>Date</strong></th>
<th width="17%" bgcolor="#D6D6D6">Number of Days<br /></th>
<th width="28%" bgcolor="#D6D6D6"><span style="font-weight: bold">Actions</span></th>
</tr>
<?php foreach($rows as $row):?>
	<?php $bg = $this->Helps->set_line_colors();?>     
<tr bgcolor="<?php echo $bg;?>" onmouseover="this.bgColor = '#EDFEF1'" onclick="this.bgColor = 'RED'"
onmouseout ="this.bgColor = '<?php echo $bg;?>'">
<td><input name="ob[]" type="checkbox" id="ob[]" ONCLICK="highlightRow(this,'#ABC7E9');" value=""/>
<?php echo $row->employee_id;?></td>
<td><?php echo $name['fname'].' '.$name['mname'].' '.$name['lname'];?></td>
<td><?php echo $this->Helps->get_month_name($row->month).' '.$row->dates.' ,'.$row->year;?></td>
<td><?php echo $row->days;?></td>
<td align="left">
<a href="<?php echo base_url();?>manual_manage/cancel_cto/<?php echo $row->id.'/'.$row->employee_id;?>" onclick="return confirm_msg('Are you sure you want to cancel this?\n Click OK to proceed otherwise click Cancel.');">Cancel</a></td>
</tr>
<?php endforeach;?><tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
</table>