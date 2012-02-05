<table width="100%" border="0" class="type-one">
    <tr class="type-one-header">
      <th width="2%" bgcolor="#D6D6D6"><input name="checkall" type="checkbox" id="checkall" onclick="select_all('employee', '1');" value="1"/>
          </td>              </th>
      <th width="8%" bgcolor="#D6D6D6"><strong>Employee No.</strong></th>
      <th width="22%" bgcolor="#D6D6D6"><strong>Employee Name</strong></th>
      <th width="30%" bgcolor="#D6D6D6"><strong>Department / Office</strong></th>
      <th width="38%" bgcolor="#D6D6D6">Schedule</th>
    </tr>
    <?php 
    foreach($rows as $row)
    {
        $fname 		= $row['fname'];
        $mname 		= $row['mname'];
        $lname 		= $row['lname'];
        $id	   		= $row['id'];
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
            if(in_array($id, $this->session->userdata('employees')))
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
        <tr bgcolor="<?php echo $bg;?>" onmouseover="this.bgColor = '#ABC7E9';this.style.color='#000000';" 
onmouseout ="this.bgColor = '<?php echo $bg;?>';this.style.color='#000000'" class = "row_selected" employee_id="<?php echo $id;?>">
          <td bgcolor=""><input name="employee[]" type="checkbox" class = "set_selected" value="<?php echo $id;?>" <?php echo $checked; ?>/></td>
          <td bgcolor=""><?php echo $id;?></td>
          <td bgcolor=""><?php echo $lname.' '.$fname.' '.$mname;?></td>
          <td bgcolor=""><?php echo $office_name;?></td>
          <td bgcolor=""><a href="<?php echo base_url().'settings_manage/employee_sched/'.$id;?>">Show</a></td>
        </tr>
        <?php
    }
    ?>
    <tr>
      <td colspan="2">&nbsp;</td>
      <td></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
  <script>
  $(document).ready(function() {
      
      $('.set_selected').click(function(){

        $('#divTopLeft').html("Loading... Please wait...");
        
        //Add to session data
        if ($(this).attr("checked") == true)
        {
            $('#divTopLeft').load("<?php echo base_url().('ajax/set_selected/'); ?>" + $(this).val() + "/1");
        }
        else //Remove to session data
        {
            $('#divTopLeft').load("<?php echo base_url().('ajax/set_selected/'); ?>" + $(this).val() + "/0");
        }
            
      });
	  
	  /*
	  $('.row_selected').click(function(){

        $('#divTopLeft').html("Loading... Please wait...");
        
		//alert($(this).attr("employee_id"))
		
        //Add to session data
        if ($(this).attr("checked") == true)
        {
            $('#divTopLeft').load("<?php echo base_url().('ajax/set_selected/'); ?>" + $(this).attr("employee_id") + "/1");
        }
        else //Remove to session data
        {
            $('#divTopLeft').load("<?php echo base_url().('ajax/set_selected/'); ?>" + $(this).attr("employee_id") + "/0");
        }
		
            
      });
	  */
      
    });
  </script>