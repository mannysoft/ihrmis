<script type="text/javascript" src="<?php echo base_url();?>js/edit_place/sack.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/edit_place/datagrid.js"></script>
<script type="text/javascript">
//var dtr = new dataGrid('dtr','edit_place.php');
var dtr = new dataGrid('dtr','<?php echo base_url();?>ajax/edit_place/salary_grade');
dtr.m_columns['step1']={'coltype':'text','style':''};
dtr.m_columns['step2']={'coltype':'text','style':''};
dtr.m_columns['step3']={'coltype':'text','style':''};
dtr.m_columns['step4']={'coltype':'text','style':''};
dtr.m_columns['step5']={'coltype':'text','style':''};
dtr.m_columns['step6']={'coltype':'text','style':''};
dtr.m_columns['step7']={'coltype':'text','style':''};
dtr.m_columns['step8']={'coltype':'text','style':''};
</script>
<span id="dtr.span">
<form method="post" action="">
<strong>
<?php $js = 'id= "year"';echo form_dropdown('year', $year_options, $year_selected, $js);?>
<?php 
if ( $hospital == 'yes')
{
	$options = array(
                  ''  			=> 'Regular',
                  'hospital'    => 'Hospital'
                );
				
	$options_selected = $this->input->post('salary_grade_type');
				
	$js = 'id= "salary_grade_type"';echo form_dropdown('salary_grade_type', $options, $options_selected, $js);
}
?>
</strong>
<input type="submit" name="Submit" value="Go" />
<table width="100%" border="0" id="dtr.table" class="type-one">
  <tr class="type-one-header">
    <th width="2%" bgcolor="#FFFF00"><strong>SG</strong></th>
    <th align="center" bgcolor="#FFFF00"><strong>Step 1</strong></th>
    <th align="center" bgcolor="#FFFF00"><strong>Step 2</strong></th>
    <th align="center" bgcolor="#FFFF00"><strong>Step 3</strong></th>
    <th align="center" bgcolor="#FFFF00"><strong>Step 4</strong></th>
    <th align="center" bgcolor="#FFFF00"><strong>Step 5</strong></th>
    <th align="center" bgcolor="#FFFF00"><strong>Step 6</strong></th>
    <th align="center" bgcolor="#FFFF00"><strong>Step 7</strong></th>
    <th align="center" bgcolor="#FFFF00"><strong>Step 8</strong></th>
    </tr>
    <?php 
	$sg = 1; 
	$i = 1; 
	?>
    <?php foreach ($rows as $row): ?>
    	<?php 
			$bg = $this->Helps->set_line_colors(); 
			$onclick1 = "onClick=\"dg_editCell(dtr,'".$row['id']."','step1','dtr.1.$i','salary_grade')\"";
			$onclick2 = "onClick=\"dg_editCell(dtr,'".$row['id']."','step2','dtr.2.$i','salary_grade')\"";
			$onclick3 = "onClick=\"dg_editCell(dtr,'".$row['id']."','step3','dtr.3.$i','salary_grade')\"";
			$onclick4 = "onClick=\"dg_editCell(dtr,'".$row['id']."','step4','dtr.4.$i','salary_grade')\"";
			$onclick5 = "onClick=\"dg_editCell(dtr,'".$row['id']."','step5','dtr.5.$i','salary_grade')\"";
			$onclick6 = "onClick=\"dg_editCell(dtr,'".$row['id']."','step6','dtr.6.$i','salary_grade')\"";
			$onclick7 = "onClick=\"dg_editCell(dtr,'".$row['id']."','step7','dtr.7.$i','salary_grade')\"";
			$onclick8 = "onClick=\"dg_editCell(dtr,'".$row['id']."','step8','dtr.8.$i','salary_grade')\"";
		?>
          <tr bgcolor="<?php echo $bg;?>" onmouseover="this.bgColor = '#ABC7E9';this.style.color='#000000';" 
            onmouseout ="this.bgColor = '<?php echo $bg;?>';this.style.color='#000000'">
            <th align="right" bgcolor="#FFFF00"><?php echo $sg;?></th>
            <td width="11.25%" align="right" id="dtr.1.<?php echo $i;?>" <?php echo $onclick1;?>><?php echo number_format($row['step1'], 2);?></td>
            <td width="11.25%" align="right" id="dtr.2.<?php echo $i;?>" <?php echo $onclick2;?>><?php echo number_format($row['step2'], 2);?></td>
            <td width="11.25%" align="right" id="dtr.3.<?php echo $i;?>" <?php echo $onclick3;?>><?php echo number_format($row['step3'], 2);?></td>
            <td width="11.25%" align="right" id="dtr.4.<?php echo $i;?>" <?php echo $onclick4;?>><?php echo number_format($row['step4'], 2);?></td>
            <td width="11.25%" align="right" id="dtr.5.<?php echo $i;?>" <?php echo $onclick5;?>><?php echo number_format($row['step5'], 2);?></td>
            <td width="11.25%" align="right" id="dtr.6.<?php echo $i;?>" <?php echo $onclick6;?>><?php echo number_format($row['step6'], 2);?></td>
            <td width="11.25%" align="right" id="dtr.7.<?php echo $i;?>" <?php echo $onclick7;?>><?php echo number_format($row['step7'], 2);?></td>
            <td width="11.25%" align="right" id="dtr.8.<?php echo $i;?>" <?php echo $onclick8;?>><?php echo number_format($row['step8'], 2);?></td>
           </tr>
   			<?php 
			$sg++; 
			$i ++; 
			?>
  
 	<?php endforeach; ?>
</table>
</form>
</span>