<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_holiday_add_column_half_day extends CI_Migration {
	
	function up() 
	{			
		$fields = array(
                        'half_day' => array('type' => 'ENUM("yes","no")', 'null' => FALSE, 'DEFAULT' => 'no')
);
		$this->dbforge->add_column('holiday', $fields, 'regular');	
		
		$fields = array(
                        'am_pm' => array('type' => 'ENUM("am","pm")', 'null' => FALSE, 'DEFAULT' => 'pm')
);
		$this->dbforge->add_column('holiday', $fields, 'half_day');	
		
	}

	function down() 
	{		
		return TRUE;
	}
}
