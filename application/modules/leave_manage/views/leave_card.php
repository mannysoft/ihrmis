<?php 
if($name['first_day_of_service'] == '')
{
	$name['first_day_of_service'] = date('Y-m-d');
}

$name['first_day_of_service'] = convert_long_date($name['first_day_of_service']);

$lgu_code = $this->Settings->get_selected_field( 'lgu_code' );

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
      <td colspan="11" align="center">
      <?php if($lgu_code == 'bataraza'):?>
      	<strong>Republic of the Philippines</strong><br />
        PROVINCE OF PALAWAN<br />
        Municipal Government of Bataraza<br />
        <strong>BATARAZA, PALAWAN</strong><br />
        <br />
      <?php else:?>
      
        <strong>Republika ng Pilipinas</strong><br />
        KOMISYON NG SERBISYO SIBIL<br />
        (Civil Service Commission)<br />
        <strong>REGIONAL OFFICE NO. 1V</strong><br />
        Quezon City <br />
        <br />
      
      <?php endif;?>
    
        
        </td> 
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
    <?php $leave_card_print_period_from = $this->Settings->get_selected_field( 'leave_card_print_period_from' );?>
    <?php $leave_card_print_period_to 	= $this->Settings->get_selected_field( 'leave_card_print_period_to' );?>
	<?php $this->load->helper('text');?>
	<?php $this->load->library('leave/leave');?>
	<?php foreach ($cards as $card):?>
		<?php $this->leave->initialize($card); ?>
		<?php $this->leave->process_leave_card();?>
        <?php if($leave_card_print_period_from == ''):?>
            <tr>
              <td align="center"><?php echo $this->leave->period;?></td>
              <td align="center"><?php echo $this->leave->particulars;?></td>
              <td align="center"><?php echo ($this->leave->v_earned != '') ? number_format($this->leave->v_earned, 3) : $this->leave->v_earned;?></td>
              <td align="center"><?php echo $this->leave->v_abs;?></td>
              <td align="center"><?php echo number_format($this->leave->vacation_leave_balance, 3);?></td>
              <td align="center"><?php echo $this->leave->v_abs_wop;?></td>
              <td align="center"><?php echo ($this->leave->s_earned != '') ? number_format($this->leave->s_earned, 3) : $this->leave->s_earned;?></td>
              <td align="center"><?php echo $this->leave->s_abs;?></td>
              <td align="center"><?php echo number_format($this->leave->sick_leave_balance, 3)?></td>
              <td align="center"><?php echo $this->leave->s_abs_wop;?></td>
              <td align="center"><?php echo $this->leave->action_take;?></td>
            </tr>
        <?php else:?><!--We will check if with in the range-->
        	<?php if($this->leave->date >= $leave_card_print_period_from and $this->leave->date <= $leave_card_print_period_to): ?>
                <tr>
                  <td align="center"><?php echo $this->leave->period;?></td>
                  <td align="center"><?php echo $this->leave->particulars;?></td>
                  <td align="center"><?php echo ($this->leave->v_earned != '') ? number_format($this->leave->v_earned, 3) : $this->leave->v_earned;?></td>
                  <td align="center"><?php echo $this->leave->v_abs;?></td>
                  <td align="center"><?php echo number_format($this->leave->vacation_leave_balance, 3);?></td>
                  <td align="center"><?php echo $this->leave->v_abs_wop;?></td>
                  <td align="center"><?php echo ($this->leave->s_earned != '') ? number_format($this->leave->s_earned, 3) : $this->leave->s_earned;?></td>
                  <td align="center"><?php echo $this->leave->s_abs;?></td>
                  <td align="center"><?php echo number_format($this->leave->sick_leave_balance, 3)?></td>
                  <td align="center"><?php echo $this->leave->s_abs_wop;?></td>
                  <td align="center"><?php echo $this->leave->action_take;?></td>
                </tr>
            <?php endif; ?>
            
        <?php endif;?>
	<?php endforeach;?>
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