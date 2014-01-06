<?php

 
$class_menu_close = '';

$base = '<a href="'.base_url().'';
$image = '<img class="menu_icon" src="'.base_url().'images/blank.gif">';

//http://codeigniter.com/user_guide/helpers/html_helper.html#ol_and_ul

$attributes = array('class' => 'list_modules');
						
$leave_management = 	array(
						$base.'leave_manage/file_leave">'.$image.'File Leave</a>',
						$base.'leave_manage/leave_apps">'.$image.'Leave Application</a>'
            			);
						
?>
<ul id="main_menu" class="main_menu_over"><!-- Main menu -->

<li class="menu_close" onMouseOver="adminOpenMenu(this, 'menu_open');" onMouseOut="adminCloseMenu(this, 'menu_close');"><a class="first_line" href="<?php echo base_url();?>home/home_page" onClick="return true;"><img src="<?php echo base_url();?>/images/classroom_classroom.png" alt=".:" width="22" height="22" class="little_icon"><br>
  Home</a></li>
   
<li class="menu_close" onMouseOver="adminOpenMenu(this, 'menu_open');" onMouseOut="adminCloseMenu(this, 'menu_close');"><a class="first_line" href="index.php?q=13" onClick="return false;"><img src="<?php echo base_url();?>/images/manpage_manpage.png" alt=".:" width="22" height="22" class="little_icon"><br>
  Leave <br /> Management</a>
  <?php echo ul($leave_management, $attributes);?>
  </li>
   
  </ul>
Welcome, <a href="<?php echo base_url();?>user_manage/my_account/"><?php echo Session::get('fname').' '.Session::get('username');?></a>&nbsp;<a href="<?php echo base_url();?>login/log_out">Logout</a> | <a href="#" id="check_updates">Check for updates</a> | <a href="#" onclick="bug_show_form2('<?php echo Session::get('username');?>')">Report Bugs</a>
<div id="updates_out"></div>

<script>
$('#check_updates').click(function(){

	$('#updates_out').html("Connecting...");
	$('#updates_out').load('<?php echo base_url();?>Client_services/check_updates/' + 12);
		
});
</script>