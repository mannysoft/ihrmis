<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Integrated Human Resource Management Information System
 *
 * An Open Source Application Software use by Government agencies for  
 * management of employees Attendance, Leave Administration, Payroll, 
 * Personnel Training, Service Records, Performance, Recruitment,
 * Personnel Schedule(Plantilla) and more...
 *
 * @package		iHRMIS
 * @author		Manny Isles
 * @copyright	Copyright (c) 2008 - 2013, Charliesoft
 * @license		http://charliesoft.net/ihrmis/license
 * @link		http://charliesoft.net
 * @github	    http://github.com/mannysoft/ihrmis
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * iHRMIS Utility Class
 *
 * This class use for processing data from remote scanner.
 *
 * @package		iHRMIS
 * @subpackage	Controllers
 * @category	Utilities
 * @author		Manny Isles
 * @link		http://charliesoft.net
 * @github	    http://github.com/mannysoft/ihrmis/hrmis/user_guide/controllers/utility.html
 */

class Utility extends MX_Controller {

	// --------------------------------------------------------------------
	
	public $xml			= '';
	public $office_id 	= 1;
	
	// --------------------------------------------------------------------
	
	function __construct()
    {
	    parent::__construct();
		//$this->output->enable_profiler(TRUE);
    }  
	
	// --------------------------------------------------------------------
	
	function manual_upload_data($file_type = 'xml')
	{
		$config['upload_path'] 		= './logs/uploaded/';
		$config['allowed_types'] 	= 'zip|jpg|png|txt';
		//$config['allowed_types'] = 'application/zip';
		$config['overwrite'] 		= TRUE;
		$config['remove_spaces'] 	= TRUE;
		//$config['max_size']	= '100';
		//$config['max_width']  = '1024';
		//$config['max_height']  = '768';
		
		//echo 'ok';
			//exit;
		
		$this->load->library('upload', $config);
	
		if ( ! $this->upload->do_upload('file'))
		{
			$error = array('error' => $this->upload->display_errors());
			
			//print_r( $error);
			
			
			//$this->load->view('upload_form', $error);
		}	
		else
		{
			$data = array('upload_data' => $this->upload->data());
			
			// Use for uploading text file
			// =====================================================
			if ($data['upload_data']['file_ext'] == '.txt')
			{
				set_time_limit(0);
				
				// Process text file
				
				//Read the logs file and put to db
				$TempTXT = 'logs/uploaded/'.$data['upload_data']['file_name'];
				
				//print_r($data);
				if (!file_exists($TempTXT))
				{
					$TempTXT = 't4_connect/logs/temp.txt';
				}
				
				if ($fd = fopen ($TempTXT, "r")) 
				{
					while (!feof ($fd)) 
					{ 
						$lines[] = fgets($fd, 4096); 
					}
				  fclose ($fd);
				}
				
				sort($lines);
				
				$log_type 	 = '';
				$ampm 	  	 = '';
				$employee_id = '';
				$log_date	 = '';
				
				foreach($lines as $line)
				{
					$line = ltrim($line);
					
					//echo $line.'<br>';
					
					if (count(explode("\t", $line)) != 6)
					{
						$employee_id = '';
						$date_time = '' ;
						$stat = '';
						$inout = '';
					}
					else
					{
						list($employee_id, $date_time, $stat, $inout)  = explode("\t", $line);
					}
					
					$employee_id  = sprintf("%03d",$employee_id); 
					
					
					if (count(explode(" ", $date_time)) != 2)
					{
						$date = '';
						$time = '';
					}
					else
					{
						list($date, $time)  = explode(' ', $date_time);
					}
					
					
					$time = date('H:i', strtotime($time));
				
					//0 = in , 1 = out
					
					// get the office id of an employee
					$office_id = $this->Employee->get_single_field('office_id', $employee_id);
					
					
					
					//INSERT to table
					$info = array(
								"employee_id" 	=> $employee_id,
								"office_id"		=> $office_id,
								"log_date" 		=> $date,
								"logs" 			=> $time,
								"log_type" 		=> $inout,
								"date_extract" 	=> date('Y-m-d')
								);
				
					$id = $this->Dtr_temp->insert_dtr_temp($info);
					
					
					
					//echo( $time).'<br>';
					//echo $line.'<br>';
				}
				
				//INSERT the logs to dtr table
				$this->Stand_alone->get_logs();
			?>
			<script>
            alert("Manual uploading success!");
			javascript:parent.change_parent_url('<?php echo base_url().'home/home_page'?>');
            </script>
			<?php
			
			exit;
				
			}
			
			
			// =====================================
			
			//print_r($data);
			
			//echo $data['file_ext'] ;
			
			//echo 'ok';
			
			
			$file_name = $data['upload_data']['file_name'];
			
			//echo $file_name;
			
			$this->load->library('ftp');
			//$this->load->library('my_ftp');
			$this->load->library('archive_extractor');
			
			//list($office_id, $day, $year) = split('[-.-]', $file_name);
			list($office_id, $day, $year) = explode('-', $file_name);
			
			//Extract the file to office id folder
			$files=$this->archive_extractor->extractArchive( 'logs/uploaded/'.$file_name, 'logs/uploaded/'.$office_id.'/' );
			
			//process logs
			$this->office_id = $office_id;
			$this->process_logs();
			
			//delete the zip file
			if(file_exists('logs/uploaded/'.$file_name))
			{
				unlink('logs/uploaded/'.$file_name);
			}
			
			?>
			<script>
            alert("Manual uploading success!");
			javascript:parent.change_parent_url('<?php echo base_url().'home/home_page'?>');
            </script>
			<?php
			//echo '<b><font color=red>Manual uploading success!</font></b>';
			
		}
	}
	
	// --------------------------------------------------------------------
	
	function process_logs()
	{
		
		// Need to change the error reporting in index.php
		// Show all errors, except for notices
		 error_reporting(E_ALL & ~E_NOTICE);
		
		$office_id = $this->office_id;
		
		//$office_id = 21;
		
		// For DTR
		$xml_data=file_get_contents('logs/uploaded/'.$office_id.'/logs/dtr.xml');
		
		$this->XmlToArray($xml_data);
		
		// Creating Array
		$arrayData = $this->createArray();
						
		if (array_key_exists('dtr', $arrayData['root']))
		{
			foreach($arrayData['root']['dtr'] as $dtr)
			{
				$office_id2 = $this->Employee->get_single_field('office_id', $dtr['employee_id']);
				
				$is_log_exists = $this->Dtr->is_log_date_exists($dtr['employee_id'], $dtr['log_date']);
				
				if ($is_log_exists == FALSE)
				{
					$dtr['leave_type_id'] 	= ($dtr['leave_type_id'] == 0) ? '' : $dtr['leave_type_id'];
					$dtr['leave_half_day'] 	= ($dtr['leave_half_day'] == 0) ? '' : $dtr['leave_half_day'];
					
					$dtr['pm_login'] 	= $this->format_logs($dtr['pm_login']);
					$dtr['pm_logout'] 	= $this->format_logs($dtr['pm_logout']);
					$dtr['ot_login'] 	= $this->format_logs($dtr['ot_login']);
					$dtr['ot_logout'] 	= $this->format_logs($dtr['ot_logout']);
					
					$data = array(
					   'employee_id' 	=> $dtr['employee_id'],
					   'log_date' 		=> $dtr['log_date'],
					   'am_login' 		=> $dtr['am_login'],
					   'am_logout' 		=> $dtr['am_logout'],
					   'pm_login' 		=> $dtr['pm_login'],
					   'pm_logout' 		=> $dtr['pm_logout'],
					   'ot_login' 		=> $dtr['ot_login'],
					   'ot_logout' 		=> $dtr['ot_logout'],
					   'office_id' 		=> $office_id2,
					   'shift_id' 		=> $dtr['shift_id'],
					   'leave_type_id' 	=> $dtr['leave_type_id'],
					   'leave_half_day' => $dtr['leave_half_day']
					);
					
					$this->Dtr->insert_dtr($data); 
				}
				else
				{
					//update the dtr
					
					if($dtr['am_login'] != '')
					{										
						$data = array(
									'am_login' 	=> $dtr['am_login'],
									'office_id'	=> $office_id2
									);				
										
						$this->Dtr->edit_dtr($data, $dtr['employee_id'], $dtr['log_date']);			
					}
					
					
					
					if($dtr['am_logout'] != '')
					{									
						$data = array(
									'am_logout' => (is_array($dtr['am_logout'])) ? '' : $dtr['am_logout'],
									'office_id'	=> $office_id2
									);				
										
						$this->Dtr->edit_dtr($data, $dtr['employee_id'], $dtr['log_date']);						
					}				
					
					if($dtr['pm_login'] != '')
					{
						$dtr['pm_login'] 	= $this->format_logs($dtr['pm_login']);
															
						$data = array(
									'pm_login' => $dtr['pm_login'],
									'office_id'	=> $office_id2
									);				
										
						$this->Dtr->edit_dtr($data, $dtr['employee_id'], $dtr['log_date']);						
					}
					if($dtr['pm_logout'] != '')
					{
						$dtr['pm_logout'] 	= $this->format_logs($dtr['pm_logout']);
															
						$data = array(
									'pm_logout' => $dtr['pm_logout'],
									'office_id'	=> $office_id2
									);				
										
						$this->Dtr->edit_dtr($data, $dtr['employee_id'], $dtr['log_date']);							
					}
					if($dtr['ot_login'] != '')
					{
						
						$dtr['ot_login'] 	= $this->format_logs($dtr['ot_login']);
															
						$data = array(
									'ot_login' => $dtr['ot_login'],
									'office_id'	=> $office_id2
									);				
										
						$this->Dtr->edit_dtr($data, $dtr['employee_id'], $dtr['log_date']);							
					}
					if($dtr['ot_logout'] != '')
					{
						$dtr['ot_logout'] 	= $this->format_logs($dtr['ot_logout']);
															
						$data = array(
									'ot_logout' => $dtr['ot_logout'],
									'office_id'	=> $office_id2
									);				
										
						$this->Dtr->edit_dtr($data, $dtr['employee_id'], $dtr['log_date']);						
					}
							
				}
					
			}
		}
		
		echo 'ok';
		exit;
		//$xml_data=file_get_contents('logs/uploaded/'.$office_id.'/logs/dtr.xml');
		
		//For LOgs
		$xml_data=file_get_contents('logs/uploaded/'.$office_id.'/logs/logs.xml');
		
		$this->XmlToArray($xml_data);
		
		//Creating Array
		$arrayData = $this->createArray();
		
		if (array_key_exists('logs', $arrayData['root']))
		{		
			foreach($arrayData['root']['logs'] as $logs)
			{
				$is_log_exists = $this->Logs->is_log_exists($logs['username'], $logs['office_id'], $logs['date']);
				
				if ($is_log_exists == FALSE)
				{
				
					$data = array(
					   'username' 				=> $logs['username'] ,
					   'office_id' 				=> $logs['office_id'] ,
					   'command' 				=> $logs['command'],
					   'details' 				=> $logs['details'],
					   'employee_id_affected' 	=> $logs['employee_id_affected'] ,
					   'date' 					=> $logs['date'] 
					);
					
					//$this->Logs->add_logs($data); 
				}
				
			}
		}	
		
		
		//For Employee
		$xml_data=file_get_contents('logs/uploaded/'.$office_id.'/logs/employee.xml');
		
		$this->XmlToArray($xml_data);
		
		//Creating Array
		$arrayData = $this->createArray();
		
		if (array_key_exists('employee', $arrayData['root']))
		{		
			foreach($arrayData['root']['employee'] as $employee)
			{
				$is_employee_exists = $this->Employee->is_employee_id_exists($employee['id']);
				
				if ($is_employee_exists == FALSE)
				{
				
					$data = array(
					   'id' 				=> $employee['id'],
					   'salut' 				=> $employee['salut'],
					   'fname' 				=> $employee['fname'],
					   'mname' 				=> $employee['mname'],
					   'lname' 				=> $employee['lname'],
					   'salary_grade' 		=> $employee['salary_grade'] ,
					   'step' 				=> $employee['step'],
					   'monthly_salary' 	=> $employee['monthly_salary'],
					   'permanent' 			=> $employee['permanent'],
					   'office_id' 			=> $employee['office_id'],
					   'detailed_office_id' => $employee['detailed_office_id'],
					   'pics' 				=> $employee['pics'],
					   'status' 			=> $employee['status'],
					   'shift_id' 			=> $employee['shift_id'] ,
					   'shift_type' 		=> $employee['shift_type']  
					);
					
					$this->Employee->add_employee($data); 
				}
				
			}
			
		}
		
		$response = array (
                   array(
                         'msg' => array('Uploading data to server success!!!', 'string'),
                         'description' => array('OK', 'string'),
                         'other_message' => array('sample', 'string')
                        ),
                 'struct'
                 );
				 
		//delete the files
		$this->load->helper('file');
		delete_files('logs/uploaded/'.$office_id.'/', TRUE);	 
						
		//return $this->xmlrpc->send_response($response);
	}
	
	function format_logs($log = '')
	{
		
		if ($log < '13:00' && $log != '') 
		{
			$log = strtotime($log.' PM');
			$log = date('H:i', $log);
			
			return $log;
		}
		
		return $log;
	}
	
	// --------------------------------------------------------------------
	
	function upload_image()
	{
		$config['upload_path'] = './pics/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['overwrite'] 		= FALSE;
		//$config['remove_spaces'] 	= TRUE;
		//$config['max_size']	= '100';
		//$config['max_width']  = '1024';
		//$config['max_height']  = '768';
		
		$this->load->library('upload', $config);
	
		if ( ! $this->upload->do_upload('file'))
		{
			$error = array('error' => $this->upload->display_errors());
			//$this->load->view('upload_form', $error);
			//echo 'whahahahhaa';
		}	
		else
		{
			$data = array('upload_data' => $this->upload->data());
			
			$config['image_library'] = 'gd2';
			$config['source_image'] = 'pics/'.$data['upload_data']['file_name'];
			//$config['create_thumb'] = TRUE;
			$config['maintain_ratio'] = TRUE;
			$config['width'] = 220;
			$config['height'] = 220;
			
			$this->load->library('image_lib', $config);
			
			$this->image_lib->resize();
			
			echo $this->image_lib->display_errors();
			
			// Put the file name to session
			$this->session->set_userdata('file_register', $data['upload_data']['file_name']);
			
			echo '<img src="'.base_url().'pics/'.$data['upload_data']['file_name'].'" />';
			//$this->load->view('upload_success', $data);
		}
	}
	
	// --------------------------------------------------------------------
	
	function show_image($image_file_name = '')
	{
		echo '<img src="'.base_url().'pics/'.$image_file_name.'" alt="loading image..."/>';
	}
	
	// --------------------------------------------------------------------
	
	/**
    * Default Constructor
    * @param $xml = xml data
    * @return none
    */
    function XmlToArray($xml)
    {
       $this->xml = $xml;   
    }
	
	// --------------------------------------------------------------------
   
    /**
    * _struct_to_array($values, &$i)
    *
    * This is adds the contents of the return xml into the array for easier processing.
    * Recursive, Static
    *
    * @access    private
    * @param    array  $values this is the xml data in an array
    * @param    int    $i  this is the current location in the array
    * @return    Array
    */
    function _struct_to_array($values, &$i)
    {
        $child = array();
        if (isset($values[$i]['value'])) array_push($child, $values[$i]['value']);
       
        while ($i++ < count($values)) {
            switch ($values[$i]['type']) {
                case 'cdata':
                array_push($child, $values[$i]['value']);
                break;
               
                case 'complete':
                    $name = $values[$i]['tag'];
                    if(!empty($name)){
                    $child[$name]= ($values[$i]['value'])?($values[$i]['value']):'';
                    if(isset($values[$i]['attributes'])) {                   
                        $child[$name] = $values[$i]['attributes'];
                    }
                }   
              break;
               
                case 'open':
                    $name = $values[$i]['tag'];
                    $size = isset($child[$name]) ? sizeof($child[$name]) : 0;
                    $child[$name][$size] = $this->_struct_to_array($values, $i);
                break;
               
                case 'close':
                return $child;
                break;
            }
        }
        return $child;
    }//_struct_to_array
   	
	// --------------------------------------------------------------------
	
    /**
    * createArray($data)
    *
    * This is adds the contents of the return xml into the array for easier processing.
    *
    * @access    public
    * @param    string    $data this is the string of the xml data
    * @return    Array
    */
    function createArray()
    {
        $xml    = $this->xml;
        $values = array();
        $index  = array();
        $array  = array();
        $parser = xml_parser_create();
        xml_parser_set_option($parser, XML_OPTION_SKIP_WHITE, 1);
        xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, 0);
        xml_parse_into_struct($parser, $xml, $values, $index);
        xml_parser_free($parser);
        $i = 0;
        $name = $values[$i]['tag'];
        $array[$name] = isset($values[$i]['attributes']) ? $values[$i]['attributes'] : '';
        $array[$name] = $this->_struct_to_array($values, $i);
        return $array;
    }//createArray
	
	// --------------------------------------------------------------------
	
	function xml_leave_credits($employee_id = '')
	{
		$total_leave = $this->Leave_card->get_total_leave_credits($employee_id);

		header('Content-type: application/xml');
		header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
		header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
		echo '<?xml version="1.0" encoding="UTF-8"?>
		<leave>
		  <name credits="0">
			<last_earn>'.$total_leave['last_earn'].'</last_earn>
			<vacation>'.$total_leave['vacation'].'</vacation>
			<sick>'.$total_leave['sick'].'</sick>
			<mc>'.$total_leave['mc'].'</mc>
			<forced>'.$total_leave['forced'].'</forced>
			<monetary_equivalent>'.$total_leave['monetary_equivalent'].'</monetary_equivalent>
		  </name>
		</leave>';	
	}
	
	// --------------------------------------------------------------------
	
	function xml_login($username = '', $password = '')
	{
		$success = 1;
		
		$data = $this->User->validate_user($username, $password);
				
		if ($data['system_message'] == 'valid')
		{
			$success = 1;
		}
		else
		{
			$success = 0;
		}
		
		header('Content-type: application/xml');
		header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
		header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
		echo '<?xml version="1.0" encoding="UTF-8"?>
		<leave>
		  <name credits="0">
			<success>'.$success.'</success>
		  </name>
		</leave>';	
	}
	
	// --------------------------------------------------------------------

	function xml_image($filename = '')
	{
		if (file_exists('pics/'.$filename)) {
			
			$success = 1;
		}
		else
		{
			$success = 0;

		}
		
		header('Content-type: application/xml');
		header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
		header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
		echo '<?xml version="1.0" encoding="UTF-8"?>
		<leave>
		  <name credits="0">
			<success>'.$success.'</success>
		  </name>
		</leave>';	
	}

	function show_image_url($employee_id = '')
	{
		//echo '3';
		//exit;

		$e = new Employee_m();
		$e->get_by_employee_id($employee_id);
		//echo $this->db->last_query();
		echo '<img src="'.base_url().'pics/'.$e->pics.'">';
	}
}