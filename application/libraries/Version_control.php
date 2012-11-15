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
 * @since		Version 1.75
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * iHRMIS Version Control Class
 *
 * This class check the current version installed and do appropriate
 * action if needed.
 *
 * @package		iHRMIS
 * @subpackage	Libraries
 * @category	Libraries
 * @author		Manolito Isles
 * @link		http://charliesoft.net/hrmis/user_guide/libraries/version_control.html
 */
class Version_control {

   	var $version = '';
   
    // ------------------------------------------------------------------------
   
    function __construct($params = array())
    {
        if (count($params) > 0)
		{
			$this->initialize($params);
		}
		
		$CI =& get_instance();
		
		$CI->load->model( 'Settings' );
		
		$CI->config->load( 'script_version' );
		
		//By default, version_compare() returns -1 if the first version is lower than the second, 
		//0 if they are equal, and 1 if the second is lower.

		//When using the optional operator argument, 
		//the function will return TRUE if the relationship is the one specified by the operator, 
		//FALSE otherwise. 
		//http://www.php.net/manual/en/function.version-compare.php
		
		$db_version 	= $CI->Settings->get_selected_field( 'version' );
		
		$script_version = $CI->config->item('script_version');
		//echo $db_version;
		// If database version is lower than script version
		if (version_compare($db_version, $script_version) == -1)
		{
			//echo 'Your database need to upgrade!<br>';	
			//echo 'Click <a href="'.base_url().'index.php/">here</a> to upgrade!';
			
			// If database version is 1.75
			// Upgrade to 1.76
			if ($db_version == '1.76')
			{
				//$this->version176();
				//redirect('http://www.google.com');
			}
			//exit;
		}
		
		//$s = serialize(array('a', 'b', 'c'));
		
		//echo $s;
		//echo print_r(unserialize($s));
		//echo $db_version;
		
		//echo $script_version;
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
	
	function upgrade($old = '', $new = '')
	{
		if ($old == '' OR $new == '')
		{
			return FALSE;
		}
	}
	
	// ------------------------------------------------------------------------
	
	function version176()
	{
		echo 'Database upgraded to version 1.76!';
	}
}
