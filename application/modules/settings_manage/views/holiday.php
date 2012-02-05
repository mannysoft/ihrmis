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
      <tr bgcolor="<?php echo $bg;?>" onmouseover="this.bgColor = '#ABC7E9';this.style.color='#000000';" 
        onmouseout ="this.bgColor = '<?php echo $bg;?>';this.style.color='#000000'">
        <td><?php echo $date;?></td>
        <td><?php echo $row['description'];?></td>
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