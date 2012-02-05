<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_leave_apps_add_column extends CI_Migration {
	
	function up() 
	{	
		//$this->migrations->verbose AND print "adding colum allow_sat_sun to leave_apps table...";
		
		$fields = array(
                        'allow_sat_sun' => array('type' => 'INT NOT NULL AFTER `date_encode`')
						);
						
		$this->dbforge->add_column('leave_apps', $fields);

	}

	function down() 
	{
		//$this->migrations->verbose AND print "dropping column allow_sat_sun from leave_apps...";
		
		$this->dbforge->drop_column('leave_apps', 'allow_sat_sun');
		
	}
}
