<table width="100%" border="0" class="type-one">
    <tr class="type-one-header">
      <th width="3%" bgcolor="#D6D6D6"><input name="checkall" type="checkbox" id="checkall" onclick="select_all('employee', '1');" value="1"/>
      </td>              </th>
      <th width="14%" bgcolor="#D6D6D6"><strong>Employee No.</strong></th>
      <th width="26%" bgcolor="#D6D6D6"><strong>Employee Name</strong></th>
      <th width="57%" bgcolor="#D6D6D6"><strong>Department / Office</strong></th>
    </tr>
    <?php 
   
foreach($rows as $row)
{
    $fname 			= $row['fname'];
    $mname 			= $row['mname'];
    $lname 			= $row['lname'];
    $employee_id	= $row['employee_id'];
    $office_id		= $row['office_id'];
    $office_name 	= $this->Office->get_office_name($office_id);
    $bg 			= $this->Helps->set_line_colors();
    
    ?>
        <tr bgcolor="<?php echo $bg;?>" onmouseover="this.bgColor = '#ABC7E9';this.style.color='#000000';" 
onmouseout ="this.bgColor = '<?php echo $bg;?>';this.style.color='#000000'">
          <td bgcolor=""><input name="employee[]" type="checkbox" value="<?php echo $employee_id;?>" ONCLICK="highlightRow(this,'#ABC7E9');"/></td>
          <td bgcolor=""><?php echo $employee_id;?></td>
          <td bgcolor=""><?php echo $lname.', '.$fname.' '.$mname;?></td>
          <td bgcolor=""><?php echo $office_name;?></td>
        </tr>
        <?php
    
    }
  ?>
    <tr>
      <td colspan="2">
      <input type="submit" name="Submit2" value="View DTR" class="button"/></td>
      <td></td>
      <td>&nbsp;</td>
    </tr>
  </table>