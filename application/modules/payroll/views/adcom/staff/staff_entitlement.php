<script type="text/javascript" src="<?php echo base_url();?>js/edit_place/sack.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/edit_place/datagrid.js"></script>
<script type="text/javascript">
var offices = new dataGrid('offices','<?php echo base_url();?>payroll/adcom/edit_place/adcom');
offices.m_columns['effectivity_date']={'coltype':'text','style':''};
offices.m_columns['ineffectivity_date']={'coltype':'text','style':''};
offices.m_columns['amount']={'coltype':'text','style':''};
offices.m_columns['sg']={'coltype':'text','style':''};
offices.m_columns['amount']={'coltype':'text','style':''};
</script>
<form id="myform" method="post" action="" target="" enctype="multipart/form-data">
<table width="100%" border="0">
  <tr>
    <td align="right" valign="top"><strong>Office:</strong></td>
    <td><?php $js = 'id = "office_id"';echo form_dropdown('office_id', $options, $selected, $js);?>
  &nbsp;
  <div id="loading"></div></td>
    <td>&nbsp;</td>
    <td align="right">&nbsp;</td>
  </tr>
  <tr>
    <td width="17%" align="right" valign="top"><strong>Additional Compensation:</strong></td>
    <td width="30%"><?php $js = 'id = "additional_compensation_id"';
	echo form_dropdown(
			'additional_compensation_id', 
			adcom_options(), 
			$additional_compensation_id, 
			$js);?>
      <input type="submit" name="button" id="button" value="-- Go --" /></td>
    <td width="20%">&nbsp;</td>
    <td width="30%" align="right"><input name="op" type="hidden" id="op" value="1" />
      </td>
  </tr>
</table>
</form>
<span id="offices.span">
  <table width="100%" border="0" class="type-one" id="offices.table">
	<tr class="type-one-header">
	  <th width="2%" bgcolor="#D6D6D6">&nbsp;</th>
	  <th width="19%" bgcolor="#D6D6D6">Name</th>
	  <th width="27%" bgcolor="#D6D6D6">Position Title</th>
	  <th width="12%" bgcolor="#D6D6D6">Effectivity Date</th>
	  <th width="12%" bgcolor="#D6D6D6"><strong>Ineffectivity Date</strong></th>
	  <th width="9%" bgcolor="#D6D6D6">Amount</th>
	  <th width="12%" bgcolor="#D6D6D6">&nbsp;</th>
	  <th width="7%" bgcolor="#D6D6D6">&nbsp;</th>
	</tr>
	<?php $i = 0;?>
	<?php $s = new Staff_entitlement_m();?>
	<?php foreach($rows as $row):?>
	<?php 
		
		$s->where('employee_id', $row->id);
		$s->where('additional_compensation_id', $additional_compensation_id);
		$s->get();
		
		if ($s->exists())
		{
			$id = $s->id;
			//echo 'hehe';
		}
		else
		{
			$s->employee_id					= $row->id;
			$s->additional_compensation_id 	= $additional_compensation_id;
			$s->effectivity_date 			= '';
			$s->ineffectivity_date 			= '';
			$s->amount 						= '';
			$s->save();
			
			$id = $s->id;
		}
		
		// last param of dg_editCell is the size of the textbox
		
		$onclick0 = "onClick=\"dg_editCell(offices,'".$id."','effectivity_date','offices.0.$i', 'adcom', '8')\"";
		$onclick1 = "onClick=\"dg_editCell(offices,'".$id."','ineffectivity_date','offices.1.$i', 'adcom', '8')\"";
		$onclick2 = "onClick=\"dg_editCell(offices,'".$id."','amount','offices.2.$i', 'adcom', '8')\"";
		$onclick3 = "onClick=\"dg_editCell(offices,'".$id."','sg','offices.3.$i', 'adcom', '5')\"";
		$onclick4 = "onClick=\"dg_editCell(offices,'".$id."','amount','offices.4.$i', 'adcom', '10')\"";

	?>
	<?php $bg = $this->Helps->set_line_colors();?>
	<tr bgcolor="<?php echo $bg;?>" onmouseover="this.bgColor = '<?php echo $this->config->item('mouseover_linecolor')?>';" 
onmouseout ="this.bgColor = '<?php echo $bg;?>';" style="border-bottom: 1px solid #999999;">
	  <td><input name="employee[]" type="checkbox" value="<?php echo $id;?>" ONCLICK="highlightRow(this,'#ABC7E9');" id="employee"/></td>
	  <td><?php echo $row->lname.', '.$row->fname;?>&nbsp;</td>
	  <td><?php echo $row->position;?></td>
	  <td id="offices.0.<?php echo $i;?>" <?php echo $onclick0;?>><?php echo $s->effectivity_date;?></td>
	  <td id="offices.1.<?php echo $i;?>" <?php echo $onclick1;?>><?php echo $s->ineffectivity_date;?></td>
	  <td align="right" id="offices.2.<?php echo $i;?>" <?php echo $onclick2;?>><?php echo ($s->amount) ? number_format($s->amount, 2) : '';?></td>
	  <td id="offices.3.<?php echo $i;?>" <?php //echo $onclick3;?>>&nbsp;</td>
	  <td align="right" id="offices.4.<?php echo $i;?>" <?php //echo $onclick4;?>>&nbsp;</td>
	</tr>
	<?php $i ++;?>

<?php endforeach;?>
	<tr>
	  <td>&nbsp;</td>
	  <td></td>
	  <td></td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	</tr>
  </table></span>
<script>

$('#office_id').change(function(){

	$('#loading').html("Loading...");
	$('#myform').submit();
	
});
</script>
