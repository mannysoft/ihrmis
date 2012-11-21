<form id="myform" method="post" target="" enctype="multipart/form-data">
<table width="100%" border="0" class="type-one">
  <tr>
    <td width="36%"><strong>
      <?php $js = 'id= "month"';echo form_dropdown('month', $month_options, $month_selected, $js);?>
    </strong><strong>
    <?php $js = 'id= "year"';echo form_dropdown('year', $year_options, $year_selected, $js);?>
    </strong>
    <input name="filter" type="submit" class="button" id="filter" value="Filter"/>
    <strong>
    <input name="op" type="hidden" id="op" value="1" />
    </strong></td>
    <td colspan="4">For the month of <?php echo $this->Helps->get_month_name($month).' '.$year;?></td>
  </tr>
  <tr>
    <th>Name</td>
    <th width="17%">1-7</th>
    <th width="15%">8-15</th>
    <th width="18%">16-22</th>
    <th width="14%">23-31</th>
  </tr>
  <?php foreach($rows as $row) :?>
	<?php $bg = $this->Helps->set_line_colors();?>
  <tr bgcolor="<?php echo $bg;?>" onmouseover="this.bgColor = '<?php echo $this->config->item('mouseover_linecolor')?>';" 
    onmouseout ="this.bgColor = '<?php echo $bg;?>';" style="border-bottom: 1px solid #999999;">
    <td><?php echo $row['lname'].', '. $row['fname'].' '.$row['mname']?>&nbsp;</td>
    <td><?php echo $this->Dtr->get_contractual_work($row['id'], $month, $year, 1, 7).' day(s)';?></td>
    <td><?php echo $this->Dtr->get_contractual_work($row['id'], $month, $year, 8, 15).' day(s)';?></td>
    <td><?php echo $this->Dtr->get_contractual_work($row['id'], $month, $year, 16, 22).' day(s)';?></td>
    <td><?php echo $this->Dtr->get_contractual_work($row['id'], $month, $year, 23, 31).' day(s)';?></td>
  </tr>
  <?php endforeach;?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>