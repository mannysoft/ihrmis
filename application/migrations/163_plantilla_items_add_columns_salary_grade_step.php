<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_plantilla_items_add_columns_salary_grade_step extends CI_Migration {
	
	function up() 
	{			
	
		$fields = array(
                        'division_id' => array('type' => 'INT (11)', 'null' => FALSE));
		$this->dbforge->add_column('plantilla_items', $fields, 'office_id');
		
		$fields = array(
                        'salary_grade' => array('type' => 'TINYINT (2)', 'null' => FALSE));
		$this->dbforge->add_column('plantilla_items', $fields, 'description');

		$fields = array(
                        'step' => array('type' => 'TINYINT (1)', 'null' => FALSE));
		$this->dbforge->add_column('plantilla_items', $fields, 'salary_grade');	

		$fields = array(
                        'order' => array('type' => 'INT (4)', 'null' => FALSE));
		$this->dbforge->add_column('plantilla_items', $fields, 'step');	
		
		$fields = array(
                        'have_budget' => array('type' => 'ENUM("yes","no")', 'null' => FALSE));
		$this->dbforge->add_column('plantilla_items', $fields, 'order');	
	}

	function down() 
	{		
		return TRUE;
	}
}
