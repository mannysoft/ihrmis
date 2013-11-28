<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang=""><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"><meta name="Copyright" content="Docebo srl"><link rel="Copyright" href="http://www.docebo.com/" title="Copyright Notice"><link href="<?php echo base_url();?>images/favicon.ico" rel="shortcut icon"><title>Integrated Human Resources Management Information System <?php echo Setting::getField('version');?></title>
			
		<link type="text/css" href="<?php echo base_url();?>css/reset-min.css" rel="stylesheet">
		<link type="text/css" href="<?php echo base_url();?>css/style_home.css" rel="stylesheet">
		<link type="text/css" href="<?php echo base_url();?>css/global.css" rel="stylesheet">
        <link type="text/css" href="<?php echo base_url();?>css/message.css" rel="stylesheet">
        <style type="text/css">
<!--
#Layer1 {
	position:absolute;
	width:239px;
	height:370px;
	z-index:1;
	left: 642px;
	top: 39px;
	background-color: #CCCCCC;
}
-->
        </style>
        </head>
<body onload="document.myform.username.focus();"
    onunload="clockOnUnload()">
		
		<div id="rowHeaderLogin">Integrated Human Resources Management Information System</div>
		<form class="std_form" name="myform" method="POST" action="" >
		<div id="Layer1">
		  <table width="96%" height="363" border="0" align="center" bgcolor="#F3F3F3">
            <tr>
              <td>&nbsp;</td>
              <td colspan="4">Sign in to iHRMIS</td>
            </tr>
            <tr>
              <td colspan="5">
              <?php if ($system_message != ''): ?>
              <div class="clean-red"><?php echo ''.$system_message;?></div>
              <?php endif; ?>
              </td>
            </tr>
            <tr>
              <td height="48">&nbsp;</td>
              <td colspan="4">Username:<br />
              <input name="username" type="text" class="textfield" id="username" tabindex="1" value="" size="25" maxlength="255" /></td>
            </tr>
            <tr>
              <td height="52">&nbsp;</td>
              <td colspan="4">Password:<br />
              <input name="password" type="password" class="textfield" id="password" tabindex="2" value="" size="25" maxlength="255" /></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td><input class="button" id="login" name="log_button" value="Sign In" tabindex="3" type="submit" /></td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td><input name="op" type="hidden" id="op" value="1" /></td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
          </table>
		</div>
		<table width="119" height="382" border="0" align="left">
          <tr>
            <td colspan="2">&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td colspan="4">&nbsp;</td>
          </tr>
          <tr>
            <td><label for="login_userid"></label></td>
            <td><br />
            </td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><label for="login_pwd"></label></td>
            <td><br />
              <br />
            </td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table>
</form>
		<div id="rowFooter">

<a name="bottom">	</a>
<div class="textFooter">
<a name="bottom">.		<br>
		<?php $this->Helps->footer(); echo ' (Database Version '.$this->Migrations->get_version().')';?> | Copyright © 2008 - <?php echo date('Y');?> <a href="http://www.charliesoft.net/" class="footerLink" target="_new">Charliesoft</a>. All Rights Reserved.

		<br>
		<br>
				<a href="http://www.charliesoft.net/"></a></div>
</div>
</body></html>