<script type="text/javascript" src="<?php echo base_url();?>js/edit_place/sack.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/edit_place/datagrid.js"></script>
<script type="text/javascript">
//var dtr = new dataGrid('dtr','edit_place.php');
var dtr = new dataGrid('dtr','<?php echo base_url();?>ajax/edit_place/schedule');
dtr.m_columns['hour_from']={'coltype':'text','style':''};
dtr.m_columns['hour_to']={'coltype':'text','style':''};
dtr.m_columns['pm_login']={'coltype':'text','style':''};
dtr.m_columns['pm_logout']={'coltype':'text','style':''};
dtr.m_columns['ot_login']={'coltype':'text','style':''};
dtr.m_columns['ot_logout']={'coltype':'text','style':''};
dtr.m_columns['ob_leave']={'coltype':'text','style':''};
</script>
<table width="100%" border="0">
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><a href="<?php echo base_url().'settings_manage/add_sched'?>">Create Schedule</a></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

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
      <input name="employee_id" type="text" id="employee_id" onclick="this.value=''" value="<?php echo $_POST['employee_id'];?>" size="10" />
      <input name="date" type="text" class="ilaw" id="date" onfocus="this.style.margin = '0'; this.style.borderWidth = '2px'; this.style.backgroundColor = '#FFFFFF';" onblur="this.style.margin = '1px'; this.style.borderWidth = '1px'; this.style.backgroundColor = '#E9F0F5';" value="<?php echo $date;?>" size="11" maxlength="10" />
      <input name="this_only" type="checkbox" id="this_only" value="1" />
    to 
    <input name="date2" type="text" class="ilaw" id="date2" onfocus="this.style.margin = '0'; this.style.borderWidth = '2px'; this.style.backgroundColor = '#FFFFFF';" onblur="this.style.margin = '1px'; this.style.borderWidth = '1px'; this.style.backgroundColor = '#E9F0F5';" value="<?php echo $date2;?>" size="11" maxlength="10" />
    <input name="go" type="submit"  id="go"  value="Go"/>
    <!--<input name="dtr2" type="submit" id="dtr2" value="View DTR" />-->
    <input name="lname" type="hidden" id="lname" />
    <input name="fname" type="hidden" id="fname" />
    <input name="una" type="hidden" id="una" size="2" />
    <input name="dalawa" type="hidden" id="dalawa" size="2" />
    <input name="log" type="hidden" id="log" size="10" />
    <input name="row_id" type="hidden" id="row_id" size="10" />
    <input name="keycode" type="hidden" id="keycode" size="10" />
    <input name="new_val" type="hidden" id="new_val" value="<?php echo $am_initial = 0;?>" size="10" />
    <input name="arrow" type="hidden" id="arrow" value="1" size="6" />
    </strong></th>
  </tr>
  <tr class="type-one-header">
    <th width="7%" bgcolor="#D6D6D6">Date</th>
    <th width="7%" bgcolor="#D6D6D6"><strong>Employee No.</strong></th>
    <th width="18%" bgcolor="#D6D6D6"><strong>Employee Name</strong></th>
    <th width="8%" bgcolor="#D6D6D6">From</th>
    <th width="9%" bgcolor="#D6D6D6">To </th>
    <th width="8%" bgcolor="#D6D6D6">&nbsp;</th>
    <th width="9%" bgcolor="#D6D6D6">&nbsp;</th>
    <th width="9%" bgcolor="#D6D6D6">&nbsp;</th>
    <th width="8%" bgcolor="#D6D6D6">&nbsp;</th>
    <th width="17%" bgcolor="#D6D6D6">&nbsp;</th>
  </tr>
  <?php 
	 
	//number of results
	
	$i =1;
	$array = '[';	
	
	$minutes_tardy = $this->Settings->get_selected_field('minutes_tardy');
		
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
		$hour_from	= $row['hour_from'];
		$date		= $row['date'];
		$hour_to	= $row['hour_to'];
		
		
		$lname		= $row['lname'];
		$fname		= $row['fname'];
		$shift_type = $row['shift_type'];
		
		$onclick0 = "onClick=\"dg_editCell(dtr,'".$id."','hour_from','dtr.0.$i','dtr')\"";
		$onclick1 = "onClick=\"dg_editCell(dtr,'".$id."','hour_to','dtr.1.$i','dtr')\"";
		//$onclick2 = "onClick=\"dg_editCell(dtr,'".$id."','pm_login','dtr.2.$i','dtr')\"";
		//$onclick3 = "onClick=\"dg_editCell(dtr,'".$id."','pm_logout','dtr.3.$i','dtr')\"";
		//$onclick4 = "onClick=\"dg_editCell(dtr,'".$id."','ot_login','dtr.4.$i','dtr')\"";
		//$onclick5 = "onClick=\"dg_editCell(dtr,'".$id."','ot_logout','dtr.5.$i','dtr')\"";
		//$onclick6 = "onClick=\"dg_editCell(dtr,'".$id."','ob_leave','dtr.6.$i','ob_leave')\"";
		
		$onclick2 = "";
		$onclick3 = "";
		$onclick4 = "";
		$onclick5 = "";
		$onclick6 = "";
		
		$bg1 = $this->Helps->is_log_blank($hour_from);
		$bg2 = $this->Helps->is_log_blank($hour_to);
		//$bg3 = $this->Helps->is_log_blank($pm_login);
		//$bg4 = $this->Helps->is_log_blank($pm_logout);
		
		list($log_year, $log_month, $log_day) = explode('-', $row['date']);
		
		$sat_or_sun = $this->Helps->is_sat_sun($log_month, $log_day, $log_year);
		
		if ($sat_or_sun == 'Saturday' || $sat_or_sun == 'Sunday')
		{
			$date = '<b><font color="red">'.$date.'</font></b>';
			
		}
		else
		{
			$date = $date;
			//echo 'ok';
		}
		
		$notes = '';
		
		//check the late, undertime and tardiness here right away
		
		$bg = $this->Helps->set_line_colors();
		
		?>
		
  <tr bgcolor="<?php echo $bg;?>" onmouseover="this.bgColor = '#ABC7E9';this.style.color='#000000';" 
    onmouseout ="this.bgColor = '<?php echo $bg;?>';this.style.color='#000000'">
    <td bgcolor=""><?php echo $date;?></td>
    <td bgcolor=""><?php echo $employee_id;?></td>
    <td bgcolor=""><?php echo $lname.', '.$fname;?></td>
    <td align="center" bgcolor="<?php echo $bg1;?>" id="dtr.0.<?php echo $i;?>" <?php echo $onclick0;?> class="tae"><?php echo $hour_from;?></td>
    <td align="center" bgcolor="<?php echo $bg2;?>" id="dtr.1.<?php echo $i;?>" <?php echo $onclick1;?>><?php echo $hour_to;?></td>
    <td align="center" bgcolor="<?php //echo $bg3;?>" id="dtr.2.<?php echo $i;?>" <?php echo $onclick2;?>><?php //echo $pm_login;?></td>
    <td align="center" bgcolor="<?php //echo $bg4;?>" id="dtr.3.<?php echo $i;?>" <?php echo $onclick3;?>><?php //echo $pm_logout;?></td>
    <td align="center" bgcolor="" id="dtr.4.<?php echo $i;?>" <?php echo $onclick4;?>><?php //echo $ot_login;?></td>
    <td align="center" bgcolor="" id="dtr.5.<?php echo $i;?>" <?php echo $onclick5;?>><?php //echo $ot_logout;?></td>
    <td align="center" bgcolor="" id="dtr.6.<?php echo $i;?>" <?php echo $onclick6;?>><?php //echo $notes;?></td>
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
<script>
dg_editCell(dtr, '<?php echo $js_id;?>','hour_from','dtr.0.1','dtr')
</script>

<script type="text/javascript">

$('#employee_id').keyup(function(){

	if ($('#employee_id').val() == "" || $('#employee_id').val() == undefined)
	{
		//alert("Please enter a valid employee no.");
		$('#outputname').html("Please enter a valid employee no.");
		return
	}
	else
	{
	
		$('#outputname').load("<?php echo base_url().('ajax/view_name/'); ?>" + $('#employee_id').val());
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
	  	log2 = "hour_to"
	  }
	   if ($('#log').val() == "hour_to")
	  {
	  	log2 = "hour_from"
	  }
	  if ($('#log').val() == "hour_from")
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
	
	//Press right
	if (e.keyCode == 39) { 
	
	  var dtr3 = "dtr."+ $('#una').val() +"." + $('#dalawa').val()
		
	  dg_editCell2(dtr, $('#row_id').val(), $('#log').val() ,dtr3,'dtr')
	
      $("#keycode").val(e.keyCode)
	  var una = parseInt($('#una').val()) + 1
	  var dalawa = parseInt($('#dalawa').val())
	  var log2
	  
	  if ($('#log').val() == "hour_from")
	  {
	  	log2 = "hour_to"
	  }
	  
	  if ($('#log').val() == "hour_to")
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
		log2 = "hour_from"
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
	////==============DOWN================
	if (e.keyCode == 40) { 
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


//dg_editCell(dtr,'994','hour_from','dtr.0.8','dtr')
</script>