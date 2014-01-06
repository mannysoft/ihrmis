<?php if (validation_errors() || $error_msg != ''): ?>
<div class="clean-red"><?php echo validation_errors(); ?><?php echo $msg; ?></div><br />
<?php elseif (Session::flashData('msg') || $msg != ''): ?>
<div class="clean-green"><?php echo Session::flashData('msg');?><?php echo $msg;?></div><br />
<?php else: ?>
<?php endif; ?>
<script type="text/javascript" src="<?php echo base_url();?>js/edit_place/sack.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/edit_place/datagrid.js"></script>
<script type="text/javascript">
var offices = new dataGrid('offices','<?php echo base_url();?>personnel/plantilla/edit_place/plantilla');
offices.m_columns['item_no']={'coltype':'text','style':''};
offices.m_columns['position']={'coltype':'text','style':''};
offices.m_columns['year']={'coltype':'text','style':''};
offices.m_columns['sg']={'coltype':'text','style':''};
offices.m_columns['amount']={'coltype':'text','style':''};
</script>
<form method="post" action="" id="myform">
<table width="100%" border="0" class="type-one">
      <tr>
        <td width="70%">
        <?php 
		$js = 'id = "office_id" ';
		echo form_dropdown('office_id', $options, $selected, $js); ?>
        <strong>
        <?php $js = 'id= "year"';echo form_dropdown('year', $year_options, $year_selected, $js);?>
        </strong><div id="loading"></div></td>
        <td width="30%"></td>
	</tr>
</table>
</form>
		
		<span id="offices.span">
  <table width="100%" border="0" class="type-one" id="offices.table">
	<tr class="type-one-header">
	  <th width="5%" bgcolor="#D6D6D6"><strong>Item Number</strong></th>
	  <th width="19%" bgcolor="#D6D6D6">Position Title</th>
	  <th width="8%" bgcolor="#D6D6D6">Item No.</th>
	  <th width="38%" bgcolor="#D6D6D6"><strong>Name of Incumbent</strong></th>
	  <th width="12%" bgcolor="#D6D6D6">Year</th>
	  <th width="7%" bgcolor="#D6D6D6">SG</th>
	  <th width="11%" bgcolor="#D6D6D6">Amount</th>
	</tr>
	<?php $i = 0;?>
	<?php $p = new Plantilla_m();?>
	<?php foreach($rows as $row):?>
	<?php 
		
		$p->where('year', $year);
		$p->where('plantilla_item_id', $row->id);
		$p->get();
		
		// Check if exists ()
		$e = new Employee_m();
		
		if ($p->exists())
		{
			$e->get_by_id($p->employee_id);
		}
		else // If not exists try to search from last year
		{
			$p->where('year', $year - 1);
			$p->where('plantilla_item_id', $row->id);
			$p->get();
		}
				
		// last param of dg_editCell is the size of the textbox
		
		$onclick0 = "onClick=\"dg_editCell(offices,'".$p->id."','item_no','offices.0.$i', 'plantilla')\"";
		$onclick1 = "onClick=\"dg_editCell(offices,'".$p->id."','position','offices.1.$i', 'plantilla', '40')\"";
		$onclick2 = "onClick=\"dg_editCell(offices,'".$p->id."','year','offices.2.$i', 'plantilla', '8')\"";
		$onclick3 = "onClick=\"dg_editCell(offices,'".$p->id."','sg','offices.3.$i', 'plantilla', '5')\"";
		$onclick4 = "onClick=\"dg_editCell(offices,'".$p->id."','amount','offices.4.$i', 'plantilla', '10')\"";

	?>
	<?php $bg = $this->Helps->set_line_colors();?>
	<tr bgcolor="<?php echo $bg;?>" onmouseover="this.bgColor = '<?php echo $this->config->item('mouseover_linecolor')?>';" 
onmouseout ="this.bgColor = '<?php echo $bg;?>';" style="border-bottom: 1px solid #999999;">
	  <td id="offices.0.<?php echo $i;?>" <?php echo $onclick0;?>><?php echo $row->item_no;?></td>
	  <td id="offices.1.<?php echo $i;?>" <?php echo $onclick1;?>><?php echo $row->position_title;?></td>
	  <td><?php echo $row->item_no;?></td>
	  <td><?php echo $e->lname.', '.$e->fname.' '.$e->mname;?></td>
	  <td id="offices.2.<?php echo $i;?>" <?php //echo $onclick2;?>><?php echo $p->year;?></td>
	  <td id="offices.3.<?php echo $i;?>" <?php echo $onclick3;?>><?php echo $p->sg;?></td>
	  <td align="right" id="offices.4.<?php echo $i;?>" <?php echo $onclick4;?>><?php echo $p->amount;?></td>
	</tr>
	<?php $i ++;?>

<?php endforeach;?>
	<tr>
	  <td>&nbsp;</td>
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
$('#year').change(function(){

	$('#loading').html("Loading...");
	$('#myform').submit();
	
});

</script>