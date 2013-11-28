<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_laguna_modify_emp_nos extends CI_Migration {
	
	function up() 
	{	
		// Do only if Province of Laguna
		$lgu_code = Setting::getField( 'lgu_code' );
		
		if ($lgu_code == 'laguna_province')
		{
			$o = new Office_m();
		
			$offices = $o->get();
			
			foreach ($offices as $office)
			{			
				// Select all employees by office
				$e = new Employee_m();
				$employees = $e->get_by_office_id($office->office_id);
				
				$office_id = sprintf("%03d", $office->office_id); // Add leading zeros
				
				$i = 1;
				
				foreach ($employees as $employee)
				{					
					// Lets update the employee id
					$employee_id = sprintf("%03d", $i); // Add leading zeros
					
					$update_employee = new Employee_m();
					
					$update_employee->get_by_id($employee->id);
					$update_employee->employee_id = $office_id.$employee_id;
					$update_employee->save();
					
					$i++;
				}
				
			}
			
		}
		
		
	}

	function down() 
	{
		
	}
}
