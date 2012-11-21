<table width="100%" border="0" class="type-one">
    <tr class="type-one-header">
      <th width="3%" bgcolor="#D6D6D6"><input name="checkall" type="checkbox" id="checkall" onclick="select_all('employee', '1');" value="1"/>
          </td>              </th>
      <th width="22%" bgcolor="#D6D6D6"><strong>Employee No.</strong></th>
      <th width="29%" bgcolor="#D6D6D6"><strong>Employee Name</strong></th>
      <th width="46%" bgcolor="#D6D6D6"><strong>Department / Office</strong></th>
    </tr>
    <?php 
    foreach($rows as $row)
    {
        $fname 		= $row['fname'];
        $mname 		= $row['mname'];
        $lname 		= $row['lname'];
        $employee_id= $row['employee_id'];
        $office_id	= $row['office_id'];
        $status	   	= $row['status'];
        
        //get the office name
        $office_name = $this->Office->get_office_name($office_id);
        
        
        if($status==1)
        {
            $status='Active';
        }
        
        else{
            $status='Not Active';
        }
        
        $checked = '';
        
        if(is_array($this->session->userdata('employees')))
        {
            if(in_array($employee_id, $this->session->userdata('employees')))
            {
                $checked = 'checked="checked"';
            }
            else
            {
                $checked = '';
            }
        }
        
        $bg = $this->Helps->set_line_colors();
        ?>
        <tr bgcolor="<?php echo $bg;?>" onmouseover="this.bgColor = '<?php echo $this->config->item('mouseover_linecolor')?>';" 
    onmouseout ="this.bgColor = '<?php echo $bg;?>';" class = "row_selected" employee_id="<?php echo $employee_id;?>" style="border-bottom: 1px solid #999999;">
          <td bgcolor=""><input name="employee[]" type="checkbox" class = "set_selected" value="<?php echo $employee_id;?>" <?php echo $checked; ?>/></td>
          <td bgcolor=""><?php echo $employee_id;?></td>
          <td bgcolor=""><?php echo $lname.' '.$fname.' '.$mname;?></td>
          <td bgcolor=""><?php echo $office_name;?></td>
        </tr>
        <?php
    }
    ?>
    <tr>
      <td colspan="2">
      <input type="button" name="Submit2" value="Log All" class="button" onclick="process_manual_log();"/></td>
      <td></td>
      <td>&nbsp;</td>
    </tr>
  </table>
  <script>
  $(document).ready(function() {
      
      $('.set_selected').click(function(){

        $('#divTopLeft').html("Loading... Please wait...");
        
        //Add to session data
        if ($(this).attr("checked") == "checked")
        {
            $('#divTopLeft').load("<?php echo base_url().('ajax/set_selected/'); ?>" + $(this).val() + "/1");
        }
        else //Remove to session data
        {
            $('#divTopLeft').load("<?php echo base_url().('ajax/set_selected/'); ?>" + $(this).val() + "/0");
        }
            
      });
      
    });
  </script>