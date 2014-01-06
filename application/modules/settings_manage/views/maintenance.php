<?php if (validation_errors()): ?>
<div class="clean-red"><?php echo validation_errors(); ?></div>
<?php elseif (Session::flashData('msg')): ?>
<div class="clean-green"><?php echo Session::flashData('msg');?></div>
<?php else: ?>
<?php endif; ?>
<form action="" method="post">
<table width="100%" border="0">
  <tr>
    <td></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="35%">&nbsp;</td>
    <td width="58%">&nbsp;</td>
    <td width="7%">&nbsp;</td>
  </tr>
  <tr>
    <td><input name="uploadedfile" type="file" id="uploadedfile" />
    <input name="restore" type="submit" class="button" id="restore" value="Go"/>
    <input type="hidden" name="MAX_FILE_SIZE" value="10000000000"/>
    <input name="op" type="hidden" id="op" value="1" /></td>
    <td><input name="repair" type="submit" class="button" id="repair" value="Repair"/></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Select the zip file </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>