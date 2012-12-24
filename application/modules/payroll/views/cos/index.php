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
offices.m_columns['hours']={'coltype':'text','style':''};
offices.m_columns['days']={'coltype':'text','style':''};
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
      <th width="13%" bgcolor="#D6D6D6"><strong>Employee Name</strong></th>
      <th width="22%" bgcolor="#D6D6D6">Position</th>
      <th width="3%" bgcolor="#D6D6D6">Status</th>
      <th width="7%" bgcolor="#D6D6D6">Monthly Salary</th>
      <th width="6%" bgcolor="#D6D6D6">Tax Exemption</th>
      <th width="5%" bgcolor="#D6D6D6">Rate per Day</th>
      <th width="4%" bgcolor="#D6D6D6">Rate per Hour</th>
      <th width="5%" bgcolor="#D6D6D6">Number of Hours</th>
      <th width="4%" bgcolor="#D6D6D6">No. of days with Pay</th>
      <th width="7%" bgcolor="#D6D6D6">Total Amount of Salary</th>
      <th width="7%" bgcolor="#D6D6D6">Withholding tax</th>
      <th width="6%" bgcolor="#D6D6D6">Total Deduction</th>
      <th width="7%" bgcolor="#D6D6D6">AMOUNT PAID in Cash</th>
      <th width="2%" bgcolor="#D6D6D6">&nbsp;</th>
    </tr>
    <?php $i = 0;?>
    <?php $n = 1;?>
    <?php $grand_total_salary = 0;?>
    <?php $grand_total_amount_due = 0;?>
    <?php $deduction = 0;?>
    <?php $c = new Cos_status();?>
    <?php $j = new Jo_days();?>
    <?php $p = new Personal_m();?>
    
    <?php foreach($rows as $row):?>
    
	<?php $p->get_by_employee_id($row['id']);?>
    <?php $c->get_by_employee_id($row['employee_id']);?>
    <?php $j->get_days($period, $row['employee_id']);?>
    <?php 
	
	$this->tax->status 				= $c->status;
	$this->tax->salary_grade 		= $row['salary_grade'];
	$this->tax->step 				= $row['step'];
	$this->tax->days 				= $j->days;
	$this->tax->hours 				= $j->hours;
	$this->tax->count_working_days 	= $count_working_days;
	//$this->tax->tax_table_status	
	
	$this->tax->initialize();
	
	$this->tax->grand_total_salary += $this->tax->total_salary;
	
	?>
    <?php 
        
       // $total_salary = 0;
		//$grand_total_salary += $total_salary;
		
		//$total_amount_due = $total_salary - $deduction;
		//$grand_total_amount_due += $total_amount_due;
		    
        $onclick0 = "onClick=\"dg_editCell(offices,'".$j->id."','hours','offices.0.$i', 'cto_balance')\"";
        $onclick1 = "onClick=\"dg_editCell(offices,'".$j->id."','days','offices.1.$i', 'cto_balance')\"";
		
		//$onclick0 = '';

    ?>
    <?php $bg = $this->Helps->set_line_colors();?>
    <tr bgcolor="<?php echo $bg;?>" onmouseover="this.bgColor = '<?php echo $this->config->item('mouseover_linecolor')?>';" 
onmouseout ="this.bgColor = '<?php echo $bg;?>';" style="border-bottom: 1px solid #999999;">
      <td align="right"><?php echo $n;?></td>
      <td><?php echo $row['lname'].', '.$row['fname'].' '.$row['mname'];?></td>
      <td align="left"><?php echo $row['position'];?></td>
      <td align="left"><?php echo $c->status?></td>
      <td align="right"><?php echo number_format($this->tax->monthly_salary, 2);?></td>
      <td><?php echo ($row['tax_status'] != 'Single' ) ? 'ME' : 'S'; echo $row['dependents'];?></td>
      <td align="right"><?php echo ($this->tax->daily_rate != 0 ) ? number_format($this->tax->daily_rate, 2) : '';?></td>
      <td align="right"><?php echo ($this->tax->hour_rate != 0 ) ? number_format($this->tax->hour_rate, 2) : '';?></td>
      <td align="right" id="offices.0.<?php echo $i;?>" <?php echo $onclick0;?>><?php echo $this->tax->hours?></td>
      <td align="right" id="offices.1.<?php echo $i;?>" <?php echo $onclick1;?>><?php echo $this->tax->days?></td>
      <td align="right"><?php echo number_format($this->tax->total_salary, 2);?></td>
      <td align="right">&nbsp;</td>
      <td align="right"><?php echo $deduction?></td>
      <td align="right"><?php //echo number_format($total_amount_due, 2);?></td>
      <td><?php //echo $r->dates;?></td>
    </tr>
    <?php $i ++;?>
    <?php $n ++;?>

<?php endforeach;?>
    <tr>
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
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
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
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
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
      <td align="right"><strong><?php echo number_format($grand_total_salary, 2);?></strong></td>
      <td>&nbsp;</td>
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