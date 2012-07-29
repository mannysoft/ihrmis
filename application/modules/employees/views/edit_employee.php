<style type="text/css">
<!--
#pics {
	position:absolute;
	width:141px;
	height:220px;
	z-index:1;
	left: 659px;
	top: 182px;
}
-->
</style>
<?php if (validation_errors()): ?>
<div class="clean-red"><?php echo validation_errors(); ?></div>
<?php elseif ($this->session->flashdata('msg')): ?>
<div class="clean-green"><?php echo $this->session->flashdata('msg');?></div><br />
<?php else: ?>
<?php endif; ?>
<form method="post" action="<?php echo base_url().'utility/upload_image';?>" target="upload_iframe" enctype="multipart/form-data">
<table width="100%" border="0">
  <tr>
    <td colspan="4"></td>
    </tr>
  <tr>
    <td width="17%" align="right">Photo</td>
    <td width="3%">&nbsp;</td>
    <td width="36%"><input type="file" name="file" id="file" onChange="jsUpload(this)"/>
      <input name="filename" type="hidden" id="filename" />
      <input type="hidden" name="fileframe" value="true" /></td>
    <td width="44%"><div id="upload_status"></div></td>
    </tr>
</table>
</form>
<script type="text/javascript">
/* This function is called when user selects file in file dialog */
function jsUpload(upload_field)
{
    // this is just an example of checking file extensions
    // if you do not need extension checking, remove 
    // everything down to line

    var re_text = /\.jpg|\.gif|\.png/i;
    var filename = upload_field.value;

    /* Checking file type */
    if (filename.search(re_text) == -1)
    {
        alert("File does not have text(jpg, gif, png) extension");
        upload_field.form.reset();
        return false;
    }

    upload_field.form.submit();
    
	upload_field.form.reset();
	
    return true;
}
</script>
<form id="myform" method="post" action="" target="" enctype="multipart/form-data">
<table width="100%" border="0" cellpadding="5" cellspacing="5">
    <tr>
      <td width="20%" align="right">Employee no. </td>
      <td width="2%"><input name="id" type="hidden" id="id" value="<?php echo $id;?>" /></td>
      <td width="78%" align="left"><input name="employee_id" type="text" class="ilaw" id="employee_id" onfocus="this.style.margin = '0'; this.style.borderWidth = '2px'; this.style.backgroundColor = '#FFFFFF';" onblur="this.style.margin = '1px'; this.style.borderWidth = '1px'; this.style.backgroundColor = '#E9F0F5';" value="<?php echo set_value('employee_id', $employee_id); ?>" size="35" autocomplete="off"/>
	  <div id="outemployee_id"><?php echo $msg;?></div></td>
    </tr>
    <tr>
      <td align="right">Department / Office:</td>
      <td><?php echo form_hidden('page', $page);?><?php echo form_hidden('office_return', $office_return);?></td>
      <td align="left"><span class="type-one"><?php echo form_dropdown('office_id', $options, $selected, 'id="office_id"'); ?></span></td>
    </tr>
    <tr>
      <td align="right">Division:</td>
      <td>&nbsp;</td>
      <td align="left"><span class="type-one"><?php echo form_dropdown('division_id', array(), '', 'id="division_id"'); ?></span></td>
    </tr>
    <tr>
      <td align="right">Section:</td>
      <td>&nbsp;</td>
      <td align="left"><span class="type-one"><?php echo form_dropdown('section_id', array(), '', 'id="section_id"'); ?></span></td>
    </tr>
    <tr>
      <td align="right">Detailed Office: </td>
      <td><?php echo form_hidden('orig_id', $orig_id);?></td>
      <td align="left"><span class="type-one"><?php echo form_dropdown('detailed_office_id', $detailed_options, $detailed_selected); ?></span></td>
    </tr>
    <tr>
      <td align="right">Salutation:</td>
      <td>&nbsp;</td>
      <td align="left"><input name="salutation" type="text" class="ilaw" id="salutation" onfocus="this.style.margin = '0'; this.style.borderWidth = '2px'; this.style.backgroundColor = '#FFFFFF';" onblur="this.style.margin = '1px'; this.style.borderWidth = '1px'; this.style.backgroundColor = '#E9F0F5';" value="<?php echo set_value('salutation', $salutation); ?>" size="35"/>
        (ex: Mr., Ms., Mrs.)</td>
    </tr>
    <tr>
      <td align="right">Last name </td>
      <td>&nbsp;</td>
      <td align="left"><input name="lname" type="text" class="ilaw" id="lname" onFocus="this.style.margin = '0'; this.style.borderWidth = '2px'; this.style.backgroundColor = '#FFFFFF';" onBlur="this.style.margin = '1px'; this.style.borderWidth = '1px'; this.style.backgroundColor = '#E9F0F5';" value="<?php echo set_value('lname', $lname); ?>" size="35" />
      <div id="pics">
      <iframe src="<?php echo base_url().'utility/show_image/'.$image_file_name;?>" name="upload_iframe" style="width: 230px; height: 230px; display: block;"></iframe></div></td>
    </tr>
    <tr>
      <td align="right">First name </td>
      <td>&nbsp;</td>
      <td align="left"><input name="fname" type="text" class="ilaw" id="fname" onFocus="this.style.margin = '0'; this.style.borderWidth = '2px'; this.style.backgroundColor = '#FFFFFF';" onBlur="this.style.margin = '1px'; this.style.borderWidth = '1px'; this.style.backgroundColor = '#E9F0F5';" value="<?php echo set_value('fname', $fname); ?>" size="35"/></td>
    </tr>
    <tr>
      <td align="right">Middle Name </td>
      <td>&nbsp;</td>
      <td align="left"><input name="mname" type="text" class="ilaw" id="mname" onFocus="this.style.margin = '0'; this.style.borderWidth = '2px'; this.style.backgroundColor = '#FFFFFF';" onBlur="this.style.margin = '1px'; this.style.borderWidth = '1px'; this.style.backgroundColor = '#E9F0F5';" value="<?php echo set_value('mname', $mname); ?>" size="35"/></td>
    </tr>
    <tr>
      <td align="right">Type of employment: </td>
      <td>&nbsp;</td>
      <td align="left">
	  <?php $js = 'id="permanent" onchange="ispermanent(this.form);"';
		echo form_dropdown('permanent', $permanent_options, $permanent_options_selected, $js); ?></td>
    </tr>
    <tr>
      <td align="right">1st day of service<br />
        (<span class="style2">if permanent</span>): </td>
      <td>&nbsp;</td>
      <td align="left"><input name="first_day_of_service" type="text" class="ilaw" id="first_day_of_service" onfocus="this.style.margin = '0'; this.style.borderWidth = '2px'; this.style.backgroundColor = '#FFFFFF';" onblur="this.style.margin = '1px'; this.style.borderWidth = '1px'; this.style.backgroundColor = '#E9F0F5';" value="<?php echo set_value('first_day_of_service', $first_day_of_service); ?>" size="35" readonly/>
          <img src="<?php echo base_url();?>images/img.gif" width="20" height="14" align="middle" class="calimg" id="f_trigger_a" style="" title="Date selector" onmouseover="this.style.background='red';" onmouseout="this.style.background=''" />
          <script type="text/javascript">
		    Calendar.setup({
	          inputField     :    "first_day_of_service",     // id of the input field
	          ifFormat       :    "%Y-%m-%d", // format of the input field
	          button         :    "f_trigger_a",  // trigger for the calendar (button ID)
	          align          :    "Bl",    // alignment (defaults to "Bl")
	          singleClick    :    true
		    });
		</script></td>
    </tr>
    <tr>
      <td align="right">Salary Grade: </td>
      <td>&nbsp;</td>
      <td align="left"><?php echo form_dropdown('sg', $sg_options, $sg_selected); ?>
        Step:<?php echo form_dropdown('step', $step_options, $step_selected); ?></td>
    </tr>
    <tr>
      <td align="right">Position/Designation:</td>
      <td><strong>
        <input name="op" type="hidden" id="op" value="1" />
      </strong></td>
      <td align="left"><input name="position" type="text" class="ilaw" id="position" onFocus="this.style.margin = '0'; this.style.borderWidth = '2px'; this.style.backgroundColor = '#FFFFFF';" onBlur="this.style.margin = '1px'; this.style.borderWidth = '1px'; this.style.backgroundColor = '#E9F0F5';" value="<?php echo set_value('position', $position); ?>" size="35"/></td>
    </tr>
    
    <?php if ($this->config->item('active_apps') != 'leave_only'): ?>
    
  <tr>
      <td align="right">Assistant Dept. Head:</td>
      <td>&nbsp;</td>
      <td align="left">
      <?php
	   $checked = '';
	  if($assistant_dept_head == 1)
	  {
		  $checked = 'checked';
		}?>
      <input name="assistant_dept_head" type="checkbox" id="assistant_dept_head" value="1" <?php echo $checked?>/>
        <label for="assistant_dept_head">Yes</label></td>
  </tr>
  <tr>
      <td align="right">Shift / Time:</td>
      <td>&nbsp;</td>
      <td align="left"><span class="type-one">
        <?php 
	  $js = 'id = "shift2"';
	  echo form_dropdown('shift2', $shifts_options, 1, $js); 
	  ?>
        <select name="hour1" id="hour1" disabled="disabled">
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
<select name="minute1" id="minute1" disabled="disabled">
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
<select name="am_pm1" id="am_pm1" disabled="disabled">
  <option value="AM">AM</option>
  <option value="PM">PM</option>
</select>
to
<select name="hour2" id="hour2" disabled="disabled">
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
<select name="minute2" id="minute2" disabled="disabled">
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
<select name="am_pm2" id="am_pm2" disabled="disabled">
  <option value="AM">AM</option>
  <option value="PM">PM</option>
</select>
      </span><div id="shift_description">Working hours - 8am-12noon to 01pm-5pm</div></td>
    </tr>
    
    <?php endif; ?>
    
    <tr>
      <td align="right"><strong>
        <input type="submit" name="button2" id="button" value="Update" class="button"/>
      </strong><a href="<?=base_url().'employees'?>">Cancel</a></td>
      <td>&nbsp;</td>
      <td align="left"><input type="hidden" name="MAX_FILE_SIZE" value="10000000000"/></td>
    </tr>
</table>
<script>

$(document).ready(function(){

	//return
	var office_id = $('#office_id').val()
	
	var selected = "";
		
	$.getJSON('<?php echo base_url();?>json/divisions/' + office_id, null, function (data) {
		
		$('#division_id').empty().append("<option value='0'>--All--</option>");
				
		$.each(data, function (key, val) {
			
			if ( key == "<?php echo $division_id;?>")
			{
				selected = "selected";
			}
			else
			{
				selected = "";
			}
			
			$('#division_id').append("<option value='" + key + "' "+ selected +">" + val + "</option>");

		});
	});
	

});

$('#office_id').change(function(){

	//return
	var office_id = $('#office_id').val()
	
	var selected = "";
		
	$.getJSON('<?php echo base_url();?>json/divisions/' + office_id, null, function (data) {
		
		$('#division_id').empty().append("<option value='0'>SELECT</option>");
				
		$.each(data, function (key, val) {
			
			if ( key == "<?php echo $division_id;?>")
			{
				selected = "selected";
			}
			else
			{
				selected = "";
			}
			
			$('#division_id').append("<option value='" + key + "' "+ selected +">" + val + "</option>");

		});
	});

});

$('#id').keyup(function(){

	if ($('#id').val() == "" || $('#id').val() == undefined)
	{
		$('#outemployee_id').html("Please enter a valid employee no.");
		return
	}
	else
	{
	
		$('#outemployee_id').load("<?php echo base_url().('ajax/is_employee_id_exists/'); ?>" + $('#id').val());
	}
});

//Use for new shift or other shift
$('#shift2').change(function(){

	var other_shift = $('#shift2').val();
	
	$('#shift_description').addClass("clean-green");
	
	if ( other_shift == 1)
	{
		$('#shift_description').html("Working hours - 8am-12noon 01pm-5pm");
	}
	if ( other_shift == 2)
	{
		$('#shift_description').html("Working hours like 7am - 3pm, 3pm - 11pm , 11pm - 7am");
	}
	if ( other_shift == 3)
	{
		$('#shift_description').html("Working hours like 6am - 12noon - 3pm - 5pm");
	}
	if ( other_shift == 4)
	{
		$('#shift_description').html("Working hours like Doctors.");
	}
	
	if(other_shift == 0)
	{
		$('#hour1').attr("disabled", false)
		$('#minute1').attr("disabled", false)
		$('#am_pm1').attr("disabled", false)
		$('#hour2').attr("disabled", false)
		$('#minute2').attr("disabled", false)
		$('#am_pm2').attr("disabled", false)
		
	}
	
	else
	{
		$('#hour1').attr("disabled", true)
		$('#minute1').attr("disabled", true)
		$('#am_pm1').attr("disabled", true)
		$('#hour2').attr("disabled", true)
		$('#minute2').attr("disabled", true)
		$('#am_pm2').attr("disabled", true)
		
	}
});
</script>
