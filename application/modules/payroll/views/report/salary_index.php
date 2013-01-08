<form action="" method="post">
<table width="100%" border="0">
  <tr>
    <td colspan="7"></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td width="10%">&nbsp;</td>
    <td width="12%">&nbsp;</td>
    <td width="22%">&nbsp;</td>
    <td width="13%">&nbsp;</td>
    <td width="13%">&nbsp;</td>
    <td>&nbsp;</td>
    <td>
    <?php if ( $employee_id != '' ):?>
    <a href="<?php echo base_url().'payroll/additional_compensation/staff_entitlement_save/0/'.$employee_id;?>">Add Staff Entitlements</a>
     <?php endif;?>
    </td>
  </tr>
  <tr>
    <td align="right">Year:</td>
    <td colspan="4"><strong>
      <?php echo form_year_dropdown();?>
      </strong>Month:<strong>
        <?php echo form_month_dropdown();?>
      </strong> Period:<strong>
      <?php $js = 'id= "period"';echo form_dropdown('period', array('1-15/16-31'));?>
      </strong></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td></td>
  </tr>
  <tr>
    <td width="8%" align="right">Office:</td>
    <td colspan="5"><?php echo form_office_dropdown();?>
      
      Document:<?php $js = 'id= "document"';echo form_dropdown('document', array('monthly_salary'=> 'Monthly Salary', 'pera'=> 'PERA/ADCOM', 'rata' => 'RATA'), $this->input->post('document'));?>
      <input type="submit" name="go" id="go" value="-- G O --" /></td>
    <td width="13%">&nbsp;
      <input name="op" type="hidden" id="op" value="1" /></td>
    <td width="9%"></td>
  </tr>
</table>
</form>
<!--style="border:thin inset; padding:6px;overflow:auto;"-->
<div id="payroll_sheet" >
<table width="100%" border="0" class="type-one">
  <tr class="type-one-header">
    <th>&nbsp;</th>
    <th>&nbsp;</th>
    <th>&nbsp;</th>
    <th>&nbsp;</th>
    <th>&nbsp;</th>
    <th>Monthly Salary</th>
    <th>Extra1</th>
    <th>extra2</th>
    <?php 
	$ph = new Payroll_heading();
	$line1 = $ph->get_line();
	
	$ph2 = new Payroll_heading();
		
	$lines2 = $ph2->get_line(2);
	?>
    <?php foreach($line1 as $line):?>
    	<th width="7%"><?php echo $line->caption;?></th>
    <?php endforeach;?>
    
    <th>&nbsp;</th>
    <th>extra3</th>
    <th>Total Amount Due</th>
    <th>extra5</th>
    
    
    
  </tr>
  <tr class="type-one-header">
    <th width="2%">&nbsp;</th>
    <th width="12%">Employee Name</th>
    <th width="15%">Designation</th>
    <th width="4%">Daily Rate</th>
    <th width="4%">Days Earned</th>
    <th width="6%">Tax Exemption</th>
    <th width="6%">extra1</th>
    <th width="17%">extra2</th>
    
	<?php 
	$ph = new Payroll_heading();
	$line2 = $ph->get_line(2);
	?>
    <?php foreach($line2 as $line):?>
    	<th><?php echo $line->caption;?></th>
    <?php endforeach;?>
        
    <!--Just add additional column if the first line is greater than 2nd line
    Lets practice that the first line is always greater than or equal to
    2nd line. Cheers!-->
    <?php if($line1->result_count() > $line2->result_count()):?>
    	<?php $rows = $line1->result_count() - $line2->result_count();?>
        <?php //while($rows != 0):?>
        	<?php echo '<th></th>';?>
            <?php //$rows --;?>
        <?php //endwhile;?>
    <?php endif;?>
    
    <th width="6%">&nbsp;</th>
    <th width="6%">extra3</th>
    <th width="6%">extra4</th>
    <th width="9%">extra5</th>
   
    </tr>
    
    <?php $employee_count = 1;
	$this->load->library('payroll_lib');
	?>
  <?php foreach ($employees as $employee): ?>
  		<?php $bg = $this->Helps->set_line_colors();?>
        <?php
		$params = array(
					'salary_grade' 	=>  $employee->salary_grade,
					'step' 			=>  $employee->step,
					'tax_status' 	=>  $employee->tax_status,
					'dependents' 	=>  $employee->dependents,
					);
					
		$this->payroll_lib->initialize($params);
		
		?>
      <tr bgcolor="<?php echo $bg;?>" onmouseover="this.bgColor = '<?php echo $this->config->item('mouseover_linecolor')?>';" 
    onmouseout ="this.bgColor = '<?php echo $bg;?>';" style="border-bottom: 1px solid #999999;">
        <td align="right" valign="top"><?php echo $employee_count;?></td>
        <td valign="top"><?php echo $employee->lname.', '.$employee->fname;?></td>
        <td valign="top"><?php echo $employee->position;?></td>
        <td><br />
          <br /></td>
        <td><br />
          <br /></td>
        <td align="center" valign="top"><?php //echo number_format($this->payroll_lib->monthly_salary, 2);?><br />
          <br /></td>
        <td align="center" valign="top">&nbsp;</td>
        <td align="center" valign="top">&nbsp;</td>
        
		<?php 
		
		
		
		$lines = $ph->get_line();
		
		$i = 0;
		
		?>
		<?php foreach($line1 as $line):?>
			<td align="center">
				<?php 
				$this->payroll_lib->deduction_compensation($line, $employee->id); 
				//echo $this->payroll_lib->amount().'<br><br>';
				
				// This is not a good idea code but I need technical debt now
				$j = 0;
				
				foreach ($lines2 as $line2)
				{
					if ($i == $j)
					{
						$this->payroll_lib->amount = 0;
						$this->payroll_lib->deduction_compensation($line2, $employee->id); 
						//echo $this->payroll_lib->amount();
					}
					
					$j ++;
				}
				// Not good idea end
				?>
                
            </td>
            <?php $i ++;?>
		<?php endforeach;?>
        
        
        
        <td align="center" valign="top">&nbsp;</td>
        <td align="center" valign="top"><?php echo $this->payroll_lib->employee_deductions.'<br><br>'.$this->payroll_lib->employer_deductions;?></td>
        <td align="center" valign="top"><?php echo number_format($this->payroll_lib->total_amount_due(), 2);?></td>
        <td align="center" valign="top">&nbsp;</td>
      </tr>
      
      <?php 
	  $employee_count++;
	  $this->payroll_lib->reset_class();
	  ?>
     
  <?php endforeach; //end $employees foreach?>
  <tr>
    <td></td>
    <td></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    
    <?php 
	$ph = new Payroll_heading();
	$line1 = $ph->get_line();
	?>
    <?php foreach($line1 as $line):?>
    	<td><?php //echo $line->type;?></td>
    <?php endforeach;?>
    
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
</table>
</div>
    <script>

$('#office_id').change(function(){

	
	//return
	var office_id = $(this)[0].value.toString();
		
	$.getJSON('<?php echo base_url();?>pds/employees/' + office_id, null, function (data) {
		
		$('#employee_id').empty().append("<option value='0'>--All--</option>");
		$.each(data, function (key, val) {
			$('#employee_id').append("<option value='" + key + "'>" + val + "</option>");

		});
	});

});

$('#go').click(function(){

	if ($('#employee_id').val() == 0)
	{
		alert("Please select employee");
		return false
	}

});
</script>