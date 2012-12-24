<script type="text/javascript" src="<?php echo base_url();?>js/edit_place/sack.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/edit_place/datagrid.js"></script>
<script type="text/javascript">
var offices = new dataGrid('offices','<?php echo base_url();?>payroll/cos/edit_place/status');
//offices.m_columns['days']={'coltype':'text','style':''};
//offices.m_columns['dates']={'coltype':'text','style':''};
offices.m_columns['cos_status']={'coltype':'select'};

offices.m_columns['cos_status']['selectvalues']=<?php echo json_encode(array('FT', 'PT'));?>;

</script>
<form method="post" action="" id="rates">
<table width="100%" border="0" cellpadding="5" cellspacing="5" class="type-one">
  <tr>
    <td width="9%" align="right"><strong>Office:</strong></td>
    <td width="91%"><?php 
    $js = 'id = "office_id" ';
    echo form_dropdown('office_id', $options, $selected, $js); ?>
      <input name="op" type="hidden" id="op" value="1" /></td>
  </tr>
    </table></form>
    
        <span id="offices.span">
  <table width="100%" border="0" class="type-one" id="offices.table">
    <tr class="type-one-header">
      <th width="2%" bgcolor="#D6D6D6">No.</th>
      <th width="25%" bgcolor="#D6D6D6"><strong>Employee Name</strong></th>
      <th width="29%" bgcolor="#D6D6D6">Position</th>
      <th width="44%" bgcolor="#D6D6D6">Status</th>
    </tr>
    <?php $i = 0;?>
    <?php $n = 1;?>
    <?php $c = new Cos_status();?>
    <?php foreach($rows as $row):?>
    
    <?php $c->get_by_employee_id($row['employee_id']);?>
    <?php 
        		    
        //$onclick0 = "onClick=\"dg_editCell(offices,'".$j->id."','days','offices.0.$i', 'cto_balance')\"";
        $onclick0 = "onClick=\"dg_editCell(offices,'".$c->id."','cos_status','offices.1.$i', 'cto_balance')\"";

    ?>
    <?php $bg = $this->Helps->set_line_colors();?>
    <tr bgcolor="<?php echo $bg;?>" onmouseover="this.bgColor = '<?php echo $this->config->item('mouseover_linecolor')?>';" 
onmouseout ="this.bgColor = '<?php echo $bg;?>';" style="border-bottom: 1px solid #999999;">
      <td align="right"><?php echo $n;?></td>
      <td><?php echo $row['lname'].', '.$row['fname'].' '.$row['mname'];?></td>
      <td align="left"><?php echo $row['position'];?></td>
      <td align="left" id="offices.1.<?php echo $i;?>" <?php echo $onclick0;?>><?php echo $c->status?></td>
    </tr>
    <?php $i ++;?>
    <?php $n ++;?>

<?php endforeach;?>
    <tr>
      <td>&nbsp;</td>
      <td></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table></span>
  <script>
$('#office_id').change(function(){

	$('#rates').submit();
	
});
</script>