<?php
/*##############################################################################

  AJAX Data Grid
  
  An AJAX enabled datagrid with pagewise scrolling, column sorting, and in-place 
  editing of data cells with textbox, textarea, select, and checkbox controls.
  
  Written by: Hugo Weijes 28 DEC 2006 (fx122@yahoo.com)
  
  License: MIT (http://www.opensource.org/licenses/mit-license.html)

  This file is an extended version of TableEditor written by Andrew Sullivan
  http://www.phpclasses.org/browse/package/3104.html - acsulli@gmail.com
  
================================================================================
Copyright (c) 2006, Hugo Weijes

Permission is hereby granted, free of charge, to any person obtaining a copy of 
this software and associated documentation files (the "Software"), to deal in 
the Software without restriction, including without limitation the rights to 
use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of 
the Software, and to permit persons to whom the Software is furnished to do so, 
subject to the following conditions:

The above copyright notice and this permission notice shall be included in all 
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR 
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS 
FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR 
COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER 
IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN 
CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
##############################################################################*/

/* Global Variables:
$DataGrid_InstanceCount counts instances of this class (to generate unique $JsClass names)
$DataGrid_JsIncluded set to true after the Js includes have been output to the page
*/




  
class DataGrid 
{

  var $pos; //one based position of start data page
  var $poscnt; //total number of records in all data (not just current page)
  var $pospage; //paging size
  
  var $JsClass = 'te'; //javascript class (variable) name and html id prefix
  	
  /*
		The datapage contains a multidimensional array that consists of the data for the table.
		It should be in the following format:
			In the primary array, each element should have a key equal to the row id and the value is
			a sub array that contains column data.
			
			The column data subarray should have key values that are the column values from the db and the values
			are the data to be displayed.
			
		An example would be:
			[1] => array(
					[Name] => 'Some Guy'
					[Address] => '123 Some Street'
					[Phone] => '123-123-1234'
				)
			[2] => array(
					[Name] => 'Some Girl'
					[Address] => '321 Some Drive'
					[Phone] => '987-987-9876'
				}
			etc.
			
	*/
	var $data = array();
  
  var $RequestFile = "";

  function DataGrid($data='',$RequestFile='')
  {
    global $DataGrid_InstanceCount;
    $DataGrid_InstanceCount++;
    $this->JsClass.=$DataGrid_InstanceCount;
    if($data) $this->data=$data;
    if($RequestFile) $this->RequestFile=$RequestFile; else $this->RequestFile=$_SERVER['PHP_SELF'];
  }
  
  function HtmlId($rowid,$colid)
  {
    return $this->JsClass . '.' . $rowid . '.' . $colid;
  }
    
  var $columns = array();

  function AddColumnReadonly($colname,$coltitle)
  {
    $this->columns[]=array('colname'=>$colname,'coltitle'=>$coltitle,'coltype'=>'readonly');
  }
  
  function AddColumnHidden($colname='',$coltitle='')
  {
    $this->columns[]=array('colname'=>$colname,'coltitle'=>$coltitle,'coltype'=>'hidden');
  }

  function AddColumnText($colname,$coltitle)
  {
    $this->columns[]=array('colname'=>$colname,'coltitle'=>$coltitle,'coltype'=>'text');
  }

  function AddColumnCheckbox($colname,$coltitle)
  {
    $this->columns[]=array('colname'=>$colname,'coltitle'=>$coltitle,'coltype'=>'checkbox');
  }

  function AddColumnSelect($colname,$coltitle,$selectvalues)
  {
    if(!is_array($selectvalues)) $selectvalues=$this->db_array($selectvalues);
    $this->columns[]=array('colname'=>$colname,'coltitle'=>$coltitle,'coltype'=>'select','selectvalues'=>$selectvalues);
  }

  function AddColumnSelectkey($colname,$coltitle,$selectvalues)
  {
    if(!is_array($selectvalues)) $selectvalues=$this->db_assoc($selectvalues);
    $this->columns[]=array('colname'=>$colname,'coltitle'=>$coltitle,'coltype'=>'selectkey','selectvalues'=>$selectvalues);
  }
  
  function AddColumnTextarea($colname,$coltitle,$width,$height)
  {
    $this->columns[]=array('colname'=>$colname,'coltitle'=>$coltitle,'coltype'=>'textarea','style'=>'width:'.$width.'px; height:'.$height.'px;');
  }

  function db_array($sql)
  {
    $arr=array();
    $result=mysql_query($sql);
    while($row=@mysql_fetch_row($result)) $arr[]=$row[0];
    return $arr;
  }

  function db_assoc($sql)
  {
    $arr=array();
    $result=mysql_query($sql);
    while($row=@mysql_fetch_row($result)) $arr[$row[0]]=$row[1];
    return $arr;
  }  

  
  	/*
  These vars are arrays that contain key => value pairs of attribs for the table.
  For example:
  	['class'] => 'evenrow'
  	
  Would result in the even rows having the attrib <tr class="evenrow">
  
  	['align'] => 'center'
  	['valign'] => 'top'
  	['style'] => 'background-color: #EEEEEE;'
  	
  Would result in <tr align="center" valign="top" style="background-color: #EEEEEE;">
	*/
  
	//array that contains the table attribs
	var $tattrib = array();
	
	//odd row attribs
	var $oddattrib = array();
	var $odd = "<tr>";
	
	//even row class
	var $evenattrib = array();
	var $even = "<tr>";
	
	//header attribs
	var $headerattrib = array();
		
	function SetEvenRowAttribs($attrib) {
		$this->evenattrib = $attrib;
		$this->evenTR();
	}
	
	function SetOddRowAttribs($attrib) {
		$this->oddattrib = $attrib;
		$this->oddTR();
	}
	
	function SetTableAttribs($attrib) {
		$this->tattrib = $attrib;
	}
		
	function SetHeaderAttribs($attrib) 
  {
		$this->headerattrib = $attrib;
	}
	
	function oddTR() 
  {
		$html = "<tr";		
		foreach ($this->oddattrib as $key => $value) $html .= " $key=\"$value\"";
		$html .= ">";
		$this->odd = $html;
	}
	
	function evenTR() 
  {
		$html = "<tr";
		foreach ($this->evenattrib as $key => $value) $html .= " $key=\"$value\"";
		$html .= ">";		
		$this->even = $html;
	}
	
  //returns <span> tag with table	
	function GenerateTable() 
  {
    $JsClass=$this->JsClass;
    
    //generate table first, this creates $column (if not predefined). $column is referenced by GenerateJS)
    $s =  $this->GenerateTableSpan();
    
    //include JS
		return $this->GenerateJS() . "<span id=\"$JsClass.span\">\n" . $s . '</span>';
  }
  
  //returns content of the table <span> tag (this part is reloaded on scrolling the table)
  function GenerateTableSpan()
  {
    $JsClass=$this->JsClass;

    //$table .= $this->GenerateNav();
    
		//build the table opener
		$table .= "\n<table id=\"$JsClass.table\" ";
		foreach ($this->tattrib as $key => $value) {
			$table .= " $key=\"$value\"";
		}
		$table .= ">";
    
		$table .= $this->GenerateTableBody();

    //nav
    $table .= "\n<tr style=\"background-color:lightyellow;\"><td colspan=\"$this->colcnt\">";
    $table .= $this->GenerateNav();
    $table .= "</td></tr>";
    
		$table .= '</table>';
        
    return $table;
  }
  
  //generates the table navigation and busy indicator
  function GenerateNav()
  {
    $JsClass=$this->JsClass;

    $pos=$this->pos; //current position 1-based
    if($pos<1) $pos=1;
    $posto=$pos+count($this->data)-1; //last pos in current page
    $pospage=$this->pospage; //page length
    $posprev=$pos-$pospage; //start pos of prev page 
    $posnext=$pos+$pospage; //start pos of next page 
    $poscnt=$this->poscnt; //total number of records
    $poslast=floor(($poscnt-1)/$pospage)*$pospage+1; //start pos of last page
    //build table navigator
    $table .= "<span style=\"cursor:pointer; color:blue; font-weight:900; font-family:arial;\">";
    $table .= "&nbsp;<a onclick=\"dg_move($JsClass,1)\">|&lt;</a>";
    $table .= "&nbsp;&nbsp;<a onclick=\"dg_move($JsClass,$posprev)\">&lt;&lt;</a>";
    $table .= "&nbsp;&nbsp;<a onclick=\"dg_move($JsClass,$posnext)\">&gt;&gt;</a>";
    $table .= "&nbsp;&nbsp;<a onclick=\"dg_move($JsClass,$poslast)\">&gt;|</a>&nbsp;";
    $table .= "</span>";
    $table .= " Showing $pos to $posto of $poscnt records.";
    $table .= " <span id=\"$JsClass.navbusy\" style=\"background-color:yellow;\"></span>";
    $table .= "<br>\n";
    	
		return $table;
  }
  
  //generates the table header and data rows
  function GenerateTableBody()
  {
		$colcnt = 0;
    $JsClass=$this->JsClass;
  
    //rowid is first column
    
    //get column count from this->columns
    $colcnt = count($this->columns);
    if($colcnt==0) 
    {
      //else get column count from first datarow and build columns headers
      foreach(current($this->data) as $k=>$v) if(count($this->columns)==0) 
        $this->AddColumnReadonly($k,$k);
      else 
        $this->AddColumnText($k,$k);
      $colcnt = count($this->columns);
    }
    
    //build the header section
  	$c = 0;
  	$s = "\n<tr";
  	if (!empty($this->headerattrib)) 
    {
  		foreach($this->headerattrib as $k=>$v) $s .= " $k=\"$v\"";
  	}
  	$s .= ">\n";
  	foreach($this->columns as $k=>$v) 
    {
      if($v['coltype']!='hidden')	$s .= "\t<th onclick=\"dg_onHeadClick($this->JsClass,'$v[colname]')\">$v[coltitle]</th>\n";
  		$c++;
  	}
 		while ($c < $colcnt) 
    {
 			$s .= "\t<th>&nbsp;</th>\n";
 			$c++;
 		}
  	$s .= "\n</tr>";
    
		//build the data portion of the table
		$r = 0;
		foreach ($this->data as $k => $rowdat) 
    {
      //apply odd/even row style
			if ($r % 2 == 0) 
				$s .= "\n" . $this->even;
		  else 
				$s .= "\n" . $this->odd;
			
      //add missing columns
      while(count($rowdat)<$colcnt) $rowdat[]='';	

      //get rowid from first column
      reset($rowdat);
      $rowid=current($rowdat);
      
      $c=0;		
			foreach ($rowdat as $kk => $coldat) 
      {
        //exit if more columns than defined
        if($c>=$colcnt) break;
        
        $HtmlId=$this->HtmlId($r,$c);
        $col = &$this->columns[$c];
        $colid = $col['colname'];
        switch($col['coltype'])
        {
        case 'hidden':
          break;
        case 'checkbox':
				  $s .= "\n\t<td><input type=\"checkbox\" id=\"$HtmlId\" onClick=\"dg_checkChange($JsClass,'$rowid','$colid','$HtmlId')\"" . ($coldat?'checked':'') . '>';
          break;
        case 'selectkey':
				  $s .= "\n\t<td id=\"$HtmlId\" onClick=\"dg_editCell($JsClass,'$rowid','$colid','$HtmlId')\"><input type=\"hidden\" id=\"$HtmlId.h\" value=\"".htmlspecialchars($coldat, ENT_QUOTES)."\">";
          $txt=$col['selectvalues'][$coldat];
				  if($txt) 
					  $s .= htmlspecialchars($txt, ENT_QUOTES);
          else 
					  $s .= "KEY: " . htmlspecialchars($coldat, ENT_QUOTES); //XXX
          break;
        default:
				  $s .= "\n\t<td id=\"$HtmlId\" onClick=\"dg_editCell($JsClass,'$rowid','$colid','$HtmlId')\">";
				  if ($coldat !== '') 
					  $s .= htmlspecialchars($coldat, ENT_QUOTES);
          else 
					  $s .= "&nbsp;";
        }
				$s .= "</td>";
        $c++;
			}
			$s .= "\n</tr>";
			$r++;
		}
				
    //save column count
    $this->colcnt=$colcnt;
    
  	return $s;		
	}	
		  
  //generate the JavaScript for the table    
	function GenerateJS() 
  {
    $JsClass=$this->JsClass;
    
    $js = '';
		
    //determine if we need the 'includes'
    global $DataGrid_JsIncluded;
    if(!$DataGrid_JsIncluded)
    {
      $js .= '<script type="text/javascript" src="sack.js"></script>';
      $js .= '<script type="text/javascript" src="datagrid.js"></script>';
      $DataGrid_JsIncluded=1;
    }    
    
    $js .= '<script type="text/javascript">'."\n";
    $js .= "var $JsClass = new dataGrid('$JsClass','$this->RequestFile');\n";

    if(is_array($this->columns)) foreach($this->columns as $k=>$v) 
    {
      $js .= "$JsClass.m_columns['$v[colname]']={'coltype':'$v[coltype]','style':'$v[style]'};\n";
      $opt=array();
      if(is_array($v['selectvalues'])) foreach($v['selectvalues'] as $kk=>$vv) 
      {
        $opt[]="'".htmlentities($kk,ENT_QUOTES)."':'".htmlentities($vv,ENT_QUOTES)."'";
      }
      if($opt) $js .= "$JsClass.m_columns['$v[colname]']['selectvalues']={".join($opt,",")."};\n";    
    }
    
    $js .= '</script>';
    
		return $js;
	}
	
}