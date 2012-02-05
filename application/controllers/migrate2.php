<?php
class Migrate2 extends CI_Controller
{
	function __construct()
	{
		//https://github.com/philsturgeon/codeigniter-migrations
		
		//table schema_version involve here
		//echo 'ayos';
		
		parent::__construct();
		
		$this->load->library('migrations');
		
		if ( $this->db->table_exists('schedule'))
		{	
			$this->dbforge->rename_table('schedule', 'schedule_employees');
		}
		
			$fields = array(
                        'pass_slip_date' => array('type' => 'DATE NOT NULL AFTER `card_no`')
						);
						
		$this->dbforge->add_column('leave_card', $fields);
		
		$fields = array(
                        'allow_sat_sun' => array('type' => 'INT NOT NULL AFTER `date_encode`')
						);
						
		$this->dbforge->add_column('leave_apps', $fields);
		
		$data = array(
				'name' 			=> 'print_office_head_in_dtr',
				'setting_value' => '0'
				);
		
		$this->db->insert('settings', $data);
		
		$data = array(
				'name' 			=> 'minutes_tardy_am_only',
				'setting_value' => '0'
				);
		
		$this->db->insert('settings', $data);
		
		if ( ! $this->db->table_exists('compensatory_timeoff'))
		{	
			// Setup Keys
			$this->dbforge->add_key('id', TRUE);
			
			$this->dbforge->add_field(array(
				'id' => array('type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, 'auto_increment' => TRUE),
				'employee_id' => array('type' => 'VARCHAR', 'constraint' => '16', 'null' => FALSE),
				'month' => array('type' => 'VARCHAR', 'constraint' => '2', 'null' => FALSE),
				'year' => array('type' => 'VARCHAR', 'constraint' => '4', 'null' => FALSE),
				'days' => array('type' => 'VARCHAR', 'constraint' => '3', 'null' => FALSE),
				'dates' => array('type' => 'VARCHAR', 'constraint' => '128', 'null' => FALSE),
				'type' => array('type' => 'VARCHAR', 'constraint' => '8', 'null' => FALSE),
				'status' => array('type' => 'VARCHAR', 'constraint' => '8', 'null' => FALSE),
			));
			
			$this->dbforge->create_table('compensatory_timeoff', TRUE);
		}
		
		$fields = array(
                        'employee_id' => array('type' => 'VARCHAR (16) NOT NULL AFTER `office_head`')
						);
						
		$this->dbforge->add_column('office', $fields);
		
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
			
			if ( $this )
			{
				echo 'cool';
			
			}

			// --------------------------------------------------------------------
			
		}
		
		

		
		
		//$this->migrations->set_verbose(TRUE);
		
		//$this->migrations->version('033'); // migrate the database to a particular version
											// sample - put 1 to upgrdate to version 1 or put 0
											// to downgrade 
											
		// if the schema_version is 3 and you want to migrate to 10
		// all version between 3 and 10 will be process									
		
		
		
		//$this->migrations->latest(); // migrate the database to the latest version
		//$this->migrations->install(); // install to the latest version.
		
		/** VERY IMPORTANT - only turn this on when you need it. */
		//show_error('Access to this controller is blocked, turn me on when you need me.');
	}

	// Install up to the most up-to-date version.
	function install()
	{
		if ( ! $this->migrations->install())
		{
			show_error($this->migrations->error);
			exit;
		}

		echo "<br />Migration Successful<br />";
	}

	// This will migrate up to the configed migration version
	function version($id = NULL)
	{
		// No $id supplied? Use the config version
		$id OR $id = $this->config->item('migrations_version');

		if ( ! $this->migrations->version($id))
		{
			show_error($this->migrations->error);
			exit;
		}

		echo "<br />Migration Successful<br />";
	}
}
