<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_employee_drop_columns_monthly_salary extends CI_Migration {
	
	function up() 
	{	
		
		$this->dbforge->drop_column('employee', 'monthly_salary');
		$this->dbforge->drop_column('employee', 'm_address');
		$this->dbforge->drop_column('employee', 'e_address');
		$this->dbforge->drop_column('employee', 'contact_number');
		$this->dbforge->drop_column('employee', 'maiden_name');
		$this->dbforge->drop_column('employee', 'religion_code');
		$this->dbforge->drop_column('employee', 'telno');
		$this->dbforge->drop_column('employee', 'weight');
		
		$this->dbforge->drop_column('employee', 'height');
		$this->dbforge->drop_column('employee', 'group_id');
		$this->dbforge->drop_column('employee', 'mun_id');
		
		$this->dbforge->drop_column('employee', 'province_id');
		$this->dbforge->drop_column('employee', 'div_code');
		$this->dbforge->drop_column('employee', 'sect_code');
		
		$this->dbforge->drop_column('employee', 'unit_code');
		$this->dbforge->drop_column('employee', 'pos_code');
		$this->dbforge->drop_column('employee', 'old_pos_code');
		$this->dbforge->drop_column('employee', 'no_of_items');
		$this->dbforge->drop_column('employee', 'salary_grade_step');
		
		
		$this->dbforge->drop_column('employee', 'salary');
		$this->dbforge->drop_column('employee', 'employment_status');
		$this->dbforge->drop_column('employee', 'operator_code');
		$this->dbforge->drop_column('employee', 'record_no');
		
		
		$this->dbforge->drop_column('employee', 'email_password');
		$this->dbforge->drop_column('employee', 'plantilla');
		//$this->dbforge->drop_column('employee', 'sect_code');
		
		

	}

	function down() 
	{
		
	}
}
