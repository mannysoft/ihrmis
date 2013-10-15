<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_plantilla_drop_columns_office_id extends CI_Migration {
	
	function up() 
	{	
		
		$this->dbforge->drop_column('plantilla', 'office_id');
		$this->dbforge->drop_column('plantilla', 'position');
		$this->dbforge->drop_column('plantilla', 'sg');
		$this->dbforge->drop_column('plantilla', 'amount');

	}

	function down() 
	{
		return TRUE;
	}
}
