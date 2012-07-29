<form action="" method="post">
<table width="100%" border="0">
  <tr>
    <td colspan="7"><a href="http://philippinestaxcomputation.blogspot.com/">http://philippinestaxcomputation.blogspot.com/</a></td>
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
      <?php $js = 'id= "year"';echo form_dropdown('year', $year_options, $year_selected, $js);?>
      </strong>Month:<strong>
        <?php $js = 'id= "month"';echo form_dropdown('month', $month_options, $month_selected, $js);?>
      </strong> Period:<strong>
      <?php $js = 'id= "period"';echo form_dropdown('period', array('1-15/16-31'));?>
      </strong></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td></td>
  </tr>
  <tr>
    <td width="8%" align="right">Office:</td>
    <td colspan="5"><?php $js = 'id = "office_id"';echo form_dropdown('office_id', $options, $selected, $js);?>
      
      Document:<?php $js = 'id= "document"';echo form_dropdown('document', array('monthly_salary'=> 'Monthly Salary', 'pera'=> 'PERA/ADCOM', 'rata' => 'RATA'), $this->input->post('document'));?>
      <input type="submit" name="go" id="go" value="-- G O --" /></td>
    <td width="13%">&nbsp;
      <input name="op" type="hidden" id="op" value="1" />
      <input type="button" name="button" id="toggle_deductions" value="hide deductions" /></td>
    <td width="9%"></td>
  </tr>
</table>
</form>

<?php $array =array(1,2,3,4);?>
<div id="payroll_sheet" style="border:thin inset; padding:6px;overflow:auto;">
<table width="100%" border="0" class="type-one">
  <tr class="type-one-header">
    <th>&nbsp;</th>
    <th>&nbsp;</th>
    <th>&nbsp;</th>
    <th>&nbsp;</th>
    <th>&nbsp;</th>
    <th>&nbsp;</th>
    <th>&nbsp;</th>
    <th>&nbsp;</th>
    <?php foreach($agencies as $agency):?>
    <?php 
            // Lets count info per agency
            $d  = new Deduction_information();
            $infos = $d->get_by_deduction_agency_id($agency->id);
			
			$colspan = 0;
			
			foreach($infos as $info)
			{
				$colspan++;
			}
			
			$colspan = ($colspan > 1) 
						? 'colspan="'.$colspan.'"' 
						: '';
			
        ?>
    <th width="8%" <?php echo $colspan;?>><?php echo $agency->code.'-'.$agency->id;?></th>
    <?php endforeach;?>
    <th width="8%">&nbsp;</th>
  </tr>
  <tr class="type-one-header">
    <th>&nbsp;</th>
    <th>&nbsp;</th>
    <th>&nbsp;</th>
    <th>&nbsp;</th>
    <th>&nbsp;</th>
    <th>&nbsp;</th>
    <th>ACA</th>
    <th>1</th>
    <?php foreach($agencies as $agency):?>
		<?php 
        // Lets count info per agency
        $d  = new Deduction_information();
		$d->order_by('report_order');
        $infos = $d->get_by_deduction_agency_id($agency->id);
        ?>
        
        <?php foreach($infos as $info):?>
        	<th><?php echo $info->code.'-'.$info->id;?></th>
        <?php endforeach;?>
        
        <?php if( ! $infos->exists()):?>
        <th><?php echo 'NONE';?></th>
        <?php endif;?>
        
    <?php endforeach;?>
    <th>2</th>
  </tr>
  <tr class="type-one-header">
    <th width="3%">&nbsp;</th>
    <th width="36%">Employee Name</th>
    <th width="15%">Designation</th>
    <th width="4%">Daily Rate</th>
    <th width="5%">Days Earned</th>
    <th width="6%">Monthly Salary</th>
    <th width="6%">PERA</th>
    <th width="6%">Gross Amount Earned</th>
    
    <?php foreach($agencies as $agency):?>
		<?php 
        // Lets count info per agency
        $d  = new Deduction_information();
		$d->order_by('report_order');
        $infos = $d->get_by_deduction_agency_id($agency->id);
        ?>
        
        <?php foreach($infos as $info):?>
        	<th><?php echo $info->code.'-'.$info->id;?></th>
        <?php endforeach;?>
        
        <?php if( ! $infos->exists()):?>
        <th><?php echo 'NONE';?></th>
        <?php endif;?>
        
    <?php endforeach;?>
    
    <th width="5%">Net Pay</th>
    </tr>
    
    <?php $employee_count = 1;?>
  <?php foreach ($employees as $employee): ?>
  		<?php $bg = $this->Helps->set_line_colors();?>
        <?php
		//$d = new Additional_compensation_m();
		
		//$d->get_by_id( $deduction->additional_compensation_id );
		
		$monthly_salary = $this->Salary_grade->get_monthly_salary($employee->salary_grade, $employee->step);
		
		//echo $this->db->last_query();
		//echo $employee->step;
		
		$daily_rate = $monthly_salary / 22;
		
		$gross_amount_earned = $monthly_salary / 2;
		
		$net_pay_monthly = $monthly_salary;
		$net_pay_15 = $gross_amount_earned;
		$net_pay_30 = $gross_amount_earned;
		
		//echo $net_pay_monthly;
		
				
		?>
      <tr bgcolor="<?php echo $bg;?>" onmouseover="this.bgColor = '<?php echo $this->config->item('mouseover_linecolor')?>';" 
    onmouseout ="this.bgColor = '<?php echo $bg;?>';">
        <td align="right" valign="top"><?php echo $employee_count;?></td>
        <td valign="top"><?php echo $employee->lname.', '.$employee->fname;?></td>
        <td valign="top"><?php echo $employee->position;?></td>
        <td><input name="daily_rate[]" type="text" id="daily_rate[]" value="<?php echo number_format($daily_rate, 2);?>" size="6" readonly="readonly" style="text-align:right;font-weight:bold;text-emphasis:dot"/>
        <br />
        <input name="daily_rate[]" type="text" id="daily_rate[]" value="<?php echo number_format($daily_rate, 2);?>" size="6" style="text-align:right" />
        <br />
        <input name="daily_rate[]" type="text" id="daily_rate[]" value="<?php echo number_format($daily_rate, 2);?>" size="6" style="text-align:right"/></td>
        <td><input name="days_earned[]" type="text" id="days_earned[]" value="22" size="3" readonly="readonly" style="text-align:right" />
        <br />
        <input name="days_earned[]" type="text" id="days_earned[]" value="11" size="3" style="text-align:right" />
        <br />
        <input name="days_earned[]" type="text" id="days_earned[]" value="11" size="3" style="text-align:right"/></td>
        <td align="center" valign="top"><input name="textfield" type="text" id="textfield" value="<?php echo number_format($monthly_salary, 2);?>" size="7" readonly="readonly" style="text-align:right" />
        <br />
        <input name="textfield2" type="text" id="textfield2" value="<?php echo number_format($monthly_salary, 2);?>" size="7" style="text-align:right" />
        <br />
        <input name="textfield3" type="text" id="textfield3" value="<?php echo number_format($monthly_salary, 2);?>" size="7" style="text-align:right" /></td>
        <td align="center" valign="top">&nbsp;</td>
        <td align="center" valign="top"><input name="textfield" type="text" id="textfield" value="<?php echo number_format($monthly_salary, 2);?>" size="7" readonly="readonly" style="text-align:right" />
        <br />
        <input name="textfield2" type="text" id="textfield2" value="<?php echo number_format($gross_amount_earned, 2);?>" size="7" style="text-align:right" />
        <br />
        <input name="textfield3" type="text" id="textfield3" value="<?php echo number_format($gross_amount_earned, 2);?>" size="7" style="text-align:right" /></td>
     <?php foreach($agencies as $agency):?>
		<?php 
        // Lets count info per agency
        $d  = new Deduction_information();
		$d->order_by('report_order');
        $infos = $d->get_by_deduction_agency_id($agency->id);
        ?>
        
        <?php foreach($infos as $info):?>
        	
            <?php 
			// To do: we are going to check for active deductions per employee
			$dl = new Deduction_loan();
			$dl->where('employee_id', $employee->id);
			$dl->where('deduction_information_id', $info->id);
			$dl->get();
			
			$deduct = 0;
			
			if ($dl->exists())
			{
				$deduct = $dl->monthly_due;
				
				// Deduct from salary
				$net_pay_monthly = $net_pay_monthly - $dl->monthly_due;
			}
			
			// If tax
			if ($info->code == 'Tax Withheld')
			{
				$tt = new Tax_table();
				$tt->where('start_range <', $monthly_salary);
				$tt->order_by('start_range', 'DESC');
				$tt->get(1);
				
				
				
				// The tax fix amount
				// If fix amount is not equal to zero meaning the
				// salary is more than 10,000.00
				if ($tt->fix_amount != 0)
				{
					$tax_with_held = $tt->fix_amount;
					
					//echo $tax_with_held;
										
					// Well lets check how much excess
					$excess = $monthly_salary - $tt->start_range;
					
					$percentage = intval($tt->percentage);
					
					// Add the excess to tax with held
					$tax_percentage = ($excess / 100) * $percentage;
					
					$tax_with_held = $tax_with_held + $tax_percentage;
					
					//echo $tax_percentage;
					
					
					//echo $excess;
				}
				// If the salary is below 10,000.00
				// We will get the percentage only
				else 
				{
					$this->load->helper('percent');
					
					$percentage = intval($tt->percentage);
					
					$tax_with_held = ($monthly_salary / 100) * $percentage;
				}
				
				$deduct = $tax_with_held;
				
				$net_pay_monthly = $net_pay_monthly - $deduct;
			}
			
			$deduct_half = 0;
			
			if ($deduct != 0)
			{
				$deduct_half = $deduct / 2;
				
				$net_pay_15 = $net_pay_15 - $deduct_half;
				$net_pay_30 = $net_pay_30 - $deduct_half;
			}
			
			//var_dump($deduct);
			
			//echo $employee->id.', ';
			//echo $net_pay_monthly.', ';
			//echo $deduct;
			//echo $this->db->last_query();
			//echo $employee->id;
			//$info->id);
			
			?>
        	<td align="center">
            <input name="deduct_<?php echo $info->id;?>_1" type="text" id="deduct_" value="<?php echo ($deduct != 0) ? number_format($deduct ,2): '';?>" size="5" readonly="readonly" style="text-align:right"/>
        	<br />
        	<input name="deduct_<?php echo $info->id;?>_2" type="text" id="textfield2" value="<?php echo ($deduct_half != 0) ? number_format($deduct_half ,2) : '';?>" size="5" style="text-align:right"/>
        	<br />
        	<input name="deduct_<?php echo $info->id;?>_3" type="text" id="textfield3" value="<?php echo ($deduct_half != 0) ? number_format($deduct_half ,2) : '';?>" size="5" style="text-align:right"/>
            </td>
        <?php endforeach; // end $infos foreach?>
        
        <?php if( ! $infos->exists()):?>
        	<td>
			<input name="textfield" type="text" id="textfield" value="none" size="5" readonly="readonly" />
        	<br />
        	<input name="textfield2" type="text" id="textfield2" value="none" size="5" />
        	<br />
        	<input name="textfield3" type="text" id="textfield3" value="none" size="5" />
            </td>
        <?php endif;?>
        
    <?php endforeach; // end $agencies foreach?>
        <td align="right">
		<?php echo number_format($net_pay_monthly, 2); ?><br />
        <?php echo number_format($net_pay_15, 2); ?><br />
        <?php echo number_format($net_pay_30, 2); ?>
        </td>
      </tr>
      
      <?php $employee_count++;?>
     
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
   <?php foreach($agencies as $agency):?>
		<?php 
        // Lets count info per agency
        $d  = new Deduction_information();
        $infos = $d->get_by_deduction_agency_id($agency->id);
        ?>
        
        <?php foreach($infos as $info):?>
        	<td></td>
        <?php endforeach;?>
        
        <?php if( ! $infos->exists()):?>
        <td></td>
        <?php endif;?>
        
    <?php endforeach;?>
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


$('#toggle_deductions').click(function(){

	if ($('.official_deductions').val() == 'hide deductions')
	{
		$('.official_deductions').hide('slow');
		$('.official_deductions').val('show deductions');
	}
	
	else
	{
		$('.official_deductions').show('slow');
		$('.official_deductions').val('hide deductions');
	}
	

});

$(document).ready(function(){

	
	//return
	var office_id = $('#office_id').val()
	
	var selected = "";
		
	$.getJSON('<?php echo base_url();?>pds/employees/' + office_id, null, function (data) {
		
		$('#employee_id').empty().append("<option value='0'>--All--</option>");
		$.each(data, function (key, val) {
			
			if ( key == "<?php echo $employee_id;?>")
			{
				selected = "selected";
			}
			else
			{
				selected = "";
			}
			
			$('#employee_id').append("<option value='" + key + "' "+ selected +">" + val + "</option>");

		});
		
		$('#employee_id').sort();
	});
	

});
</script>