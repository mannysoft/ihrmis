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
		$line1 = 0;
		$line2 = 0;
		$line3 = 0;
		$line4 = 0;
		$line5 = 0;
		$line6 = 0;
		$line7 = 0;
		$line8 = 0;
		$line9 = 0;
		$line10 = 0;
		$line11 = 0;
		$line12 = 0;
		$line13 = 0;
		$line14 = 0;
		$line15 = 0;
		$line16 = 0;
		$line17 = 0;
		$line18 = 0;
		$line19 = 0;
		$line20 = 0;
		$line21 = 0;
		$line22 = 0;
		$line23 = 0;
		$line24 = 0;
		$line25 = 0;
		
		
		$renglones[0] = '';
		$renglones[1] = '';
		$renglones[2] = '';
		$renglones[3] = '';
		$renglones[4] = '';
		$renglones[5] = '';
		$renglones[6] = '';
		$renglones[7] = '';
		$renglones[8] = '';
		$renglones[9] = '';
		$renglones[10] = '';
		$renglones[11] = '';
		$renglones[12] = '';
		$renglones[13] = '';
		$renglones[14] = '';
		$renglones[15] = '';
		
		$renglones[16] = '';
		$renglones[17] = '';
		$renglones[18] = '';
		$renglones[19] = '';
		$renglones[20] = '';
		$renglones[21] = '';
		$renglones[22] = '';
		$renglones[23] = '';
		$renglones[24] = '';
		$renglones[25] = '';
		
		$renglon1  = array();
		$renglon2  = array();
		$renglon3  = array();
		$renglon4  = array();
		$renglon5  = array();
		$renglon6  = array();
		$renglon7  = array();
		$renglon8  = array();
		$renglon9   = array();
		$renglon10  = array();
		$renglon11  = array();
		$renglon12  = array();
		$renglon13  = array();
		$renglon14  = array();
		$renglon15  = array();
		$renglon16  = array();
		$renglon17  = array();
		$renglon18  = array();
		$renglon19  = array();
		$renglon20  = array();
		$renglon21  = array();
		$renglon22  = array();
		$renglon23  = array();
		$renglon24  = array();
		$renglon25  = array();
		
		$one = array();
		
		
		$palabras = explode(" ",trim($string));
	    
		
		for ($i = 0; $i < count($palabras); $i++) 
		{
			$line1 += strlen($palabras[$i])+1;
			$line3 = $line1 - $char_no;				
			$line4 = $line3 - $char_no;
			$line5 = $line4 - $char_no;
			$line6 = $line5 - $char_no;
			$line7 = $line6 - $char_no;
			$line8 = $line7 - $char_no;
			$line9 = $line8 - $char_no;
			$line10 = $line9 - $char_no;
			$line11 = $line10 - $char_no;
			$line12 = $line11 - $char_no;
			$line13 = $line12 - $char_no;
			$line14 = $line13 - $char_no;
			$line15 = $line14 - $char_no;
			$line16 = $line15 - $char_no;
			$line17 = $line16 - $char_no;
			$line18 = $line17 - $char_no;
			$line19 = $line18 - $char_no;
			$line20 = $line19 - $char_no;
			$line21 = $line20 - $char_no;
			$line22 = $line21 - $char_no;
			$line23 = $line22 - $char_no;
			$line24 = $line23 - $char_no;
			$line25 = $line24 - $char_no;			

			if($line25 >= $char_no)
			{
				$renglon25[] = $palabras[$i] . " ";
			
			}
			elseif($line24 >= $char_no)
			{
				$renglon24[] = $palabras[$i] . " ";
			
			}
			elseif($line23 >= $char_no)
			{
				$renglon23[] = $palabras[$i] . " ";
			
			}
			elseif($line22 >= $char_no)
			{
				$renglon22[] = $palabras[$i] . " ";
			
			}
			elseif($line21 >= $char_no)
			{
				//seventh line
				$renglon21[] = $palabras[$i] . " ";
			
			}
			elseif($line20 >= $char_no)
			{
				$renglon20[] = $palabras[$i] . " ";
			
			}
		 	elseif($line19 >= $char_no)
			{
				$renglon19[] = $palabras[$i] . " ";
			
			}
			elseif($line18 >= $char_no)
			{
				$renglon18[] = $palabras[$i] . " ";
			
			}
			elseif($line17 >= $char_no)
			{
				$renglon17[] = $palabras[$i] . " ";
			
			}
			elseif($line16 >= $char_no)
			{
				$renglon16[] = $palabras[$i] . " ";
			
			}
			elseif($line15 >= $char_no)
			{
				$renglon15[] = $palabras[$i] . " ";
			
			}	
			elseif($line14 >= $char_no)
			{
				$renglon14[] = $palabras[$i] . " ";
			
			}	
			elseif($line13 >= $char_no)
			{
				$renglon13[] = $palabras[$i] . " ";
			
			}	
			elseif($line12 >= $char_no)
			{
				$renglon12[] = $palabras[$i] . " ";
			
			}	
			elseif($line11 >= $char_no)
			{
				$renglon11[] = $palabras[$i] . " ";
			
			}	
			elseif($line10 >= $char_no)
			{
				$renglon10[] = $palabras[$i] . " ";
			
			}	
			elseif($line9 >= $char_no)
			{
				$renglon9[] = $palabras[$i] . " ";
			
			}	
						
			elseif($line8 >= $char_no)
			{
				$renglon8[] = $palabras[$i] . " ";
			
			}		
			elseif($line7 >= $char_no)
			{
				$renglon7[] = $palabras[$i] . " ";
			
			}
			elseif($line6 >= $char_no)
			{
				//sixth line
				$renglon6[] = $palabras[$i] . " ";
			
			}
			elseif($line5 >= $char_no)
			{
				$renglon5[] = $palabras[$i] . " ";
			}
			elseif($line4 >= $char_no)
			{
				//forth line
				$renglon4[] = $palabras[$i] . " ";
			}
			elseif($line3 >= $char_no)
			{
				//third line
				$renglon3[] = $palabras[$i] . " ";
			}
			elseif ($line1 >= $char_no) 
			{
				//second line
				$renglon2[] = $palabras[$i] . " ";
			}
			else
			{
				//First line
				$renglon1[] = $palabras[$i] . " ";
			} 
		}
		
		//1st	   
		for ($i = 0; $i < count($renglon1); $i++)
		{
			$renglones[0] .= $renglon1[$i];
		}
		//2nd			   
		for ($i = 0; $i < count($renglon2); $i++)
		{
			$renglones[1] .= $renglon2[$i];
		}
		//3rd
		for ($i = 0; $i < count($renglon3); $i++)
		{
			$renglones[2] .= $renglon3[$i];
		}
		//4th
		for ($i = 0; $i < count($renglon4); $i++)
		{
			$renglones[3] .= $renglon4[$i];
		}
		//5th
		for ($i = 0; $i < count($renglon5); $i++)
		{
			$renglones[4] .= $renglon5[$i];
		}
		//6th
		for ($i = 0; $i < count($renglon6); $i++)
		{
			$renglones[5] .= $renglon6[$i];
		}
		//7th
		for ($i = 0; $i < count($renglon7); $i++)
		{
			$renglones[6] .= $renglon7[$i];
		}
		//8th
		for ($i = 0; $i < count($renglon8); $i++)
		{
			$renglones[7] .= $renglon8[$i];
		}
		//9th
		for ($i = 0; $i < count($renglon9); $i++)
		{
			$renglones[8] .= $renglon9[$i];
		}
		//10th
		for ($i = 0; $i < count($renglon10); $i++)
		{
			$renglones[9] .= $renglon10[$i];
		}
		//11
		for ($i = 0; $i < count($renglon11); $i++)
		{
			$renglones[10] .= $renglon11[$i];
		}
		//12
		for ($i = 0; $i < count($renglon12); $i++)
		{
			$renglones[11] .= $renglon12[$i];
		}
		//13
		for ($i = 0; $i < count($renglon13); $i++)
		{
			$renglones[12] .= $renglon13[$i];
		}
		//14th
		for ($i = 0; $i < count($renglon14); $i++)
		{
			$renglones[13] .= $renglon14[$i];
		}
		//15th
		for ($i = 0; $i < count($renglon15); $i++)
		{
			$renglones[14] .= $renglon15[$i];
		}
		
		for ($i = 0; $i < count($renglon16); $i++)
		{
			$renglones[15] .= $renglon16[$i];
		}
		for ($i = 0; $i < count($renglon17); $i++)
		{
			$renglones[16] .= $renglon17[$i];
		}
		for ($i = 0; $i < count($renglon18); $i++)
		{
			$renglones[17] .= $renglon18[$i];
		}
		for ($i = 0; $i < count($renglon19); $i++)
		{
			$renglones[18] .= $renglon19[$i];
		}
		for ($i = 0; $i < count($renglon20); $i++)
		{
			$renglones[19] .= $renglon20[$i];
		}
		for ($i = 0; $i < count($renglon21); $i++)
		{
			$renglones[20] .= $renglon21[$i];
		}
		for ($i = 0; $i < count($renglon22); $i++)
		{
			$renglones[21] .= $renglon22[$i];
		}
		for ($i = 0; $i < count($renglon23); $i++)
		{
			$renglones[22] .= $renglon23[$i];
		}
		for ($i = 0; $i < count($renglon24); $i++)
		{
			$renglones[23] .= $renglon24[$i];
		}
		for ($i = 0; $i < count($renglon25); $i++)
		{
			$renglones[24] .= $renglon25[$i];
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