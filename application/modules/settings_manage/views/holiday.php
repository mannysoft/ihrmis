<form method="post" action="" id="myform">
For the year:
      <strong>
      <?php $js = 'id= "year_select"';echo form_dropdown('year_select', $year_options, $year_selected, $js);?>
      </strong>
<table width="100%" border="0" class="type-one">
  <tr>
    <th width="35%">Date</th>
    <th width="25%">Description</th>
    <th width="37%">Actions</th>
    <th width="3%">&nbsp;</th>
  </tr>
  <?php foreach ($rows as $row): ?>
  	<?php $bg = $this->Helps->set_line_colors(); $date = date("F j, Y", strtotime($row['date']));?>
      <tr bgcolor="<?php echo $bg;?>" onmouseover="this.bgColor = '<?php echo $this->config->item('mouseover_linecolor')?>';" 
    onmouseout ="this.bgColor = '<?php echo $bg;?>';" style="border-bottom: 1px solid #999999;">
        <td><?php echo $date;?></td>
        <td><?php echo $row['description'].''; echo ($row['half_day'] == 'yes') ? ' (Half Day - '.$row['am_pm'].')' : '';?></td>
        <td>Edit | <a href="<?php echo base_url();?>settings_manage/holiday/<?php echo $row['id']; ?>">Delete</a> </td>
        <td>&nbsp;</td>
      </tr>
 <?php endforeach; ?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>
      <?php $js = 'id= "month"';echo form_dropdown('month', $month_options, $month_selected, $js);?>
    </strong><strong>
    <?php $js = 'id= "day"';echo form_dropdown('day', $days_options, $days_selected, $js);?>
    </strong><strong>
    <?php $js = 'id= "year"';echo form_dropdown('year', $year_options, $year_selected, $js);?>
    </strong><strong>
      <input name="op" type="hidden" id="op" value="1" />
      </strong></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Description
    <input name="description" type="text" id="description" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><input name="half_day" type="checkbox" id="half_day" value="yes" />
      <label for="half_day">Half day</label></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><input type="radio" name="am_pm" id="radio" value="am" />
      <label for="am_pm">AM</label> <input type="radio" name="am_pm" id="radio2" value="pm" />
      <label for="am_pm">PM</label></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><input name="add_date" type="submit" class="button" id="add_date" value="Add Date"/></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>
<script>
$('#year_select').change(function(){

	$('#myform').submit();
	
});
</script>