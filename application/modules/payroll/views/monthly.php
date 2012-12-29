<form action="" method="post">
<table width="100%" border="0">
  <tr>
    <td colspan="7"><a href="http://philippinestaxcomputation.blogspot.com/">http://philippinestaxcomputation.blogspot.com/</a>
    http://thecolorcure.com/taxcalculator/</td>
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

<div id="payroll_sheet" style="border:thin inset; padding:6px;overflow:auto;">
<table width="100%" border="0" class="type-one">
  <tr class="type-one-header">
    <th>&nbsp;</th>
    <th>&nbsp;</th>
    <th>&nbsp;</th>
    <th>&nbsp;</th>
    <th>&nbsp;</th>
    <th>&nbsp;</th>
    <th>Extra1</th>
    <th>extra2</th>
    <?php 
	$ph = new Payroll_heading();
	$line1 = $ph->get_line();
	
	$ph2 = new Payroll_heading();
		
	$lines2 = $ph2->get_line(2);
	?>
    <?php foreach($line1 as $line):?>
    	<th><?php echo $line->caption;?></th>
    <?php endforeach;?>
    
    <th>&nbsp;</th>
    <th>extra3</th>
    
    
    
  </tr>
  <tr class="type-one-header">
    <th width="2%">&nbsp;</th>
    <th width="17%">Employee Name</th>
    <th width="20%">Designation</th>
    <th width="6%">Daily Rate</th>
    <th width="16%">Days Earned</th>
    <th width="23%">Monthly Salary</th>
    <th width="8%">extra1</th>
    <th width="8%">extra2</th>
    
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
        	<th></th>
            <?php //$rows --;?>
        <?php //endwhile;?>
    <?php endif;?>
    
    <th width="8%">&nbsp;</th>
    <th width="8%">extra3</th>
   
    </tr>
    
    <?php $employee_count = 1;
	$this->load->library('payroll_lib');
	?>
  <?php foreach ($employees as $employee): ?>
  		<?php $bg = $this->Helps->set_line_colors();?>
        <?php
		$this->payroll_lib->salary_grade 	= $employee->salary_grade;
		$this->payroll_lib->step 			= $employee->step;
		$this->payroll_lib->tax_status 		= $employee->tax_status;
		$this->payroll_lib->dependents 		= $employee->dependents;
		?>
      <tr bgcolor="<?php echo $bg;?>" onmouseover="this.bgColor = '<?php echo $this->config->item('mouseover_linecolor')?>';" 
    onmouseout ="this.bgColor = '<?php echo $bg;?>';">
        <td align="right" valign="top"><?php echo $employee_count;?></td>
        <td valign="top"><?php echo $employee->lname.', '.$employee->fname;?></td>
        <td valign="top"><?php echo $employee->position;?></td>
        <td><br />
          <br /></td>
        <td><br />
          <br /></td>
        <td align="center" valign="top"><br />
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
				echo $this->payroll_lib->amount().'<br><br>';
				
				// This is not a good idea code but I need technical debt now
				$j = 0;
				
				foreach ($lines2 as $line2)
				{
					if ($i == $j)
					{
						$this->payroll_lib->amount = 0;
						$this->payroll_lib->deduction_compensation($line2, $employee->id); 
						echo $this->payroll_lib->amount();
					}
					
					$j ++;
				}
				// Not good idea end
				?>
                
            </td>
            <?php $i ++;?>
		<?php endforeach;?>
        
        
        
        <td align="center" valign="top">&nbsp;</td>
        <td align="center" valign="top">&nbsp;</td>
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
    
    <?php 
	$ph = new Payroll_heading();
	$line1 = $ph->get_line();
	?>
    <?php foreach($line1 as $line):?>
    	<td><?php //echo $line->type;?></td>
    <?php endforeach;?>
    
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <?php foreach($agencies as $agency):?>
		<?php 
        // Lets count info per agency
        $d  = new Deduction_information();
        $infos = $d->get_by_deduction_agency_id($agency->id);
        ?>
        
        <?php foreach($infos as $info):?>
       	<?php endforeach;?>
        
        <?php if( ! $infos->exists()):?>
        <?php endif;?>
        
    <?php endforeach;?>
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