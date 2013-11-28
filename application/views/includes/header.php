<?php 
if(!$this->session->userdata('username'))
{
 	redirect(base_url(), 'refresh');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang=""><head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link href="<?php echo base_url();?>images/favicon.ico" rel="shortcut icon">
    <title>Integrated Human Resources Management Information System <?php echo Setting::getField('version');?></title>
<link href="<?php echo base_url();?>css/edo-style.css" rel="stylesheet" type="text/css" >	
<link href="<?php echo base_url();?>css/style.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url();?>css/message.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url();?>css/style_form.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url();?>css/style_table.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url();?>css/style_layout.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url();?>css/style_menu_dropdown.css" rel="stylesheet" type="text/css" media="screen,print,handheld,projection">
<link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url();?>css/calendar-win2k-cold-1.css" title="win2k-cold-1">	
<script language="javascript" src="<?php echo base_url();?>js/tooltip.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/calendar.js"></script>  
<script type="text/javascript" src="<?php echo base_url();?>js/calendar-en.js"></script>  
<script type="text/javascript" src="<?php echo base_url();?>js/calendar-setup.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/row_highlight.js"></script>
<script type="text/JavaScript" src="<?php echo base_url();?>js/function.js"></script>
<script type="text/JavaScript" src="<?php echo base_url();?>js/jquery-1.8.1.js"></script>
<script type="text/JavaScript" src="<?php echo base_url();?>js/jquery.labelify.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/lib.js"></script>
<script type="text/JavaScript" src="<?php echo base_url();?>js/jquery.tablednd.js"></script>


<!--Use for thickbox added on april 11, 2011-->
<script type="text/JavaScript" src="<?php echo base_url();?>js/thickbox.js"></script>
<link href="<?php echo base_url();?>js/thickbox.css" rel="stylesheet" type="text/css">
<!--Use for thickbox end -->
<!--[if lt IE 7.]>
		<script type="text/javascript" src="./lib/lib.pngfix.js"></script>
	<![endif]--><script type="text/javascript">
		switchToDrowpdown('opened_menu', 'opened_menu_2', 'menu_close');
		</script><link href="<?php echo base_url();?>css/style_heading.css" rel="stylesheet" type="text/css">
        <style type="text/css">
<!--
#Layer1 {
	position:absolute;
	width:200px;
	height:115px;
	z-index:1;
	left: 342px;
	top: 69px;
}
-->
</style>
<style type="text/css">
.access-only {
		display: none;
}

</style>
</head>
<body><script type="text/javascript" src="<?php echo base_url();?>js/wz_tooltip.js"></script>
<div id="header" class="layout_header">
<div class="system_name"><br />&nbsp;&nbsp;&nbsp;<span class="integrated">Integrated </span>Human Resources Management Information System<span class="version"> ver. <?php echo Setting::getField('version');?></span></div>
</div>
<div id="menu_over" class="layout_menu_over">
<div>