<style type="text/css">
a:focus {
	outline: none;
}
ul.sidenav {
	font-size: 1em;
	float: left;
	width: 200px;
	margin: 0;
	padding: 0;
	list-style: none;
	background: #005094;
	border-bottom: 1px solid #3373a9;
	border-top: 1px solid #003867;
}
ul.sidenav li a{
	display: block;
	color: #fff;
	text-decoration: none;
	width: 155px;
	padding: 10px 10px 10px 35px;
	background: url(sidenav_a.gif) no-repeat 5px 7px;
	border-top: 1px solid #3373a9;
	border-bottom: 1px solid #003867;
}
ul.sidenav li a:hover {
	background: #003867 url(sidenav_a.gif) no-repeat 5px 7px;
	border-top: 1px solid #1a4c76;
}
ul.sidenav li span{	display: none; }
ul.sidenav li a:hover span {
	display: block;
	font-size: 0.8em;
	padding: 10px 0;
}
</style>


<form id="myform" method="post" action="<?php echo base_url();?>employee_manage/list_employee" target="" enctype="multipart/form-data">
  
</form>

<table width="100%" border="0">
  <tr>
    <td width="23%"><table width="200" border="0">
    <tr>
      <td><ul class="sidenav">
	<li><a href="<?php echo base_url();?>pds/personal_info">Personal Information</a></li>
	<li><a href="#">Family Background</a></li>
    <li><a href="#">Education</a></li>
	<li><a href="#">Examinations</a></li>
    <li><a href="#">Work Experience</a></li>
	<li><a href="#">Voluntary Work</a></li>
    <li><a href="#">Trainings</a></li>
	<li><a href="#">Other Information</a></li>
    <li><a href="#">Position Details</a></li>
</ul>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>&nbsp;</td>
    <td width="75%" valign="top">
    <div class="clean-green">
    <table width="100%" border="0">
      <tr>
        <td align="right">Employee Number:</td>
        <td align="left"><?php echo $employee['id'];?></td>
        <td width="29%" rowspan="5" align="center" valign="middle"><img src="<?php echo base_url();?>pics/<?php echo $employee['pics'];?>" /></td>
      </tr>
      <tr>
        <td align="right">Employe Name:</td>
        <td align="left"><?php echo $employee['lname'].', '.$employee['fname'].' '.$employee['mname'];?></td>
      </tr>
      <tr>
        <td align="right"><!--<a href="<?php echo base_url();?>employee_manage/modal_edit_employee/<?php echo $employee['id'];?>?keepThis=true&TB_iframe=true&height=570&width=950" title="Personal Data Sheet of <?php echo $employee['lname'].', '.$employee['fname'].' '.$employee['mname'];?>" class="thickbox">PDS</a>-->
          Office/Department:</td>
        <td align="left"><?php echo office_name($employee['office_id']);?></td>
      </tr>
      <tr>
        <td align="right">Position/Designation:</td>
        <td align="left"><?php echo $employee['position'];?></td>
      </tr>
      <tr>
        <td width="26%">&nbsp;</td>
        <td width="45%">&nbsp;</td>
      </tr>
    </table></div>
    </td>
    <td width="2%">&nbsp;</td>
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

<script>

$('#delete_employee').click(function(){

	
	alert("2")
});

$('#office_id').change(function(){

	$('#loading').html("Loading...");
	$('#myform').submit();
	
});

function delete_employee(delete_id, msg, url)
{
	var answer = confirm(msg)
	
	if (!answer)
	{
		return false;
	}
	//alert(url)
	window.location = url
}

</script>