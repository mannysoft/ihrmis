<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class twilio_demo extends MX_Controller {

	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		$this->load->library('twilio');

		$from = '+19546038530';
		//$from = '+15005550006';
		
		
		$to = '+639395558050';
		$message = 'Call me kapag received mo ito. manoklito';
		
		//$to = '+639478931259';

		//$response = $this->twilio->sms($from, $to, $message);
		
		//$to = '+639279880599';
		//$response = $this->twilio->sms($from, $to, $message);
		
		//$to = '+639059036954';
		//$response = $this->twilio->sms($from, $to, $message);


		if($response->IsError)
			echo 'Error: ' . $response->ErrorMessage;
		else
			echo 'Sent message to ' . $to;
	}

}

/* End of file twilio_demo.php */