<?php if (validation_errors()): ?>
<div class="clean-red"><?php echo validation_errors(); ?><?php echo $msg; ?></div><br />
<?php elseif (Session::flashData('msg') || $msg != ''): ?>
<div class="clean-green"><?php echo Session::flashData('msg');?><?php echo $msg;?></div><br />
<?php else: ?>
<?php endif; ?>
<form id="myform" method="post" target="" enctype="multipart/form-data"><table width="100%" border="0" cellpadding="5" cellspacing="5">
  <tr>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td width="63%" align="right">Date(YYYY-MM-DD):</td>
    <td width="37%"><input name="date" type="text" id="date" value="<?php echo $date;?>" /></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="button" id="button" value="Submit" /></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input name="op" type="hidden" id="op" value="1" /></td>
    </tr>
</table>

</form>