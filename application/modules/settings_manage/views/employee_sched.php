<table width="100%">
  <tr>
    <td width="12%" align="right">Name:</td>
    <td colspan="2"><?php echo $name['lname'].', '.$name['fname'].' '.$name['mname']; ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td width="26%"><input name="employee_id" type="text" id="employee_id" value="<?php echo $name['id'];?>" /></td>
    <td width="62%">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><a href="#" class="add_schedule">Add schedule</a></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

<div id="add_schedule_div" style="display:block">
<table width="100%">
  <tr>
    <td width="19%" align="right">Date:</td>
    <td width="63%"><strong>
      <?php $js = 'id= "month"';echo form_dropdown('month', $month_options, $month_selected, $js);?>
      <?php $js = 'id= "day1"';echo form_dropdown('day1', $days_options, '01', $js);?>
    </strong> To: <strong>
    <?php $js = 'id= "day2"';echo form_dropdown('day2', $days_options, $days_selected, $js);?>
    </strong><strong>
    <?php $js = 'id= "year"';echo form_dropdown('year', $year_options, $year_selected, $js);?>
    </strong></td>
    <td width="18%">&nbsp;</td>
  </tr>
  <tr>
    <td align="right">Time:</td>
    <td><select name="hour1" id="hour1">
      <option value="01">01</option>
      <option value="02">02</option>
      <option value="03">03</option>
      <option value="04">04</option>
      <option value="05">05</option>
      <option value="06" selected="selected">06</option>
      <option value="07">07</option>
      <option value="08">08</option>
      <option value="09">09</option>
      <option value="10">10</option>
      <option value="11">11</option>
      <option value="12">12</option>
      <option value="13">13</option>
      <option value="14">14</option>
      <option value="15">15</option>
      <option value="16">16</option>
      <option value="17">17</option>
      <option value="18">18</option>
      <option value="19">19</option>
      <option value="20">20</option>
      <option value="21">21</option>
      <option value="22">22</option>
      <option value="23">23</option>
      <option value="00">00</option>
    </select>
       to 
       <select name="hour2" id="hour2">
        <option value="01">01</option>
        <option value="02">02</option>
        <option value="03">03</option>
        <option value="04">04</option>
        <option value="05">05</option>
        <option value="06">06</option>
        <option value="07">07</option>
        <option value="08">08</option>
        <option value="09">09</option>
        <option value="10">10</option>
        <option value="11">11</option>
        <option value="12">12</option>
        <option value="13">13</option>
        <option value="14" selected="selected">14</option>
        <option value="15">15</option>
        <option value="16">16</option>
        <option value="17">17</option>
        <option value="18">18</option>
        <option value="19">19</option>
        <option value="20">20</option>
        <option value="21">21</option>
        <option value="22">22</option>
        <option value="23">23</option>
        <option value="00">00</option>
      </select></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td><input type="button" name="btn_save" id="btn_save" value="Save" />
      <input type="button" name="btn_cancel" id="btn_cancel" value="Cancel" /></td>
    <td>&nbsp;</td>
  </tr>
</table>

</div>

<table width="100%" border="0" class="type-one">
    <tr class="type-one-header">
      <th width="2%" bgcolor="#D6D6D6"><input name="checkall" type="checkbox" id="checkall" onclick="select_all('employee', '1');" value="1"/>
          </td>              </th>
      <th width="8%" bgcolor="#D6D6D6"><strong>Day</strong></th>
      <th width="22%" bgcolor="#D6D6D6"><strong>Time</strong></th>
      <th width="30%" bgcolor="#D6D6D6">&nbsp;</th>
      <th width="38%" bgcolor="#D6D6D6">&nbsp;</th>
    </tr>
    <?php 
    /*
	
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
          <td bgcolor="">&nbsp;</td>
          <td bgcolor="">&nbsp;</td>
          <td bgcolor=""><a href="<?php echo base_url().'Settings_Manage/employee_sched/'.$id;?>">Show</a></td>
        </tr>
        <?php
    }
	*/
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
     
	 $('#add_schedule_div').hide('fast'); 
     
	  $('.add_schedule').click(function(){

       $('#add_schedule_div').show('fast');
	    //alert("")
		
		      
      });
	  
	  var date1 = "";
	  var date2 = "";
	  
	  date1 = $('#year').val() + "-" + $('#month').val() +"-" + $('#day1').val();
	  date2 = $('#year').val() + "-" + $('#month').val() +"-" + $('#day2').val();
	  
	  //alert($('#year').val() + "-" + $('#month').val() +"-" + $('#day2').val())
	  
	  $('#btn_save').click(function(){
		  
		  //var date1 = "";
		  //var date2 = "";
		  
		  //date1 = $('#month').val() + "-" + $('#day1').val() +"-" + $('#year').val();
		  //alert(date2);
		  //return

       $.post('<?php echo base_url();?>Settings_Manage/add_sched', 
		   { employee_id: $('#employee_id').val(), date1: $('#year').val() + "-" + $('#month').val() +"-" + $('#day1').val(), date2: $('#year').val() + "-" + $('#month').val() +"-" + $('#day2').val()}, 
		   function(data) 
		   {
  				// Tell if success or error
				if (data.substr(0, 1) == "0")
				{
					// Remove the leading zero
					//data = data.substr(1);
					//$('#messages').html(data);
					//$('#messages').hide('fast');
					
					//$('#messages').show('slow');
				}
				else
				{
					
					// Success
					// Remove the leading zero
					data = data.substr(1);
					
					alert(data)
					
					//$('#list_div').html(data);
					//$('#list_div').show('fast');
					//$('#add_district_div').hide('fast');
					//$('#list_div').load("<?php echo base_url().('Settings_Manage/district_list_view'); ?>");
				}
				
		   });
		      
      });
	  
	  $('#btn_cancel').click(function(){

       //$('#add_schedule_div').show('fast');
	   $('#add_schedule_div').hide('slow');
	    //alert("cancel")
		
		      
      });
	  
	  
	  
      
    });
  </script>