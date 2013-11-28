<script type="text/javascript" src="<?php echo base_url();?>js/edit_place/sack.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/edit_place/datagrid.js"></script>
<script type="text/javascript">
//var dtr = new dataGrid('dtr','edit_place.php');
var dtr = new dataGrid('dtr','<?php echo base_url();?>ajax/edit_place');
dtr.m_columns['am_login']={'coltype':'text','style':''};
dtr.m_columns['am_logout']={'coltype':'text','style':''};
dtr.m_columns['pm_login']={'coltype':'text','style':''};
dtr.m_columns['pm_logout']={'coltype':'text','style':''};
dtr.m_columns['ot_login']={'coltype':'text','style':''};
dtr.m_columns['ot_logout']={'coltype':'text','style':''};
dtr.m_columns['ob_leave']={'coltype':'text','style':''};
</script>
<span id="dtr.span">
<form method="post" action="" enctype="multipart/form-data">
<table id="dtr.table" width="100%" border="0" class="type-one">
  <tr class="type-one-header">
    <th colspan="10" align="left" bgcolor="#D6D6D6"><div id="outputname"></div></th>
  </tr>
  <tr class="type-one-header">
    <th colspan="10" align="left" bgcolor="#D6D6D6"><strong>
      <?php $js = 'onchange="this.form.submit();"';echo form_dropdown('office_id', $options, $selected);?>
      <input name="op" type="hidden" id="op" value="1" />
      <input name="employee_id" type="text" id="employee_id" value="<?php echo Input::get('employee_id');?>" size="10" placeholder="Employee ID" />
      <input name="date" type="text" class="ilaw" id="date" onfocus="this.style.margin = '0'; this.style.borderWidth = '2px'; this.style.backgroundColor = '#FFFFFF';" onblur="this.style.margin = '1px'; this.style.borderWidth = '1px'; this.style.backgroundColor = '#E9F0F5';" value="<?php echo $date;?>" size="11" maxlength="10" />
      <input name="this_only" type="checkbox" id="this_only" value="1" />
    to 
    <input name="date2" type="text" class="ilaw" id="date2" onfocus="this.style.margin = '0'; this.style.borderWidth = '2px'; this.style.backgroundColor = '#FFFFFF';" onblur="this.style.margin = '1px'; this.style.borderWidth = '1px'; this.style.backgroundColor = '#E9F0F5';" value="<?php echo $date2;?>" size="11" maxlength="10" />
    <input name="go" type="submit"  id="go"  value="Go"/>
    <input name="dtr2" type="submit" id="dtr2" value="View DTR" />
    <input name="lname" type="hidden" id="lname" />
    <input name="fname" type="hidden" id="fname" />
    <input name="una" type="hidden" id="una" size="2" />
    <input name="dalawa" type="hidden" id="dalawa" size="2" />
    <input name="log" type="hidden" id="log" size="10" />
    <input name="row_id" type="hidden" id="row_id" size="10" />
    <input name="keycode" type="hidden" id="keycode" size="10" />
    <input name="new_val" type="hidden" id="new_val" value="<?php echo $am_initial = 0;?>" size="10" />
    <input name="arrow" type="hidden" id="arrow" value="1" size="6" />
    </strong>
    <?php $show_incomplete_logs = Setting::getField( 'show_incomplete_logs' );?>
    <?php if ($show_incomplete_logs == 'yes'):?>
      <table width="385" border="0">
        <tr>
          <td><input name="double_incomplete" type="checkbox" id="double_incomplete" value="1" />
            <label for="double_incomplete">Show Incomplete logs </label></td>
          <td>&nbsp;</td>
        </tr>
      </table>
      <?php endif;?>
      </th>
  </tr>
  <tr class="type-one-header">
    <th width="7%" bgcolor="#D6D6D6">Date</th>
    <th width="7%" bgcolor="#D6D6D6"><strong>Employee No.</strong></th>
    <th width="18%" bgcolor="#D6D6D6"><strong>Employee Name</strong></th>
    <th width="8%" bgcolor="#D6D6D6">AM Login</th>
    <th width="9%" bgcolor="#D6D6D6">AM Logout </th>
    <th width="8%" bgcolor="#D6D6D6">PM Login</th>
    <th width="9%" bgcolor="#D6D6D6">PM Logout </th>
    <th width="9%" bgcolor="#D6D6D6">OT Login</th>
    <th width="8%" bgcolor="#D6D6D6">OT Logout </th>
    <th width="17%" bgcolor="#D6D6D6">OB/LEAVE</th>
  </tr>
  
  <?php 
  $p = new Permission_m();
	$permissions = $p->get_by_group_id($this->session->userdata('group_id'));
			
	$read_only = FALSE;
	
	foreach ( $permissions as $permission)
	{
		if ( $permission->module == 'attendance')
		{
			$users_methods_access = json_decode($permission->roles);
			
			if (in_array('view_attendance_only', $users_methods_access))
			{
				$read_only = TRUE;
			}
			
		}
	}
  
  ?>
  
  <?php 
	 
	//number of results
	
	$id = 1;
	
	$i = 1;
	$array = '[';	
	
	$minutes_tardy = Setting::getField('minutes_tardy');
		
	foreach($rows as $row)
	{
		$id	= $row['id'];
		
		if (!isset($js_id))
		{
			$js_id = $id;
		}
		
		if (!isset($am_initial))
		{
			$am_initial = $row['am_login'];
		}
		
		$array .='"'.$id.'",';
		
		$employee_id= $row['employee_id'];
		$log_date= date('m-d-Y',strtotime($row['log_date']));
		$am_login	= $row['am_login'];
		$am_logout	= $row['am_logout'];
		$pm_login	= $row['pm_login'];
		$pm_logout	= $row['pm_logout'];
		$ot_login	= $row['ot_login'];
		$ot_logout	= $row['ot_logout'];
		
		$lname		= $row['lname'];
		$fname		= $row['fname'];
		$shift_type = $row['shift_type'];
		
		//If shift type is equal to 1 or regular working hours
		if ($shift_type == 1)
		{
			
			if ($minutes_tardy != 1)
			{
				if ($am_login > '08:00')
				{
				
					$seconds_late = strtotime($am_login) - strtotime('08:00');
					
					if ($seconds_late >= ($minutes_tardy * 60))
					{					
						$am_login = $this->Helps->set_font_red($am_login, "08:00", 0);	
					}
					else
					{
						$am_login = $this->Helps->set_font_maroon($am_login, 0);
					}
				}
				//echo $pm_login;
				//for pm
				if ($pm_login > '13:00')
				{
				
					$seconds_late = strtotime($pm_login) - strtotime('13:00');
					
					//echo $seconds_late.'<br>';
					if ($seconds_late >= ($minutes_tardy * 60))
					{
						$pm_login = $this->Helps->set_font_red($pm_login, "13:00", 1);	
					}
					else
					{
						$pm_login = $this->Helps->set_font_maroon($pm_login, 1);
					}
				}
				else
				{
					if ($pm_login != '')
					{
						$pm_login = $this->Helps->set_font_red($pm_login, "13:00", 1);
					}
					
				}
			}
			else
			{			
				//echo $pm_login;
				$am_login = $this->Helps->set_font_red($am_login, "08:00", 0);
								
				$pm_login = $this->Helps->set_font_red($pm_login, "13:00", 1);
				
				
			}
		}
		
		
		
		//$pm_login = $this->Helps->change_format($pm_login, 1, $format = '');
		
		$pm_logout = $this->Helps->change_format($pm_logout, 1, $format = '');
		
		$ot_login = $this->Helps->change_format($ot_login, 1, $format = '');
		
		$ot_logout = $this->Helps->change_format($ot_logout, 1, $format = '');
		
		$onclick0 = "onClick=\"dg_editCell(dtr,'".$id."','am_login','dtr.0.$i','dtr')\"";
		$onclick1 = "onClick=\"dg_editCell(dtr,'".$id."','am_logout','dtr.1.$i','dtr')\"";
		$onclick2 = "onClick=\"dg_editCell(dtr,'".$id."','pm_login','dtr.2.$i','dtr')\"";
		$onclick3 = "onClick=\"dg_editCell(dtr,'".$id."','pm_logout','dtr.3.$i','dtr')\"";
		$onclick4 = "onClick=\"dg_editCell(dtr,'".$id."','ot_login','dtr.4.$i','dtr')\"";
		$onclick5 = "onClick=\"dg_editCell(dtr,'".$id."','ot_logout','dtr.5.$i','dtr')\"";
		$onclick6 = "onClick=\"dg_editCell(dtr,'".$id."','ob_leave','dtr.6.$i','ob_leave')\"";
		
		
		if ( $this->session->userdata('user_type') == 6 or $this->session->userdata('user_type') == 8 or $this->session->userdata('user_type') == 5)
  		{
			$onclick0 = "";
			$onclick1 = "";
			$onclick2 = "";
			$onclick3 = "";
			$onclick4 = "";
			$onclick5 = "";
			$onclick6 = "";
		}
		
		if ( $read_only == TRUE)
		{
			$onclick0 = "";
			$onclick1 = "";
			$onclick2 = "";
			$onclick3 = "";
			$onclick4 = "";
			$onclick5 = "";
			$onclick6 = "";
			
			// Lets add edited logs
			$orig_dtr = json_decode($row['orig_dtr']);
			
			if ($orig_dtr != NULL)
			{
				$am_login .= isset($orig_dtr->am_login) ? '<font color="green">('.$orig_dtr->am_login.')</font>' : '';
				$am_logout .= isset($orig_dtr->am_logout) ? '<font color="green">('.$orig_dtr->am_logout.')</font>' : '';
				$pm_login .= isset($orig_dtr->pm_login) ? '<font color="green">('.$orig_dtr->pm_login.')</font>' : '';
				$pm_logout .= isset($orig_dtr->pm_logout) ? '<font color="green">('.$orig_dtr->pm_logout.')</font>' : '';
				//var_dump($orig_dtr);
			}
			
		}
		
		$bg1 = $this->Helps->is_log_blank($am_login);
		$bg2 = $this->Helps->is_log_blank($am_logout);
		$bg3 = $this->Helps->is_log_blank($pm_login);
		$bg4 = $this->Helps->is_log_blank($pm_logout);
				
		list($log_year, $log_month, $log_day) = explode('-', $row['log_date']);
		
		$sat_or_sun = $this->Helps->is_sat_sun($log_month, $log_day, $log_year);
				
		if ($sat_or_sun == 'Saturday' || $sat_or_sun == 'Sunday')
		{
			$log_date = '<b><font color="red">'.$log_date.'</font></b>';
		}
		else
		{
			$log_date = $log_date;
		}
		
		$notes = '';
		
		if ($row['manual_log_id'] != '')
		{
			$notes = $this->Manual_log->get_notes($row['manual_log_id']);
		}
		
		//check the late, undertime and tardiness here right away
		
		$bg = $this->Helps->set_line_colors();
		
		?>
		
  <tr bgcolor="<?php echo $bg;?>" onmouseover="this.bgColor = '<?php echo $this->config->item('mouseover_linecolor')?>';" 
    onmouseout ="this.bgColor = '<?php echo $bg;?>';" style="border-bottom: 1px solid #999999;">
    <td bgcolor=""><?php echo $log_date;?></td>
    <td bgcolor=""><?php echo $employee_id;?></td>
    <td bgcolor=""><?php echo $lname.', '.$fname;?></td>
    <td align="center" bgcolor="<?php echo $bg1;?>" id="dtr.0.<?php echo $i;?>" <?php echo $onclick0;?> class="tae"><?php echo $am_login;?></td>
    <td align="center" bgcolor="<?php echo $bg2;?>" id="dtr.1.<?php echo $i;?>" <?php echo $onclick1;?>><?php echo $am_logout;?></td>
    <td align="center" bgcolor="<?php echo $bg3;?>" id="dtr.2.<?php echo $i;?>" <?php echo $onclick2;?>><?php echo $pm_login;?></td>
    <td align="center" bgcolor="<?php echo $bg4;?>" id="dtr.3.<?php echo $i;?>" <?php echo $onclick3;?>><?php echo $pm_logout;?></td>
    <td align="center" bgcolor="" id="dtr.4.<?php echo $i;?>" <?php echo $onclick4;?>><?php echo $ot_login;?></td>
    <td align="center" bgcolor="" id="dtr.5.<?php echo $i;?>" <?php echo $onclick5;?>><?php echo $ot_logout;?></td>
    <td align="center" bgcolor="" id="dtr.6.<?php echo $i;?>" <?php echo $onclick6;?>><?php echo $notes;?></td>
  </tr>
  <?php
		
		$i ++;
		}
		$array .='""]';
		$last_id = $id;
		$count = $i - 1;
		
	  ?>
  <tr>
    <td colspan="10">
        </td>
  </tr>
</table>
</form>
</span>
<?php if ( $this->session->userdata('user_type') == 6 or $this->session->userdata('user_type') == 8 or $this->session->userdata('user_type') == 5 or $read_only == TRUE):?>

<?php else:?>
	<script>
	dg_editCell(dtr, '<?php echo $js_id;?>','am_login','dtr.0.1','dtr')
	</script>
<?php endif;?>

<script type="text/javascript">

$('#employee_id').keyup(function(){

	if ($('#employee_id').val() == "" || $('#employee_id').val() == undefined || $('#employee_id').val() == 0)
	{
		//alert("Please enter a valid employee no.");
		$('#outputname').html("Please enter a valid employee no.");
		return
	}
	else
	{
		$('#outputname').load("<?php echo base_url().('ajax/view_name/'); ?>" + $('#employee_id').val());
		
		return true;
		//$('#go').focus();
		
	}
});

function change_value(new_value)
{
	
	$('#outputname').load("<?php echo base_url().('ajax/view_name/'); ?>" + new_value);
	$('#employee_id').val(new_value);
}

$('#office_id').focus(function(e){
	
	$("#arrow").val(0)
});
$('#employee_id').focus(function(e){
	
	$("#arrow").val(0)
});
$('#date').focus(function(e){
	
	$("#arrow").val(0)
});
$('#date2').focus(function(e){
	
	$("#arrow").val(0)
});

$(document).keydown(function(e){


	// Use for detecting tab
	var keycode;
  if (window.event) {
    keycode = window.event.keyCode;
  } else if (e) { 
    keycode = e.which;
  } else {
    return true;
  }

  if (keycode == 9 || keycode == 13) { // if is the tab key
    // Do stuff, return false to prevent key from being output
	//alert("")
	
	// If the cursor is in the employee_id date or date 2
	// and the enter key has been pressed
	if ($("#arrow").val() == 0 && keycode == 13)
	{
		return true;
	}
	
	e.preventDefault();
	//alert("enter")
	//return false;
  }


$("#keycode").val(e.keyCode)


if ($("#arrow").val() == 0)
{
	return;
}

//=======LEFT=========
 if (e.keyCode == 37) 
 { 
       
	  var dtr3 = "dtr."+ $('#una').val() +"." + $('#dalawa').val()
		
	  dg_editCell2(dtr, $('#row_id').val(), $('#log').val() ,dtr3,'dtr')
	   
	   
	  var una = parseInt($('#una').val()) - 1
	  var dalawa = parseInt($('#dalawa').val())
	  var log2
	  $("#keycode").val(e.keyCode)
	  
	  if ($('#log').val() == "ob_leave")
	  {
	  	log2 = "ot_logout"
		
	  }
	  if ($('#log').val() == "ot_logout")
	  {
	  	log2 = "ot_login"
	  }
	   if ($('#log').val() == "ot_login")
	  {
	  	log2 = "pm_logout"
	  }
	   if ($('#log').val() == "pm_logout")
	  {
	  	log2 = "pm_login"
	  }
	   if ($('#log').val() == "pm_login")
	  {
	  	log2 = "am_logout"
	  }
	   if ($('#log').val() == "am_logout")
	  {
	  	log2 = "am_login"
	  }
	  if ($('#log').val() == "am_login")
	  {
	  	log2 = "ob_leave"
		una = 6
		
		
		//====================================
		
		
		var array=new Array();
		
		$.each( <?php echo $array;?>, function(i, l){
	   //alert( "Index #" + i + ": " + l );
		  
		array[i] = l
	   
		});
		
		//remove last element of an array
		array.pop();
		
		var next_id = 0;
		//var last_id = array.pop();
		
		for(var i=0;i<array.length;i++)
		{
			//document.write(array[i]+"<br>")
			if (array[i] == parseInt($('#row_id').val()))
		   {
				if (next_id == 0 || next_id == "")
				{
					next_id = array[i-1]
					$('#row_id').val(next_id);
				}
				
		   }
		  
		}
		
		dalawa = dalawa - 1
		
		//if first array
		if (parseInt($('#una').val()) == 0 && parseInt($('#dalawa').val()) == 1)
		{
			una = 6;
			dalawa = <?php echo $count;?>;
			$('#row_id').val(<?php echo $last_id;?>);
		}
		//==============================================
		
		
		
	  }
	  
	  dtr2 = "dtr."+ una +"." + dalawa
	
	  dg_editCell(dtr, parseInt($('#row_id').val()), log2 ,dtr2,'dtr')
	   
      
 }
	//==========UP=============
	if (e.keyCode == 38) { 
       var dtr3 = "dtr."+ $('#una').val() +"." + $('#dalawa').val()
		
	   dg_editCell2(dtr, $('#row_id').val(), $('#log').val() ,dtr3,'dtr')
	   
	   $("#keycode").val(e.keyCode)
       //return false;
	   var una = parseInt($('#una').val())
	   var dalawa = parseInt($('#dalawa').val()) - 1
	   var log2
	   
	   log2 = $('#log').val()
	   
	   
	   
	   //=======================================
	   
	   var array=new Array();
		
		$.each( <?php echo $array;?>, function(i, l){
	   //alert( "Index #" + i + ": " + l );
		  
		array[i] = l
	   
		});
		
		//remove last element of an array
		array.pop();
		
		var next_id = 0;
		//var last_id = array.pop();
		
		for(var i=0;i<array.length;i++)
		{
			//document.write(array[i]+"<br>")
			if (array[i] == parseInt($('#row_id').val()))
		   {
				if (next_id == 0 || next_id == "")
				{
					next_id = array[i-1]
					$('#row_id').val(next_id);
				}
				
		   }
		  
		}
		
		//==============================================
	    //if last
		if (parseInt($('#dalawa').val()) == 1)
		{
			una = $('#una').val();
			dalawa = <?php echo $count;?>;
			$('#row_id').val(<?php echo $last_id;?>);
		}
	   
	   
	   
	   dtr2 = "dtr."+ una +"." + dalawa

	   dg_editCell(dtr, parseInt($('#row_id').val()), log2 ,dtr2,'dtr')
    }
	
	//Press right or tab
	if (e.keyCode == 39 || keycode == 9) { 
	
	  var dtr3 = "dtr."+ $('#una').val() +"." + $('#dalawa').val()
		
	  dg_editCell2(dtr, $('#row_id').val(), $('#log').val() ,dtr3,'dtr')
	
      $("#keycode").val(e.keyCode)
	  var una = parseInt($('#una').val()) + 1
	  var dalawa = parseInt($('#dalawa').val())
	  var log2
	  
	  if ($('#log').val() == "am_login")
	  {
	  	log2 = "am_logout"
	  }
	  
	  if ($('#log').val() == "am_logout")
	  {
	  	log2 = "pm_login"
	  }
	   if ($('#log').val() == "pm_login")
	  {
	  	log2 = "pm_logout"
	  }
	   if ($('#log').val() == "pm_logout")
	  {
	  	log2 = "ot_login"
	  }
	   if ($('#log').val() == "ot_login")
	  {
	  	log2 = "ot_logout"
	  }
	  if ($('#log').val() == "ot_logout")
	  {
	  	log2 = "ob_leave"
	  }
	  
	  if ($('#log').val() == "ob_leave")
	  {
	  	dalawa = parseInt($('#dalawa').val()) + 1
		log2 = "am_login"
		una = 0
		
		
		var array=new Array();
		
		$.each( <?php echo $array;?>, function(i, l){
	   //alert( "Index #" + i + ": " + l );
		  
		array[i] = l
	   
		});
		
		//remove last element of an array
		array.pop();
		
		var next_id = 0;
		//var last_id = array.pop();
		
		for(var i=0;i<array.length;i++)
		{
			//document.write(array[i]+"<br>")
			if (array[i] == parseInt($('#row_id').val()))
		   {
				if (next_id == 0 || next_id == "")
				{
					next_id = array[i+1]
					$('#row_id').val(next_id);
				}
				
		   }
		  
		}
		
		//if last array
		if (parseInt($('#row_id').val()) == <?php echo $last_id;?> && parseInt($('#dalawa').val()) == <?php echo $count;?>)
		{
			una = 0;
			dalawa = 1;
			$('#row_id').val(<?php echo $js_id;?>);
		}
			
	  }
	  
	   
	  dtr2 = "dtr."+ una +"." + dalawa
		
		
		
	  dg_editCell(dtr, parseInt($('#row_id').val()), log2 ,dtr2,'dtr')
	  
    }
	////==============DOWN or enter================
	if (e.keyCode == 40 || keycode == 13) { 
       var dtr3 = "dtr."+ $('#una').val() +"." + $('#dalawa').val()
		
	   dg_editCell2(dtr, $('#row_id').val(), $('#log').val() ,dtr3,'dtr')
	   
	   $("#keycode").val(e.keyCode)
       //return false;
	   var una = parseInt($('#una').val())
	   var dalawa = parseInt($('#dalawa').val()) + 1
	   var log2
	   
	   log2 = $('#log').val()
	   
	   
	   
	   
	   //=======================================
	   
	   var array=new Array();
		
		$.each( <?php echo $array;?>, function(i, l){
	   //alert( "Index #" + i + ": " + l );
		  
		array[i] = l
	   
		});
		
		//remove last element of an array
		array.pop();
		
		var next_id = 0;
		//var last_id = array.pop();
		
		for(var i=0;i<array.length;i++)
		{
			//document.write(array[i]+"<br>")
			if (array[i] == parseInt($('#row_id').val()))
		   {
				if (next_id == 0 || next_id == "")
				{
					next_id = array[i+1]
					$('#row_id').val(next_id);
				}
				
		   }
		  
		}
		
		//==============================================
	   //if last
		if (parseInt($('#dalawa').val()) == <?php echo $count;?>)
		{
			una = $('#una').val();
			dalawa = 1;
			$('#row_id').val(<?php echo $js_id;?>);
		}
	   
	   
	   
	   
	   
	   
	   dtr2 = "dtr."+ una +"." + dalawa

	   dg_editCell(dtr, parseInt($('#row_id').val()), log2 ,dtr2,'dtr')
    }
});


//dg_editCell(dtr,'994','am_login','dtr.0.8','dtr')
</script>