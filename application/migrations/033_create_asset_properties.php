<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_asset_properties extends CI_Migration {
	
	function up() 
	{	
		//$this->migrations->verbose AND print "creating asset_properties table...";
		
		if ( ! $this->db->table_exists('asset_properties'))
		{	
			// Setup Keys
			$this->dbforge->add_key('id', TRUE);
			
			$this->dbforge->add_field(array(
				'id' => array('type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, 'auto_increment' => TRUE),
				'employee_id' => array('type' => 'VARCHAR', 'constraint' => '16', 'null' => FALSE),
				'kind' => array('type' => 'VARCHAR', 'constraint' => '64', 'null' => FALSE),
				'location' => array('type' => 'VARCHAR', 'constraint' => '64', 'null' => FALSE),
				'year_acquired' => array('type' => 'VARCHAR', 'constraint' => '4', 'null' => FALSE),
				'mode_acquisition' => array('type' => 'VARCHAR', 'constraint' => '64', 'null' => FALSE),
				'nature_property' => array('type' => 'VARCHAR', 'constraint' => '64', 'null' => FALSE),
				'assessed_value' => array('type' => 'VARCHAR', 'constraint' => '16', 'null' => FALSE),
				'market_value' => array('type' => 'VARCHAR', 'constraint' => '16', 'null' => FALSE),
				'land_cost' => array('type' => 'VARCHAR', 'constraint' => '16', 'null' => FALSE),
				'improvement_cost' => array('type' => 'VARCHAR', 'constraint' => '16', 'null' => FALSE),
			));
			
			$this->dbforge->create_table('asset_properties', TRUE);
			
			// --------------------------------------------------------------------
			
			$this->dbforge->add_key('id', TRUE);
			
			$this->dbforge->add_field(array(
				'id' => array('type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, 'auto_increment' => TRUE),
				'employee_id' => array('type' => 'VARCHAR', 'constraint' => '16', 'null' => FALSE),
				'kind' => array('type' => 'VARCHAR', 'constraint' => '64', 'null' => FALSE),
				'year_acquired' => array('type' => 'VARCHAR', 'constraint' => '4', 'null' => FALSE),
				'acquisition_cost' => array('type' => 'VARCHAR', 'constraint' => '16', 'null' => FALSE),
			));
			
			$this->dbforge->create_table('asset_personals', TRUE);
			
			// --------------------------------------------------------------------
			
			$this->dbforge->add_key('id', TRUE);
			
			$this->dbforge->add_field(array(
				'id' => array('type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, 'auto_increment' => TRUE),
				'employee_id' => array('type' => 'VARCHAR', 'constraint' => '16', 'null' => FALSE),
				'nature' => array('type' => 'VARCHAR', 'constraint' => '64', 'null' => FALSE),
				'name_creditors' => array('type' => 'VARCHAR', 'constraint' => '64', 'null' => FALSE),
				'amount' => array('type' => 'VARCHAR', 'constraint' => '16', 'null' => FALSE),
			));
			
			$this->dbforge->create_table('asset_liabilities', TRUE);
			
			// --------------------------------------------------------------------
			
			$this->dbforge->add_key('id', TRUE);
			
			$this->dbforge->add_field(array(
				'id' => array('type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, 'auto_increment' => TRUE),
				'employee_id' => array('type' => 'VARCHAR', 'constraint' => '16', 'null' => FALSE),
				'name' => array('type' => 'VARCHAR', 'constraint' => '64', 'null' => FALSE),
				'company' => array('type' => 'VARCHAR', 'constraint' => '64', 'null' => FALSE),
				'address' => array('type' => 'VARCHAR', 'constraint' => '128', 'null' => FALSE),
				'nature_business' => array('type' => 'VARCHAR', 'constraint' => '64', 'null' => FALSE),
				'date_acquisition' => array('type' => 'VARCHAR', 'constraint' => '32', 'null' => FALSE),
			));
			
			$this->dbforge->create_table('asset_business_interests', TRUE);
			
			// --------------------------------------------------------------------
			
			$this->dbforge->add_key('id', TRUE);
			
			$this->dbforge->add_field(array(
				'id' => array('type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, 'auto_increment' => TRUE),
				'employee_id' => array('type' => 'VARCHAR', 'constraint' => '16', 'null' => FALSE),
				'name' => array('type' => 'VARCHAR', 'constraint' => '64', 'null' => FALSE),
				'position' => array('type' => 'VARCHAR', 'constraint' => '64', 'null' => FALSE),
				'relationship' => array('type' => 'VARCHAR', 'constraint' => '32', 'null' => FALSE),
				'name_address' => array('type' => 'VARCHAR', 'constraint' => '128', 'null' => FALSE),
			));
			
			$this->dbforge->create_table('asset_relatives', TRUE);
			
			// --------------------------------------------------------------------
			
		}

	}

	function down() 
	{
		//$this->migrations->verbose AND print "dropping asset_properties table...";
		
		if ( $this->db->table_exists('asset_properties'))
		{
			$this->dbforge->drop_table('asset_properties');
		}
		
		// --------------------------------------------------------------------
		
		if ( $this->db->table_exists('asset_personals'))
		{
			$this->dbforge->drop_table('asset_personals');
		}
		
		// --------------------------------------------------------------------
		
		if ( $this->db->table_exists('asset_liabilities'))
		{
			$this->dbforge->drop_table('asset_liabilities');
		}
		
		// --------------------------------------------------------------------
		
		if ( $this->db->table_exists('asset_business_interests'))
		{
			$this->dbforge->drop_table('asset_business_interests');
		}
		
		// --------------------------------------------------------------------
		
		if ( $this->db->table_exists('asset_relatives'))
		{
			$this->dbforge->drop_table('asset_relatives');
		}
		
	}
}
