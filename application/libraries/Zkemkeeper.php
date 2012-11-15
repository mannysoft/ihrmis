<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Integrated Human Resource Management Information System
 *
 * An Application Software use by Government agencies for management
 * of employees Attendance, Leave Administration, Payroll, Personnel
 * Training, Service Records, Performance, Recruitment and more...
 *
 * @package		iHRMIS
 * @author		Manolito Isles
 * @copyright	Copyright (c) 2008 - 2013, Charliesoft
 * @license		http://charliesoft.net/ihrmis/license
 * @link		http://charliesoft.net
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * iHRMIS Zkemkeeper Class
 *
 * This class use for processing log of zksoftware biometric devices.
 *
 * @package		iHRMIS
 * @subpackage	Libraries
 * @category	Leave
 * @author		Manolito Isles
 * @link		http://charliesoft.net/hrmis/user_guide/libraries/zkemkeeper.html
 */
class Zkemkeeper {
   
    private $_zkemkeeper = '';
	
	// ------------------------------------------------------------------------
   
    function __construct($params = array())
    {
        if (count($params) > 0)
		{
			$this->initialize($params);
		}
    }
	
	// ------------------------------------------------------------------------
	
	/**
	 * Initialize Preferences
	 *
	 * @access	public
	 * @param	array	initialization parameters
	 * @return	void
	 */
	function initialize($params = array())
	{
		if (count($params) > 0)
		{
			foreach ($params as $key => $val)
			{
				if (isset($this->$key))
				{
					$this->$key = $val;
				}
			}
		}
		
	}
	
	// ------------------------------------------------------------------------
	
	function connect($ip = '192.168.0.201', $port = 4370)
	{
		//try{
		
		//$this->_zkemkeeper = new COM("zkemkeeper.zkem.1") or die("Unable to create com object"); // This is the INIT METHOD
		
		// If no zkemkeeper installed
		try 
		{
			$this->create_object();
			
		} catch (Exception $e) {
			
			//echo 'Error: ',  $e->getMessage(), "\n";
			
			echo 'Error: Cant create Zkemkeeper object. Please install the SDK';
			
			return;
		}
		
		
		com_load_typelib('zkemkeeper.zkem');
			
		$s='';
		
		$this->_zkemkeeper->GetSDKVersion($s);
		
		echo $s ;
		
		$u= true;
		
		$u = $this->_zkemkeeper->Connect_Net($ip,$port) ;
		
		$error_code = 0;
		
		if ($u == false)
		{
			$this->_zkemkeeper->GetLastError($error_code);
			
			var_dump($error_code);
		}
		
	}
	
	// ------------------------------------------------------------------------
	
	function get_logs()
	{
		
			
	}
	
	function create_object() {
		
		$this->_zkemkeeper = new COM("zkemkeeper.zkem.1") or new Exception(); // This is the INIT METHOD	
	}
	
}
