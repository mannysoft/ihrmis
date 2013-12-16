<?php
//==============================================================================
// OPTIONS (comment line out to disable option)
//==============================================================================

//delay answering ajax requests (demonstrates the first "A" in AJAX) 
$option_delay_seconds=2;

//all ajax requests are logged to this file
$option_ajax_log_file="./ajax_log.txt"; 

//simulate update failures
//$option_update_fail="... put your error message here ...";

//data table file
$data_file="./testdata.txt";

//debuging
//ini_set("display_errors", "1");
//ini_set("error_reporting", "E_ALL");

//==============================================================================
// AJAX REQUEST HANDLER
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
    $at=BuildTable($tbl,$pos,$sortcol,$sortdesc);
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
    
    //get the data table
    $data = unserialize(file_get_contents($data_file));
    
    //do the cell update
    $data[$rowid][$colid] = stripslashes($new);
   
    //store the data table  
    $open = fopen($data_file, 'w');
    fwrite($open, serialize($data));
    fclose($open);
        
    if($option_update_fail) echo $option_update_fail;
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

//table rebuild
if($_GET['rebuild']) 
{
  rebuild_table(6,20);
  echo 'Table was rebuild. <a href="?rebuild=0">Continue</a><br>';
  exit();
}

echo "<h3>DataGrid Example</h3>This page displays two views of the same table. You can navigate each table independently. Changes made in one table will appear in the other table after you navigate the other table. <br>";
if($option_delay_seconds) echo "NOTE: The AJAX replies are delayed by $option_delay_seconds seconds to demonstrate the asynchronous nature of this example.<br>";
echo "<br>";

//table output
$tt1=BuildTable('tt1');
echo $tt1->GenerateTable();

echo "<br>";
$tt2=BuildTable('tt2');
echo $tt2->GenerateTable();

//print table data 
echo '<br>Below is the table content at the moment this page was loaded. <a href="?rebuild=0&rndval='.rand().'">Reload</a> | <a href="?rebuild=1&rndval='.rand().'">Rebuild Table</a><br><pre>';
print_r($tt1->data);
  
  
//==============================================================================
// FUNCTIONS
//==============================================================================
function BuildTable($cls,$pos=1,$sortcol='',$sortdesc=0)
{
  $pospage=8;
 
  global $data_file;
   
	//the display properties for the odd and even rows
	$odd = array('style' => 'background-color: #CCCCCC;');
	$even = array('style' => 'background-color: #EEEEEE;');

	//the display properties for the overall table
	$table = array('cellpadding' => '3', 'cellspacing' => '0');

	//table column header formatting properties
	$headerattrib = array('style' => 'background-color: skyblue; cursor:pointer;');

	$data = file_get_contents($data_file);
	$data = unserialize($data);
  
  //sort
  if($sortcol)
  {
    // Obtain a list of columns
    foreach ($data as $key => $row) {$sort1[$key]  = $row[$sortcol]; $data[$key]['key']=$key;}
    // Sort the data
    if($sortdesc) array_multisort($sort1, SORT_DESC, $data); else array_multisort($sort1, SORT_ASC, $data);
  }
  
  //filter rows
  $pos--;//zero based position
  if($pos<0) $pos=0;
  $poscnt=count($data);
  if($pos>=$poscnt) $pos=floor(($poscnt-1)/$pospage)*$pospage;
  $r=0;
  foreach($data as $k=>$v) 
  {
    if($r<$pos||$r>=$pos+$pospage) unset($data[$k]);
    $r++;
  }
	
  require_once("./AjaxDataGrid.class.php");
  $at = new DataGrid($data,"");
  
  $at->JsClass=$cls;
  
  $at->pos=$pos+1; //one based position
  $at->pospage=$pospage;
  $at->poscnt=$poscnt;
	
	$at->SetEvenRowAttribs($even);
	$at->SetOddRowAttribs($odd);
	
	$at->SetTableAttribs($table);
	  
	$at->SetHeaderAttribs($headerattrib);
	
  $at->AddColumnReadonly ("id","id[Readonly]");
  $at->AddColumnHidden   ("col1","col1[Hidden]");
  $at->AddColumnText     ("col2","col2[Text]");
  $at->AddColumnSelect   ("col3","col3[Select]",array("1st option","2nd option","test ' qoute","test \" dqoute","test < lt","test & amp"));
  $at->AddColumnSelectkey("col4","col4[Selectkey]",array("key1"=>"1st option","key2"=>"2nd option","key3"=>"test ' qoute","key4"=>"test \" dqoute","key5"=>"test < lt","key6"=>"test & amp"));
  $at->AddColumnCheckbox ("col5","col5[Checkbox]");
  $at->AddColumnTextarea ("col6","col6[Textarea]",200,100);
  return $at;
}

function rebuild_table($colcnt,$rowcnt)
{
  global $data_file;
  
  for ($r = 1; $r <= $rowcnt; $r++) 
  {
    $rid=$r+1000;
    $arr[$rid]['id']=$rid;
  	for ($c = 1; $c <= $colcnt; $c++) 
    {
  		$arr[$rid]["col" . $c] = "Row $r Column $c";
  	}
  }
  
  $open = fopen($data_file, 'w');
  fwrite($open, serialize($arr));
  fclose($open);
}
?>
