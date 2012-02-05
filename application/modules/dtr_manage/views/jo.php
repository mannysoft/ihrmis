<form id="myform" method="post" target="" enctype="multipart/form-data">
<table width="100%" border="0" class="type-one">
  <tr>
    <td width="36%"><select name="month" id="month"  >
      <option value="01">January</option>
      <option value="02">February</option>
      <option value="03">March</option>
      <option value="04">April</option>
      <option value="05">May</option>
      <option value="06">June</option>
      <option value="07">July</option>
      <option value="08">August</option>
      <option value="09">September</option>
      <option value="10">October</option>
      <option value="11">November</option>
      <option value="12">December</option>
    </select>
      <select name="year" id="year" >
        <option value="2009">2009</option>
        <option value="2010">2010</option>
        <option value="2011">2011</option>
      </select>
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
  <?php 
  
  foreach($rows as $row)
	{
		$employeeId = $row['id'];
		$lname 		= $row['lname'];
		$mname 		= $row['mname'];
		$fname 		= $row['fname'];
		
		
		
		$bg = $this->Helps->set_line_colors();
  ?>
  <tr bgcolor="<?php echo $bg;?>" onmouseover="this.bgColor = '#ABC7E9';this.style.color='#000000';" 
    onmouseout ="this.bgColor = '<?php echo $bg;?>';this.style.color='#000000'">
    <td><?php echo $lname.', '. $fname.' '.$mname?>&nbsp;</td>
    <td><?php echo $this->Dtr->get_contractual_work($employeeId, $month, $year, 1, 7).' day(s)';?></td>
    <td><?php echo $this->Dtr->get_contractual_work($employeeId, $month, $year, 8, 15).' day(s)';?></td>
    <td><?php echo $this->Dtr->get_contractual_work($employeeId, $month, $year, 16, 22).' day(s)';?></td>
    <td><?php echo $this->Dtr->get_contractual_work($employeeId, $month, $year, 23, 31).' day(s)';?></td>
  </tr>
  <?php
  }
   ?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>