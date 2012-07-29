<table width="100%" border="0" class="type-one">
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td></td>
      </tr>
      <tr>
        <td width="22%"><strong>
        <?php $js = 'id= "office_id"';echo form_dropdown('office_id', $options, $selected, $js);?>
        </strong><strong>
<input name="op" type="hidden" id="op" value="1" />
          </strong></td>
        <td width="34%">&nbsp;</td>
        <td width="14%">&nbsp;</td>
        <td width="12%"></td>
  </tr>
    	</table>
		<div id="div15" style="display:block"></div>
		<div id="employees"></div>
	
<div id="divTopLeft" style="position:absolute; width: 210px; height: 238px; background-color: #FFCC33; layer-background-color: #FFCC33; border: 1px none #000000;">
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


$('#select_times').click(function(){
	
	if ($('#select_times').attr("checked") == true)
	{
		$("#hour1").val( "08" ).attr('selected', true);
		$("#minute1").val( "00" ).attr('selected', true);
		$("#hour2").val( "12" ).attr('selected', true);
		$("#minute2").val( "00" ).attr('selected', true);
		$("#hour3").val( "01" ).attr('selected', true);
		$("#minute3").val( "00" ).attr('selected', true);
		$("#hour4").val( "05" ).attr('selected', true);
		$("#minute4").val( "00" ).attr('selected', true);
	
	}
	else
	{
		$("#hour1").val( "0" ).attr('selected', true);
		$("#minute1").val( "0" ).attr('selected', true);
		$("#hour2").val( "0" ).attr('selected', true);
		$("#minute2").val( "0" ).attr('selected', true);
		$("#hour3").val( "0" ).attr('selected', true);
		$("#minute3").val( "0" ).attr('selected', true);
		$("#hour4").val( "0" ).attr('selected', true);
		$("#minute4").val( "0" ).attr('selected', true);
	}
	
});

$('#select_all_ob').click(function(){

	
	if ($('#select_all_ob').attr("checked") == true)
	{
		$("#hour1").val( "o" ).attr('selected', true);
		$("#minute1").val( "b" ).attr('selected', true);
		$("#hour2").val( "o" ).attr('selected', true);
		$("#minute2").val( "b" ).attr('selected', true);
		$("#hour3").val( "o" ).attr('selected', true);
		$("#minute3").val( "b" ).attr('selected', true);
		$("#hour4").val( "o" ).attr('selected', true);
		$("#minute4").val( "b" ).attr('selected', true);
	
	}
	else
	{
		$("#hour1").val( "0" ).attr('selected', true);
		$("#minute1").val( "0" ).attr('selected', true);
		$("#hour2").val( "0" ).attr('selected', true);
		$("#minute2").val( "0" ).attr('selected', true);
		$("#hour3").val( "0" ).attr('selected', true);
		$("#minute3").val( "0" ).attr('selected', true);
		$("#hour4").val( "0" ).attr('selected', true);
		$("#minute4").val( "0" ).attr('selected', true);
	}
	
});

$('#office_id').change(function(){
	
	$('#div15').html("Loading... Please wait...");
	$('#div15').load("<?php echo base_url().('Ajax/employees_schedule/'); ?>" + $('#office_id').val());
	
});

$(document).ready(function() {
	
   $('#div15').html("Loading... Please wait...");
   $('#div15').load("<?php echo base_url().('Ajax/employees_schedule/'); ?>" + <?php echo $this->session->userdata('office_id');?>);
   
    //Display name in the yellow box if there is names selected
	$('#divTopLeft').load("<?php echo base_url().('Ajax/set_selected/'); ?>" + "0/1");
});


$('#process_manual_log').click(function(){
	
	var date1 = $('#year').val()+"-"+$('#month').val()+"-"+$('#day').val();
	var date2 = $('#year2').val()+"-"+$('#month2').val()+"-"+$('#day2').val();
	
	var time1 = $('#hour1').val()+":"+$('#minute1').val();
	var time2 = $('#hour2').val()+":"+$('#minute2').val();
	var time3 = $('#hour3').val()+":"+$('#minute3').val();
	var time4 = $('#hour4').val()+":"+$('#minute4').val();
	
	
	var overwrite_logs = 0;
	
	var start_ob = 0;
	
	if ($('#start_ob').attr("checked") == true)
	{
		start_ob = 1;
	}
	else
	{
		start_ob = 0;
	}
	
	if ($('#overwrite_logs').attr("checked") == true)
	{
		overwrite_logs = 1;
	}
	else
	{
		overwrite_logs = 0;
	}
	
	var url = ""
	
	url = url + start_ob + "/" + overwrite_logs + "/" + date1 + "/" + date2 + "/";
	url = url + time1 + "/" + time2 + "/" + time3 + "/" + time4;
	
	$('#divTopLeft').html("Loading... Please wait...");
	$('#divTopLeft').load("<?php echo base_url().('Ajax/process_manual_log/'); ?>" + url);

});


</script>