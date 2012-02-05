<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Server_services extends MX_Controller  {

	// --------------------------------------------------------------------
	
	var $xml				='';
	var $office_id 			= 1;
	
	var $system_name		= '';
	var $installed_version	= '';
	var $latest_version		= '';
	var $license			= '';
	
	// --------------------------------------------------------------------
	
	function __construct()
    {
        parent::__construct();
		
		
		//echo 'ok';
		$this->load->library('xmlrpc');
		$this->load->library('xmlrpcs');
		
		//$this->xmlrpc->set_debug(TRUE);
		
		$config['functions']['sample'] 				= array('function' => 'Server_services.sample');
		
		$this->xmlrpcs->initialize($config);
		$this->xmlrpcs->serve();
		
		
    }  
	
	// --------------------------------------------------------------------
	
	function index()
	{
		$this->load->library('xmlrpc');
		$this->load->library('xmlrpcs');
		//$this->xmlrpc->set_debug(TRUE);
		
		$config['functions']['dtr'] 				= array('function' => 'Server_services.process');
		
		$config['functions']['check_updates_ats'] 	= array('function' => 'Server_services.check_updates');
		
		$config['functions']['download_logs']		= array('function' => 'Server_services.download_logs');
		
		$config['functions']['received_template'] 	= array('function' => 'Server_services.received_template');
		
		$config['functions']['get_leave_balances'] 	= array('function' => 'Server_services.serve_leave_balances');
		
		$config['functions']['server_date_time'] 	= array('function' => 'Server_services.server_date_time');
		
		$config['functions']['sample'] 				= array('function' => 'Server_services.sample');
		
		$this->xmlrpcs->initialize($config);
		$this->xmlrpcs->serve();
	}
	
	function sample($request)
	{
		$parameters = $request->output_parameters();
		
		$response = array (
                   array(
                         'latest_version' 	=> array("sample", 'string'),
                         'filename' 		=> array("sample", 'string')
                        ),
                 'struct'
                 ); 
						
		return $this->xmlrpc->send_response($response);
	}
	
	// --------------------------------------------------------------------
	
	function process($request)
	{
		$parameters = $request->output_parameters();
							
		foreach ($parameters as $parameter)
		{
			if($parameter['am_login'] == '')
			{
				$parameter['am_login'] = '';
			}
			if($parameter['am_logout'] == '')
			{
				$parameter['am_logout'] = '';
			}
			if($parameter['pm_login'] == '')
			{
				$parameter['pm_login'] = '';
			}
			if($parameter['pm_logout'] == '')
			{
				$parameter['pm_logout'] = '';
			}
			if($parameter['ot_login'] == '')
			{
				$parameter['ot_login'] = '';
			}
			if($parameter['ot_logout'] == '')
			{
				$parameter['ot_logout'] = '';
			}
			if($parameter['manual_log_id'] == '')
			{
				$parameter['manual_log_id'] = '';
			}
			
			// Get office_id
			$office_id = $this->Employee->get_single_field('office_id', $parameter['employee_id']);
			
			
			if ($parameter['pm_login'] < '13:00' && $parameter['pm_login'] != '') 
			{
				$parameter['pm_login'] = strtotime($parameter['pm_login'].' PM');
				$parameter['pm_login'] = date('H:i', $parameter['pm_login']);
			}
			
			if ($parameter['pm_logout'] < '13:00' && $parameter['pm_logout'] != '') 
			{
				$parameter['pm_logout'] = strtotime($parameter['pm_logout'].' PM');
				$parameter['pm_logout'] = date('H:i', $parameter['pm_logout']);
			}
			
			if ($parameter['ot_login'] < '13:00' && $parameter['ot_login'] != '') 
			{
				$parameter['ot_login'] = strtotime($parameter['ot_login'].' PM');
				$parameter['ot_login'] = date('H:i', $parameter['ot_login']);
			}
			
			if ($parameter['ot_logout'] < '13:00' && $parameter['ot_logout'] != '') 
			{
				$parameter['ot_logout'] = strtotime($parameter['ot_logout'].' PM');
				$parameter['ot_logout'] = date('H:i', $parameter['ot_logout']);
			}
			
			// Check if the employee has log on that date
			$is_log_date_exists = $this->Dtr->is_log_date_exists($parameter['employee_id'], $parameter['log_date']);
			
			// Update the dtr table
			if ($is_log_date_exists == TRUE)
			{
				if($parameter['am_login'] != '')
				{				
					$data = array(
								'am_login' 	=> $parameter['am_login'],
								'office_id' => $office_id
								);				
									
					$this->Dtr->edit_dtr($data, $parameter['employee_id'], $parameter['log_date']);				
				}				
				if($parameter['am_logout'] != '')
				{			
					$data = array(
								'am_logout' => $parameter['am_logout'],
								'office_id' => $office_id
								);				
									
					$this->Dtr->edit_dtr($data, $parameter['employee_id'], $parameter['log_date']);							
				}				
				
				if($parameter['pm_login'] != '')
				{
					if ($parameter['pm_login'] < '13:00') 
					{
						$parameter['pm_login'] = strtotime($parameter['pm_login'].' PM');
						$parameter['pm_login'] = date('H:i', $parameter['pm_login']);
					}
								
					$data = array(
								'pm_login' => $parameter['pm_login'],
								'office_id' => $office_id
								);				
									
					$this->Dtr->edit_dtr($data, $parameter['employee_id'], $parameter['log_date']);				
				}
				if($parameter['pm_logout'] != '')
				{
					if ($parameter['pm_logout'] < '13:00') 
					{
						$parameter['pm_logout'] = strtotime($parameter['pm_logout'].' PM');
						$parameter['pm_logout'] = date('H:i', $parameter['pm_logout']);
					}
					
					$data = array(
								'pm_logout' => $parameter['pm_logout'],
								'office_id' => $office_id
								);				
									
					$this->Dtr->edit_dtr($data, $parameter['employee_id'], $parameter['log_date']);	
				}
				if($parameter['ot_login'] != '')
				{
					if ($parameter['ot_login'] < '13:00') 
					{
						$parameter['ot_login'] = strtotime($parameter['ot_login'].' PM');
						$parameter['ot_login'] = date('H:i', $parameter['ot_login']);
					}
					
					$data = array(
								'ot_login' => $parameter['ot_login'],
								'office_id' => $office_id
								);				
									
					$this->Dtr->edit_dtr($data, $parameter['employee_id'], $parameter['log_date']);	
				}
				if($parameter['ot_logout'] != '')
				{
					if ($parameter['ot_logout'] < '13:00') 
					{
						$parameter['ot_logout'] = strtotime($parameter['ot_logout'].' PM');
						$parameter['ot_logout'] = date('H:i', $parameter['ot_logout']);
					}
					
					$data = array(
								'ot_logout' => $parameter['ot_logout'],
								'office_id' => $office_id
								);				
									
					$this->Dtr->edit_dtr($data, $parameter['employee_id'], $parameter['log_date']);	
				}
			}
			else if ($is_log_date_exists == FALSE)
			{
				$data = array(
						'employee_id' 	=> $parameter['employee_id'],
						'log_date' 		=> $parameter['log_date'],
						'am_login' 		=> $parameter['am_login'],
						'am_logout' 	=> $parameter['am_logout'],
						'pm_login' 		=> $parameter['pm_login'],
						'pm_logout'		=> $parameter['pm_logout'],
						'ot_login' 		=> $parameter['ot_login'],
						'ot_logout' 	=> $parameter['ot_logout'],
						'manual_log_id' => $parameter['manual_log_id'],
						'office_id' 	=> $office_id,
						'shift_id' 		=> $parameter['shift_id']
						);
				
				$this->Dtr->insert_dtr($data);
			}
		}
		
		//get the mysql date and time for time and date
		$server_date = $this->server_date_time();
		
		
		$response = array (
                   array(
                         'msg' => array('Uploading data to server success!', 'string'),
                         'description' => array('OK', 'string'),
                         'other_message' => array('Thanks', 'string'),
						 'server_time' => array($server_date['time'], 'string'),
						 'server_date' => array($server_date['date'], 'string')
                        ),
                 'struct'
                 ); 
						
		return $this->xmlrpc->send_response($response);
	}
	
	// --------------------------------------------------------------------
	
	function get_logs($office_id)
	{
		$this->load->library('xmlrpc');
		$this->load->library('xmlrpcs');
		$this->xmlrpc->set_debug(TRUE);
		
		$this->office_id = $office_id;
		
		$config['functions']['logs'] = array('function' => 'Xmlrpc_server.process_logs');
		
		$this->xmlrpcs->initialize($config);
		$this->xmlrpcs->serve();
	}
	
	// --------------------------------------------------------------------
	
	function check_updates($request)
	{
		
		$parameters = $request->output_parameters();
							
		$this->system_name 		 = $parameters[0];
		$this->installed_version = $parameters[1];
		$this->license			 = $parameters[2];
		
		$this->load->library('encrypt');
		
		$latest_version = $this->get_latest_version();
		
		$response = array (
                   array(
                         'latest_version' 	=> array($latest_version['latest_version'], 'string'),
                         'filename' 		=> array($latest_version['filename'], 'string'),
                         'ftp' 				=> array($latest_version['ftp'], 'string'),
						 'user' 			=> array($latest_version['user'], 'string'),
                         'pass' 			=> array($latest_version['pass'], 'string')
                        ),
                 'struct'
                 ); 
						
		return $this->xmlrpc->send_response($response);
	}
	
	// --------------------------------------------------------------------
	
	function get_latest_version()
	{		
		return $this->Settings->get_selected_field('latest_version');
	}
	
	// --------------------------------------------------------------------
	
	function download_logs($request)
	{
		$parameters 	= $request->output_parameters();
							
		$date 		 	= $parameters[0];
		
		$dtr 			= $this->Dtr->get_dtr($date);
						 
		$response 		= array($dtr, 'struct');
						
		return $this->xmlrpc->send_response($response);
	}
	
	// --------------------------------------------------------------------
	
	function received_template($request)
	{
		$parameters = $request->output_parameters();
		
		/*					
		//$filename = '../identity2009/templates/'.$parameters[1];
		$filename = '../i/i/'.$parameters[1];
		//$somecontent = "Add this to the file\n";
		
		
		$somecontent = base64_decode($parameters[0]);
		
		// Let's make sure the file exists and is writable first.
		//if (is_writable($filename)) {
		$msg = "Success, wrote ($encoded) to file ($filename)";
		// In our example we're opening $filename in append mode.
		// The file pointer is at the bottom of the file hence
		// that's where $somecontent will go when we fwrite() it.
		if (!$handle = fopen($filename, 'w')) {
			 $msg =  "Cannot open file ($filename)";
			 //exit;
		}
	
		// Write $somecontent to our opened file.
		if (fwrite($handle, $somecontent) === FALSE) {
			$msg ="Cannot write to file ($filename)";
			//exit;
		}
	
		
	
		fclose($handle);
		*/
				
		//update the data of the server
		$data = array('base64_tpl' 	=> $parameters[0], 
					  'tpl' 		=> '/templates/'.$parameters[1],
					  'updated' 	=> 1
					  );

		$this->db->where('id', $parameters[2]);
		$this->db->update('employee', $data); 
		
		$response = array (
                   array(
                         'msg' => array($msg, 'string'),
                         'description' => array('OK', 'string'),
                         'other_message' => array('Thanks', 'string')
                        ),
                 'struct'
                 ); 
						
		return $this->xmlrpc->send_response($response);
	
	}
	
	// --------------------------------------------------------------------
	
	function serve_leave_balances($request)
	{
		$parameters = $request->output_parameters();
		
		$balances = $this->Leave_balance->get_leave_balances($parameters[0]);
		
		$response = array (
                   array(
                         'sick_leave' => array($balances['sick_leave'], 'string'),
                         'vacation_leave' => array($balances['vacation_leave'], 'string'),
                         'monetary_equivalent' => array($balances['monetary_equivalent'], 'string')
                        ),
                 'struct'
                 ); 
						
		return $this->xmlrpc->send_response($response);
		
	}
	
	// --------------------------------------------------------------------
	
	function server_date_time()
	{
		$this->load->library('xmlrpc');
		$this->load->library('xmlrpcs');
		$this->xmlrpc->set_debug(TRUE);

		$q = $this->db->select("DATE_FORMAT(now(), '%H:%i:%s') as server_time, DATE_FORMAT(now(), '%m-%d-%Y') as server_date", FALSE);
		
		$q = $this->db->get("settings");
		
		if ($q->num_rows() > 0)
		{
			foreach ($q->result_array() as $row)
			{
				$server['time'] = $row['server_time'];
				$server['date'] = $row['server_date'];
			}
		}
		
		return $server;
		
		$q->free_result();
		
	}

}

/* End of file server_services.php */
/* Location: ./system/application/modules/server_services/controllers/server_services.php */