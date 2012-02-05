<fieldset><legend><?php echo $page_name;?></legend>
<form action="" method="post">
  <table width="100%" border="0" cellspacing="5">
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td width="23%" align="right"><label for="code">Code:</label></td>
      <td width="73%">
        <input name="code" type="text" id="code" value="<?php echo $deduction->code;?>" size="30" /></td>
      <td width="4%">&nbsp;</td>
    </tr>
    <tr>
      <td align="right"><label for="desc">Description:</label></td>
      <td>
        <input name="desc" type="text" id="desc" value="<?php echo $deduction->desc;?>" size="30" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="right">Agency:</td>
      <td><select name="agency_id" id="agency_id">
        <?php foreach ($agencies as $agency): ?>
        <option value="<?=$agency->id;?>"><?=$agency->agency_name;?></option>
        <?php endforeach; ?>
      </select></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="right">Type:</td>
      <td><select name="type" id="type">
        <option value="loan">Loan</option>
        <option value="premiums">Premiums</option>
        <option value="insurances">Insurances</option>
      </select></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="right">Mandatory:</td>
      <td><select name="mandatory" id="mandatory">
        <option value="yes">Yes</option>
        <option value="no">No</option>
      </select></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="right">Tax Exempted:</td>
      <td><select name="tax_exempted" id="tax_exempted">
        <option value="yes">Yes</option>
        <option value="no">No</option>
      </select></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="right">ER Share:</td>
      <td><select name="er_share" id="er_share">
        <option value="yes">Yes</option>
        <option value="no">No</option>
      </select></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="right">Official:</td>
      <td><select name="official" id="official">
        <option value="official">Official</option>
        <option value="unofficial">Unofficial</option>
      </select></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="right">Optional Amount:</td>
      <td><select name="optional_amount" id="optional_amount">
        <option value="yes">Yes</option>
        <option value="no">No</option>
      </select></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="right">Max. Amount Exempted:</td>
      <td><input name="amount_exempted" type="text" id="amount_exempted" size="30" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="right"><label for="report_order">Order:</label></td>
      <td>
        <input name="report_order" type="text" id="report_order" size="30" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="button" id="button" value="Save" />
        <input name="op" type="hidden" id="op" value="1" />
        <input name="id" type="hidden" id="id" /></td>
      <td>&nbsp;</td>
    </tr>
  </table>
  </form>
</fieldset>