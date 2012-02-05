<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	/**
	 * 
	 *
	 * @param unknown_type $cadena
	 * @param unknown_type $char_no
	 * @return unknown
	 */
	function splitstroverflow($string,$char_no) 
	{
		$sum = 0;
		$sum2 = 0;
		
		$renglones[0] = '';
		$renglones[1] = '';
		
		$pri_renglon = array();
		$seg_renglon = array();
		
		$one = array();
		
		$palabras = explode(" ",trim($string));
	       
		for ($i = 0; $i < count($palabras); $i++) 
		{
			$sum += strlen($palabras[$i])+1;
			
			if ($sum >= $char_no) 
			{
				//second line
				$seg_renglon[] = $palabras[$i] . " ";
			}
			else
			{
				//First line
				$pri_renglon[] = $palabras[$i] . " ";
			} 
		}
			   
		for ($i = 0; $i < count($pri_renglon); $i++)
		{
			$renglones[0] .= $pri_renglon[$i];
		}
			
				   
		for ($i = 0; $i < count($seg_renglon); $i++)
		{
			$renglones[1] .= $seg_renglon[$i];
		}
			
			   
		return $renglones;
	}
	
	function calculate_age($date_of_birth) 
	{ // YYYY-MM-DD
       $cur_year=date("Y");
       $cur_month=date("m");
       $cur_day=date("d");            

       $dob_year=substr($date_of_birth, 0, 4);
       $dob_month=substr($date_of_birth, 5, 2);
       $dob_day=substr($date_of_birth, 8, 2);            
       
       if($cur_month>$dob_month || ($dob_month==$cur_month && $cur_day>=$dob_day) )
           return $cur_year-$dob_year;
       else
           return $cur_year-$dob_year-1;
   }
   
   function set_column_name($column)
   {
   		$fields = array(
					'lname' 				=> 'Last Name',
					'fname' 				=> 'First Name',
					'sex' 					=> 'Sex',
					'age' 					=> 'Age',
					'position_ranks' 		=> 'Position Ranks',
					'permanent' 			=> 'Position Status',
					'address' 				=> 'Address',
					'educ_qual' 			=> 'Educational Qualification',
					'school_graduated' 		=> 'School Graduated',
					'subject_taught' 		=> 'Subject Taught',
					'length_service' 		=> 'Lengt of Service',
					'civil_service' 		=> 'Civil Service',
					'civil_service_rating' 	=> 'Civil Service Rating',
					'campus' 				=> 'Campus',
					'acad_cluster' 			=> 'Acad Cluster',
					'cluster_age' 			=> 'Cluster Age',
					'specialization' 		=> 'Specialization',
					'ed_qual' 				=> 'Ed. Qual.',
					'college' 				=> 'College',
					'department_subject' 	=> 'Department',
					'birth_date' 			=> 'Birth Date',
					'year_in_service' 		=> 'Year in Service',
					'academic_council' 		=> 'Academic Council'
					);
		
		return $fields[$column];
		
   }