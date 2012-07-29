<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_leave_card_add_column_listing_order extends CI_Migration {
	
	function up() 
	{			
		$fields = array(
                        'listing_order' => array('type' => 'INT (4)', 'null' => FALSE)
);
		$this->dbforge->add_column('leave_card', $fields, 'enabled');
		
		
		
	}

	function down() 
	{		
		$this->dbforge->drop_column('leave_card', 'listing_order');
	}
}
