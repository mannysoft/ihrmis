<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Dwoo_test extends CI_Controller {

    function index()
    {
    	$this->load->library('parser');

    	$this->parser->parse('test', array('message' => 'OH HAI!'));
    	
	}
}

?>