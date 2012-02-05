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

.pds_active_menu{
	
	background: #003867 url(sidenav_a.gif) no-repeat 5px 7px;
	border-top: 1px solid #1a4c76;
}
</style>
<ul class="sidenav">
	<li id="personal_info"><a href="<?php echo base_url();?>pds/personal_info/<?php echo $employee_id;?>">Personal Information</a></li>
	<li id="family"><a href="<?php echo base_url();?>pds/family/<?php echo $employee_id;?>">Family Background</a></li>
    <li id="education"><a href="<?php echo base_url();?>pds/education/<?php echo $employee_id;?>">Education</a></li>
	<li id="examination"><a href="<?php echo base_url();?>pds/examination/<?php echo $employee_id;?>">Examinations</a></li>
    <li id="work"><a href="<?php echo base_url();?>pds/work/<?php echo $employee_id;?>">Work Experience</a></li>
	<li id="voluntary_work"><a href="<?php echo base_url();?>pds/voluntary_work/<?php echo $employee_id;?>">Voluntary Work</a></li>
    <li id="trainings"><a href="<?php echo base_url();?>pds/trainings/<?php echo $employee_id;?>">Trainings</a></li>
	<li id="other_info"><a href="<?php echo base_url();?>pds/other_info/<?php echo $employee_id;?>">Other Information</a></li>
    <li id="position_details"><a href="<?php echo base_url();?>pds/position_details/<?php echo $employee_id;?>">Position Details</a></li>
    <li id="service_record"><a href="<?php echo base_url();?>pds/service_record/<?php echo $employee_id;?>">Service Record</a></li>
</ul>
   
  
<script>
$(document).ready(function(){

	var url = '<?php echo $this->uri->segment(2);?>'
	
	$('#'+url).addClass('pds_active_menu');

});
</script>