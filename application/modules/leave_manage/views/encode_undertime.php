<!--Added since version 1.75 (04.01-2011)-->
<?php if (validation_errors()): ?>
<div class="clean-red"><?php echo validation_errors(); ?><?php echo $msg; ?></div><br />
<?php elseif ($this->session->flashdata('msg') || $msg != ''): ?>
<div class="clean-green"><?php echo $this->session->flashdata('msg');?><?php echo $msg;?></div><br />
<?php else: ?>
<?php endif; ?>
<form id="myform" method="post" target="" enctype="multipart/form-data">
<table width="100%" border="0" class="type-one">
  <tr class="type-one-header">
    <th colspan="5" bgcolor="#D6D6D6"><th bgcolor="#D6D6D6">
   </th>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td><?php $lgu_code = $this->Settings->get_selected_field( 'lgu_code' );?></td>
    <td colspan="2" rowspan="6" align="left"><div id="outputname">
      <input name="no_record2" type="hidden" id="no_record2" />
    </div></td>
    <td align="left"></td>
  </tr>
  <tr>
    <td width="15" align="right">&nbsp;</td>
    <td width="224" align="right">
     <?php if($lgu_code == 'laguna_province'):?>
      Employee number:
      <?php else:?>
      Employee Number/Last Name:
      <?php endif;?>
    </td>
    <td width="391"><input name="employee_id" type="text" class="ilaw" id="employee_id" onfocus="this.style.margin = '0'; this.style.borderWidth = '2px'; this.style.backgroundColor = '#FFFFFF';" onblur="this.style.margin = '1px'; this.style.borderWidth = '1px'; this.style.backgroundColor = '#E9F0F5';" value="<?php echo set_value('employee_id', $employee_id);?>" size="20" autocomplete="off"/>
        <strong>
        <input name="op" type="hidden" id="op" value="1" />
    </strong></td>
    <td width="57" align="left">
    </td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td align="right">Late/Undertime:</td>
    <td><select name="days" id="days">
      <option value="0"></option>
      <option value="01">01</option>
      <option value="02">02</option>
      <option value="03">03</option>
      <option value="04">04</option>
      <option value="05">05</option>
      <option value="06">06</option>
      <option value="07">07</option>
      <option value="08">08</option>
      </select>
      Days<br />
      <select name="hours" id="hours" >
        <option value="0"></option>
        <option value="01">01</option>
        <option value="02">02</option>
        <option value="03">03</option>
        <option value="04">04</option>
        <option value="05">05</option>
        <option value="06">06</option>
        <option value="07">07</option>
</select>
      Hours<br />
      <select name="minutes" id="minutes" >
        <option value="0"></option>
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
      Minutes</td>
    <td align="left">&nbsp;</td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td align="right">For:</td>
    <td><strong>
      <?php 
	  $js = 'id= "month"';
	  echo form_dropdown('month', $month_options, $month_selected, $js);
	  
	  // Check if if the enable day textbox
	  $enable_add_day_encode_tardy = $this->Settings->get_selected_field('enable_add_day_encode_tardy');
	  
	  if ($enable_add_day_encode_tardy == 'yes')
	  {
		  echo form_input('day', set_value('day'), 'size="4"');
	  }
	  
	  ?>
      </strong><strong>
        <?php //$js = 'id= "year"';echo form_dropdown('year', $year_options, $year_selected, $js);?>
        
      <?php if($lgu_code == 'laguna_province'):?>
      <?php $js = 'id= "year" size="4" autocomplete="off" class="ilaw" maxlength="4"';echo 'Year: '.form_input('year', '', $js);?>
      <?php else:?>
      <?php $js = 'id= "year"';echo form_dropdown('year', $year_options, $year_selected, $js);?>
      <?php endif;?>
        
      </strong></td>
    <td align="left">&nbsp;</td>
  </tr>
  
  <?php $allow_encode_digit_undertime = $this->Settings->get_selected_field( 'allow_encode_digit_undertime' );?>
  <?php if($allow_encode_digit_undertime == 'yes'): ?>
  <tr>
    <td align="right">&nbsp;</td>
    <td align="right">Or VL Deduction Figure:</td>
    <td><input type="text" name="v_abs" id="v_abs" /></td>
    <td align="left">&nbsp;</td>
  </tr>
  <?php endif;?>
  
  <tr>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td><input name="set_leave" type="submit" class="button" id="set_leave" value="Save"/>
    <?php if($lgu_code == 'laguna_province'):?>
    	<input name="close_window" type="button" class="button" id="close_window" value="Close" onclick="javascript:window.close();"/>
	<?php endif?></td>
    <td width="57" align="left">&nbsp;</td>
  </tr>
</table>
<div id="leave_card">

</div>
</form>
<script>


$(document).ready(function(){
 
	if ($('#employee_id').val() != "")
	{
		$('#outputname').load("<?php echo base_url().('ajax/view_name/'); ?>" + $('#employee_id').val());
		
		// Show undertime 
		$('#leave_card').load("<?php echo base_url().('ajax/show_undertime/'); ?>" + $('#employee_id').val());
		
	}
	
	$('#employee_id').focus();
});

$('#employee_id').keyup(function(){

	
	if ($('#employee_id').val() == "" || $('#employee_id').val() == undefined)
	{
		//alert("Please enter a valid employee no.");
		$('#outputname').html("Please enter a valid employee no.");
		
		$('#leave_card').html("");
		
		return
	}
	else
	{
		$('#outputname').load("<?php echo base_url().('ajax/view_name/'); ?>" + $('#employee_id').val());
		
		// Show undertime 
		$('#leave_card').load("<?php echo base_url().('ajax/show_undertime/'); ?>" + $('#employee_id').val());
		
	}
});

function change_value(new_value)
{
	
	$('#outputname').load("<?php echo base_url().('ajax/view_name/'); ?>" + new_value);
	
	// Show leave card 
	$('#leave_card').load("<?php echo base_url().('ajax/show_undertime/'); ?>" + new_value);
	
	$('#employee_id').val(new_value);
}
</script>