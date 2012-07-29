<?php
//==============================================================================
// OPTIONS (comment line out to disable option)
//==============================================================================
$db_host='';
$db_user='root';
$db_pass='';

//allow db updates (assumes first column is the primary key of the table)
//$option_db_allow_update=1;

//delay answering ajax requests (demonstrates the first "A" in AJAX) 
$option_delay_seconds=2;

//all ajax requests are logged to this file
$option_ajax_log_file="./ajax_log.txt"; 

ini_set("display_errors", "1");
ini_set("error_reporting", "E_ALL");
//==============================================================================
// DB CONNECT
//==============================================================================
  extract($_GET);
  
  mysql_connect($db_host,$db_user,$db_pass);
  if(!$db)
  {
    echo "<h3>Select Database</h3>";
    $result=mysql_list_dbs();
    while ($row = mysql_fetch_row($result)) 
       echo  "<a href=\"?db=$row[0]\">$row[0]</a><br>";
    exit();
  }
  mysql_select_db($db);

//==============================================================================
// AJAX HANDLER
//==============================================================================
if($_POST['ajax'])
{
  if($option_ajax_log_file)
  {
    $open = fopen($option_ajax_log_file, 'a');
    fwrite($open, serialize($_REQUEST));
    fwrite($open, "\r\n");
    fclose($open);
  }
  
  extract($_POST);
  
  switch($ajax)
  {
  case 'nav':  
    /*
        AJAX 'nav' request variables:
        $ajax:     the ajax command ('nav')
        $tbl:      table name
        $pos:      new position (1 based)
        $sortcol:  columnname to sort on 
        $sortdesc: set to 1 if sort descending
    
        the AJAX reply is the new table body
    */  
    $at=BuildTable($db,$tbl,$pos,$sortcol,$sortdesc);
    echo $at->GenerateTableSpan();
    break;
  case 'updcell':
    /*
        AJAX 'updcell' request variables:
        $ajax:  the ajax command ('updcell')
        $tbl:   table name
        $rowid: row id 
        $colid: columnname
        $new:   the new cell value that was typed into the text input
        $old:   old value
    
        the AJAX reply is the error message, or empty on success
    */
    
    //update the database
    if($option_db_allow_update)
    {
      //NOTE: assumes first column is the primary key of the table
      $col_rowid=mysql_field_name(mysql_query("SELECT * FROM `$tbl` LIMIT 1"),0);
      $sql = "UPDATE `$tbl` SET `$colid`='$new' WHERE `$col_rowid`='$rowid' LIMIT 1";
      //uncomment next line for strict updates [updates only if data was not changed by another session]
      //$sql = "UPDATE `$tbl` SET `$colid`='$new' WHERE `$colid`='$old' AND `$col_rowid`='$rowid' LIMIT 1";
      if(!mysql_query($sql)) 
        echo mysql_error() . " in $sql"; 
      elseif(mysql_affected_rows()==0)
        echo "Database table update failed.";
    }
    else
    {
      echo 'Database updates are disabled in example_mysql.php. set $option_db_allow_update to enable.';
    }
    break;
  default:
    echo 'Unknown AJAX cmd';
  }
  if($option_delay_seconds) sleep($option_delay_seconds);
  exit();
}

//==============================================================================
// REGULAR PAGE OUTPUT
//==============================================================================
setcookie("testcookie","1234"); //test cookie for AJAX requests

if(!$tbl)
{
  echo "<h3>Select Table</h3>";
  $result = mysql_query("SHOW TABLES");
  while ($row = mysql_fetch_row($result)) 
     echo  "<a href=\"?db=$db&tbl=$row[0]\">$row[0]</a><br>";
  exit();
}

echo "<h3>Table $db.$tbl</h3>";
if($option_db_allow_update) echo '<b style="background-color:orangered;">WARNING: DATABASE UPDATES ENABLED</b><br>';
if($option_delay_seconds) echo "NOTE: The AJAX replies are delayed by $option_delay_seconds seconds to demonstrate the asynchronous nature of this example.<br>";
echo "<br>";

$ta=BuildTable($db,$tbl);
echo $ta->GenerateTable();
  

//==============================================================================
// FUNCTIONS
//==============================================================================
function BuildTable($db,$tbl,$pos=1,$sortcol='',$sortdesc=0)
{
  $pospage=8;
  
	//the display properties for the odd and even rows
	$odd = array('style' => 'background-color: #CCCCCC;');
	$even = array('style' => 'background-color: #EEEEEE;');

	//the display properties for the overall table
	$table = array('cellpadding' => '3', 'cellspacing' => '0');

	//table column header formatting properties
	$headerattrib = array('style' => 'background-color: skyblue; cursor:pointer;');

  //get data and rowcount
  $possql=$pos-1;
  if($sortcol) $orderby=" ORDER BY $sortcol ".($sortdesc?'DESC':'');
  $result = mysql_query("SELECT SQL_CALC_FOUND_ROWS * FROM $tbl $orderby LIMIT $possql,$pospage");
  $poscnt = mysql_result(mysql_query("SELECT FOUND_ROWS()"),0,0);
  while ($row = mysql_fetch_assoc($result)) $data[]=$row;
 
  //build the datagrid
  require_once("./AjaxDataGrid.class.php");
  $at = new DataGrid($data,$_SERVER['PHP_SELF']."?db=$db");
  $at->JsClass=$tbl;
  $at->pos=$pos;
  $at->pospage=$pospage;
  $at->poscnt=$poscnt;
	$at->SetEvenRowAttribs($even);
	$at->SetOddRowAttribs($odd);
	$at->SetTableAttribs($table);
	$at->SetHeaderAttribs($headerattrib);
  //NOTE: the columns types are setup automatically - first column readonly, 
  //rest text. See example.php for setting up columns manually.
  return $at;
}
?>

