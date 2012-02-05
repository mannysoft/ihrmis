<?php
class Migrate extends CI_Controller
{
	function __construct()
	{		
		//table schema_version involve here
		
		parent::__construct();
		
		// As of HRMIS 2.0
		// We need to check if migrations table exists
		// If not exists rename the 'schema_version' table to 'migrations'
		// We have changed the migrations library from third party to
		// built in to CI Lib
		if ( ! $this->db->table_exists('migrations'))
		{
			if ( $this->db->table_exists('schema_version'))
			{	
				$this->load->dbforge();
				
				$this->dbforge->rename_table('schema_version', 'migrations');
			}
		}
	
		$this->load->library('migration');
				
		//if ( ! $this->migration->version('052'))
		if ( ! $this->migration->latest())
		{
			
			show_error($this->migration->error_string());
			exit;
		}
		
		exit;
				
	}
}
