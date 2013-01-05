<table width="100%" border="0">
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><a href="<?php echo base_url().'payroll/report/headings_save/';?>">Add</a></td>
  </tr>
  <tr>
    <td width="19%">&nbsp;</td>
    <td width="68%">&nbsp;</td>
    <td width="13%"></td>
  </tr>
</table>

<table width="100%" border="0" class="type-one" id="headings">
  <tr class="type-one-header">
    <th width="6%">Number</th>
    <th width="11%">Type</th>
    <th width="10%">Line</th>
    <th width="34%">Caption</th>
    <th width="17%">Deduction/Compensation</th>
    <th width="22%">Actions</th>
  </tr>
  <?php $i = 1;?>
  <?php foreach ($rows as $row): ?>
  		<?php $bg = $this->Helps->set_line_colors();?>
      <tr bgcolor="<?php echo $bg;?>" onmouseover="this.bgColor = '<?php echo $this->config->item('mouseover_linecolor')?>';" 
    onmouseout ="this.bgColor = '<?php echo $bg;?>';" id="<?php echo $row->id?>">
        <td><?php echo $i;?></td>
        <td><?php echo $row->type;?></td>
        <td><?php echo $row->line;?></td>
        <td><?php echo $row->caption;?></td>
        <td><?php echo ( ! isset($row->deduction_addcom->code)) ? '' : $row->deduction_addcom->code;?></td>
        <td><a href="<?php echo base_url().'payroll/report/headings_save/'.$row->id;?>">Edit</a><!-- | <a href="<?php echo base_url().'payroll/deduction/agency_delete/'.$row->id;?>">Delete</a>--></td>
      </tr>
      <?php $i ++;?>
  <?php endforeach; ?>
  <tr>
    <td colspan="6">&nbsp;</td>
  </tr>
</table>


<table width="100%" border="0" class="type-one" id="headings2">
  <tr class="type-one-header">
    <th width="6%">Number</th>
    <th width="11%">Type</th>
    <th width="10%">Line</th>
    <th width="34%">Caption</th>
    <th width="17%">Deduction/Compensation</th>
    <th width="22%">Actions</th>
  </tr>
  <?php $i = 1;?>
  <?php foreach ($rows2 as $row): ?>
  		<?php $bg = $this->Helps->set_line_colors();?>
      <tr bgcolor="<?php echo $bg;?>" onmouseover="this.bgColor = '<?php echo $this->config->item('mouseover_linecolor')?>';" 
    onmouseout ="this.bgColor = '<?php echo $bg;?>';" id="<?php echo $row->id?>">
        <td><?php echo $i;?></td>
        <td><?php echo $row->type;?></td>
        <td><?php echo $row->line;?></td>
        <td><?php echo $row->caption;?></td>
        <td><?php echo ( ! isset($row->deduction_addcom->code)) ? '' : $row->deduction_addcom->code;?></td>
        <td><a href="<?php echo base_url().'payroll/report/headings_save/'.$row->id;?>">Edit</a><!-- | <a href="<?php echo base_url().'payroll/deduction/agency_delete/'.$row->id;?>">Delete</a>--></td>
      </tr>
      <?php $i ++;?>
  <?php endforeach; ?>
  <tr>
    <td colspan="6">&nbsp;</td>
  </tr>
</table>


<script type="text/javascript">
$(document).ready(function(){ 
						   
	$(function() {
		$("#contentLeft ul").sortable({ opacity: 0.6, cursor: 'move', update: function() {
			var order = $(this).sortable("serialize") + '&action=updateRecordsListings'; 
			$.post("updateDB.php", order, function(theResponse){
				$("#contentRight").html(theResponse);
			}); 															 
		}								  
		});
	});

});	
</script>
<script type="text/javascript">
$(document).ready(function() {
    
   $('#headings').tableDnD({
    onDrop: function(table, row) {
		var order = $.tableDnD.serialize();
		
		$.post("<?php echo base_url().'payroll/report/sortable'?>", order, function(theResponse){
				//$("#contentRight").html(theResponse);
			}); 
    }
	});
	
	  
   $('#headings2').tableDnD({
    onDrop: function(table, row) {
		var order = $.tableDnD.serialize();
		
		$.post("<?php echo base_url().'payroll/report/sortable'?>", order, function(theResponse){
				//$("#contentRight").html(theResponse);
			}); 
    }
	});
});


</script>