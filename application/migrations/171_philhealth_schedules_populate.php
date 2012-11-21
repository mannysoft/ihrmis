<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_philhealth_schedules_populate extends CI_Migration {
	
	function up() 
	{			
		$data = array(
  array('id' => '1','salary_bracket' => '1','start_range' => '4999.99','end_range' => '0','salary_based' => '4000.00','monthly_share' => '100','employee_share' => '50.0','employer_share' => '50.0'),
  array('id' => '2','salary_bracket' => '2','start_range' => '5000.00','end_range' => '5999.99','salary_based' => '5000.00','monthly_share' => '125','employee_share' => '62.5','employer_share' => '62.5'),
  array('id' => '3','salary_bracket' => '3','start_range' => '6000.00','end_range' => '6999.99','salary_based' => '6000.00','monthly_share' => '150','employee_share' => '75.0','employer_share' => '75.0'),
  array('id' => '4','salary_bracket' => '4','start_range' => '7000.00','end_range' => '7999.99','salary_based' => '7000.00','monthly_share' => '175','employee_share' => '87.5','employer_share' => '87.5'),
  array('id' => '5','salary_bracket' => '5','start_range' => '8000.00','end_range' => '8999.99','salary_based' => '8000.00','monthly_share' => '200','employee_share' => '100.0','employer_share' => '100.0'),
  array('id' => '6','salary_bracket' => '6','start_range' => '9000.00','end_range' => '9999.99','salary_based' => '9000.00','monthly_share' => '225','employee_share' => '112.5','employer_share' => '112.5'),
  array('id' => '7','salary_bracket' => '7','start_range' => '10000.00','end_range' => '10999.99','salary_based' => '10000.00','monthly_share' => '250','employee_share' => '125.0','employer_share' => '125.0'),
  array('id' => '8','salary_bracket' => '8','start_range' => '11000.00','end_range' => '11999.99','salary_based' => '11000.00','monthly_share' => '275','employee_share' => '137.5','employer_share' => '137.5'),
  array('id' => '9','salary_bracket' => '9','start_range' => '12000.00','end_range' => '12999.99','salary_based' => '12000.00','monthly_share' => '300','employee_share' => '150.0','employer_share' => '150.0'),
  array('id' => '10','salary_bracket' => '10','start_range' => '13000.00','end_range' => '13999.99','salary_based' => '13000.00','monthly_share' => '325','employee_share' => '162.5','employer_share' => '162.5'),
  array('id' => '11','salary_bracket' => '11','start_range' => '14000.00','end_range' => '14999.99','salary_based' => '14000.00','monthly_share' => '350','employee_share' => '175.0','employer_share' => '175.0'),
  array('id' => '12','salary_bracket' => '12','start_range' => '15000.00','end_range' => '15999.99','salary_based' => '15000.00','monthly_share' => '375','employee_share' => '187.5','employer_share' => '187.5'),
  array('id' => '13','salary_bracket' => '13','start_range' => '16000.00','end_range' => '16999.99','salary_based' => '16000.00','monthly_share' => '400','employee_share' => '200.0','employer_share' => '200.0'),
  array('id' => '14','salary_bracket' => '14','start_range' => '17000.00','end_range' => '17999.99','salary_based' => '17000.00','monthly_share' => '425','employee_share' => '212.5','employer_share' => '212.5'),
  array('id' => '15','salary_bracket' => '15','start_range' => '18000.00','end_range' => '18999.99','salary_based' => '18000.00','monthly_share' => '450','employee_share' => '225.0','employer_share' => '225.0'),
  array('id' => '16','salary_bracket' => '16','start_range' => '19000.00','end_range' => '19999.99','salary_based' => '19000.00','monthly_share' => '475','employee_share' => '237.5','employer_share' => '237.5'),
  array('id' => '17','salary_bracket' => '17','start_range' => '20000.00','end_range' => '20999.99','salary_based' => '20000.00','monthly_share' => '500','employee_share' => '250.0','employer_share' => '250.0'),
  array('id' => '18','salary_bracket' => '18','start_range' => '21000.00','end_range' => '21999.99','salary_based' => '21000.00','monthly_share' => '525','employee_share' => '262.5','employer_share' => '262.5'),
  array('id' => '19','salary_bracket' => '19','start_range' => '22000.00','end_range' => '22999.99','salary_based' => '22000.00','monthly_share' => '550','employee_share' => '275.0','employer_share' => '275.0'),
  array('id' => '20','salary_bracket' => '20','start_range' => '23000.00','end_range' => '23999.99','salary_based' => '23000.00','monthly_share' => '575','employee_share' => '287.5','employer_share' => '287.5'),
  array('id' => '21','salary_bracket' => '21','start_range' => '24000.00','end_range' => '24999.99','salary_based' => '24000.00','monthly_share' => '600','employee_share' => '300.0','employer_share' => '300.0'),
  array('id' => '22','salary_bracket' => '22','start_range' => '25000.00','end_range' => '25999.99','salary_based' => '25000.00','monthly_share' => '625','employee_share' => '312.5','employer_share' => '312.5'),
  array('id' => '23','salary_bracket' => '23','start_range' => '26000.00','end_range' => '26999.99','salary_based' => '26000.00','monthly_share' => '650','employee_share' => '325.0','employer_share' => '325.0'),
  array('id' => '24','salary_bracket' => '24','start_range' => '27000.00','end_range' => '27999.99','salary_based' => '27000.00','monthly_share' => '675','employee_share' => '337.5','employer_share' => '337.5'),
  array('id' => '25','salary_bracket' => '25','start_range' => '28000.00','end_range' => '28999.99','salary_based' => '28000.00','monthly_share' => '700','employee_share' => '350.0','employer_share' => '350.0'),
  array('id' => '26','salary_bracket' => '26','start_range' => '29000.00','end_range' => '29999.99','salary_based' => '29000.00','monthly_share' => '725','employee_share' => '362.5','employer_share' => '362.5'),
  array('id' => '27','salary_bracket' => '27','start_range' => '30000.00','end_range' => '0','salary_based' => '30000.00','monthly_share' => '750','employee_share' => '375.0','employer_share' => '375.0')
);



		$this->db->insert_batch('payroll_philhealth_schedules', $data); 
	}

	function down() 
	{		
		return TRUE;
	}
}
