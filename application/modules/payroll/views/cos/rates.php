<?php if (validation_errors() || $error_msg != ''): ?>
<div class="clean-red"><?php echo validation_errors(); ?><?php echo $msg; ?></div><br />
<?php elseif (Session::flashData('msg') || $msg != ''): ?>
<div class="clean-green"><?php echo Session::flashData('msg');?><?php echo $msg;?></div><br />
<?php else: ?>
<?php endif; ?>
<script type="text/javascript" src="<?php echo base_url();?>js/edit_place/sack.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/edit_place/datagrid.js"></script>
<script type="text/javascript">
var offices = new dataGrid('offices','<?php echo base_url();?>payroll/cos/edit_place/rates');
offices.m_columns['rate_per_day']={'coltype':'text','style':''};
offices.m_columns['pagibig_amount']={'coltype':'text','style':''};
</script>
<form method="post" action="" id="rates">
<table width="100%" border="0" class="type-one">
  <tr>
    <td width="20%">
    <?php echo form_office_dropdown(); ?></td>
    <td width="71%"></td>
</tr>
    </table></form>
    
        <span id="offices.span">
  <table width="100%" border="0" class="type-one" id="offices.table">
    <tr class="type-one-header">
      <th width="13%" bgcolor="#D6D6D6"><strong>Employee No.</strong></th>
      <th width="40%" bgcolor="#D6D6D6"><strong>Employee Name</strong></th>
      <th width="16%" bgcolor="#D6D6D6">Rate per Day</th>
      <th width="31%" bgcolor="#D6D6D6">Pag-ibig Personal Contribution</th>
      <th width="31%" bgcolor="#D6D6D6">&nbsp;</th>
    </tr>
    <?php $i = 0;?>
    <?php $r = new Rates();?>
    <?php foreach($rows as $row):?>
    <?php 
        
        $r->where('employee_id', $row['employee_id']);
        $r->get();
		    
        $onclick0 = "onClick=\"dg_editCell(offices,'".$r->id."','rate_per_day','offices.0.$i', 'cto_balance')\"";
        $onclick1 = "onClick=\"dg_editCell(offices,'".$r->id."','pagibig_amount','offices.1.$i', 'cto_balance')\"";

    ?>
    <?php $bg = $this->Helps->set_line_colors();?>
    <tr bgcolor="<?php echo $bg;?>" onmouseover="this.bgColor = '<?php echo $this->config->item('mouseover_linecolor')?>';" 
onmouseout ="this.bgColor = '<?php echo $bg;?>';" style="border-bottom: 1px solid #999999;">
      <td><?php echo $row['employee_id'];?></td>
      <td><?php echo $row['lname'].', '.$row['fname'].' '.$row['mname'];?></td>
      <td align="right" id="offices.0.<?php echo $i;?>" <?php echo $onclick0;?>><?php echo number_format($r->rate_per_day, 2);?></td>
      <td align="right" id="offices.1.<?php echo $i;?>" <?php echo $onclick1;?>><?php echo number_format($r->pagibig_amount, 2);?></td>
      <td align="right" id="offices.2.<?php echo $i;?>" <?php //echo $onclick1;?>>&nbsp;</td>
    </tr>
    <?php $i ++;?>

<?php endforeach;?>
    <tr>
      <td>&nbsp;</td>
      <td></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table></span>
  <script>
$('#office_id').change(function(){

	$('#rates').submit();
	
});
</script>