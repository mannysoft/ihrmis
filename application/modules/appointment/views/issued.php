<?php if (validation_errors()): ?>
<div class="clean-red"><?php echo validation_errors(); ?></div>
<?php elseif ($this->session->flashdata('msg')): ?>
<div class="clean-green"><?php echo $this->session->flashdata('msg');?></div>
<?php else: ?>
<?php endif; ?>
<form action="" method="post">
  <table width="100%" border="0">
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><a href="<?php echo base_url();?>office_manage/add_office">Add Office</a></td>
    </tr>
    <tr>
      <td width="9%"><?php echo $msg;?></td>
      <td width="79%">&nbsp;</td>
      <td width="12%"></td>
    </tr>
  </table>
  <table width="100%" border="0" class="type-one">
    <tr class="type-one-header">
      <th bgcolor="#D6D6D6">&nbsp;</th>
      <th bgcolor="#D6D6D6">&nbsp;</th>
      <th bgcolor="#D6D6D6">&nbsp;</th>
      <th bgcolor="#D6D6D6">&nbsp;</th>
      <th bgcolor="#D6D6D6">&nbsp;</th>
      <th bgcolor="#D6D6D6">&nbsp;</th>
      <th colspan="4" bgcolor="#D6D6D6">Date</th>
      <th bgcolor="#D6D6D6">&nbsp;</th>
      <th bgcolor="#D6D6D6">&nbsp;</th>
      <th bgcolor="#D6D6D6">&nbsp;</th>
      <th bgcolor="#D6D6D6">&nbsp;</th>
      <th bgcolor="#D6D6D6">&nbsp;</th>
      <th bgcolor="#D6D6D6">&nbsp;</th>
      <th bgcolor="#D6D6D6">&nbsp;</th>
      <th bgcolor="#D6D6D6">&nbsp;</th>
      <th bgcolor="#D6D6D6">&nbsp;</th>
      <th bgcolor="#D6D6D6">&nbsp;</th>
      <th bgcolor="#D6D6D6">&nbsp;</th>
      <th bgcolor="#D6D6D6">&nbsp;</th>
    </tr>
    <tr class="type-one-header">
      <th width="6%" bgcolor="#D6D6D6">Name of Appointee</th>
      <th width="19%" bgcolor="#D6D6D6"><strong>Position Title</strong></th>
      <th width="15%" bgcolor="#D6D6D6">SG</th>
      <th width="9%" bgcolor="#D6D6D6">Status</th>
      <th width="20%" bgcolor="#D6D6D6">Nature</th>
      <th width="17%" bgcolor="#D6D6D6">Item No</th>
      <th width="17%" bgcolor="#D6D6D6">Publication</th>
      <th width="17%" bgcolor="#D6D6D6">Issuance</th>
      <th width="17%" bgcolor="#D6D6D6">Received by CSC</th>
      <th width="17%" bgcolor="#D6D6D6">Acted Upon</th>
      <th width="17%" bgcolor="#D6D6D6">KSS Form</th>
      <th width="17%" bgcolor="#D6D6D6">PDF</th>
      <th width="17%" bgcolor="#D6D6D6">PDS</th>
      <th width="17%" bgcolor="#D6D6D6">Education</th>
      <th width="17%" bgcolor="#D6D6D6">Eligibility</th>
      <th width="17%" bgcolor="#D6D6D6">NBI Clearance</th>
      <th width="17%" bgcolor="#D6D6D6">Oath of Office</th>
      <th width="17%" bgcolor="#D6D6D6">Med. Cert.</th>
      <th width="17%" bgcolor="#D6D6D6">SALN</th>
      <th width="17%" bgcolor="#D6D6D6">PES</th>
      <th width="17%" bgcolor="#D6D6D6">Remarks</th>
      <th width="14%" bgcolor="#D6D6D6"><strong>Action</strong></th>
    </tr>
    <?php $e = new Employee_m();?>
    <?php foreach($rows as $row):?>
    <?php $e->get_by_id($row->employee_id);?>
    <?php $bg = $this->Helps->set_line_colors(); ?>
    <tr bgcolor="<?php echo $bg;?>" onmouseover="this.bgColor = '<?php echo $this->config->item('mouseover_linecolor')?>';" 
    onmouseout ="this.bgColor = '<?php echo $bg;?>';">
      <td bgcolor=""><?php echo $e->lname.', '.$e->fname.' '.$e->mname;?></td>
      <td bgcolor=""><?php echo $row->position;?></td>
      <td bgcolor=""><?php echo $row->sg;?></td>
      <td bgcolor=""><?php echo $row->status;?></td>
      <td bgcolor=""><?php echo $row->nature;?></td>
      <td bgcolor=""><?php echo $row->item_no;?></td>
      <td bgcolor=""><?php echo $row->publication;?></td>
      <td bgcolor=""><?php echo $row->issuance;?></td>
      <td bgcolor=""><?php echo $row->received_csc;?></td>
      <td bgcolor=""><?php echo $row->acted_upon;?></td>
      <td bgcolor=""><?php echo $row->kss;?></td>
      <td bgcolor=""><?php echo $row->pdf;?></td>
      <td bgcolor=""><?php echo $row->pds;?></td>
      <td bgcolor=""><?php echo $row->education;?></td>
      <td bgcolor=""><?php echo $row->eligibility;?></td>
      <td bgcolor=""><?php echo $row->nbi;?></td>
      <td bgcolor=""><?php echo $row->oath;?></td>
      <td bgcolor=""><?php echo $row->med_cert;?></td>
      <td bgcolor=""><?php echo $row->saln;?></td>
      <td bgcolor=""><?php echo $row->pes;?></td>
      <td bgcolor=""><?php echo $row->remarks;?></td>
      <td align="right" bgcolor=""><a href="<?php echo base_url();?>office_manage/delete_office/<?php //echo $office_id;?>" class="delete_office">Delete</a> <a href="<?php echo base_url();?>office_manage/edit_office/<?php //echo $office_id;?>">Edit</a> | <a href="<?php echo base_url();?>office_manage/divisions/<?php //echo $office_id;?>">Divisions</a></td>
    </tr>
    <?php endforeach;?>
    <tr>
      <td colspan="3"><?php echo $this->pagination->create_links(); ?></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><input name="op" type="hidden" id="op" value="1" /></td>
    </tr>
  </table>
</form>
<script>
$('.delete_office').click(function(){

	var answer = confirm("Are you sure?")
	
	if (!answer)
	{
		return false;
	}
});
</script>