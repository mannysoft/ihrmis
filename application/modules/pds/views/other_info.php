
<table width="100%" border="0">
  <tr>
    <td width="19%" rowspan="3" valign="top"><table width="200" border="0">
    <tr>
      <td>
      <?php $this->load->view('menu');?>
</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>&nbsp;</td>
    <td width="79%" valign="top">
    <?php $this->load->view('name_tag');?>
    </td>
    <td width="2%">&nbsp;</td>
  </tr>
  <tr>
    <td>
    <?php if ($msg != ''): ?>
    <div class="clean-green"><?php echo $msg;?></div>
    <?php endif; ?>
    </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><form action="" method="post">
    <fieldset class="adminform">
      <legend>Other Information</legend>
      <table width="97%" cellspacing="1" class="admintable">
      <tbody>
        <tr>
          <td width="14%" align="center" valign="top">SPECIAL SKILLS/HOBBIES </td>
          <td align="center" valign="top" >NON-ACADEMIC DISTINCTIONS/ RECOGNITION </td>
          <td align="center" valign="top" >MEMBERSHIP IN ASSOCIATION/ ORGANIZATION<br />
            (Write in full) </td>
          <td width="0%" valign="top" >&nbsp;</td>
        </tr>
        <?php $i = 0;?>
			
		<?php foreach ($infos as $info):?>	
                <tr>
                  <td><input name="skill[]" type="text" id="skill" value="<?php echo $info->special_skills;?>" size="30" /></td>
                  <td width="14%"><input name="recognition[]" type="text" id="recognition[]" value="<?php echo $info->recognition;?>" size="45" /></td>
                  <td width="6%"><input name="membership_organization[]" type="text" id="membership_organization[]" value="<?php echo $info->membership_organization;?>" size="30" /></td>
                  <td>&nbsp;</td>
                </tr>
                <?php $i ++;?>
                <?php endforeach;?>
		
			  <?php if ($i <= 7):?>
			   <?php while($i != 7):?>
			
					
                        <tr>
                          <td><input name="skill[]" type="text" id="skill" size="30" /></td>
                          <td width="14%"><input name="recognition[]" type="text" id="recognition[]" size="45" /></td>
                          <td width="6%"><input name="membership_organization[]" type="text" id="membership_organization[]" size="30" /></td>
                          <td>&nbsp;</td>
                        </tr>
                        <?php $i ++;?>
			 <?php endwhile;?>
			<?php endif;?>
           
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td colspan="3">36. Are you related by consanguinity or affinity to any of the following: </td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td colspan="3">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td colspan="3">a.) Within the third degree (For National Government Employees) </td>
          <td><?php echo form_dropdown('q[]', $question_options, $question1->answer);?></td>
        </tr>
        <tr>
          <td colspan="3">Appointing authority, recommeding authority, chief of office/bureau/department or person who has </td>
          <td>If yes, give details </td>
        </tr>
        <tr>
          <td colspan="3">immediate supervision over you in the Office, Bureau or Department where you will be appointed? </td>
          <td><input name="details[]" type="text" id="details[]" value="<?php echo $question1->details;?>" size="40" /></td>
        </tr>
        <tr>
          <td colspan="4">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="3">b.) Within the fourth degree (for Local Government Employees) </td>
          <td><?php echo form_dropdown('q[]', $question_options, $question2->answer);?></td>
        </tr>
        <tr>
          <td height="25" colspan="3">Appointing authority or recommending authority where you will be appointed? </td>
          <td>If yes, give details </td>
        </tr>
        <tr>
          <td height="24" colspan="3">&nbsp;</td>
          <td><input name="details[]" type="text" id="details[]" value="<?php echo $question2->details;?>" size="40" /></td>
        </tr>
        <tr>
          <td colspan="4"><hr /></td>
        </tr>
        <tr>
          <td colspan="4">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="4">37.</td>
        </tr>
        <tr>
          <td colspan="3">a.) Have you ever been formaly charged? </td>
          <td><?php echo form_dropdown('q[]', $question_options, $question3->answer);?></td>
        </tr>
        <tr>
          <td colspan="3">&nbsp;</td>
          <td>If yes, give details </td>
        </tr>
        <tr>
          <td colspan="3">&nbsp;</td>
          <td><input name="details[]" type="text" id="details[]" value="<?php echo $question3->details;?>" size="40" /></td>
        </tr>
        <tr>
          <td colspan="4">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="3">b.) Have you been guilty of administrative offense? </td>
          <td><?php echo form_dropdown('q[]', $question_options, $question4->answer);?></td>
        </tr>
        <tr>
          <td colspan="3">&nbsp;</td>
          <td>If yes, give details </td>
        </tr>
        <tr>
          <td colspan="3">&nbsp;</td>
          <td><input name="details[]" type="text" id="details[]" value="<?php echo $question4->details;?>" size="40" /></td>
        </tr>
        <tr>
          <td colspan="4"><hr /></td>
        </tr>
        <tr>
          <td colspan="4">38.</td>
        </tr>
        <tr>
          <td colspan="3">Have you ever been convicted of any crime or violation of any law, decree, ordinance or </td>
          <td><?php echo form_dropdown('q[]', $question_options, $question5->answer);?></td>
        </tr>
        <tr>
          <td colspan="3">regulation by any court or tribunal? </td>
          <td>If yes, give details </td>
        </tr>
        <tr>
          <td colspan="3">&nbsp;</td>
          <td><input name="details[]" type="text" id="details[]" value="<?php echo $question5->details;?>" size="40" /></td>
        </tr>
        <tr>
          <td colspan="4"><hr /></td>
        </tr>
        <tr>
          <td colspan="4">39.</td>
        </tr>
        <tr>
          <td colspan="3">Have you ever been separate from the service in any of the following modes: resignation </td>
          <td><?php echo form_dropdown('q[]', $question_options, $question6->answer);?></td>
        </tr>
        <tr>
          <td colspan="3">retirement, cropped from the rolls, dismissal, termination, end of term, finished contract, AWOL or  </td>
          <td>If yes, give details </td>
        </tr>
        <tr>
          <td colspan="3">phased out, in the public or private sector? </td>
          <td><input name="details[]" type="text" id="details[]" value="<?php echo $question6->details;?>" size="40" /></td>
        </tr>
        <tr>
          <td colspan="4"><hr /></td>
        </tr>
        <tr>
          <td colspan="4">40.</td>
        </tr>
        <tr>
          <td colspan="3">Have you ever been candidate in the national or local election (except for barangay election) ? </td>
          <td><?php echo form_dropdown('q[]', $question_options, $question7->answer);?></td>
        </tr>
        <tr>
          <td colspan="3">&nbsp;</td>
          <td>If yes, give details </td>
        </tr>
        <tr>
          <td colspan="3">&nbsp;</td>
          <td><input name="details[]" type="text" id="details[]" value="<?php echo $question7->details;?>" size="40" /></td>
        </tr>
        <tr>
          <td colspan="4"><hr /></td>
        </tr>
        <tr>
          <td colspan="3">41. Pursuant to: (a) Indigenous People's Act (RA 8371) (b) Magna Carla for disabled persons (RA 727)</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td colspan="3">and (c) Solo Parents Welfare Act of 2000 (RA 8972) please answer the following items: </td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td colspan="4">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="3">a.) Are you a member of indigenous group? </td>
          <td><?php echo form_dropdown('q[]', $question_options, $question8->answer);?></td>
        </tr>
        <tr>
          <td colspan="3">&nbsp;</td>
          <td>If yes, please specify </td>
        </tr>
        <tr>
          <td colspan="3">&nbsp;</td>
          <td><input name="details[]" type="text" id="details[]" value="<?php echo $question8->details;?>" size="40" /></td>
        </tr>
        <tr>
          <td colspan="3">b.) Are you diffently abled? </td>
          <td><?php echo form_dropdown('q[]', $question_options, $question9->answer);?></td>
        </tr>
        <tr>
          <td colspan="3">&nbsp;</td>
          <td>If yes, please specify </td>
        </tr>
        <tr>
          <td colspan="3">&nbsp;</td>
          <td><input name="details[]" type="text" id="details[]" value="<?php echo $question9->details;?>" size="40" /></td>
        </tr>
        <tr>
          <td colspan="3">c.) Are you a solo parent? </td>
          <td><?php echo form_dropdown('q[]', $question_options, $question10->answer);?></td>
        </tr>
        <tr>
          <td colspan="3">&nbsp;</td>
          <td>If yes, please specify </td>
        </tr>
        <tr>
          <td colspan="3">&nbsp;</td>
          <td><input name="details[]" type="text" id="details[]" value="<?php echo $question10->details;?>" size="40" /></td>
        </tr>
        <tr>
          <td colspan="4"><hr /></td>
        </tr>
        <tr>
          <td colspan="4">42. REFERENCES (Person not related by consanguinity or affinity to applicant / appontee) </td>
        </tr>
        <tr>
          <td>NAME</td>
          <td>ADDRESS</td>
          <td>TEL. NO </td>
          <td>&nbsp;</td>
        </tr>
		 <?php 
			//for($i = 3; $i != 0; $i -- )
			$i = 0;
			foreach ($references as $reference)
			{
			?>
        <tr>
          <td><input name="ref_name[]" type="text" id="ref_name[]" value="<?php echo $reference->name;?>" /></td>
          <td><input name="ref_address[]" type="text" id="ref_address[]" value="<?php echo $reference->address;?>" /></td>
          <td><input name="ref_tel[]" type="text" id="ref_tel[]" value="<?php echo $reference->tel_no;?>" /></td>
          <td>&nbsp;</td>
        </tr>
		<?php 
		$i ++;
		}
		
		
		 if ($i <= 3)
			 {
					while($i != 3)
					{
						
						?>
                         <tr>
                          <td><input name="ref_name[]" type="text" id="ref_name[]" /></td>
                          <td><input name="ref_address[]" type="text" id="ref_address[]" /></td>
                          <td><input name="ref_tel[]" type="text" id="ref_tel[]" /></td>
                          <td>&nbsp;</td>
                        </tr>
                        <?php
						
						$i ++;
					}
			 }
		
		
		?>
		</tbody>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td align="right">&nbsp;</td>
        </tr>
        <tr>
          <td>COMMUNITY TAX CERTIFICATE NO.:</td>
          <td><input name="ctc_no" type="text" id="ctc_no" value="<?php echo $reference->ctc_no;?>" /></td>
          <td>&nbsp;</td>
          <td align="right">&nbsp;</td>
        </tr>
        <tr>
          <td>ISSUED AT:</td>
          <td><input name="issue_at" type="text" id="issue_at" value="<?php echo $reference->issue_at;?>" /></td>
          <td>&nbsp;</td>
          <td align="right">&nbsp;</td>
        </tr>
        <tr>
          <td>ISSUED ON (mm/dd/yyyy):</td>
          <td><input name="issue_on" type="text" id="issue_on" value="<?php echo $reference->issue_on;?>" /></td>
          <td>&nbsp;</td>
          <td align="right">&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td align="right"><SCRIPT>
	$(function() {
		$( "input:submit", ".demo" ).button();
		$( "input:submit", ".demo" ).click(function() { return true; });
	});
	</SCRIPT></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td><span style="clear: both;">
            <input type="submit" name="button" id="button" value="Save" />
            <input name="employee_id" type="hidden" id="employee_id" value="<?php echo $employee->employee_id;?>" />
            <input name="op" type="hidden" id="op" value="1" />
          </span></td>
          <td align="right">&nbsp;</td>
        </tr>
      </tbody>
    </table>
</fieldset></form></td>
    <td>&nbsp;</td>
  </tr>
</table>
