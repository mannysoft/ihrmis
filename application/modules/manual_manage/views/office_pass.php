<?php if (validation_errors()): ?>
<div class="clean-red"><?php echo validation_errors(); ?></div>
<?php elseif ($this->session->flashdata('msg') || $msg != '' ): ?>
<div class="clean-green"><?php echo $this->session->flashdata('msg');?><?php echo $msg;?></div>
<?php else: ?>
<?php endif; ?>
<form method="post" action="">
<table width="100%" border="0" class="type-one">
      <tr>
        <td>&nbsp;</td>
        <td rowspan="6"><div id="outputname"><img src="images/spacer.gif" /><br />
          <font color="#FFFFFF">.</font></div></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr class="type-one-header">
        <th width="20%" bgcolor="#D6D6D6"><?php echo $msg;?></th>
        <th width="71%" bgcolor="#D6D6D6">&nbsp;</th>
  </tr>
      <tr>
        <td align="right"><strong>Employee ID:
            <input name="op" type="hidden" id="op" value="1" />
        </strong></td>
        <td><input name="employee_id" type="text" id="employee_id" class="ilaw" onfocus="this.style.margin = '0'; this.style.borderWidth = '2px'; this.style.backgroundColor = '#FFFFFF';" onblur="this.style.margin = '1px'; this.style.borderWidth = '1px'; this.style.backgroundColor = '#E9F0F5';" autocomplete="off"/></td>
      </tr>
      <tr>
        <td align="right"><strong>Date:</strong></td>
        <td><strong>
          <?php $js = 'id= "month"';echo form_dropdown('month', $month_options, $month_selected, $js);?>
          </strong><strong>
          <?php $js = 'id= "day"';echo form_dropdown('day', $days_options, $days_selected, $js);?>
          <?php $js = 'id= "year"';echo form_dropdown('year', $year_options, $year_selected, $js);?>
          </strong></td>
      </tr>
      <tr>
        <td align="right"><strong>Time:</strong></td>
        <td><select name="hour" id="hour" >
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
                </select>
: 
<select name="minute" id="minute" >
  <option value="00">00</option>
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
  <option value="24">24</option>
  <option value="25">25</option>
  <option value="26">26</option>
  <option value="27">27</option>
  <option value="28">28</option>
  <option value="29">29</option>
  <option value="30">30</option>
  <option value="31">31</option>
  <option value="32">32</option>
  <option value="33">33</option>
  <option value="34">34</option>
  <option value="35">35</option>
  <option value="36">36</option>
  <option value="37">37</option>
  <option value="38">38</option>
  <option value="39">39</option>
  <option value="40">40</option>
  <option value="41">41</option>
  <option value="42">42</option>
  <option value="43">43</option>
  <option value="44">44</option>
  <option value="45">45</option>
  <option value="46">46</option>
  <option value="47">47</option>
  <option value="48">48</option>
  <option value="49">49</option>
  <option value="50">50</option>
  <option value="51">51</option>
  <option value="52">52</option>
  <option value="53">53</option>
  <option value="54">54</option>
  <option value="55">55</option>
  <option value="56">56</option>
  <option value="57">57</option>
  <option value="58">58</option>
  <option value="59">59</option>
</select>
<select name="am_pm" id="am_pm" >
  <option value="AM">AM</option>
  <option value="PM">PM</option>
</select> 
to 
<select name="hour2" id="hour2" >
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
</select>
:
<select name="minute2" id="select2" >
  <option value="00">00</option>
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
  <option value="24">24</option>
  <option value="25">25</option>
  <option value="26">26</option>
  <option value="27">27</option>
  <option value="28">28</option>
  <option value="29">29</option>
  <option value="30">30</option>
  <option value="31">31</option>
  <option value="32">32</option>
  <option value="33">33</option>
  <option value="34">34</option>
  <option value="35">35</option>
  <option value="36">36</option>
  <option value="37">37</option>
  <option value="38">38</option>
  <option value="39">39</option>
  <option value="40">40</option>
  <option value="41">41</option>
  <option value="42">42</option>
  <option value="43">43</option>
  <option value="44">44</option>
  <option value="45">45</option>
  <option value="46">46</option>
  <option value="47">47</option>
  <option value="48">48</option>
  <option value="49">49</option>
  <option value="50">50</option>
  <option value="51">51</option>
  <option value="52">52</option>
  <option value="53">53</option>
  <option value="54">54</option>
  <option value="55">55</option>
  <option value="56">56</option>
  <option value="57">57</option>
  <option value="58">58</option>
  <option value="59">59</option>
</select>
<select name="am_pm2" id="select3" >
  <option value="AM">AM</option>
  <option value="PM">PM</option>
</select></td>
      </tr>
      <tr>
        <td align="right"></td>
        <td></td>
      </tr>
      <tr>
        <td align="right">&nbsp;</td>
        <td><input name="view_dtr" type="submit" class="button" id="view_dtr" onclick="please_wait();" value="Go"/></td>
      </tr>
      <tr>
        <td align="right">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td align="right"></td>
        <td></td>
  </tr>
    	</table></form>
		
		
		<div id="div15" style="display:block">
		<!--<div id="div15" style="display:none">-->
		  <table width="100%" border="0" class="type-one">
            <tr class="type-one-header">
              <th width="3%" bgcolor="#D6D6D6"><input name="checkall" type="checkbox" id="checkall" onclick="select_all('employee', '1');" value="1"/>
              </td>              </th>
              <th width="7%" bgcolor="#D6D6D6"><strong>Employee No.</strong></th>
              <th width="21%" bgcolor="#D6D6D6"><strong>Employee Name</strong></th>
              <th width="29%" bgcolor="#D6D6D6"><strong>Department / Office</strong></th>
              <th width="8%" bgcolor="#D6D6D6">Date</th>
              <th width="8%" bgcolor="#D6D6D6">Time Out</th>
              <th width="7%" bgcolor="#D6D6D6">Time In </th>
              <th width="11%" bgcolor="#D6D6D6">Total</th>
              <th width="6%" bgcolor="#D6D6D6">&nbsp;</th>
            </tr>
            <?php 
			
	  //output the data
	  $x=2;
	  $y=1;
	
	
	
	
	$rows = $this->Office_pass->get_office_pass();
	
	
	
	$office = '';
			
	foreach($rows as $row)
	{
		$id	   				= $row['id'];
		
		$employee_id	   = $row['employee_id'];
		
		$date = $row['date'];
		
		$time_out = $row['time_out'];
		
		$time_in = $row['time_in'];
		
		$seconds = $row['seconds'];
		
		$this->Employee->fields = array('lname', 'fname', 'mname', 'office_id');
		$employee = $this->Employee->get_employee_info($employee_id);
		
		$office = new Office_m();
		
		$office->get_by_office_id($employee['office_id']);
		
		$bg = $this->Helps->set_line_colors();
		?>
		    <tr bgcolor="<?php echo $bg;?>" onmouseover="this.bgColor = '<?php echo $this->config->item('mouseover_linecolor')?>';" 
    onmouseout ="this.bgColor = '<?php echo $bg;?>';">
              <td bgcolor=""><input name="employee[]" type="checkbox" value="<?php echo $id;?>" ONCLICK="highlightRow(this,'#ABC7E9');"/></td>
		      <td bgcolor=""><?php echo $employee_id;?></td>
		      <td bgcolor=""><?php echo $employee['lname'].', '.$employee['fname'].' '.$employee['mname'];?></td>
		      <td bgcolor=""><?php echo $office->office_name;?></td>
		      <td bgcolor=""><?php echo $date;?></td>
		      <td bgcolor=""><?php echo $time_out;?></td>
		      <td bgcolor=""><?php echo $time_in;?></td>
		      <td bgcolor=""><?php echo $this->Helps->compute_time($seconds);?></td>
		      <td bgcolor=""><a href="<?php echo base_url().'manual_manage/cancel_office_pass/'.$id;?>" class="cancel_office_pass">Cancel</a></td>
	        </tr>
            <?php
		
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
              <td>&nbsp;</td>
            </tr>
          </table>
</div>

<script>
$('.cancel_office_pass').click(function(){

	var answer = confirm("Are you sure?")
	
	if (!answer)
	{
		return false;
	}
});
$('#employee_id').keyup(function(){

	if ($('#employee_id').val() == "" || $('#employee_id').val() == undefined)
	{
		//alert("Please enter a valid employee no.");
		$('#outputname').html("Please enter a valid employee no.");
		return
	}
	else
	{
	
		$('#outputname').load("<?php echo base_url().('ajax/view_name/'); ?>" + $('#employee_id').val());
	}
});

function change_value(new_value)
{
	
	$('#outputname').load("<?php echo base_url().('ajax/view_name/'); ?>" + new_value);
	$('#employee_id').val(new_value);
}
</script>