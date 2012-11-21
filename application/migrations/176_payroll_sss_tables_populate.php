<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_payroll_sss_tables_populate extends CI_Migration {
	
	function up() 
	{			
		$data = array(
  array('id' => '1','range_from' => '1000.00','range_to' => '1249.99','monthly_salary' => '1000.00','ss_er' => '70.70','ss_ee' => '33.30','ss_total' => '104.00','ec_er' => '10.00','tc_er' => '80.70','tc_ee' => '33.30','tc_total' => '114.00','total_contribution' => '104.00'),
  array('id' => '2','range_from' => '1250.00','range_to' => '1749.99','monthly_salary' => '1500.00','ss_er' => '106.00','ss_ee' => '50.00','ss_total' => '156.00','ec_er' => '10.00','tc_er' => '116.00','tc_ee' => '50.00','tc_total' => '166.00','total_contribution' => '156.00'),
  array('id' => '3','range_from' => '1750.00','range_to' => '2249.99','monthly_salary' => '2000.00','ss_er' => '141.30','ss_ee' => '66.70','ss_total' => '208.00','ec_er' => '10.00','tc_er' => '151.30','tc_ee' => '66.70','tc_total' => '218.00','total_contribution' => '208.00'),
  array('id' => '4','range_from' => '2250.00','range_to' => '2749.99','monthly_salary' => '2500.00','ss_er' => '176.70','ss_ee' => '83.30','ss_total' => '260.00','ec_er' => '10.00','tc_er' => '186.70','tc_ee' => '83.30','tc_total' => '270.00','total_contribution' => '260.00'),
  array('id' => '5','range_from' => '2750.00','range_to' => '3249.99','monthly_salary' => '3000.00','ss_er' => '212.00','ss_ee' => '100.00','ss_total' => '312.00','ec_er' => '10.00','tc_er' => '222.00','tc_ee' => '100.00','tc_total' => '322.00','total_contribution' => '312.00'),
  array('id' => '6','range_from' => '3250.00','range_to' => '3749.99','monthly_salary' => '3500.00','ss_er' => '247.30','ss_ee' => '116.70','ss_total' => '364.00','ec_er' => '10.00','tc_er' => '257.30','tc_ee' => '116.70','tc_total' => '374.00','total_contribution' => '364.00'),
  array('id' => '7','range_from' => '3750.00','range_to' => '4249.99','monthly_salary' => '4000.00','ss_er' => '282.70','ss_ee' => '133.30','ss_total' => '416.00','ec_er' => '10.00','tc_er' => '292.70','tc_ee' => '133.30','tc_total' => '426.00','total_contribution' => '416.00'),
  array('id' => '8','range_from' => '4250.00','range_to' => '4749.99','monthly_salary' => '4500.00','ss_er' => '318.00','ss_ee' => '150.00','ss_total' => '468.00','ec_er' => '10.00','tc_er' => '328.00','tc_ee' => '150.00','tc_total' => '478.00','total_contribution' => '468.00'),
  array('id' => '9','range_from' => '4750.00','range_to' => '5249.99','monthly_salary' => '5000.00','ss_er' => '353.30','ss_ee' => '166.70','ss_total' => '520.00','ec_er' => '10.00','tc_er' => '363.30','tc_ee' => '166.70','tc_total' => '530.00','total_contribution' => '520.00'),
  array('id' => '10','range_from' => '5250.00','range_to' => '5749.99','monthly_salary' => '5500.00','ss_er' => '388.70','ss_ee' => '183.30','ss_total' => '572.00','ec_er' => '10.00','tc_er' => '398.70','tc_ee' => '183.30','tc_total' => '582.00','total_contribution' => '572.00'),
  array('id' => '11','range_from' => '5750.00','range_to' => '6249.99','monthly_salary' => '6000.00','ss_er' => '424.00','ss_ee' => '200.00','ss_total' => '624.00','ec_er' => '10.00','tc_er' => '434.00','tc_ee' => '200.00','tc_total' => '634.00','total_contribution' => '624.00'),
  array('id' => '12','range_from' => '6250.00','range_to' => '6749.99','monthly_salary' => '6500.00','ss_er' => '459.30','ss_ee' => '216.70','ss_total' => '676.00','ec_er' => '10.00','tc_er' => '469.30','tc_ee' => '216.70','tc_total' => '686.00','total_contribution' => '676.00'),
  array('id' => '13','range_from' => '6750.00','range_to' => '7249.99','monthly_salary' => '7000.00','ss_er' => '494.70','ss_ee' => '233.30','ss_total' => '728.00','ec_er' => '10.00','tc_er' => '504.70','tc_ee' => '233.30','tc_total' => '738.00','total_contribution' => '728.00'),
  array('id' => '14','range_from' => '7250.00','range_to' => '7749.99','monthly_salary' => '7500.00','ss_er' => '530.00','ss_ee' => '250.00','ss_total' => '780.00','ec_er' => '10.00','tc_er' => '540.00','tc_ee' => '250.00','tc_total' => '790.00','total_contribution' => '780.00'),
  array('id' => '15','range_from' => '7750.00','range_to' => '8249.99','monthly_salary' => '8000.00','ss_er' => '565.30','ss_ee' => '266.70','ss_total' => '832.00','ec_er' => '10.00','tc_er' => '575.30','tc_ee' => '266.70','tc_total' => '842.00','total_contribution' => '832.00'),
  array('id' => '16','range_from' => '8250.00','range_to' => '8749.99','monthly_salary' => '8500.00','ss_er' => '600.70','ss_ee' => '283.30','ss_total' => '884.00','ec_er' => '10.00','tc_er' => '610.70','tc_ee' => '283.30','tc_total' => '894.00','total_contribution' => '884.00'),
  array('id' => '17','range_from' => '8750.00','range_to' => '9249.99','monthly_salary' => '9000.00','ss_er' => '636.00','ss_ee' => '300.00','ss_total' => '936.00','ec_er' => '10.00','tc_er' => '646.00','tc_ee' => '300.00','tc_total' => '946.00','total_contribution' => '936.00'),
  array('id' => '18','range_from' => '9250.00','range_to' => '9749.99','monthly_salary' => '9500.00','ss_er' => '671.30','ss_ee' => '316.70','ss_total' => '988.00','ec_er' => '10.00','tc_er' => '681.30','tc_ee' => '316.70','tc_total' => '998.00','total_contribution' => '988.00'),
  array('id' => '19','range_from' => '9750.00','range_to' => '10249.99','monthly_salary' => '10000.00','ss_er' => '706.70','ss_ee' => '333.30','ss_total' => '1040.00','ec_er' => '10.00','tc_er' => '716.70','tc_ee' => '333.30','tc_total' => '1050.00','total_contribution' => '1040.00'),
  array('id' => '20','range_from' => '10250.00','range_to' => '10749.99','monthly_salary' => '10500.00','ss_er' => '742.00','ss_ee' => '350.00','ss_total' => '1092.00','ec_er' => '10.00','tc_er' => '752.00','tc_ee' => '350.00','tc_total' => '1102.00','total_contribution' => '1092.00'),
  array('id' => '21','range_from' => '10750.00','range_to' => '11249.99','monthly_salary' => '11000.00','ss_er' => '777.30','ss_ee' => '366.70','ss_total' => '1144.00','ec_er' => '10.00','tc_er' => '787.30','tc_ee' => '366.70','tc_total' => '1154.00','total_contribution' => '1144.00'),
  array('id' => '22','range_from' => '11250.00','range_to' => '11749.99','monthly_salary' => '11500.00','ss_er' => '812.70','ss_ee' => '383.30','ss_total' => '1196.00','ec_er' => '10.00','tc_er' => '822.70','tc_ee' => '383.30','tc_total' => '1206.00','total_contribution' => '1196.00'),
  array('id' => '23','range_from' => '11750.00','range_to' => '12249.99','monthly_salary' => '12000.00','ss_er' => '848.00','ss_ee' => '400.00','ss_total' => '1248.00','ec_er' => '10.00','tc_er' => '858.00','tc_ee' => '400.00','tc_total' => '1258.00','total_contribution' => '1248.00'),
  array('id' => '24','range_from' => '12250.00','range_to' => '12749.99','monthly_salary' => '12500.00','ss_er' => '883.30','ss_ee' => '416.70','ss_total' => '1300.00','ec_er' => '10.00','tc_er' => '893.30','tc_ee' => '416.70','tc_total' => '1310.00','total_contribution' => '1300.00'),
  array('id' => '25','range_from' => '12750.00','range_to' => '13249.99','monthly_salary' => '13000.00','ss_er' => '918.70','ss_ee' => '433.30','ss_total' => '1352.00','ec_er' => '10.00','tc_er' => '928.70','tc_ee' => '433.30','tc_total' => '1362.00','total_contribution' => '1352.00'),
  array('id' => '26','range_from' => '13250.00','range_to' => '13749.99','monthly_salary' => '13500.00','ss_er' => '954.00','ss_ee' => '450.00','ss_total' => '1404.00','ec_er' => '10.00','tc_er' => '964.00','tc_ee' => '450.00','tc_total' => '1414.00','total_contribution' => '1404.00'),
  array('id' => '27','range_from' => '13750.00','range_to' => '14249.99','monthly_salary' => '14000.00','ss_er' => '989.30','ss_ee' => '466.70','ss_total' => '1456.00','ec_er' => '10.00','tc_er' => '999.30','tc_ee' => '466.70','tc_total' => '1466.00','total_contribution' => '1456.00'),
  array('id' => '28','range_from' => '14250.00','range_to' => '14749.99','monthly_salary' => '14500.00','ss_er' => '1024.70','ss_ee' => '483.30','ss_total' => '1508.00','ec_er' => '10.00','tc_er' => '1034.70','tc_ee' => '483.30','tc_total' => '1518.00','total_contribution' => '1508.00'),
  array('id' => '29','range_from' => '14750.00','range_to' => '30000.00','monthly_salary' => '15000.00','ss_er' => '1060.00','ss_ee' => '500.00','ss_total' => '1560.00','ec_er' => '30.00','tc_er' => '1090.00','tc_ee' => '500.00','tc_total' => '1590.00','total_contribution' => '1560.00')
);


		// Lets truncate the table first
		$this->db->truncate('payroll_sss_tables'); 

		$this->db->insert_batch('payroll_sss_tables', $data); 
	}

	function down() 
	{		
		return TRUE;
	}
}
