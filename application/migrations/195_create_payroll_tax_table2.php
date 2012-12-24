<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_payroll_tax_table2 extends CI_Migration {
	
	function up() 
	{	
		if ( ! $this->db->table_exists('payroll_tax_table2'))
		{	
			// Setup Keys
			$this->dbforge->add_key('id', TRUE);
			
			$this->dbforge->add_field(array(
				'id' => array('type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, 'auto_increment' => TRUE),
				'monthly' => array('type' => 'ENUM("daily","weekly" ,"semi", "monthly")', 'null' => FALSE, 'default' => 'semi'),
				'status' => array('type' => 'VARCHAR', 'constraint' => '16', 'null' => FALSE),
				'bracket0' => array('type' => 'VARCHAR', 'constraint' => '16', 'null' => FALSE),
				'bracket1' => array('type' => 'VARCHAR', 'constraint' => '16', 'null' => FALSE),
				'bracket2' => array('type' => 'VARCHAR', 'constraint' => '16', 'null' => FALSE),
				'bracket3' => array('type' => 'VARCHAR', 'constraint' => '16', 'null' => FALSE),
				'bracket4' => array('type' => 'VARCHAR', 'constraint' => '16', 'null' => FALSE),
				'bracket5' => array('type' => 'VARCHAR', 'constraint' => '16', 'null' => FALSE),
				'bracket6' => array('type' => 'VARCHAR', 'constraint' => '16', 'null' => FALSE),
				'bracket7' => array('type' => 'VARCHAR', 'constraint' => '16', 'null' => FALSE),
				'bracket8' => array('type' => 'VARCHAR', 'constraint' => '16', 'null' => FALSE),
		
			));
			
			$this->dbforge->create_table('payroll_tax_table2', TRUE);
			
			
			$data = array(
  array('monthly' => 'semi','status' => 'exemption','bracket0' => NULL,'bracket1' => '0','bracket2' => '0','bracket3' => '20.83','bracket4' => '104.17','bracket5' => '354.17','bracket6' => '937.50','bracket7' => '2,083.33','bracket8' => '5,208.33'),
  array('monthly' => 'semi','status' => 'percent_over','bracket0' => NULL,'bracket1' => '+0% over','bracket2' => '+5% over','bracket3' => '+10% over','bracket4' => '+15% over','bracket5' => '+20% over','bracket6' => '+25% over','bracket7' => '+30% over','bracket8' => '+32% over'),
  array('monthly' => 'semi','status' => 'Z','bracket0' => '0.0','bracket1' => '1','bracket2' => '0','bracket3' => '417','bracket4' => '1,250','bracket5' => '2,917','bracket6' => '5,833','bracket7' => '10,417','bracket8' => '20,833'),
  array('monthly' => 'semi','status' => 'S/ME','bracket0' => '50.0','bracket1' => '1','bracket2' => '2,083','bracket3' => '2,500','bracket4' => '3,333','bracket5' => '5,000','bracket6' => '7,917','bracket7' => '12,500','bracket8' => '22,917'),
  array('monthly' => 'semi','status' => 'ME1 / S1','bracket0' => '75.0','bracket1' => '1','bracket2' => '3,125','bracket3' => '3,542','bracket4' => '4,375','bracket5' => '6,042','bracket6' => '8,958','bracket7' => '13,542','bracket8' => '23,958'),
  array('monthly' => 'semi','status' => 'ME2 / S2','bracket0' => '100.0','bracket1' => '1','bracket2' => '4,167','bracket3' => '4,583','bracket4' => '5,417','bracket5' => '7,083','bracket6' => '10,000','bracket7' => '14,583','bracket8' => '25,000'),
  array('monthly' => 'semi','status' => 'ME3 / S3','bracket0' => '125.0','bracket1' => '1','bracket2' => '5,208','bracket3' => '5,625','bracket4' => '6,458','bracket5' => '8,125','bracket6' => '11,042','bracket7' => '15,625','bracket8' => '26,042'),
  array('monthly' => 'semi','status' => 'ME4 / S4','bracket0' => '150.0','bracket1' => '1','bracket2' => '6,250','bracket3' => '6,667','bracket4' => '7,500','bracket5' => '9,167','bracket6' => '12,083','bracket7' => '16,667','bracket8' => '27,083'),
  array('monthly' => 'monthly','status' => 'exemption','bracket0' => NULL,'bracket1' => '0','bracket2' => '0','bracket3' => '41.67','bracket4' => '208.33','bracket5' => '708.33','bracket6' => '1,875.00','bracket7' => '4,166.67','bracket8' => '10,416.67'),
  array('monthly' => 'monthly','status' => 'percent_over','bracket0' => NULL,'bracket1' => '+0% over','bracket2' => '+5% over','bracket3' => '+10% over','bracket4' => '+15% over','bracket5' => '+20% over','bracket6' => '+25% over','bracket7' => '+30% over','bracket8' => '+32% over'),
  array('monthly' => 'monthly','status' => 'Z','bracket0' => '0.0','bracket1' => '1','bracket2' => '0','bracket3' => '833','bracket4' => '2,500','bracket5' => '5,833','bracket6' => '11,667','bracket7' => '20,833','bracket8' => '41,667'),
  array('monthly' => 'monthly','status' => 'S/ME','bracket0' => '50.0','bracket1' => '1','bracket2' => '4,167','bracket3' => '5,000','bracket4' => '6,667','bracket5' => '10,000','bracket6' => '15,833','bracket7' => '25,000','bracket8' => '45,833'),
  array('monthly' => 'monthly','status' => 'ME1 / S1','bracket0' => '75.0','bracket1' => '1','bracket2' => '6,250','bracket3' => '7,083','bracket4' => '8,750','bracket5' => '12,083','bracket6' => '17,917','bracket7' => '27,083','bracket8' => '47,917'),
  array('monthly' => 'monthly','status' => 'ME2 / S2','bracket0' => '100.0','bracket1' => '1','bracket2' => '8,333','bracket3' => '9,167','bracket4' => '10,833','bracket5' => '14,167','bracket6' => '20,000','bracket7' => '29,167','bracket8' => '50,000'),
  array('monthly' => 'monthly','status' => 'ME3 / S3','bracket0' => '125.0','bracket1' => '1','bracket2' => '10,417','bracket3' => '11,250','bracket4' => '12,917','bracket5' => '16,250','bracket6' => '22,083','bracket7' => '31,250','bracket8' => '52,083'),
  array('monthly' => 'monthly','status' => 'ME4 / S4','bracket0' => '150.0','bracket1' => '1','bracket2' => '12,500','bracket3' => '13,333','bracket4' => '15,000','bracket5' => '18,333','bracket6' => '24,167','bracket7' => '33,333','bracket8' => '54,167')
);

			
			$this->db->insert_batch('payroll_tax_table2', $data); 
		}

	}

	function down() 
	{
		
		if ( $this->db->table_exists('payroll_tax_table2'))
		{
			$this->dbforge->drop_table('payroll_tax_table2');
		}
		
	}
}
