<script type="text/javascript" src="<?php echo base_url();?>js/edit_place/sack.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>js/edit_place/datagrid.js"></script>
    <script type="text/javascript">
    var offices = new dataGrid('offices','<?php echo base_url();?>personnel/plantilla_ajax/edit_place/plantilla');
    offices.m_columns['item_no']={'coltype':'text','style':''};
    offices.m_columns['position']={'coltype':'text','style':''};
    offices.m_columns['year']={'coltype':'text','style':''};
	offices.m_columns['sg']={'coltype':'text','style':''};
    offices.m_columns['amount']={'coltype':'text','style':''};
    </script>
    <span id="offices.span">
      <table width="100%" border="0" class="type-one" id="offices.table">
        <tr class="type-one-header">
          <th width="8%" bgcolor="#D6D6D6"><strong>Item Number</strong></th>
          <th width="19%" bgcolor="#D6D6D6">Position Title</th>
          <th width="8%" bgcolor="#D6D6D6">Item No.</th>
          <th width="35%" bgcolor="#D6D6D6"><strong>Name of Incumbent</strong></th>
          <th width="12%" bgcolor="#D6D6D6">Year</th>
          <th width="7%" bgcolor="#D6D6D6">SG</th>
          <th width="11%" bgcolor="#D6D6D6">Amount</th>
        </tr>
        <?php $i = 0;?>
        <?php $p = new Plantilla();?>
		<?php foreach($rows as $row):?>
		<?php 
			
			$p->where('year', $year);
			$p->where('employee_id', $row['id']);
			$p->get();
        	
			// last param of dg_editCell is the size of the textbox
			
			$onclick0 = "onClick=\"dg_editCell(offices,'".$p->id."','item_no','offices.0.$i', 'plantilla')\"";
			$onclick1 = "onClick=\"dg_editCell(offices,'".$p->id."','position','offices.1.$i', 'plantilla', '40')\"";
			$onclick2 = "onClick=\"dg_editCell(offices,'".$p->id."','year','offices.2.$i', 'plantilla', '8')\"";
			$onclick3 = "onClick=\"dg_editCell(offices,'".$p->id."','sg','offices.3.$i', 'plantilla', '5')\"";
			$onclick4 = "onClick=\"dg_editCell(offices,'".$p->id."','amount','offices.4.$i', 'plantilla', '10')\"";
	
        ?>
    	<?php $bg = $this->Helps->set_line_colors();?>
        <tr bgcolor="<?php echo $bg;?>" onmouseover="this.bgColor = '<?php echo $this->config->item('mouseover_linecolor')?>';" 
    onmouseout ="this.bgColor = '<?php echo $bg;?>';">
          <td id="offices.0.<?php echo $i;?>" <?php echo $onclick0;?>><?php echo $p->item_no;?></td>
          <td id="offices.1.<?php echo $i;?>" <?php echo $onclick1;?>><?php echo $p->position;?></td>
          <td>&nbsp;</td>
          <td><?php echo $row['lname'].', '.$row['fname'].' '.$row['mname'];?></td>
          <td id="offices.2.<?php echo $i;?>" <?php //echo $onclick2;?>><?php echo $p->year;?></td>
          <td id="offices.3.<?php echo $i;?>" <?php echo $onclick3;?>><?php echo $p->sg;?></td>
          <td align="right" id="offices.4.<?php echo $i;?>" <?php echo $onclick4;?>><?php echo $p->amount;?></td>
        </tr>
        <?php $i ++;?>
    
  <?php endforeach;?>
        <tr>
          <td>&nbsp;</td>
          <td></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table></span>