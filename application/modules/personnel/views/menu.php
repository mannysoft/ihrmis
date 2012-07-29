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
	<li id="assets_spouse"><a href="<?php echo base_url();?>personnel/assets_spouse/<?php echo $employee_id;?>">Spouse</a></li>
	<li id="assets_unmarried"><a href="<?php echo base_url();?>personnel/assets_unmarried/<?php echo $employee_id;?>">Unmarried Children below 18 years of age</a></li>
	<li id="assets_real_properties"><a href="<?php echo base_url();?>personnel/assets_real_properties/<?php echo $employee_id;?>">ASSETS - a. Real Properties</a></li>
    <li id="assets_personals"><a href="<?php echo base_url();?>personnel/assets_personals/<?php echo $employee_id;?>">ASSETS - b. Personal and other Properties</a></li>
	<li id="assets_liabilities"><a href="<?php echo base_url();?>personnel/assets_liabilities/<?php echo $employee_id;?>">LIABILITIES (Loans, Mortgages, etc.)</a></li>
    <li id="assets_business_interests"><a href="<?php echo base_url();?>personnel/assets_business_interests/<?php echo $employee_id;?>">BUSINESS INTERESTS AND FINANCIAL CONNECTIONS</a></li>
	<li id="assets_relatives"><a href="<?php echo base_url();?>personnel/assets_relatives/<?php echo $employee_id;?>">IDENTIFICATION OF RELATIVES IN THE GOVERNMENT SERVICE</a></li>
    <li id="assets_other_info"><a href="<?php echo base_url();?>personnel/assets_other_info/<?php echo $employee_id;?>">Other Info</a></li>
</ul>
   
  
<script>
$(document).ready(function(){

	var url = '<?php echo $this->uri->segment(2);?>'
	
	$('#'+url).addClass('pds_active_menu');

});
</script>