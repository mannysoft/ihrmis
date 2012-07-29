<?php 
if($name['first_day_of_service'] == '')
{
	$name['first_day_of_service'] = date('Y-m-d');
}

$name['first_day_of_service'] = convert_long_date($name['first_day_of_service']);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>Leave Info</title>
<link href="<?php echo base_url();?>css/style.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url();?>css/style_form.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url();?>css/style_table.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url();?>css/style_layout.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url();?>css/leave.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url();?>css/style_menu_dropdown.css" rel="stylesheet" type="text/css" media="screen,print,handheld,projection">
</head>
<body>
<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1" onsubmit='return formValidator()'>
  <table width="100%" border="0">
    <tr>
      <td colspan="11" align="center"><strong>Republika ng Pilipinas</strong><br />
        KOMISYON NG SERBISYO SIBIL<br />
        (Civil Service Commission)<br />
        <strong>REGIONAL OFFICE NO. 1V</strong><br />
        Quezon City <br />
        <br /></td> 
    </tr>
    <tr>
      <td align="left">&nbsp;</td>
      <td colspan="4" align="left"><strong><?php echo $name['lname'].', '.$name['fname'].' '.$name['mname'];?></strong></td>
      <td colspan="4" align="left"><strong><?php echo $this->Office->get_office_name($name['office_id']);?></strong></td>
      <td colspan="2" align="left"><strong><?php echo $name['first_day_of_service'];?></strong></td>
    </tr>
    <tr>
      <td align="center">&nbsp;</td>
      <td colspan="4" align="left">NAME</td>
      <td colspan="4" align="left">DIVISION</td>
      <td colspan="2" align="left">1st DAY OF SERVICE </td>
    </tr>
    <tr>
      <td width="6%" align="center">&nbsp;</td>
      <td colspan="5" align="center"><strong>VACATION LEAVE<br />
      </strong></td>
      <td colspan="4" align="center"><strong>SICK LEAVE </strong></td>
      <td width="25%" align="center">&nbsp;</td>
    </tr>
    
    <tr>
      <td align="center" valign="middle">&nbsp;&nbsp;&nbsp;&nbsp;PERIOD&nbsp;&nbsp;&nbsp;&nbsp;</td>
      <td width="7%" align="center" valign="middle">PARTICU-<br />
      LARS</td>
      <td width="7%" align="center" valign="middle">EARNED</td>
      <td width="5%" align="center" valign="middle">ABS.<br />
        UND.<br />
      W/P</td>
      <td width="13%" align="center" valign="middle">BAL.</td>
      <td width="6%" align="center" valign="middle">ABS.<br />
UND.<br />
WOP</td>
      <td width="7%" align="center" valign="middle">EARNED</td>
      <td width="7%" align="center" valign="middle">ABS.<br />
UND.<br />
W/P</td>
      <td width="10%" align="center" valign="middle">BAL.</td>
      <td width="7%" align="center" valign="middle">ABS.<br />
UND.<br />
WOP</td>
      <td align="center" valign="middle">DATE AND<br />
        ACTION<br />
        TAKEN ON<br />
        APPLICATION<br />
        FOR<br />
      LEAVE</td>
    </tr>
	<?php
	
	$this->load->helper('text');
	$this->load->library('leave/leave');
	
	
	$vacation_leave_balance = 0;
	$sick_leave_balance 	= 0;
	
	foreach ($cards as $card)
	{
		$this->leave->initialize($card);
		$this->leave->process_leave_card();
		
		$period 		= $card['period'];
		$particulars 	= $card['particulars'];
		$v_earned 		= $card['v_earned'];
		$v_abs 			= $card['v_abs'];
		$v_balance 		= $card['v_balance'];
		$v_abs_wop 		= $card['v_abs_wop'];
		
		$s_earned 		= $card['s_earned'];
		$s_abs 			= $card['s_abs'];
		$s_balance 		= $card['s_balance'];
		$s_abs_wop 		= $card['s_abs_wop'];
		
		$action_taken 	= $card['action_take'];
		$date 			= $card['date'];
				
		$period 		= is_zero($period);
				
		$v_earned 		= is_zero($v_earned);
		
		// If MC#06
		if ($v_abs == 0 || $card['leave_type_id'] == 3)
		{
			$v_abs = '';
		}
				
		$v_abs_wop 	= is_zero($v_abs_wop);
		$s_earned 	= is_zero($s_earned);
				
		// If maternity, paternity or solo parent leave
		$leave_ids = array(4, 5, 6);
		if ($s_abs == 0 || in_array($card['leave_type_id'], $leave_ids))
		{
			$s_abs = '';
		}
		
		$s_abs_wop 		= is_zero($s_abs_wop);
		
		
		// balance here
		if ($v_balance != 0)
		{
			$vacation_leave_balance += $v_balance;
		}
		if ($s_balance != 0)
		{
			$sick_leave_balance += $s_balance;
		}
		
		// If the there is a file for vacation leave
		// Vacation leave balance minus the number of
		// vacation leave days filed. 
		if ($v_abs != 0)
		{
			$vacation_leave_balance -= $v_abs;
		}
		
		// Same as VL above
		if ($s_abs != 0)
		{
			$sick_leave_balance -= $s_abs;
		}
		
		// Earned
		if ($v_earned != 0)
		{
			$vacation_leave_balance += $v_earned;
		}
		if ($s_earned != 0)
		{
			$sick_leave_balance += $s_earned;
		}
		
		// Tell if the entry is leave forwarded
		$cut_particulars = substr($particulars, 0, 3);
		
		
		// If negative
		if (substr($sick_leave_balance, 0, 1) == '-')
		{
			
			// If balance forwarded
			if ($cut_particulars == 'Bal')
			{
			
			}
			else
			{
				// do only if the entry is not earnings of leave and the entry is for sick leave
				// do this if the application is sick leave
				if ($particulars != '' && $s_abs != 0)
				{
					
					$abs_sick_leave_balance = abs($sick_leave_balance);
					
					// if the leave application is greater than
					// negative balance
					if ($abs_sick_leave_balance > $s_abs)
					{
						
						$sick_leave_balance = $abs_sick_leave_balance - $s_abs;
						$sick_leave_balance = '-'.$sick_leave_balance;
						
						// if vacation leave balance is greater than
						// number of sick leave applied
						if($vacation_leave_balance > $s_abs)
						{
							$vacation_leave_balance = $vacation_leave_balance - $s_abs;
							$v_abs = $s_abs;
							$particulars = $v_abs.' VSL';
							
							$s_abs = '';
						}
						
						// if vacation leave balance is less than 
						// sick leave applied
						// make the w/out pay to sick leave
						if ($vacation_leave_balance < $s_abs)
						{
							$s_abs_wop = abs($s_abs);
							$s_abs = '';
						}
					}
					else
					{
						$s_abs_wop = abs($sick_leave_balance);
						$sick_leave_balance = 0;
						
						// vacation leave balance less sick leave wop
						$vacation_leave_balance -= $s_abs_wop;
						
						$s = $s_abs - $s_abs_wop;
						
						$particulars = $s.' SL, '.$s_abs_wop.' VSL';
						
						if ($s == 0)
						{
							$particulars = $s_abs_wop.' VSL';
						}
						
						$s_abs = $s;
						$v_abs = $s_abs_wop;
						
						$s_abs_wop = '';
					}
				}
				
			}
			
			//update entry
		}
		
		if (substr($vacation_leave_balance, 0, 1) == '-' && $v_abs != 0)
		{
			$v_abs_wop = abs($vacation_leave_balance);
			
			
			if ($v_abs_wop > $v_abs)
			{
				$v_abs_wop = $v_abs;
				$vacation_leave_balance = abs($vacation_leave_balance) - $v_abs;
				$vacation_leave_balance = '-'.$vacation_leave_balance;
			}
			else
			{
				$vacation_leave_balance = 0;
			}
			//update entry
		}
		
		// 6.15.2011 5.51pm == ======= == = 
		if ( $card['leave_type_id'] == 21)
		{
			$vacation_leave_balance = 0;
			$sick_leave_balance 	= 0;
		}
		
		// == = == = == = = = =========== =
		
	?>
	<tr bgcolor="<?php //echo $bg;?>">
      <td align="center"><?php echo $period;?></td>
      <td align="center"><?php echo $particulars;?></td>
      <td align="center"><?php echo ($v_earned != '') ? number_format($v_earned, 3) : $v_earned;?></td>
      <td align="center"><?php echo $v_abs;?></td>
      <td align="center"><?php echo number_format($vacation_leave_balance, 3);?></td>
      <td align="center"><?php echo $v_abs_wop;?></td>
      <td align="center"><?php echo ($s_earned != '') ? number_format($s_earned, 3) : $s_earned;?></td>
      <td align="center"><?php echo $s_abs;?></td>
      <td align="center"><?php echo number_format($sick_leave_balance, 3)?></td>
      <td align="center"><?php echo $s_abs_wop;?></td>
      <td align="center"><?php echo $action_taken;?></td>
    </tr>
	
	<?php 
	

	}
	
	//Update leave balance
	$isLeaveBalanceExists = $this->Leave_balance->is_leave_balance_exists($name['id']);
	
	$office = $this->Office->get_office_info($name['office_id']);
	
	$monetary = 0;
	
	if ($name['salary_grade'] != '-' && $name['salary_grade'] != '')
	{
		// We need to check what salary grade the office use
		if ( $office['salary_grade_type'] == 'hospital' )
		{
			$this->Salary_grade->salary_grade_type = 'hospital';
		}
		
		$monetary = $this->Salary_grade->monetary_equivalent(
															$name['salary_grade'],
															$name['step'],
															$sick_leave_balance,
															$vacation_leave_balance,
															2010
															);
	}			
	
	//If exists just update
	if ($isLeaveBalanceExists == TRUE)
	{
		$this->Leave_balance->update_leave_balance($name['id'], 
												   $sick_leave_balance, 
												   $vacation_leave_balance, 
												   $monetary
												   );
	}
	//Insert
	else
	{
		$this->Leave_balance->insert_leave_balance($name['id'], 
												   $sick_leave_balance, 
												   $vacation_leave_balance, 
												   $monetary
												   );
	}
	
	//echo $vacation_leave_balance.$sick_leave_balance;
	?>
    <tr>
      <td align="left">&nbsp;</td>
      <td align="left">&nbsp;</td>
      <td align="left">&nbsp;</td>
      <td align="left">&nbsp;</td>
      <td align="left">&nbsp;</td>
      <td align="left">&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td align="center">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="11" align="center"><input name="button" type="button" onclick="javascript:window.close();" value="close" class="button"/>
      <SCRIPT LANGUAGE="JavaScript"> 
// This script was supplied free by Hypergurl // http://www.hypergurl.com <!-- 
if (window.print) { document.write('<form>Click Here 
To ' + '<input type=button name=print value="Print" ' + 'onClick="javascript:window.print()"> 
This Page!</form>'); } // End hide --> </script>
      <input name="button2" type="button" onClick="javascript:window.print()" value="Print" class="button"/></td>
    </tr>
  </table>
</form>
</body>
</html>