<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Client_services extends MX_Controller {

	// --------------------------------------------------------------------
	
	var $xml_output 	= array();
	
	var $clients 		= array();
	
	var $system_folder	= 'iHRMIS';
	
	var $controller		= 'Server_services';
	
	var $update_server  = '';
	
	// --------------------------------------------------------------------
	
	function __construct()
    {
        parent::__construct();
		
		header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
		header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
		
		
		//$this->output->enable_profiler(TRUE);
		//$this->update_server = $this->Settings->get_selected_field('update_server');
		
		//$this->output->enable_profiler(TRUE);
    }  
	
	function sample()
	{
		$this->load->library('xmlrpc');
		$this->load->library('xmlrpcs');
		$this->xmlrpc->set_debug(TRUE);
		$this->load->helper('url');
		
		$server_url = 'http://localhost/iHRMIS/2.0/server_services/';
		//$server_url = 'http://www.mannysoft.com/ats_service/xmlrpc_server';
		$this->xmlrpc->server($server_url, 80);
		$this->xmlrpc->method('sample');
		
		$request = array (
                   array('John', 'string'),
                   array('Doe', 'string'),
                   array(FALSE, 'boolean'),
                   array(12345, 'int')
                 );
				 
		$this->xmlrpc->request($request);
		
		if ( ! $this->xmlrpc->send_request())
		{
			echo $this->xmlrpc->display_error();
		}
		else
		{
			echo '<pre>';
			$msg = $this->xmlrpc->display_response();
			//echo $msg['msg'];
			echo '</pre>';
		}
	}
	
	// --------------------------------------------------------------------
	
	function index($date1 = '', $date2 = '')
	{	
		//mkdir('logs/office', 777);
		$this->load->library('xmlrpc');
		$this->xmlrpc->set_debug(TRUE);
		$this->load->helper('url');
		//$server_url = site_url('xmlrpc_server');
				
		//Change to real client(IP address)
		//$client = "localhost";
		$client = $this->Settings->get_selected_field('client');
		
		$clients = explode(",", $client);
		
		foreach ($clients as $client)
		{
			$server_url = 'http://'.$client.'/'.$this->system_folder.'/'.$this->controller;
			//$server_url = 'http://www.mannysoft.com/ats_service/xmlrpc_server';
	
			$this->xmlrpc->server($server_url, 80);
			$this->xmlrpc->method('dtr');
			
			$today = date('Y-m-d').'';
						
			//$request = $this->getDtr($date1, $date2);
			
			$request = $this->Dtr->get_dtr_range($today, $today, $web_service = TRUE);
			
			$first_day = date('Y-m').'-01';
			
			
			$days = $this->Helps->get_days_in_between($first_day, $today);
			
			//echo '<pre>';
			//print_r($request);
			//echo '</pre>';
			//$this->xmlrpc->request($request);	
			
			
			foreach($days as $day)
			{
				$request = $this->Dtr->get_dtr_range($day, $day, $web_service == TRUE);
				
				$this->xmlrpc->request($request);
				
				if ( ! $this->xmlrpc->send_request())
				{
					echo $this->xmlrpc->display_error();
				}
				else
				{
					echo '<pre>';
					//print_r($this->xmlrpc->display_response());
					$msg = $this->xmlrpc->display_response();
					echo $msg['msg'];
					echo '</pre>';
					
					//Change localtime by the server time
					exec("TIME ".$msg['server_time']);
					exec("DATE ".$msg['server_date']); 
				}
				
			}
			
		}
	}

	function check_updates($system_name = '', $installed_version = '', $license = '')
	{
		
		
		//$this->output->enable_profiler(TRUE);
		
		$this->load->library('xmlrpc');
		//$this->xmlrpc->set_debug(TRUE);
		$this->load->helper('url');
		//$this->load->library('encrypt');
		$this->load->library('session');
		
		$update_server = $this->update_server;
				
		//$server_url = 'http://www.mannysoft.com/updates/xmlrpc_server';
		//$server_url = 'http://'.$update_server.'/ats_service/xmlrpc_server';
		//$server_url = 'http://'.$client.'/'.$this->system_folder.'/'.$this->controller;
		$server_url = 'http://'.$update_server.'/'.$this->system_folder.'/'.$this->controller;
		//$server_url = 'http://'.$update_server.'/xmlrpc_server';
			//echo $server_url;
			
		//echo $server_url;
		//exit;	
			
		$this->xmlrpc->server($server_url, 80);
		$this->xmlrpc->method('check_updates_ats');
					
		$request = array(
				array("$system_name", 'string'),
				array("$installed_version", 'string'),
				array("$license", 'string')
				
				);
		
		$this->xmlrpc->request($request);	
		
		if ( ! $this->xmlrpc->send_request())
		{
			echo $this->xmlrpc->display_error();
			if ($this->xmlrpc->display_error() == "Did not receive a '200 OK' response from remote server. (HTTP/1.1 404 Not Found)")
			{
				echo 'Internet connection required.';
			}
		}
		else
		{
			//echo '<pre>';
			//print_r($this->xmlrpc->display_response());
			$version = $this->xmlrpc->display_response();
			//echo $msg['latest_version'];
			//echo '</pre>';
			//print_r( $version);
			if ($version['latest_version'] > $installed_version)
			{
				$updates_data = array(
                   'system_name'  	=> $version['system_name'],
                   'latest_version' => $version['latest_version'],
                   'filename' 		=> $version['filename'],
				   'ftp' 			=> $version['ftp'],
				   'user'			=> $version['user'],
				   'pass'			=> $version['pass']
               );
				
				//echo $this->session->userdata('filename');
				
				$this->session->set_userdata($updates_data);
				
				echo 'ATS '.$version['latest_version'].' is available! <a href="#" onclick="download_updates(1)">Please update now.</a>';
			}
			else
			{
				echo 'You already have the latest version of iHRMIS installed.';
			}
		}
	}
	
	function download_updates($online = 1)
	{
		//$this->output->enable_profiler(TRUE);
		$this->load->library('ftp');
		$this->load->library('my_ftp');
		$this->load->library('archive_extractor');
		//do this if online update
		if($online == 1)
		{
			$file_name = $this->session->userdata('filename');
			
			$config['hostname'] = $this->session->userdata('ftp');
			$config['username'] = $this->session->userdata('user');
			$config['password'] = $this->session->userdata('pass');
			$config['debug'] = TRUE;
			
			$this->my_ftp->connect($config);
			
			//download the file
			$this->my_ftp->download($file_name);
		}
		else
		{
			//get the parameter as $file_name(use for offline update)
			$file_name = $online;
		}
		//echo $file_name;
		//if $online is zero there is no need to download the file
		//the update file is uploading by user in local
		
		$files=$this->archive_extractor->extractArchive( 'updates/'.$file_name, 'updates/' );
		//echo $files;
		//copy all files extracted to ats
		$this->my_ftp->smart_copy('updates/ats/', '../ats/', $folderPermission=0755,$filePermission=0644);
		
		$this->my_ftp->smart_copy('updates/system/application/', 'system/application/', $folderPermission=0755,$filePermission=0644);
		
		//echo '<pre>';
		//print_r($files);
		//echo '</pre>';
		$this->my_ftp->close();
		
		//Create query if needed
		$this->db->trans_begin();
		
		$sqls = 'updates/ats/sql.txt';
		
		if(file_exists($sqls))
		{
			if ($fd = fopen ($sqls, "r")) 
			{
				while (!feof ($fd)) 
				{ 
					$buffer = fgets($fd, 4096); 
					$lines[] = $buffer; 
				}
				fclose ($fd);
			}

			if($lines[0] != '')
			{
				//print_r($lines);
				foreach($lines as $line)
				{
					//echo $line;
					$this->db->query($line);
				}
			}
			
			//$this->db->query('ALTER TABLE ats_201 ADD aa VARCHAR( 32 ) NOT NULL AFTER permanent_street_no');
			
			if ($this->db->trans_status() === FALSE)
			{
				$this->db->trans_rollback();
			}
			else
			{
				$this->db->trans_commit();
			}
		}	
		//delete the zip file
		if(file_exists('updates/'.$file_name) && $online == 1)
		{
			unlink('updates/'.$file_name);
		}
		
		//delete the zip file
		if(file_exists('../ats/'.$file_name) && $online == 1)
		{
			unlink('../ats/'.$file_name);
		}
		
		$this->load->helper('file');
		
		//update the settings(set the latest version installed)
		$this->Settings->set_latest_version($this->session->userdata('latest_version'));
		
		//if $online equal to zero or offline update
		$offline_file = 'updates/version.txt';
		
		if(file_exists($offline_file))
		{
			$offline_version = file_get_contents($offline_file);
			
			$this->Settings->set_latest_version($offline_version);
		}	
		
		//empty file in updates directory in ats_service
		delete_files('updates/');
		
		echo "You've been updated to the latest version of ATS. Thanks for your time!";
		unset($_SESSION['offline_update_file']);
		//echo 'ok';
	}
	
	function download_logs()
	{
		$this->output->enable_profiler(TRUE);
		$this->load->library('xmlrpc');
		$this->xmlrpc->set_debug(TRUE);
		$this->load->helper('url');
		//$this->load->library('encrypt');
		$this->load->library('session');
		
		$update_server = $this->update_server;
				
		//$server_url = 'http://www.mannysoft.com/updates/xmlrpc_server';
		//$server_url = 'http://'.$update_server.'/ats_service/xmlrpc_server';
		$server_url = 'http://'.$update_server.'/'.$this->system_folder.'/'.$this->controller;
			//echo $server_url;
		$this->xmlrpc->server($server_url, 80);
		$this->xmlrpc->method('download_logs');
					
		$request = array(
				array(date('Y-m-d'), 'string')
				);
		
		$this->xmlrpc->request($request);	
		
		if ( ! $this->xmlrpc->send_request())
		{
			echo $this->xmlrpc->display_error();
			if ($this->xmlrpc->display_error() == "Did not receive a '200 OK' response from remote server. (HTTP/1.1 404 Not Found)")
			{
				echo 'Internet connection required.';
			}
		}
		else
		{
			//echo '<pre>';
			//print_r($this->xmlrpc->display_response());
			$dtrs = $this->xmlrpc->display_response();
			//echo $msg['latest_version'];
			//echo '</pre>';
			
			foreach ($dtrs as $dtr)
			{
				$data = array(
				'employee_id' 	=> $dtr['employee_id'],
				'log_date' 		=> $dtr['log_date'],
				'am_login' 		=> $dtr['am_login'],
				'am_logout' 	=> $dtr['am_logout'],
				'pm_login' 		=> $dtr['pm_login'],
				'pm_logout'		=> $dtr['pm_logout'],
				'ot_login' 		=> $dtr['ot_login'],
				'ot_logout' 	=> $dtr['ot_logout'],
				'manual_log_id' => $dtr['manual_log_id'],
				'office_id' 	=> $dtr['office_id'],
				'shift_id' 		=> $dtr['shift_id']
				);
				
				//Check if the employee has log on that date
				$isEmployeeLog = $this->isEmployeeLog($dtr['log_date'], $dtr['employee_id']);
				
				//update the dtr table
				if ($isEmployeeLog == TRUE)
				{
					//echo 'ok';
					
					$this->updateDtr('am_login', $dtr['am_login'], $dtr['log_date'], 
									$dtr['employee_id'], $dtr['office_id']);
					
					$this->updateDtr('am_logout', $dtr['am_logout'], $dtr['log_date'], 
									$dtr['employee_id'], $dtr['office_id']);
					
					$this->updateDtr('pm_login', $dtr['pm_login'], $dtr['log_date'], 
									$dtr['employee_id'], $dtr['office_id']);
					
					$this->updateDtr('pm_logout', $parameter['pm_logout'], $parameter['log_date'], 
									$dtr['employee_id'], $dtr['office_id']);
					
					$this->updateDtr('ot_login', $dtr['ot_login'], $dtr['log_date'], 
									$dtr['employee_id'], $dtr['office_id']);
					
					$this->updateDtr('ot_logout', $dtr['ot_logout'], $dtr['log_date'], 
									$dtr['employee_id'], $dtr['office_id']);
					
				}
				else if ($isEmployeeLog == FALSE)
				{
					$this->db->insert('dtr', $data);
				}
			}
		}
	}
	
	function send_template($filename, $id)
	{
		//$this->output->enable_profiler(TRUE);
		$this->load->library('xmlrpc');
		//$this->xmlrpc->set_debug(TRUE);
		$this->load->helper('url');
		//$this->load->library('encrypt');
		$this->load->library('session');
		
		$update_server = $this->get_update_server();
				
		$server_url = 'http://'.$update_server.'/ats_service/xmlrpc_server';
				
		//$server_url = 'http://localhost/hris/xmlrpc_server';
		//echo $server_url;
		$this->xmlrpc->server($server_url, 80);
		$this->xmlrpc->method('received_template');
		
		//$filename = "license.txt";
		$filename1 = "../identity2009/templates/".$filename;
		$handle = fopen($filename1, "r");
		$contents = fread($handle, filesize($filename1));
		
		$encoded = base64_encode($contents);
		fclose($handle);
		
		//echo $encoded;
					
		$request = array(
				array($encoded, 'base64'),
				array($filename, 'string'),
				array($id, 'string')
				);
		
		$this->xmlrpc->request($request);	
		
		if ( ! $this->xmlrpc->send_request())
		{
			echo $this->xmlrpc->display_error();
			if ($this->xmlrpc->display_error() == "Did not receive a '200 OK' response from remote server. (HTTP/1.1 404 Not Found)")
			{
				echo 'Internet connection required.';
			}
		}
		
		else
		{
			//echo '<pre>';
			//print_r($this->xmlrpc->display_response());
			$msg = $this->xmlrpc->display_response();
			echo '<b><font color=red>'.$msg['msg'].'</font></b>';
			//echo '<b><font color=red>'.$msg['other_message'].'</font></b>';
			//echo '</pre>';
		}
	}
	
	function get_leave_balances($employee_id)
	{
		
		//echo 'SO THIS IS THE MOMENT';
		$this->load->library('xmlrpc');
		//$this->xmlrpc->set_debug(TRUE);
		$this->load->helper('url');
		//$this->load->library('encrypt');
		$this->load->library('session');
		
		$update_server = $this->get_update_server();
				
		$server_url = 'http://'.$update_server.'/ats_service/xmlrpc_server';
				
		//$server_url = 'http://localhost/hris/xmlrpc_server';
			//echo $server_url;
		$this->xmlrpc->server($server_url, 80);
		$this->xmlrpc->method('get_leave_balances');
					
		$request = array(
				array($employee_id, 'string')
				);
		
		$this->xmlrpc->request($request);	
		
		if ( ! $this->xmlrpc->send_request())
		{
			echo $this->xmlrpc->display_error();
			if ($this->xmlrpc->display_error() == "Did not receive a '200 OK' response from remote server. (HTTP/1.1 404 Not Found)")
			{
				echo 'Internet connection required.';
			}
		}
		
		else
		{
			//echo '<pre>';
			$balances = $this->xmlrpc->display_response();
			
			echo '<b>SICK LEAVE: '.$balances['sick_leave'].'</b><br>';
			echo '<b>VACATION LEAVE: '.$balances['vacation_leave'].'</b><br><br>';
			echo '<b>TOTAL LEAVE: ';
			echo $balances['vacation_leave'] + $balances['sick_leave'];
			echo '<br><b>MONETARY EQUIVALENT: '.$balances['monetary_equivalent'].'</b>';
			//echo '</pre>';
		}
	}
	
	function bug_report($username, $subject, $message)
	{
		echo 'ok';
		exit;
		//echo 'SO THIS IS THE MOMENT';
		$this->load->library('xmlrpc');
		//$this->xmlrpc->set_debug(TRUE);
		$this->load->helper('url');
		//$this->load->library('encrypt');
		$this->load->library('session');
		
		$update_server = $this->get_update_server();
				
		$server_url = 'http://'.$update_server.'/ats_service/xmlrpc_server';
				
		//$server_url = 'http://localhost/hris/xmlrpc_server';
			//echo $server_url;
		$this->xmlrpc->server($server_url, 80);
		$this->xmlrpc->method('get_leave_balances');
					
		$request = array(
				array($employee_id, 'string')
				);
		
		$this->xmlrpc->request($request);	
		
		if ( ! $this->xmlrpc->send_request())
		{
			echo $this->xmlrpc->display_error();
			if ($this->xmlrpc->display_error() == "Did not receive a '200 OK' response from remote server. (HTTP/1.1 404 Not Found)")
			{
				echo 'Internet connection required.';
			}
		}
		
		else
		{
			//echo '<pre>';
			$balances = $this->xmlrpc->display_response();
			
			echo '<b>SICK LEAVE: '.$balances['sick_leave'].'</b><br>';
			echo '<b>VACATION LEAVE: '.$balances['vacation_leave'].'</b><br><br>';
			echo '<b>TOTAL LEAVE: ';
			echo $balances['vacation_leave'] + $balances['sick_leave'];
			echo '<br><b>MONETARY EQUIVALENT: '.$balances['monetary_equivalent'].'</b>';
			//echo '</pre>';
		}
	}
}

/* End of file client_services.php */
/* Location: ./system/application/modules/client_services/controllers/client_services.php */