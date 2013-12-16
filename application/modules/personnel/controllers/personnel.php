<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Integrated Human Resource Management Information System
 *
 * An Open Source Application Software use by Government agencies for  
 * management of employees Attendance, Leave Administration, Payroll, 
 * Personnel Training, Service Records, Performance, Recruitment,
 * Personnel Schedule(Plantilla) and more...
 *
 * @package		iHRMIS
 * @author		Manny Isles
 * @copyright	Copyright (c) 2008 - 2013, Charliesoft
 * @license		http://charliesoft.net/ihrmis/license
 * @link		http://charliesoft.net
 * @github	    http://github.com/mannysoft/ihrmis
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * iHRMIS Conversion Table Class
 *
 * This class use for converting number of minutes late
 * to the corresponding equivalent to leave credits.
 *
 * @package		iHRMIS
 * @subpackage	Models
 * @category	Models
 * @author		Manny Isles
 * @link		http://charliesoft.net
 * @github	    http://github.com/mannysoft/ihrmis/hrmis/user_guide/models/conversion_table.html
 */
class Personnel extends MX_Controller  
{
	// --------------------------------------------------------------------
	
	function __construct()
    {
        parent::__construct();
		$this->load->model('options');
		//$this->output->enable_profiler(TRUE);
    }  
	
	// --------------------------------------------------------------------
	
	function assets($employee_id = '')
	{
		
		$data['page_name'] 			= '<b>Assets and Liabilities</b>';
		$data['msg'] 				= '';
		
		
		if ( Input::get('employee_id'))
		{
			$employee_id = Input::get('employee_id');
		}
		
		$e = new Employee_m();
		
		$data['employee'] 			= $e->get_by_id ($employee_id);
		
		$data['selected'] = $e->office_id;
		
		//Use for office listbox
		$data['options'] = $this->options->office_options();
		
		$data['employee_id'] 		= $employee_id;
		
		$data['main_content'] 		= 'assets';
		
		return View::make('includes/template', $data);
		
	}
	
	// --------------------------------------------------------------------
	
	function assets_spouse( $employee_id = '' )
	{
		$data['page_name'] 			= '<b>Assets and Liabilities</b>';
		
		$data['section_name'] 		= '<b>Spouse Information</b>';
		
		$data['msg'] 				= '';
		
		$e = new Employee_m();
		
		$data['employee'] 			= $e->get_by_id ($employee_id);
		
		if ( Input::get('op'))
		{
			$a = new Asset_info();
			
			$a->where( 'employee_id',  $employee_id )->get();
			
			$a->employee_id			= $employee_id;
			$a->s_lname 				= Input::get('s_lname');
			$a->s_fname 				= Input::get('s_fname');
			$a->s_mname 				= Input::get('s_mname');
			$a->s_office 				= Input::get('s_office');
			$a->s_position 				= Input::get('s_position');
			
			$a->save();	
						
			$data['msg'] = $data['section_name'].' has been saved!';
						
		}
				
		$a = new Asset_info();
		
		$data['info'] = $a->get_by_employee_id($employee_id);
		
		$data['selected'] = $e->office_id;
		
		//Use for office listbox
		$data['options'] = $this->options->office_options();
		
		$data['employee_id'] 		= $employee_id;
		
		$data['main_content'] = 'assets_spouse';
		
		return View::make('includes/template', $data);
		
	}
	
	// --------------------------------------------------------------------
	
	function assets_unmarried( $employee_id = '' )
	{
		$data['page_name'] 			= '<b>Assets and Liabilities</b>';
		
		$data['section_name'] 		= '<b>Unmarried Children below 18 years of age</b>';
		
		$data['msg'] 				= '';
		
		$e = new Employee_m();
		
		$data['employee'] 			= $e->get_by_id ($employee_id);
		
		if ( Input::get('op'))
		{
			$unmarried = new Asset_unmarried();
			
			$unmarried->where( 'employee_id',  $employee_id )->get();
			
			$unmarried->delete_all();
			
			$names 					= Input::get('name');
			$birth_date 			= Input::get('birth_date');
			
			$i = 0;
			
			foreach ($names as $name)
			{
				if ($name != "")
				{
					$unmarried = new Asset_unmarried();
					
					$unmarried->employee_id				= $employee_id;
					$unmarried->name 					= $names[$i];
					$unmarried->birth_date 				= $birth_date[$i];
					
					$unmarried->save();	
						
				}
				
				$i++;
			}
			
			
			$data['msg'] = 'Unmarried Children below 18 years of age has been saved!';
						
		}
				
		$a = new Asset_unmarried();
		$a->order_by('birth_date');
		
		$data['childs'] = $a->get_by_employee_id($employee_id);
		
		$data['selected'] = $e->office_id;
		
		//Use for office listbox
		$data['options'] = $this->options->office_options();
		
		$data['employee_id'] 		= $employee_id;
		
		$data['main_content'] = 'assets_unmarried';
		
		return View::make('includes/template', $data);
		
	}
	
	// --------------------------------------------------------------------
	
	function assets_real_properties( $employee_id = '' )
	{
		$data['page_name'] 			= '<b>Assets and Liabilities</b>';
		
		$data['section_name'] 		= '<b>Real Properties</b>';
		
		$data['msg'] 				= '';
		
		$e = new Employee_m();
		
		$data['employee'] 			= $e->get_by_id ($employee_id);
		
		if ( Input::get('op'))
		{
			$a = new Asset_property();
			
			$a->where( 'employee_id',  $employee_id )->get();
			
			$a->delete_all();
			
			$kinds 				= Input::get('kind');
			$location 			= Input::get('location');
			$year_acquired 		= Input::get('year_acquired');
			$mode_acquisition 	= Input::get('mode_acquisition');
			$nature_property 	= Input::get('nature_property');
			$assessed_value 	= Input::get('assessed_value');
			$market_value 		= Input::get('market_value');
			$land_cost 			= Input::get('land_cost');
			$improvement_cost 	= Input::get('improvement_cost');
			
			$i = 0;
			
			foreach ($kinds as $kind)
			{
				if ($kind != "")
				{
					$a = new Asset_property();
					
					$a->employee_id				= $employee_id;
					$a->kind 					= $kinds[$i];
					$a->location 				= $location[$i];
					$a->year_acquired 			= $year_acquired[$i];
					$a->mode_acquisition 		= $mode_acquisition[$i];
					$a->nature_property 		= $nature_property[$i];
					$a->assessed_value 			= $assessed_value[$i];
					$a->market_value 			= $market_value[$i];
					$a->land_cost 				= $land_cost[$i];
					$a->improvement_cost 		= $improvement_cost[$i];
					
					$a->save();	
						
				}
				
				$i++;
			}
			
			
			$data['msg'] = 'Real Properties has been saved!';
						
		}
				
		$a = new Asset_property();
		$a->order_by('year_acquired', 'DESC');
		
		$data['properties'] = $a->get_by_employee_id($employee_id);
		
		$data['selected'] = $e->office_id;
		
		//Use for office listbox
		$data['options'] = $this->options->office_options();
		
		$data['employee_id'] 		= $employee_id;
		
		$data['main_content'] = 'assets_real_properties';
		
		return View::make('includes/template', $data);
		
	}
	
	// --------------------------------------------------------------------
	
	function assets_personals( $employee_id = '' )
	{
		$data['page_name'] 			= '<b>Assets and Liabilities</b>';
		
		$data['section_name'] 		= '<b>Personal and other Properties</b>';
		
		$data['msg'] 				= '';
		
		$e = new Employee_m();
		
		$data['employee'] 			= $e->get_by_id ($employee_id);
		
		if ( Input::get('op'))
		{
			$a = new Asset_personal();
			
			$a->where( 'employee_id',  $employee_id )->get();
			
			$a->delete_all();
			
			$kinds 				= Input::get('kind');
			$year_acquired 		= Input::get('year_acquired');
			$acquisition_cost 	= Input::get('acquisition_cost');
		
			
			$i = 0;
			
			foreach ($kinds as $kind)
			{
				if ($kind != "")
				{
					$a = new Asset_personal();
					
					$a->employee_id				= $employee_id;
					$a->kind 					= $kinds[$i];
					$a->year_acquired 			= $year_acquired[$i];
					$a->acquisition_cost 		= $acquisition_cost[$i];
					
					$a->save();	
						
				}
				
				$i++;
			}
			
			
			$data['msg'] = 'Personal and other Properties has been saved!';
						
		}
				
		$a = new Asset_personal();
		$a->order_by('year_acquired', 'DESC');
		
		$data['properties'] = $a->get_by_employee_id($employee_id);
		
		$data['selected'] = $e->office_id;
		
		//Use for office listbox
		$data['options'] = $this->options->office_options();
		
		$data['employee_id'] 		= $employee_id;
		
		$data['main_content'] = 'assets_personals';
		
		return View::make('includes/template', $data);
		
	}
	
	// --------------------------------------------------------------------
	
	function assets_liabilities( $employee_id = '' )
	{
		$data['page_name'] 			= '<b>Assets and Liabilities</b>';
		
		$data['section_name'] 		= '<b>LIABILITIES (Loans, Mortgages, etc.)</b>';
		
		$data['msg'] 				= '';
		
		$e = new Employee_m();
		
		$data['employee'] 			= $e->get_by_id ($employee_id);
		
		if ( Input::get('op'))
		{
			$a = new Asset_liability();
			
			$a->where( 'employee_id',  $employee_id )->get();
			
			$a->delete_all();
			
			$natures 			= Input::get('nature');
			$name_creditors 	= Input::get('name_creditors');
			$amount 			= Input::get('amount');
		
			
			$i = 0;
			
			foreach ($natures as $nature)
			{
				if ($nature != "")
				{
					$a = new Asset_liability();
					
					$a->employee_id		= $employee_id;
					$a->nature 			= $natures[$i];
					$a->name_creditors 	= $name_creditors[$i];
					$a->amount 			= $amount[$i];
					
					$a->save();	
						
				}
				
				$i++;
			}
			
			
			$data['msg'] = $data['section_name'].' has been saved!';
						
		}
				
		$a = new Asset_liability();
		$a->order_by('nature');
		
		$data['liabilities'] = $a->get_by_employee_id($employee_id);
		
		$data['selected'] = $e->office_id;
		
		//Use for office listbox
		$data['options'] = $this->options->office_options();
		
		$data['employee_id'] 		= $employee_id;
		
		$data['main_content'] = 'assets_liabilities';
		
		return View::make('includes/template', $data);
		
	}
	
	// --------------------------------------------------------------------
	
	function assets_business_interests( $employee_id = '' )
	{
		$data['page_name'] 			= '<b>Assets and Liabilities</b>';
		
		$data['section_name'] 		= '<b>BUSINESS INTERESTS AND FINANCIAL CONNECTIONS</b>';
		
		$data['msg'] 				= '';
		
		$e = new Employee_m();
		
		$data['employee'] 			= $e->get_by_id ($employee_id);
		
		if ( Input::get('op'))
		{
			$a = new Asset_business_interest();
			
			$a->where( 'employee_id',  $employee_id )->get();
			
			$a->delete_all();
			
			$names 				= Input::get('name');
			$company 			= Input::get('company');
			$address 			= Input::get('address');
			$nature_business 	= Input::get('nature_business');
			$date_acquisition 	= Input::get('date_acquisition');
		
			
			$i = 0;
			
			foreach ($names as $name)
			{
				if ($name != "")
				{
					$a = new Asset_business_interest();
					
					$a->employee_id			= $employee_id;
					$a->name 				= $names[$i];
					$a->company 			= $company[$i];
					$a->address 			= $address[$i];
					$a->nature_business 	= $nature_business[$i];
					$a->date_acquisition 	= $date_acquisition[$i];
					
					$a->save();	
						
				}
				
				$i++;
			}
			
			
			$data['msg'] = $data['section_name'].' has been saved!';
						
		}
				
		$a = new Asset_business_interest();
		$a->order_by('name');
		
		$data['interests'] = $a->get_by_employee_id($employee_id);
		
		$data['selected'] = $e->office_id;
		
		//Use for office listbox
		$data['options'] = $this->options->office_options();
		
		$data['employee_id'] 		= $employee_id;
		
		$data['main_content'] = 'assets_business_interests';
		
		return View::make('includes/template', $data);
		
	}
	
	// --------------------------------------------------------------------
	
	function assets_relatives( $employee_id = '' )
	{
		$data['page_name'] 			= '<b>Assets and Liabilities</b>';
		
		$data['section_name'] 		= '<b>IDENTIFICATION OF RELATIVES IN THE GOVERNMENT SERVICE</b>';
		
		$data['msg'] 				= '';
		
		$e = new Employee_m();
		
		$data['employee'] 			= $e->get_by_id ($employee_id);
		
		if ( Input::get('op'))
		{
			$a = new Asset_relative();
			
			$a->where( 'employee_id',  $employee_id )->get();
			
			$a->delete_all();
			
			$names 			= Input::get('name');
			$position 		= Input::get('position');
			$relationship 	= Input::get('relationship');
			$name_address 	= Input::get('name_address');
		
			
			$i = 0;
			
			foreach ($names as $name)
			{
				if ($name != "")
				{
					$a = new Asset_relative();
					
					$a->employee_id			= $employee_id;
					$a->name 				= $names[$i];
					$a->position 			= $position[$i];
					$a->relationship 			= $relationship[$i];
					$a->name_address 	= $name_address[$i];
					
					$a->save();	
						
				}
				
				$i++;
			}
			
			
			$data['msg'] = $data['section_name'].' has been saved!';
						
		}
				
		$a = new Asset_relative();
		$a->order_by('name');
		
		$data['relatives'] = $a->get_by_employee_id($employee_id);
		
		$data['selected'] = $e->office_id;
		
		//Use for office listbox
		$data['options'] = $this->options->office_options();
		
		$data['employee_id'] 		= $employee_id;
		
		$data['main_content'] = 'assets_relatives';
		
		return View::make('includes/template', $data);
		
	}
	
	// --------------------------------------------------------------------
	
	function assets_other_info( $employee_id = '' )
	{
		$data['page_name'] 			= '<b>Assets and Liabilities</b>';
		
		$data['section_name'] 		= '<b>Other Info</b>';
		
		$data['msg'] 				= '';
		
		$e = new Employee_m();
		
		$data['employee'] 			= $e->get_by_id ($employee_id);
		
		if ( Input::get('op'))
		{
			$a = new Asset_info();
			
			$a->where( 'employee_id',  $employee_id )->get();
			
			$a->employee_id			= $employee_id;
			$a->s_tin 				= Input::get('s_tin');
			$a->s_cc_no 			= Input::get('s_cc_no');
			$a->s_issue_at 			= Input::get('s_issue_at');
			$a->s_issue_date 		= Input::get('s_issue_date');
			
			$a->tin 				= Input::get('tin');
			$a->cc_no 				= Input::get('cc_no');
			$a->issue_at 			= Input::get('issue_at');
			$a->issue_date 			= Input::get('issue_date');
			
			$a->save();	
						
			$data['msg'] = $data['section_name'].' has been saved!';
						
		}
				
		$a = new Asset_info();
		
		$data['info'] = $a->get_by_employee_id($employee_id);
		
		$data['selected'] = $e->office_id;
		
		//Use for office listbox
		$data['options'] = $this->options->office_options();
		
		$data['employee_id'] 		= $employee_id;
		
		$data['main_content'] = 'assets_other_info';
		
		return View::make('includes/template', $data);
		
	}
	
}

/* End of file home.php */
/* Location: ./system/application/modules/personnel/controllers/personnel.php */