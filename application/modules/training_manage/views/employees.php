<?php $this->load->view('name_tag');?>
<table width="100%" border="0">
  <tr>
    <td><a href="#" tab="general" class="click">Trainings</a> | <a href="#" tab="users" class="click">Recommended Trainings</a> | <a href="#" tab="employees" class="click">Actual Duties</a><!-- | <a href="#" tab="attendance" class="click">Attendance</a> | <a href="#" tab="leave" class="click">Leave</a> | <a href="#" tab="signatories" class="click">Signatories</a>--></td>
    <td>&nbsp;</td>
    <td>
    <?php if(Input::get('active_tab_name_tag') != ''):?>
    	<input name="active_tab" type="hidden" id="active_tab" 
        value="<?php echo Input::get('active_tab_name_tag')?>" />
    <?php else:?>
         <input name="active_tab" type="hidden" id="active_tab" 
        value="<?php echo (Input::get('active_tabs')) ? Input::get('active_tabs'): 'general'?>" />
    <?php endif;?>
   </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

<script>

$(document).ready(function(){
	
	$('.settings_tab').hide('fast');
	
	var active_tab = $('#active_tab').val();
	//alert(active_tab)
	$('#'+active_tab).show('slow');
	
});

$('.click').click(function(){

	var tab = $(this).attr("tab");
	
	$('.settings_tab').hide('slow');
	
	$('#active_tab').val(tab);
	$('#active_tab_name_tag').val(tab);
	
	$('#'+tab).show('slow');
	
});
</script>

<div id="general" class="settings_tab">
    <form action="" method="post">
      <table width="100%" cellspacing="1" class="admintable">
      <tbody>
        <tr>
          <td width="14%" align="center" valign="top">TITLE OF SEMINAR/CONFERENCES/WORKSHOP/SHORT COURSES <br />
            (Write in full)</td>
          <td colspan="2" align="center" valign="top" >INCLUSIVE DATES<br />
            (yyyy-mm-dd)</td>
          <td width="16%" align="center" valign="top" >NUMBER OF HOURS </td>
          <td width="0%" align="center" valign="top" >CONDUCTED/ SPONSORED BY<br>
            (Write in full)</td>
          <td width="0%" valign="top" >&nbsp;</td>
          <td width="0%" valign="top" >&nbsp;</td>
        </tr>
        	<?php $i = 0;?>
			<?php foreach($trains as $train):?>
				<tr>
				  <td><input name="tra_name[]" type="text" id="tra_name" value="<?php echo $train->name;?>" size="45" /></td>
				  <td width="14%"><input name="tra_date_from[]" type="text" id="tra_date_from[]" value="<?php echo $train->date_from;?>" size="12" /></td>
				  <td width="6%"><input name="tra_date_to[]" type="text" id="tra_date_to[]" value="<?php echo $train->date_to;?>" size="12" /></td>
				  <td align="center"><input name="tra_hours[]" type="text" id="tra_hours[]" value="<?php echo $train->number_hours;?>" size="12" /></td>
				  <td align="center"><input name="tra_conduct[]" type="text" id="tra_conduct[]" value="<?php echo $train->conducted_by;?>" /></td>
				  <td><?php echo form_dropdown('tra_location[]', $tra_location_options, $train->location);?></td>
				  <td>&nbsp;</td>
				</tr>
			<?php $i ++;?>
			<?php endforeach;?>
			
            <?php if ($i <= 65):?> 
			 
				<?php while($i != 65):?> 
                      <tr>
                      <td><input name="tra_name[]" type="text" id="tra_name" size="45" /></td>
                      <td width="14%"><input name="tra_date_from[]" type="text" id="tra_date_from[]" size="12" /></td>
                      <td width="6%"><input name="tra_date_to[]" type="text" id="tra_date_to[]" size="12" /></td>
                      <td align="center"><input name="tra_hours[]" type="text" id="tra_hours[]" size="12" /></td>
                      <td align="center"><input name="tra_conduct[]" type="text" id="tra_conduct[]" /></td>
                      <td><?php echo form_dropdown('tra_location[]', $tra_location_options, 'local');?></td>
                      <td>&nbsp;</td>
                    </tr>
                    <?php $i ++;?>
				<?php endwhile;?>
            <?php endif;?>
            <tr>
              <td colspan="7">&nbsp;</td>
            </tr>
            <tr>
          <td colspan="7"><input name="op" type="hidden" id="op" value="1" />
            <span style="clear: both;">
            <input name="employee_id" type="hidden" id="employee_id" value="<?php echo $employee->id;?>" />
            <input type="submit" name="button" id="button" value="Save" />
            <input name="employee_id" type="hidden" id="employee_id" value="<?php echo $employee->id;?>" />
            </span></td>
        </tr>
      </tbody>
    </table>
</form>
</div>

<div id="users" class="settings_tab">
<form action="" method="post">
<table width="100%" border="0" cellpadding="5" cellspacing="5" class="type-one" id="recommended_training">
  <tr class="type-one-header">
    <th colspan="3" align="left">Recommended Trainings</th>
    <th><span style="clear: both;">
      <input name="employee_id" type="hidden" id="employee_id" value="<?php echo $employee->id;?>" />
      <input name="op2" type="hidden" id="op2" value="1" />
      <input name="active_tabs" type="hidden" id="active_tabs" value="users" />
      </span></th>
    <th>&nbsp;</th>
  </tr>
  <tr class="type-one-header">
    <th width="4%">Remove</th>
    <th width="4%">Year</th>
    <th width="63%">Course</th>
    <th width="13%">Relevant</th>
    <th width="17%">Remarks</th>
  </tr>
  <?php $i = 0;?>
  <?php foreach($recommends as $recommend): ?>
  	<?php $t = new Training_course();?>
    <?php $t->get_by_id($recommend->course_id);?>
  <tr>
    <td align="center"><?php echo form_checkbox('remove[]', $recommend->id, FALSE);?></td>
    <td align="right"><span style="clear: both;">
      <input name="recommend_id[]" type="hidden" id="recommend_id[]" value="<?php echo $recommend->id;?>" />
    </span>      <input name="reco_year[]" type="text" id="reco_year[]" value="<?php echo $recommend->reco_year;?>" size="6" /></td>
    <td><?php //echo $courses;//echo $t->course_title?><?php echo form_dropdown('course_id[]', $courses, $recommend->course_id, 'style="width:500px"');//echo $t->course_title?></td>
    <td><input name="relevant[]" type="text" id="relevant[]" value="<?php echo $recommend->relevant;?>" size="6" /></td>
    <td><input name="reco_remarks[]" type="text" id="reco_remarks[]" value="<?php echo $recommend->reco_remarks;?>" /></td>
  </tr>
  <?php $i ++;?>
  <?php endforeach;?>
  
  <?php if ($i <= 10):?> 
			 
		<?php while($i != 10):?> 
        <tr>
          <td align="right">&nbsp;</td>
          <td align="right"><span style="clear: both;">
            <input name="recommend_id[]" type="hidden" id="recommend_id2" value="0" />
          </span>              <input name="reco_year[]" type="text" id="reco_year[]" value="" size="6" /></td>
            <td><?php echo form_dropdown('course_id[]', $courses, '', 'style="width:500px"');//echo $t->course_title?></td>
            <td><input name="relevant[]" type="text" id="relevant[]" size="6" /></td>
            <td><input name="reco_remarks[]" type="text" id="reco_remarks[]" /></td>
      </tr>
         <?php $i ++;?>
        <?php endwhile;?>
    <?php endif;?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><input type="submit" name="button5" id="button5" value="Save" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<!--<input type="button" name="add_recommended" id="add_recommended" value="Add" />-->
</form>
</div>


<div id="employees" class="settings_tab">
<form action="" method="post">
<table width="100%" border="0" cellpadding="5" cellspacing="5" class="type-one">
  <tr class="type-one-header">
    <th colspan="2">Actual Duties</th>
    <th>&nbsp;</th>
  </tr>
  <tr class="type-one-header">
    <th width="14%">Date From</th>
    <th width="14%">Date To</th>
    <th width="72%">Actual Duties</th>
  </tr>
  <?php $i = 0;?>
  <?php foreach($duties as $duty): ?>
  <tr>
    <td valign="top"><span style="clear: both;">
      <input name="duties_id[]" type="hidden" id="duties_id[]" value="<?php echo $duty->id;?>" />
    </span>
      <textarea name="duty_from[]" rows="10" id="duty_desc"><?php echo $duty->duty_from;?></textarea></td>
    <td valign="top"><textarea name="duty_to[]" rows="10" id="duty_desc"><?php echo ($duty->duty_to !='') ? $duty->duty_to: 'Present';?></textarea></td>
    <td valign="top"><textarea name="duty_desc[]" cols="70" rows="10" id="duty_desc[]"><?php echo  $duty->duty_desc;?></textarea></td>
  </tr>
  <?php $i ++;?>
  <?php endforeach;?>
  <?php if ($i <= 2):?> 
			 
		<?php while($i != 2):?> 
          <tr>
            <td valign="top"><span style="clear: both;">
              <input name="duties_id[]" type="hidden" id="duties_id[]" value="0" />
            </span>
              <textarea name="duty_from[]" rows="10" id="duty_desc2"></textarea></td>
            <td valign="top"><textarea name="duty_to[]" rows="10" id="duty_desc3"></textarea></td>
            <td valign="top"><textarea name="duty_desc[]" cols="70" rows="10" id="duty_desc[]"></textarea></td>
          </tr>
          <tr>
  	<?php $i ++;?>
        <?php endwhile;?>
    <?php endif;?>
    <td>&nbsp;</td>
    <td><input type="submit" name="button2" id="button2" value="Save" />
      <span style="clear: both;">
      <input name="op3" type="hidden" id="op3" value="1" />
      <input name="employee_id" type="hidden" id="employee_id" value="<?php echo $employee->id;?>" />
      <input name="active_tabs" type="hidden" id="active_tabs" value="employees" />
      </span></td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>
</div>
<?php 
	
	//echo $course_id;
	
	?>
<script>

</script>

