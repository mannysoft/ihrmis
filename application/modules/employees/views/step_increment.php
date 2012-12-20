<form method="post" action="" id="myform">
<table width="100%" border="0" class="type-one">
  <tr class="type-one-header">
    <th colspan="6" align="left" bgcolor="#D6D6D6"><strong>
      <?php $js = 'id= "office_id"';echo form_dropdown('office_id', $options, $selected, $js);?>
      <?php $js = 'id= "month"';echo form_dropdown('month', $month_options, $month_selected, $js);?>
      <?php $js = 'id= "year"';echo form_dropdown('year', $year_options, $year_selected, $js);?>
      <input name="Go" type="submit" id="Go" value="Go" />
      <input name="print2" type="submit" id="print2" value="Print" />
      <input name="op" type="hidden" id="op" value="1" />
    </strong></th>
    </tr>
  <tr class="type-one-header">
    <th width="29%" bgcolor="#D6D6D6"><strong>Employee No.</strong></th>
    <th width="14%" bgcolor="#D6D6D6"><strong>Employee Name</strong></th>
    <th width="12%" bgcolor="#D6D6D6">Salary Grade</th>
    <th width="12%" bgcolor="#D6D6D6">Step</th>
    <th width="15%" bgcolor="#D6D6D6">Last Promotion</th>
    <th width="30%" bgcolor="#D6D6D6">&nbsp;</th>
  </tr>
  <?php 
  
 $rows = array();
 
  foreach($rows as $id)
  {				
		
		
	 	//bg
		$bg 	= $this->Helps->set_line_colors();
		?>
  <tr bgcolor="<?php echo $bg;?>" onmouseover="this.bgColor = '<?php echo $this->config->item('mouseover_linecolor')?>';" 
    onmouseout ="this.bgColor = '<?php echo $bg;?>';" style="border-bottom: 1px solid #999999;">
    <td bgcolor=""><?php echo $id;?></td>
    <td bgcolor=""><?php echo $name['lname'].', '.$name['fname'].' '.$name['mname'];?></td>
    <td align="center" bgcolor=""><?php echo $total_tardiness;?></td>
    <td align="center" bgcolor=""><?php echo $total_tardiness;?></td>
    <td align="center" bgcolor=""><?php echo $late['tardi_count'];?></td>
    <td align="center" bgcolor=""><?php echo $this->Helps->compute_time($totalLate);?></td>
    </tr>
  <?php
		
		}
	  ?>
  <tr>
    <td></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td colspan="2"><!--<input type="submit" name="Submit" value="Submit" />-->
      <input name="print" type="submit" id="print" value="Print" />
      echo 'just search for increment candidates.&lt;br&gt;';<br />
echo 'search in last_promotion field, table employee';</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
</table>
</form>