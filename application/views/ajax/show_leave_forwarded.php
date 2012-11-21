<script type="text/javascript" src="<?php echo base_url();?>js/edit_place/sack.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>js/edit_place/datagrid.js"></script>
    <script type="text/javascript">
    var offices = new dataGrid('offices','<?php echo base_url();?>ajax/edit_place/leave_forward');
    offices.m_columns['forwarded_vacation']={'coltype':'text','style':''};
    offices.m_columns['forwarded_sick']={'coltype':'text','style':''};
    offices.m_columns['forwarded_note']={'coltype':'text','style':''};
    </script>
    <span id="offices.span">
      <table width="100%" border="0" class="type-one" id="offices.table">
        <tr class="type-one-header">
          <th width="3%" bgcolor="#D6D6D6"><input name="checkall" type="checkbox" id="checkall" onclick="select_all('employee', '1');" value="1"/>
          </td>              </th>
          <th width="10%" bgcolor="#D6D6D6"><strong>Employee No.</strong></th>
          <th width="18%" bgcolor="#D6D6D6"><strong>Employee Name</strong></th>
          <th width="21%" bgcolor="#D6D6D6"><strong>Department / Office</strong></th>
          <th width="12%" bgcolor="#D6D6D6">Vacation Leave </th>
          <th width="10%" bgcolor="#D6D6D6">Sick Leave </th>
          <th width="9%" bgcolor="#D6D6D6">Notes</th>
          <th width="5%" bgcolor="#D6D6D6">Total</th>
        </tr>
        <?php 


    
$i = 0;

        
foreach($rows as $row)
{
    $id	   				= $row['id'];
    
    $employee_id	   = $row['employee_id'];
    
    $office_name = $this->Office->get_office_name($row['office_id']);

    $leave = $this->Leave_card->get_total_leave_credits($employee_id);
    
    $onclick0 = "onClick=\"dg_editCell(offices,'".$id."','forwarded_vacation','offices.0.$i', 'leave_forward')\"";
    $onclick1 = "onClick=\"dg_editCell(offices,'".$id."','forwarded_sick','offices.1.$i', 'leave_forward')\"";
    $onclick2 = "onClick=\"dg_editCell(offices,'".$id."','forwarded_note','offices.2.$i', 'leave_forward')\"";
    
    $bg = $this->Helps->set_line_colors();
    
    ?>
        <tr bgcolor="<?php echo $bg;?>" onmouseover="this.bgColor = '<?php echo $this->config->item('mouseover_linecolor')?>';" 
    onmouseout ="this.bgColor = '<?php echo $bg;?>';" style="border-bottom: 1px solid #999999;">
          <td bgcolor=""><input name="employee[]" type="checkbox" value="<?php echo $id;?>" ONCLICK="highlightRow(this,'#ABC7E9');"/></td>
          <td bgcolor=""><?php echo $employee_id;?></td>
          <td bgcolor=""><?php echo $row['lname'].', '.$row['fname'].' '.$row['mname'];?></td>
          <td bgcolor=""><?php echo $office_name;?></td>
          <td bgcolor="" id="offices.0.<?php echo $i;?>" <?php echo $onclick0;?>><?php echo $leave['vacation'];?></td>
          <td bgcolor="" id="offices.1.<?php echo $i;?>" <?php echo $onclick1;?>><?php echo $leave['sick'];?></td>
          <td bgcolor="" id="offices.2.<?php echo $i;?>" <?php echo $onclick2;?>><?php //echo $time_in;?></td>
          <td bgcolor=""><?php echo $leave['vacation'] + $leave['sick'];?></td>
        </tr>
        <?php
    $i ++;
    }
  ?>
        <tr>
          <td colspan="2">&nbsp;</td>
          <td></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table></span>