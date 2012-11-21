<table width="100%" border="0" class="type-one">
<tr class="type-one-header">
<th width="11%" bgcolor="#D6D6D6"><strong>Employee No. </strong></th>
<th width="21%" bgcolor="#D6D6D6"><strong>Employee Name </strong></th>
<th width="23%" bgcolor="#D6D6D6"><strong>Particulars</strong></th>
<th width="17%" bgcolor="#D6D6D6">Date and Action<br /></th>
<th width="28%" bgcolor="#D6D6D6"><span style="font-weight: bold">Actions</span></th>
</tr>
<?php
foreach($rows as $row)
{
    $manual_log_id 			= $row['manual_log_id'];
    $employee_id 			= $row['employee_id'];
   
        
        
    $this->Employee->fields = array('fname', 'mname', 'lname');
        
    $name = $this->Employee->get_employee_info($employee_id);
        

    $bg = $this->Helps->set_line_colors();
    
    
    //
    
        
?>
<tr bgcolor="<?php echo $bg;?>" onmouseover="this.bgColor = '<?php echo $this->config->item('mouseover_linecolor')?>';" 
    onmouseout ="this.bgColor = '<?php echo $bg;?>';" style="border-bottom: 1px solid #999999;">
<td><input name="ob[]" type="checkbox" id="ob[]" ONCLICK="highlightRow(this,'#ABC7E9');" value="<?php echo $manual_log_id;?>"/>
<?php echo $employee_id;?></td>
<td><?php echo $name['fname'].' '.$name['mname'].' '.$name['lname'];?></td>
<td><?php echo $row['particulars'];?></td>
<td><?php echo $row['action_take'];?></td>
<td align="right">
<a href="<?php echo base_url();?>leave_manage/cancel_leave/<?php echo $manual_log_id.'/'.$employee_id.'/0/0';?>" onclick="return confirm_msg('Are you sure you want to cancel this Leave?\n Click OK to proceed otherwise click Cancel.');">Cancel</a> | 
<a href="<?php echo base_url();?>leave_manage/cancel_leave/<?php echo $manual_log_id.'/'.$employee_id.'/1/0';?>" onclick="return confirm_msg('Are you sure you want to cancel this Leave?\n Click OK to proceed otherwise click Cancel.');">Cancel(CSC)</a> | 
<a href="<?php echo base_url();?>leave_manage/cancel_leave/<?php echo $manual_log_id.'/'.$employee_id.'/0/1';?>" onclick="return confirm_msg('Are you sure you want to cancel this Leave?\n Click OK to proceed otherwise click Cancel.');">Cancel(CPO)<?php //echo $_GET['q']; ?></a></td>
</tr>
<?php
} 
?><tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
</table>