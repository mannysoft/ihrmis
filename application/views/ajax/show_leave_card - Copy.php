<table width="100%" border="0" class="type-one">
<tr class="type-one-header">
<th width="14%" bgcolor="#D6D6D6"><strong>Employee No. </strong></th>
<th width="26%" bgcolor="#D6D6D6"><strong>Employee Name </strong></th>
<th width="18%" bgcolor="#D6D6D6"><strong>Period</strong></th>
<th width="16%" bgcolor="#D6D6D6"><strong>Notes</strong></th>
<th width="26%" bgcolor="#D6D6D6"><span style="font-weight: bold">Actions</span></th>
</tr>
<?php
foreach($rows as $row)
{
    $manual_log_id 			= $row['id'];
    $employee_id 			= $row['employee_id'];
    $log_type 				= $row['log_type'];
    $cover_if_ob_or_leave 	= $row['cover_if_ob_or_leave'];
    $cover_if_ob_or_leave2 	= $row['cover_if_ob_or_leave2'];
    $multiple 				= $row['multiple'];
    $notes 					= $row['notes'];
        
        
    $this->Employee->fields = array('fname', 'mname', 'lname');
        
    $name = $this->Employee->get_employee_info($employee_id);
        
    
    if ($cover_if_ob_or_leave == $cover_if_ob_or_leave2)
    {
        $period = date('M. d, Y',strtotime($cover_if_ob_or_leave));
    }
    else
    {
        if($cover_if_ob_or_leave2 == 'Half Day')
        {
            $period = date('M. d, Y',strtotime($cover_if_ob_or_leave)).'(Half Day)';
        }
        else
        {
            $period = date('M. d',strtotime($cover_if_ob_or_leave)).'-'.date('d',strtotime($cover_if_ob_or_leave2)).date(', Y',strtotime($cover_if_ob_or_leave2));
        }
    }
    
    if ($multiple == 1)
    {
        $period = $cover_if_ob_or_leave2;
    }
    
    $bg = $this->Helps->set_line_colors();
    
    
    //
    
        
?>
<tr bgcolor="<?php echo $bg;?>" onmouseover="this.bgColor = '<?php echo $this->config->item('mouseover_linecolor')?>';" 
    onmouseout ="this.bgColor = '<?php echo $bg;?>';">
<td><input name="ob[]" type="checkbox" id="ob[]" ONCLICK="highlightRow(this,'#ABC7E9');" value="<?php echo $manual_log_id;?>"/>
<?php echo $employee_id;?></td>
<td><?php echo $name['fname'].' '.$name['mname'].' '.$name['lname'];?></td>
<td><?php echo $period;?></td>
<td><?php echo $notes;?></td>
<td align="right">
<a href="<?php echo base_url();?>Leave_Manage/cancel_leave/<?php echo $manual_log_id.'/'.$employee_id.'/0/0';?>" onclick="return confirm_msg('Are you sure you want to cancel this Leave?\n Click OK to proceed otherwise click Cancel.');">Cancel</a> | 
<a href="<?php echo base_url();?>Leave_Manage/cancel_leave/<?php echo $manual_log_id.'/'.$employee_id.'/1/0';?>" onclick="return confirm_msg('Are you sure you want to cancel this Leave?\n Click OK to proceed otherwise click Cancel.');">Cancel(CSC)</a> | 
<a href="<?php echo base_url();?>Leave_Manage/cancel_leave/<?php echo $manual_log_id.'/'.$employee_id.'/0/1';?>" onclick="return confirm_msg('Are you sure you want to cancel this Leave?\n Click OK to proceed otherwise click Cancel.');">Cancel(CPO)<?php //echo $_GET['q']; ?></a></td>
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
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
</table>