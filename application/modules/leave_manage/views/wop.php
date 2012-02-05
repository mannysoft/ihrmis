<form action="" method="post">
<table width="100%" border="0">
  <tr>
    <td width="24%" align="right">
    <strong>Office:</strong></td>
    <td width="39%"><?php 
		$js = 'id = "office_id" ';
		echo form_dropdown('office_id', $options, $selected, $js); ?>
      <strong>
      <input name="search_button" type="submit" id="search_button" value="Search" class="button"/>
      <input name="op" type="hidden" id="op" value="1" />
    </strong></td>
    <td width="37%">&nbsp;</td>
  </tr>
</table>
<table width="100%" border="0" class="type-one">
  <tr class="type-one-header">
    <th width="15%"><strong>Employee ID </strong></th>
    <th width="22%"><strong>Employee Name </strong></th>
    <th width="42%">Office</th>
    <th width="10%"><strong>Vacation Leave  </strong></th>
    <th width="11%">Sick Leave </th>
  </tr>
  <?php
if (count($rows) !=0)
{ 
  foreach($rows as $row)
  {
		$id 		= $row['id'];
		$office_id  = $row['office_id'];
		
		$this->Employee->fields = array('lname', 'fname','mname');
		
		$name = $this->Employee->get_employee_info($id);
		
		$office_name =  $this->Office->get_office_name($office_id);
		
		$bg = $this->Helps->set_line_colors();
		
  ?>
  <tr bgcolor="<?php echo $bg;?>" onmouseover="this.bgColor = '#ABC7E9';this.style.color='#000000';" 
    onmouseout ="this.bgColor = '<?php echo $bg;?>';this.style.color='#000000'">
    <td>
    <?php echo $row['id'];?></td>
    <td><?php echo $name['lname'].', '.$name['fname'].' '.$name['mname'];?></td>
    <td><?php echo $office_name;?></td>
    <td><?php echo $row['vacation'];?></td>
    <td><?php echo $row['sick'];?></td>
  </tr>
  
  <?php 
  
  
  }
  
  }
  ?>
  <tr>
    <td><strong>
      <input name="print" type="submit" id="print" value="Print" class="button"/>
    </strong></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>