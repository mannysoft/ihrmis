<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	/**
	* Name:  Twilio
	*
	* Author: Ben Edmunds
	*		  ben.edmunds@gmail.com
	*         @benedmunds
	*
	* Location:
	*
	* Created:  03.29.2011
	*
	* Description:  Twilio configuration settings.
	*
	*
	*/

	/**
	 * Mode ("sandbox" or "prod")
	 **/
	$config['mode']   = 'prod';

	/**
	 * Account SID
	 **/
	
	
	$config['account_sid']   = 'AC476520c3c8d7fcf9369966b1d86a3c2b';
	//$config['account_sid']   = 'AC75c50ab68e019c848614eeae40e5b901';
	/**
	 * Auth Token
	 **/
	$config['auth_token']    = '6d4d42fdc23c4c6ccd971077caaa82ad';
	//$config['auth_token']    = '4b57ea25a77c5f646abf4d1402f3736f';

	/**
	 * API Version
	 **/
	$config['api_version']   = '2010-04-01';

	/**
	 * Twilio Phone Number
	 **/
	$config['number']        = '+19546038530';
	//$config['number']		 = '+15005550006';


/* End of file twilio.php */