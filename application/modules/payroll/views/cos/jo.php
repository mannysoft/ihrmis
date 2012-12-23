<?php if ($pop_up == 1):?>
<script src="<?php echo base_url();?>js/function.js"></script>
<script>openBrWindow('<?php echo base_url().'payroll/report/jo_preview/'.$pop_up_office_id.'/'.$pop_up_period;?>','','scrollbars=yes,width=800,height=700')</script>
<?php endif?>
<?php if (validation_errors() || $error_msg != ''): ?>
<div class="clean-red"><?php echo validation_errors(); ?><?php echo $msg; ?></div><br />
<?php elseif ($this->session->flashdata('msg') || $msg != ''): ?>
<div class="clean-green"><?php echo $this->session->flashdata('msg');?><?php echo $msg;?></div><br />
<?php else: ?>
<?php endif; ?>
<script type="text/javascript" src="<?php echo base_url();?>js/edit_place/sack.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/edit_place/datagrid.js"></script>
<script type="text/javascript">
var offices = new dataGrid('offices','<?php echo base_url();?>payroll/cos/edit_place/jo_days');
offices.m_columns['days']={'coltype':'text','style':''};
offices.m_columns['dates']={'coltype':'text','style':''};
</script>
<form method="post" action="" id="rates">
<table width="100%" border="0" cellpadding="5" cellspacing="5" class="type-one">
  <tr>
    <td align="right"><strong>Office:</strong></td>
    <td><?php 
    $js = 'id = "office_id" ';
    echo form_dropdown('office_id', $options, $selected, $js); ?></td>
  </tr>
  <tr>
    <td align="right"><strong>Number of Days with Pay:</strong></td>
    <td><input type="text" name="number_days" id="number_days" /></td>
  </tr>
  <tr>
    <td width="18%" align="right"><strong>For the Month of: </strong></td>
    <td width="82%"><strong>
      <?php $js = 'id= "month"';echo form_dropdown('month', $month_options, $month_selected, $js);?>
      <?php $js = 'id= "period_from"';echo form_dropdown('period_from', $days_options, $period_from_selected, $js);?>
    </strong> To: <strong>
    <?php $js = 'id= "period_to"';echo form_dropdown('period_to', $days_options, $days_selected, $js);?>
    </strong><strong>
    <?php $js = 'id= "year"';echo form_dropdown('year', $year_options, $year_selected, $js);?>
    <input type="submit" name="button" id="button" value="-- Go --" />
    <input name="op" type="hidden" id="op" value="1" />
    <input type="submit" name="print" id="print" value="Print" />
    </strong></td>
</tr>
    </table></form>
    
        <span id="offices.span">
  <table width="100%" border="0" class="type-one" id="offices.table">
    <tr class="type-one-header">
      <th width="2%" bgcolor="#D6D6D6">No.</th>
      <th width="6%" bgcolor="#D6D6D6"><strong>Employee No.</strong></th>
      <th width="19%" bgcolor="#D6D6D6"><strong>Employee Name</strong></th>
      <th width="10%" bgcolor="#D6D6D6">TIN</th>
      <th width="9%" bgcolor="#D6D6D6">Tax Exemption</th>
      <th width="7%" bgcolor="#D6D6D6">Rate per Day</th>
      <th width="8%" bgcolor="#D6D6D6">No. of days with Pay</th>
      <th width="9%" bgcolor="#D6D6D6">Total Amount of Salary</th>
      <th width="12%" bgcolor="#D6D6D6">Total Deduction</th>
      <th width="7%" bgcolor="#D6D6D6">Total Amount Due</th>
      <th width="11%" bgcolor="#D6D6D6">&nbsp;</th>
    </tr>
    <?php $i = 0;?>
    <?php $n = 1;?>
    <?php $grand_total_salary = 0;?>
    <?php $grand_total_amount_due = 0;?>
    <?php $deduction = 0;?>
    <?php $r = new Rates();?>
    <?php $p = new Personal_m();?>
    <?php $j = new Jo_days();?>
    <?php foreach($rows as $row):?>
    
    <?php $r->get_by_employee_id($row['employee_id']);?>
	<?php $p->get_by_employee_id($row['id']);?>
    <?php 
			$j->where('employee_id',$row['employee_id']);
			$j->where('period', $period);
			$j->get();
	
	?>
    <?php 
        
        $total_salary = $r->rate_per_day * $j->days;
		$grand_total_salary += $total_salary;
		
		$total_amount_due = $total_salary - $deduction;
		$grand_total_amount_due += $total_amount_due;
		    
        //$onclick0 = "onClick=\"dg_editCell(offices,'".$j->id."','days','offices.0.$i', 'cto_balance')\"";
        $onclick0 = "onClick=\"dg_editCell(offices,'".$j->id."','days','offices.1.$i', 'cto_balance')\"";

    ?>
    <?php $bg = $this->Helps->set_line_colors();?>
    <tr bgcolor="<?php echo $bg;?>" onmouseover="this.bgColor = '<?php echo $this->config->item('mouseover_linecolor')?>';" 
onmouseout ="this.bgColor = '<?php echo $bg;?>';" style="border-bottom: 1px solid #999999;">
      <td align="right"><?php echo $n;?></td>
      <td><?php echo $row['employee_id'];?></td>
      <td><?php echo $row['lname'].', '.$row['fname'].' '.$row['mname'];?></td>
      <td align="left"><?php echo $p->tin;?></td>
      <td><?php echo ($row['tax_status'] != 'Single' ) ? 'ME' : 'S'; echo $row['dependents'];?></td>
      <td align="right"><?php echo number_format($r->rate_per_day, 2);?></td>
      <td align="right" id="offices.1.<?php echo $i;?>" <?php echo $onclick0;?>><?php echo $j->days?></td>
      <td align="right"><?php echo number_format($total_salary, 2);?></td>
      <td align="right"><?php echo $deduction?></td>
      <td align="right"><?php echo number_format($total_amount_due, 2);?></td>
      <td><?php //echo $r->dates;?></td>
    </tr>
    <?php $i ++;?>
    <?php $n ++;?>

<?php endforeach;?>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td align="right"><strong><?php echo number_format($grand_total_salary, 2);?></strong></td>
      <td>&nbsp;</td>
      <td align="right"><strong><?php echo number_format($grand_total_amount_due, 2);?></strong></td>
      <td>&nbsp;</td>
    </tr>
  </table></span>
  <script>
$('#office_id').change(function(){

	$('#rates').submit();
	
});
</script>