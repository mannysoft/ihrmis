<script type="text/javascript" src="<?php echo base_url();?>js/edit_place/sack.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/edit_place/datagrid.js"></script>
<script type="text/javascript">
var offices = new dataGrid('offices','<?php echo base_url();?>payroll/ajax/edit_place/tax_exempt');
offices.m_columns['tax_status']={'coltype':'select'};

offices.m_columns['tax_status']['selectvalues']=<?php echo json_encode($options);?>;

offices.m_columns['dependents']={'coltype':'text','style':''};


//tt1.m_columns['col4']={'coltype':'selectkey','style':''};


//offices.m_columns['forwarded_note']={'coltype':'text','style':''};
</script>
<?php //echo json_encode(array('key' => 'option', 'key2' => 'option2'));?>
<span id="offices.span">
  <table width="100%" border="0" class="type-one" id="offices.table">
	<tr class="type-one-header">
	  <th width="10%" bgcolor="#D6D6D6"><strong>Employee No.</strong></th>
	  <th width="28%" bgcolor="#D6D6D6"><strong>Employee Name</strong></th>
	  <th width="20%" bgcolor="#D6D6D6">Tax Status </th>
	  <th width="29%" bgcolor="#D6D6D6">Dependents</th>
	</tr>
	<?php $i = 0;?>
	<?php foreach($rows as $row):?>
	<?php 
			
		$onclick0 = "onClick=\"dg_editCell(offices,'".$row['id']."','tax_status','offices.0.$i', 'tax_exempt')\"";
		$onclick1 = "onClick=\"dg_editCell(offices,'".$row['id']."','dependents','offices.1.$i', 'tax_exempt')\"";

	?>
	<?php $bg = $this->Helps->set_line_colors();?>
	<tr bgcolor="<?php echo $bg;?>" onmouseover="this.bgColor = '<?php echo $this->config->item('mouseover_linecolor')?>';" 
    onmouseout ="this.bgColor = '<?php echo $bg;?>';">
	  <td><?php echo $row['employee_id'];?></td>
	  <td><?php echo $row['lname'].', '.$row['fname'].' '.$row['mname'];?></td>
	  <td id="offices.0.<?php echo $i;?>" <?php echo $onclick0;?>><?php echo $row['tax_status'];?></td>
	  <td id="offices.1.<?php echo $i;?>" <?php echo $onclick1;?>><?php echo $row['dependents'];?></td>
	</tr>
	<?php $i ++;?>

<?php endforeach;?>
	<tr>
	  <td>&nbsp;</td>
	  <td></td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	</tr>
  </table></span>