<script type="text/javascript" src="<?php echo base_url();?>js/edit_place/sack.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>js/edit_place/datagrid.js"></script>
    <script type="text/javascript">
    var offices = new dataGrid('offices','<?php echo base_url();?>ajax/edit_place/cto_balance');
    offices.m_columns['days']={'coltype':'text','style':''};
    offices.m_columns['dates']={'coltype':'text','style':''};
    //offices.m_columns['forwarded_note']={'coltype':'text','style':''};
    </script>
    <span id="offices.span">
      <table width="100%" border="0" class="type-one" id="offices.table">
        <tr class="type-one-header">
          <th width="10%" bgcolor="#D6D6D6"><strong>Employee No.</strong></th>
          <th width="28%" bgcolor="#D6D6D6"><strong>Employee Name</strong></th>
          <th width="20%" bgcolor="#D6D6D6">Balance </th>
          <th width="29%" bgcolor="#D6D6D6">As of (yyyy-mm-dd)</th>
        </tr>
        <?php $i = 0;?>
		<?php foreach($rows as $row):?>
		<?php 
			
			$c = CompensatoryTimeoff::getId($row['employee_id']);
			
			$onclick0 = "onClick=\"dg_editCell(offices,'".$c->id."','days','offices.0.$i', 'cto_balance')\"";
			$onclick1 = "onClick=\"dg_editCell(offices,'".$c->id."','dates','offices.1.$i', 'cto_balance')\"";
	
        ?>
    	<?php $bg = $this->Helps->set_line_colors();?>
        <tr bgcolor="<?php echo $bg;?>" onmouseover="this.bgColor = '<?php echo $this->config->item('mouseover_linecolor')?>';" 
    onmouseout ="this.bgColor = '<?php echo $bg;?>';" style="border-bottom: 1px solid #999999;">
          <td><?php echo $row['employee_id'];?></td>
          <td><?php echo $row['lname'].', '.$row['fname'].' '.$row['mname'];?></td>
          <td id="offices.0.<?php echo $i;?>" <?php echo $onclick0;?>><?php echo $c->days;?></td>
          <td id="offices.1.<?php echo $i;?>" <?php echo $onclick1;?>><?php echo $c->dates;?></td>
        </tr>
        <?php $i ++;?>
    
  <?php endforeach;?>
        <tr>
          <td>&nbsp;</td>
          <td></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table></span>