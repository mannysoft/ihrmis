<form method="post" action="">
<strong>
<?php $js = 'id= "year"';echo form_dropdown('year', $year_options, $year_selected, $js);?>
</strong>
<input type="submit" name="Submit" value="Go" />
<table width="100%" border="0">
  
  <tr>
    <td width="2%" bgcolor="#FFFF00">SG</td>
    <td colspan="2" align="center" bgcolor="#FFFF00">Step1</td>
    <td colspan="2" align="center" bgcolor="#FFFF00">Step2</td>
    <td colspan="2" align="center" bgcolor="#FFFF00">Step3</td>
    <td colspan="2" align="center" bgcolor="#FFFF00">Step4</td>
    <td colspan="2" align="center" bgcolor="#FFFF00">Step5</td>
    <td colspan="2" align="center" bgcolor="#FFFF00">Step6</td>
    <td colspan="2" align="center" bgcolor="#FFFF00">Step7</td>
    <td colspan="2" align="center" bgcolor="#FFFF00">Step8</td>
  </tr>
  <?php 
	
	$sg = 1;		
	
	foreach($rows as $row)
	{
		$step1 = $row['step1'];
		$step2 = $row['step2'];
		$step3 = $row['step3'];
		$step4 = $row['step4'];
		$step5 = $row['step5'];
		$step6 = $row['step6'];
		$step7 = $row['step7'];
		$step8 = $row['step8'];
		
		
	?>		
  <tr onmouseover="this.bgColor = '#ABC7E9';this.style.color='#000000';" 
    onmouseout ="this.bgColor = '<?php //echo $bg;?>';this.style.color='#000000'">
    <td bgcolor="#FFFF00"><?php echo $sg;?></td>
    <td width="5%" bgcolor="#00FF00"><?php echo number_format($step1, 2);?></td>
    <td width="4%"><?php echo $step1*12;?></td>
    <td width="9%" bgcolor="#00FF00"><?php echo $step2;?></td>
    <td width="6%"><?php echo $step2*12;?></td>
    <td width="6%" bgcolor="#00FF00"><?php echo $step3;?></td>
    <td width="6%"><?php echo $step3*12;?></td>
    <td width="6%" bgcolor="#00FF00"><?php echo $step4;?></td>
    <td width="6%"><?php echo $step4*12;?></td>
    <td width="6%" bgcolor="#00FF00"><?php echo $step5;?></td>
    <td width="6%"><?php echo $step5*12;?></td>
    <td width="6%" bgcolor="#00FF00"><?php echo $step6;?></td>
    <td width="6%"><?php echo $step6*12;?></td>
    <td width="6%" bgcolor="#00FF00"><?php echo $step7;?></td>
    <td width="6%"><?php echo $step7*12;?></td>
    <td width="6%" bgcolor="#00FF00"><?php echo $step8;?></td>
    <td width="8%"><?php echo $step8*12;?></td>
  </tr>
  <?php
  $sg ++; 
  }
  
  ?>
</table>
</form>