<?php if (validation_errors()): ?>
<div class="clean-red"><?php echo validation_errors(); ?></div>
<?php elseif ($this->session->flashdata('msg')): ?>
<div class="clean-green"><?php echo $this->session->flashdata('msg'); echo $msg;?></div>
<?php else: ?>
<?php endif; ?>

<?php if ( $msg != '' ): ?>
<div class="clean-green"><?php echo $msg;?></div>
<?php endif; ?>

<table width="100%" border="0">
  <tr>
    <td><a href="<?php echo base_url();?>attendance/employee_schedule">Back</a>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

<form action="" method="post">
<table width="100%" cellpadding="5" cellspacing="5">
  <tr>
    <td align="right">Description</td>
    <td width="14%"><input name="name" type="text" id="name" value="<?php echo $sched->name;?>" /></td>
    <td width="10%"> </td>
    <td width="67%">&nbsp;</td>
  </tr>
  <tr>
    <td width="9%" align="right">Schedule:</td>
    <td><?php 
		$js = 'id = "schedule_id"';
		echo form_dropdown('schedule_id', schedule_options(), $sched->schedule_id, $js); ?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">Date:</td>
    <td colspan="3"><strong>
      <?php $js = 'id= "month"';echo form_dropdown('month', $month_options, $month_selected, $js);?>
      <?php $js = 'id= "period_from"';echo form_dropdown('period_from', $days_options, $period_from_selected, $js);?>
    </strong> To: <strong>
    <?php $js = 'id= "period_to"';echo form_dropdown('period_to', $days_options, $period_to_selected, $js);?>
    </strong><strong>
    <?php $js = 'id= "year"';echo form_dropdown('year', $year_options, $year_selected, $js);?>
    </strong></td>
  </tr>
  <tr>
    <td align="right">Office:</td>
    <td colspan="3"><?php $js = 'id = "office_id"';echo form_dropdown('office_id', $options, $selected, $js);?></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="button" id="button" value="Save" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input name="op" type="hidden" id="op" value="1" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>

<div id="div15" style="display:block"></div>
		<div id="employees"></div>
	
<div id="divTopLeft" style="position:absolute; width: 210px; height: 350px; background-color: #FFCC33; layer-background-color: #FFCC33; border: 1px none #000000;">
<!-- Start - put your content here --->
<b>Employee</b>
<!-- End   - put your content here --->
</div>

<script type="text/javascript">
var ns = (navigator.appName.indexOf("Netscape") != -1);
var d = document;
function JSFX_FloatDiv(id, sx, sy)
{
	var el=d.getElementById?d.getElementById(id):d.all?d.all[id]:d.layers[id];
	var px = document.layers ? "" : "px";
	window[id + "_obj"] = el;
	if(d.layers)el.style=el;
	el.cx = el.sx = sx;el.cy = el.sy = sy;
	el.sP=function(x,y){this.style.left=x+px;this.style.top=y+px;};

	el.floatIt=function()
	{
		var pX, pY;
		pX = (this.sx >= 0) ? 0 : ns ? innerWidth : 
		document.documentElement && document.documentElement.clientWidth ? 
		document.documentElement.clientWidth : document.body.clientWidth;
		pY = ns ? pageYOffset : document.documentElement && document.documentElement.scrollTop ? 
		document.documentElement.scrollTop : document.body.scrollTop;
		if(this.sy<0) 
		pY += ns ? innerHeight : document.documentElement && document.documentElement.clientHeight ? 
		document.documentElement.clientHeight : document.body.clientHeight;
		this.cx += (pX + this.sx - this.cx)/8;this.cy += (pY + this.sy - this.cy)/8;
		this.sP(this.cx, this.cy);
		setTimeout(this.id + "_obj.floatIt()", 40);
	}
	return el;
}
//JSFX_FloatDiv("divTopLeft", 100,30).floatIt();
JSFX_FloatDiv("divTopLeft", 750,300).floatIt();




$('#office_id').change(function(){
	
	$('#div15').html("Loading... Please wait...");
	$('#div15').load("<?php echo base_url().('ajax/manual_log_employees/'); ?>" + $('#office_id').val());
	
});

$(document).ready(function() {
	
   $('#div15').html("Loading... Please wait...");
   $('#div15').load("<?php echo base_url().('ajax/manual_log_employees/'); ?>" + <?php echo $this->session->userdata('office_id');?>);
   
    //Display name in the yellow box if there is names selected
	$('#divTopLeft').load("<?php echo base_url().('ajax/set_selected/'); ?>" + "0/1");
});


</script>

<script>
  
	
	
	
	$('#office_id').change(function(){

	
	return false;
	var office_id = $(this)[0].value.toString();
		
	$.getJSON('<?php echo base_url();?>pds/employees/' + office_id, null, function (data) {
		
		$('#left').empty();
		//$('#left').empty().append("<option value='0'>--All--</option>");
		$.each(data, function (key, val) {
			$('#left').append("<option value='" + key + "'>" + val + "</option>");

		});
	});

});

$('#go').click(function(){

	if ($('#employee_id').val() == 0)
	{
		alert("Please select employee");
		return false
	}

});



	$(function() {  
  $(".low input[type='button']").click(function(){  
    var arr = $(this).attr("name").split("2");  
    var from = arr[0];  
    var to = arr[1]; 
    $("#" + from + " option:selected").each(function(){  
      $("#" + to).append($(this).clone());  
      $(this).remove();  
    });  
  });  
})  
	
	
  </script>