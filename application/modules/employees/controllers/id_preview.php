<?php 
class Id_preview extends MX_Controller
{
	var $pds = array();
	
	function __construct()
    {
        parent::__construct();
		
		
		//set_time_limit(0);
		//ini_set('memory_limit', '9999999M');
		//print system('ulimit -a');

	}
	
	function front_id($results)
	{
		
		$this->load->helper('settings');		
		//print preview of MR		
		$this->load->library('fpdf');
			
					
		$this->load->library('fpdi');
		
		// initiate FPDI   
		$pdf = new FPDI('L');
		
		// add a page
		$pdf->AddPage();
		// set the sourcefile
		$pagecount = $pdf->setSourceFile('pdf-report/id/front-id.pdf');
		// import page 1
		$tplIdx = $pdf->importPage(1);
		// use the imported page and place it at point 10,10 with a width of 100 mm
		$pdf->useTemplate($tplIdx);
		//367
		// now write some text above the imported page			

		$pdf->SetTextColor(0,0,0);
	
		$pdf->SetFont('Arial', '', 9);		
		

				
			$n = 1;		

			foreach($results as $result)
			{
				$s = new Employee_m();
				$row = $s->get_by_id($result->employee_id);
			
				if($n == 11)
				{
					//add new page		
					$pdf->addPage();
					
	
					for ($n = 1; $n <= 1; $n++)
					{
						$tplidx = $pdf->ImportPage(1);
							
						$pdf->useTemplate($tplIdx); //, 1, 1, 210
					}
					$n = $n-1;
				}	
				

				//======================== START Column 1 ==============================
				
				$pic = 'pics/not_available.png';
				
				$photo = 'pics/'.$row->employee_id.'.png';
				if(file_exists($photo))
				{
					$pic = 'pics/'.$row->employee_id.'.png';
				}


				//signature
				$sign  = 'pics/signatures/'.$row->employee_id.'.png';
				
				$employee_id = $row->employee_id;
				$name = utf8_decode($row->fname.' '.$row->lname);
				$lblname = 'NAME';
				$office = 'LAGUNA UNIVERSITY';
				$position = $row->position;

				$fs ='11.5';
				if(strlen($name) >= 22)
				{
					$fs ='9';
				}
	
							
				//----------------------------- Row 1 ----------------------------------
				if($n == 1)
				{				

					//Employee number
					$pdf->SetTextColor(0, 0, 0);
					$pdf->SetFont('Arial', 'B', 9);
					$pdf->SetXY(18.5,29);
					$pdf->Cell(30,0,'EMP No. '.$employee_id, '0', 0,'C',false);	
					
					//Employee Photo 2x3
					$pdf->image($pic,17.5,31, 32, 37); //x, y, w, h
				
					//Employee name
					$pdf->SetFont('Arial', 'B', $fs);
					$pdf->SetXY(18.5,71);
					$pdf->Cell(30,0,strtoupper($name), '0', 0,'C',false);	
									
					//label name
					$pdf->SetFont('Arial', '', 5);
					$pdf->SetXY(18.5,74);
					$pdf->Cell(30,0,$lblname, '0', 0,'C',false);	
								
					//Signature
					if(file_exists($sign))
					{
						$pdf->image($sign,20,75, 25, 10); //x, y, w, h
					}
					
					//label signature
					$pdf->SetXY(18.5,83);
					$pdf->Cell(30,0,'SIGNATURE', '0', 0,'C',false);	
					
					//Office
					$pdf->SetTextColor(255, 255, 255); //r, g ,b
					$pdf->SetFont('Arial', 'B', 13);
					$pdf->SetXY(18.5,88);
					$pdf->Cell(30,0,$office, '0', 0,'C',false);
					
					//Position
					$pdf->SetTextColor(255, 255, 0);
					$pdf->SetFont('Arial', '', 10);
					$pdf->SetXY(18.5,94);
					$pdf->Cell(30,0,strtoupper($position), '0', 0,'C',false);	
		
				}
				
				
				//----------------------------- Row 2 ----------------------------------
				if($n == 2)
				{
				
					//Employee number
					$pdf->SetTextColor(0, 0, 0);
					$pdf->SetFont('Arial', 'B', 9);
					$pdf->SetXY(76.5,29);
					$pdf->Cell(30,0,'EMP No. '.$employee_id, '0', 0,'C',false);	
					
					//Employee Photo 2x3
					$pdf->image($pic,75.5,31, 32, 37); //x, y, w, h
				
					//Employee name
					$pdf->SetFont('Arial', 'B', $fs);
					$pdf->SetXY(76.5,71);
					$pdf->Cell(30,0,strtoupper($name), '0', 0,'C',false);	
									
					//label name
					$pdf->SetFont('Arial', '', 5);
					$pdf->SetXY(76.5,74);
					$pdf->Cell(30,0,$lblname, '0', 0,'C',false);	
								
					//Signature
					if(file_exists($sign))
					{
						$pdf->image($sign,78,75, 25, 10); //x, y, w, h
					}
					
					//label signature
					$pdf->SetXY(76.5,83);
					$pdf->Cell(30,0,'SIGNATURE', '0', 0,'C',false);	
					
					//Office
					$pdf->SetTextColor(255, 255, 255); //r, g ,b
					$pdf->SetFont('Arial', 'B', 13);
					$pdf->SetXY(76.5,88);
					$pdf->Cell(30,0,$office, '0', 0,'C',false);
					
					//Position
					$pdf->SetTextColor(255, 255, 0);
					$pdf->SetFont('Arial', '', 10);
					$pdf->SetXY(76.5,94);
					$pdf->Cell(30,0,strtoupper($position), '0', 0,'C',false);	
												
				}
				
				//----------------------------- Row 3 ----------------------------------
				if($n == 3)
				{
					//Employee number
					$pdf->SetTextColor(0, 0, 0);
					$pdf->SetFont('Arial', 'B', 9);
					$pdf->SetXY(134.5,29);
					$pdf->Cell(30,0,'EMP No. '.$employee_id, '0', 0,'C',false);	
					
					//Employee Photo 2x3
					$pdf->image($pic,133.5,31, 32, 37); //x, y, w, h
				
					//Employee name
					$pdf->SetFont('Arial', 'B', $fs);
					$pdf->SetXY(134.5,71);
					$pdf->Cell(30,0,strtoupper($name), '0', 0,'C',false);	
									
					//label name
					$pdf->SetFont('Arial', '', 5);
					$pdf->SetXY(134.5,74);
					$pdf->Cell(30,0,$lblname, '0', 0,'C',false);	
								
					//Signature
					if(file_exists($sign))
					{
						$pdf->image($sign,136,75, 25, 10); //x, y, w, h
					}
					
					//label signature
					$pdf->SetXY(134.5,83);
					$pdf->Cell(30,0,'SIGNATURE', '0', 0,'C',false);	
					
					//Office
					$pdf->SetTextColor(255, 255, 255); //r, g ,b
					$pdf->SetFont('Arial', 'B', 13);
					$pdf->SetXY(134.5,88);
					$pdf->Cell(30,0,$office, '0', 0,'C',false);
					
					//Position
					$pdf->SetTextColor(255, 255, 0);
					$pdf->SetFont('Arial', '', 10);
					$pdf->SetXY(134.5,94);
					$pdf->Cell(30,0,strtoupper($position), '0', 0,'C',false);	

				}
				
				//----------------------------- Row 4 ----------------------------------
				if($n == 4)
				{	
					//Employee number
					$pdf->SetTextColor(0, 0, 0);
					$pdf->SetFont('Arial', 'B', 9);
					$pdf->SetXY(192.5,29);
					$pdf->Cell(30,0,'EMP No. '.$employee_id, '0', 0,'C',false);	
					
					//Employee Photo 2x3
					$pdf->image($pic,191.5,31, 32, 37); //x, y, w, h
				
					//Employee name
					$pdf->SetFont('Arial', 'B', $fs);
					$pdf->SetXY(192.5,71);
					$pdf->Cell(30,0,strtoupper($name), '0', 0,'C',false);	
									
					//label name
					$pdf->SetFont('Arial', '', 5);
					$pdf->SetXY(192.5,74);
					$pdf->Cell(30,0,$lblname, '0', 0,'C',false);	
								
					//Signature
					if(file_exists($sign))
					{
						$pdf->image($sign,194,75, 25, 10); //x, y, w, h
					}
					
					//label signature
					$pdf->SetXY(192.5,83);
					$pdf->Cell(30,0,'SIGNATURE', '0', 0,'C',false);	
					
					//Office
					$pdf->SetTextColor(255, 255, 255); //r, g ,b
					$pdf->SetFont('Arial', 'B', 13);
					$pdf->SetXY(192.5,88);
					$pdf->Cell(30,0,$office, '0', 0,'C',false);
					
					//Position
					$pdf->SetTextColor(255, 255, 0);
					$pdf->SetFont('Arial', '', 10);
					$pdf->SetXY(192.5,94);
					$pdf->Cell(30,0,strtoupper($position), '0', 0,'C',false);	
		
				}
				
				//----------------------------- Row 5 ----------------------------------
				if($n == 5)
				{
										
					//Employee number
					$pdf->SetTextColor(0, 0, 0);
					$pdf->SetFont('Arial', 'B', 9);
					$pdf->SetXY(250.5,29);
					$pdf->Cell(30,0,'EMP No. '.$employee_id, '0', 0,'C',false);	
					
					//Employee Photo 2x3
					$pdf->image($pic,249.5,31, 32, 37); //x, y, w, h
				
					//Employee name
					$pdf->SetFont('Arial', 'B', $fs);
					$pdf->SetXY(250.5,71);
					$pdf->Cell(30,0,strtoupper($name), '0', 0,'C',false);	
									
					//label name
					$pdf->SetFont('Arial', '', 5);
					$pdf->SetXY(250.5,74);
					$pdf->Cell(30,0,$lblname, '0', 0,'C',false);	
								
					//Signature
					if(file_exists($sign))
					{
						$pdf->image($sign,252,75, 25, 10); //x, y, w, h
					}
					
					//label signature
					$pdf->SetXY(250.5,83);
					$pdf->Cell(30,0,'SIGNATURE', '0', 0,'C',false);	
					
					//Office
					$pdf->SetTextColor(255, 255, 255); //r, g ,b
					$pdf->SetFont('Arial', 'B', 13);
					$pdf->SetXY(250.5,88);
					$pdf->Cell(30,0,$office, '0', 0,'C',false);
					
					//Position
					$pdf->SetTextColor(255, 255, 0);
					$pdf->SetFont('Arial', '', 10);
					$pdf->SetXY(250.5,94);
					$pdf->Cell(30,0,strtoupper($position), '0', 0,'C',false);	

		
				}
				//======================== END Column 1 ==============================
							
									
				//======================== START Column 1 ==============================
	
				//----------------------------- Row 2 ----------------------------------
				if($n == 6)
				{				

				//Employee number
					$pdf->SetTextColor(0, 0, 0);
					$pdf->SetFont('Arial', 'B', 9);
					$pdf->SetXY(18.5,129);
					$pdf->Cell(30,0,'EMP No. '.$employee_id, '0', 0,'C',false);	
					
					//Employee Photo 2x3
					$pdf->image($pic,17.5,132, 32, 37); //x, y, w, h
				
					//Employee name
					$pdf->SetFont('Arial', 'B', $fs);
					$pdf->SetXY(18.5,172);
					$pdf->Cell(30,0,strtoupper($name), '0', 0,'C',false);	
									
					//label name
					$pdf->SetFont('Arial', '', 5);
					$pdf->SetXY(18.5,175);
					$pdf->Cell(30,0,$lblname, '0', 0,'C',false);	
								
					//Signature
					if(file_exists($sign))
					{
						$pdf->image($sign,20,176, 25, 10); //x, y, w, h
					}
					
					//label signature
					$pdf->SetXY(18.5,184);
					$pdf->Cell(30,0,'SIGNATURE', '0', 0,'C',false);	
					
					//Office
					$pdf->SetTextColor(255, 255, 255); //r, g ,b
					$pdf->SetFont('Arial', 'B', 13);
					$pdf->SetXY(18.5,188.5);
					$pdf->Cell(30,0,$office, '0', 0,'C',false);
					
					//Position
					$pdf->SetTextColor(255, 255, 0);
					$pdf->SetFont('Arial', '', 10);
					$pdf->SetXY(18.5,200);
					$pdf->Cell(30,-11,strtoupper($position), '0', 0,'C',false);	
		
				}
				
				
				//----------------------------- Row 2 ----------------------------------
				if($n == 7)
				{
				
					//Employee number
					$pdf->SetTextColor(0, 0, 0);
					$pdf->SetFont('Arial', 'B', 9);
					$pdf->SetXY(76.5,129);
					$pdf->Cell(30,0,'EMP No. '.$employee_id, '0', 0,'C',false);	
					
					//Employee Photo 2x3
					$pdf->image($pic,75.5,132, 32, 37); //x, y, w, h
				
					//Employee name
					$pdf->SetFont('Arial', 'B', $fs);
					$pdf->SetXY(76.5,172);
					$pdf->Cell(30,0,strtoupper($name), '0', 0,'C',false);	
									
					//label name
					$pdf->SetFont('Arial', '', 5);
					$pdf->SetXY(76.5,175);
					$pdf->Cell(30,0,$lblname, '0', 0,'C',false);	
								
					//Signature
					if(file_exists($sign))
					{
						$pdf->image($sign,78,176, 25, 10); //x, y, w, h
					}
					
					//label signature
					$pdf->SetXY(76.5,184);
					$pdf->Cell(30,0,'SIGNATURE', '0', 0,'C',false);	
					
					//Office
					$pdf->SetTextColor(255, 255, 255); //r, g ,b
					$pdf->SetFont('Arial', 'B', 13);
					$pdf->SetXY(76.5,188.5);
					$pdf->Cell(30,0,$office, '0', 0,'C',false);
					
					//Position
					$pdf->SetTextColor(255, 255, 0);
					$pdf->SetFont('Arial', '', 10);
					$pdf->SetXY(76.5,200);
					$pdf->Cell(30,-11,strtoupper($position), '0', 0,'C',false);	
												
				}
				
				//----------------------------- Row 3 ----------------------------------
				if($n == 8)
				{
					//Employee number
					$pdf->SetTextColor(0, 0, 0);
					$pdf->SetFont('Arial', 'B', 9);
					$pdf->SetXY(134.5,129);
					$pdf->Cell(30,0,'EMP No. '.$employee_id, '0', 0,'C',false);	
					
					//Employee Photo 2x3
					$pdf->image($pic,133.5,132, 32, 37); //x, y, w, h
				
					//Employee name
					$pdf->SetFont('Arial', 'B', $fs);
					$pdf->SetXY(134.5,172);
					$pdf->Cell(30,0,strtoupper($name), '0', 0,'C',false);	
									
					//label name
					$pdf->SetFont('Arial', '', 5);
					$pdf->SetXY(134.5,175);
					$pdf->Cell(30,0,$lblname, '0', 0,'C',false);	
								
					//Signature
					if(file_exists($sign))
					{
						$pdf->image($sign,136,176, 25, 10); //x, y, w, h
					}
					
					//label signature
					$pdf->SetXY(134.5,184);
					$pdf->Cell(30,0,'SIGNATURE', '0', 0,'C',false);	
					
					//Office
					$pdf->SetTextColor(255, 255, 255); //r, g ,b
					$pdf->SetFont('Arial', 'B', 13);
					$pdf->SetXY(134.5,188.5);
					$pdf->Cell(30,0,$office, '0', 0,'C',false);
					
					//Position
					$pdf->SetTextColor(255, 255, 0);
					$pdf->SetFont('Arial', '', 10);
					$pdf->SetXY(134.5,200);
					$pdf->Cell(30,-11,strtoupper($position), '0', 0,'C',false);	

				}
				
				//----------------------------- Row 4 ----------------------------------
				if($n == 9)
				{	
					//Employee number
					$pdf->SetTextColor(0, 0, 0);
					$pdf->SetFont('Arial', 'B', 9);
					$pdf->SetXY(192.5,129);
					$pdf->Cell(30,0,'EMP No. '.$employee_id, '0', 0,'C',false);	
					
					//Employee Photo 2x3
					$pdf->image($pic,191.5,132, 32, 37); //x, y, w, h
				
					//Employee name
					$pdf->SetFont('Arial', 'B', $fs);
					$pdf->SetXY(192.5,172);
					$pdf->Cell(30,0,strtoupper($name), '0', 0,'C',false);	
									
					//label name
					$pdf->SetFont('Arial', '', 5);
					$pdf->SetXY(192.5,175);
					$pdf->Cell(30,0,$lblname, '0', 0,'C',false);	
								
					//Signature
					if(file_exists($sign))
					{
						$pdf->image($sign,194,176, 25, 10); //x, y, w, h
					}
					
					//label signature
					$pdf->SetXY(192.5,184);
					$pdf->Cell(30,0,'SIGNATURE', '0', 0,'C',false);	
					
					//Office
					$pdf->SetTextColor(255, 255, 255); //r, g ,b
					$pdf->SetFont('Arial', 'B', 13);
					$pdf->SetXY(192.5,188.5);
					$pdf->Cell(30,0,$office, '0', 0,'C',false);
					
					//Position
					$pdf->SetTextColor(255, 255, 0);
					$pdf->SetFont('Arial', '', 10);
					$pdf->SetXY(192.5,200);
					$pdf->Cell(30,-11,strtoupper($position), '0', 0,'C',false);	
		
				}
				
				//----------------------------- Row 5 ----------------------------------
				if($n == 10)
				{
										
					//Employee number
					$pdf->SetTextColor(0, 0, 0);
					$pdf->SetFont('Arial', 'B', 9);
					$pdf->SetXY(250.5,129);
					$pdf->Cell(30,0,'EMP No. '.$employee_id, '0', 0,'C',false);	
					
					//Employee Photo 2x3
					$pdf->image($pic,249.5,132, 32, 37); //x, y, w, h
				
					//Employee name
					$pdf->SetFont('Arial', 'B', $fs);
					$pdf->SetXY(250.5,172);
					$pdf->Cell(30,0,strtoupper($name), '0', 0,'C',false);	
									
					//label name
					$pdf->SetFont('Arial', '', 5);
					$pdf->SetXY(250.5,175);
					$pdf->Cell(30,0,$lblname, '0', 0,'C',false);	
								
					//Signature
					if(file_exists($sign))
					{
						$pdf->image($sign,252,176, 25, 10); //x, y, w, h
					}
					
					//label signature
					$pdf->SetXY(250.5,184);
					$pdf->Cell(30,0,'SIGNATURE', '0', 0,'C',false);	
					
					//Office
					$pdf->SetTextColor(255, 255, 255); //r, g ,b
					$pdf->SetFont('Arial', 'B', 13);
					$pdf->SetXY(250.5,188.5);
					$pdf->Cell(30,0,$office, '0', 0,'C',false);
					
					//Position
					$pdf->SetTextColor(255, 255, 0);
					$pdf->SetFont('Arial', '', 10);
					$pdf->SetXY(250.5,200);
					$pdf->Cell(30,-11,strtoupper($position), '0', 0,'C',false);	

		
				}

				$n++;
				//======================== END Column 2 ==============================	
	
			}	
			

	
		// Output
		$pdf->Output('pdf-report/front-id.pdf', 'F'); 
		return 'pdf-report/front-id.pdf';
		
	}
	//--------------------------------------------------------------------------------------
	function back_id($results)
	{
		$this->load->helper('settings');		
		//print preview of MR		
		$this->load->library('fpdf');
			
					
		$this->load->library('fpdi');
		
		// initiate FPDI   
		$pdf = new FPDI('L');
		
		// add a page
		$pdf->AddPage();
		// set the sourcefile
		$pagecount = $pdf->setSourceFile('pdf-report/id/back-id.pdf');
		// import page 1
		$tplIdx = $pdf->importPage(1);
		// use the imported page and place it at point 10,10 with a width of 100 mm
		$pdf->useTemplate($tplIdx);

		// now write some text above the imported page	

		$pdf->SetTextColor(0,0,0);
	

		$pdf->SetFont('Arial', '', 7);		
		
		
		$n = 1;		
		
		foreach($results as $result)
		{
			$s = new Personal_m();
			$row = $s->get_by_employee_id($result->employee_id);
			//======================== START Column 1 | Right to Left ==============================	
			
				if($n == 11)
				{
					//add new page		
					$pdf->addPage();
					
	
					for ($n = 1; $n <= 1; $n++)
					{
						$tplidx = $pdf->ImportPage(1);
							
						$pdf->useTemplate($tplIdx); //, 1, 1, 210
					}
					$n = $n-1;
				}	
			
						
			$bday = $row->birth_date;
			$address = $row->res_address;
			$blood_type = '"'.$row->blood_type.'"';
			$gsis = $row->gsis;
			$pagibig = $row->pagibig;
			$philhealth = $row->philhealth;
			$tin = $row->tin;
			$emergency = '';
			$contact = $row->cp;
			
			//----------------------------- Row 1 ----------------------------------
			
			///Birthday
			if($n == 1)
			{
				//Birthday
				if($bday != '0000-00-00')
				{
					$pdf->SetXY(247,23);
					$pdf->Cell(50,0,date('F d, Y',strtotime(date('F d, Y',strtotime($bday)))), '0', 0,'C',false);
				}
				
				//Address
				$pdf->SetXY(257,15);
				$addr = splitstroverflow(ucwords(strtolower(utf8_decode($address))), 28);
				$pdf->Cell(30,0,$addr[0], '0', 0,'C',false);
				//display text overflow
				if($addr[1])
				{		
					$pdf->Ln(2.5);
					$pdf->SetX(257);
					$pdf->Cell(30,0,$addr[1], '0', 0,'C',false);	
				}
				if($addr[2])
				{		
					$pdf->Ln(2.5);
					$pdf->SetX(257);
					$pdf->Cell(30,0,$addr[2], '0', 0,'C',false);	
				}
				if($addr[3])
				{		
					$pdf->Ln(2.5);
					$pdf->SetX(257);
					$pdf->Cell(30,0,$addr[3], '0', 0,'C',false);	
				}
				
				//Blood Type
				$pdf->SetXY(247,28.3);
				$pdf->Cell(50,0,strtoupper($blood_type), '0', 0,'C',false);
				
				//GSIS
				$pdf->SetXY(247,33);
				$pdf->Cell(50,0,strtoupper($gsis), '0', 0,'C',false);
				
				//PAGIBIG
				$pdf->SetXY(247,38);
				$pdf->Cell(50,0,strtoupper($pagibig), '0', 0,'C',false);
				
				//PHILHEALTH
				$pdf->SetXY(247,43.5);
				$pdf->Cell(50,0,strtoupper($philhealth), '0', 0,'C',false);
				
				//PHILHEALTH
				$pdf->SetXY(247,48.5);
				$pdf->Cell(50,0,strtoupper($tin), '0', 0,'C',false);
				
				//in case of emergency
				$pdf->SetXY(235,75.5);
				$pdf->Cell(60,0,strtoupper($emergency), '0', 0,'C',false);
				
				//CP No.
				$pdf->SetXY(250,78);
				$cpno = splitstroverflow($contact, 13);
				$pdf->Cell(30,0,$cpno[0], '0', 0,'C',false);
	
				if($cpno[1])
				{		
					$pdf->Ln(3);
					$pdf->SetX(250);
					$pdf->Cell(30,0,$cpno[1], '0', 0,'C',false);	
				}
			}
			
			//----------------------------- Row 2 ----------------------------------
			if($n == 2)
			{
				//Birthday
				if($bday != '0000-00-00')
				{
					$pdf->SetXY(189,23);
					$pdf->Cell(50,0,date('F d, Y',strtotime(date('F d, Y',strtotime($bday)))), '0', 0,'C',false);
				}
				
				//Address
				$pdf->SetXY(199,15);
				$addr = splitstroverflow(ucwords(strtolower(utf8_decode($address))), 28);
				$pdf->Cell(30,0,$addr[0], '0', 0,'C',false);
				//display text overflow
				if($addr[1])
				{		
					$pdf->Ln(2.5);
					$pdf->SetX(199);
					$pdf->Cell(30,0,$addr[1], '0', 0,'C',false);	
				}
				if($addr[2])
				{		
					$pdf->Ln(2.5);
					$pdf->SetX(199);
					$pdf->Cell(30,0,$addr[2], '0', 0,'C',false);	
				}
				if($addr[3])
				{		
					$pdf->Ln(2.5);
					$pdf->SetX(199);
					$pdf->Cell(30,0,$addr[3], '0', 0,'C',false);	
				}
				
				//Blood Type
				$pdf->SetXY(189,28.3);
				$pdf->Cell(50,0,strtoupper($blood_type), '0', 0,'C',false);
				
				//GSIS
				$pdf->SetXY(189,33);
				$pdf->Cell(50,0,strtoupper($gsis), '0', 0,'C',false);
				
				//PAGIBIG
				$pdf->SetXY(189,38);
				$pdf->Cell(50,0,strtoupper($pagibig), '0', 0,'C',false);
				
				//PHILHEALTH
				$pdf->SetXY(189,43.5);
				$pdf->Cell(50,0,strtoupper($philhealth), '0', 0,'C',false);
				
				//PHILHEALTH
				$pdf->SetXY(189,48.5);
				$pdf->Cell(50,0,strtoupper($tin), '0', 0,'C',false);
				
				//in case of emergency
				$pdf->SetXY(177,75.5);
				$pdf->Cell(60,0,strtoupper($emergency), '0', 0,'C',false);
				
				//CP No.
				$pdf->SetXY(192,78);
				$cpno = splitstroverflow($contact, 13);
				$pdf->Cell(30,0,$cpno[0], '0', 0,'C',false);
	
				if($cpno[1])
				{		
					$pdf->Ln(3);
					$pdf->SetX(192);
					$pdf->Cell(30,0,$cpno[1], '0', 0,'C',false);	
				}
			}
			
			//----------------------------- Row 3 ----------------------------------
			if($n == 3)
			{
				//Birthday
				if($bday != '0000-00-00')
				{
					$pdf->SetXY(131,23);
					$pdf->Cell(50,0,date('F d, Y',strtotime(date('F d, Y',strtotime($bday)))), '0', 0,'C',false);
				}
				
				//Address
				$pdf->SetXY(141,15);
				$addr = splitstroverflow(ucwords(strtolower(utf8_decode($address))), 28);
				$pdf->Cell(30,0,$addr[0], '0', 0,'C',false);
				//display text overflow
				if($addr[1])
				{		
					$pdf->Ln(2.5);
					$pdf->SetX(141);
					$pdf->Cell(30,0,$addr[1], '0', 0,'C',false);	
				}
				if($addr[2])
				{		
					$pdf->Ln(2.5);
					$pdf->SetX(141);
					$pdf->Cell(30,0,$addr[2], '0', 0,'C',false);	
				}
				if($addr[3])
				{		
					$pdf->Ln(2.5);
					$pdf->SetX(141);
					$pdf->Cell(30,0,$addr[3], '0', 0,'C',false);	
				}
				
				//Blood Type
				$pdf->SetXY(131,28.3);
				$pdf->Cell(50,0,strtoupper($blood_type), '0', 0,'C',false);
				
				//GSIS
				$pdf->SetXY(131,33);
				$pdf->Cell(50,0,strtoupper($gsis), '0', 0,'C',false);
				
				//PAGIBIG
				$pdf->SetXY(131,38);
				$pdf->Cell(50,0,strtoupper($pagibig), '0', 0,'C',false);
				
				//PHILHEALTH
				$pdf->SetXY(131,43.5);
				$pdf->Cell(50,0,strtoupper($philhealth), '0', 0,'C',false);
				
				//PHILHEALTH
				$pdf->SetXY(131,48.5);
				$pdf->Cell(50,0,strtoupper($tin), '0', 0,'C',false);
				
				//in case of emergency
				$pdf->SetXY(119,75.5);
				$pdf->Cell(60,0,strtoupper($emergency), '0', 0,'C',false);
				
				//CP No.
				$pdf->SetXY(134,78);
				$cpno = splitstroverflow($contact, 13);
				$pdf->Cell(30,0,$cpno[0], '0', 0,'C',false);
	
				if($cpno[1])
				{		
					$pdf->Ln(3);
					$pdf->SetX(134);
					$pdf->Cell(30,0,$cpno[1], '0', 0,'C',false);	
				}
			}
			
			//----------------------------- Row 4 ----------------------------------
			if($n == 4)
			{
				//Birthday
				if($bday != '0000-00-00')
				{
					$pdf->SetXY(73,23);
					$pdf->Cell(50,0,date('F d, Y',strtotime(date('F d, Y',strtotime($bday)))), '0', 0,'C',false);
				}
				
				//Address
				$pdf->SetXY(83,15);
				$addr = splitstroverflow(ucwords(strtolower(utf8_decode($address))), 28);
				$pdf->Cell(30,0,$addr[0], '0', 0,'C',false);
				//display text overflow
				if($addr[1])
				{		
					$pdf->Ln(2.5);
					$pdf->SetX(83);
					$pdf->Cell(30,0,$addr[1], '0', 0,'C',false);	
				}
				if($addr[2])
				{		
					$pdf->Ln(2.5);
					$pdf->SetX(83);
					$pdf->Cell(30,0,$addr[2], '0', 0,'C',false);	
				}
				if($addr[3])
				{		
					$pdf->Ln(2.5);
					$pdf->SetX(3);
					$pdf->Cell(30,0,$addr[3], '0', 0,'C',false);	
				}
				
				//Blood Type
				$pdf->SetXY(73,28.3);
				$pdf->Cell(50,0,strtoupper($blood_type), '0', 0,'C',false);
				
				//GSIS
				$pdf->SetXY(73,33);
				$pdf->Cell(50,0,strtoupper($gsis), '0', 0,'C',false);
				
				//PAGIBIG
				$pdf->SetXY(73,38);
				$pdf->Cell(50,0,strtoupper($pagibig), '0', 0,'C',false);
				
				//PHILHEALTH
				$pdf->SetXY(73,43.5);
				$pdf->Cell(50,0,strtoupper($philhealth), '0', 0,'C',false);
				
				//PHILHEALTH
				$pdf->SetXY(73,48.5);
				$pdf->Cell(50,0,strtoupper($tin), '0', 0,'C',false);
				
				//in case of emergency
				$pdf->SetXY(61,75.5);
				$pdf->Cell(60,0,strtoupper($emergency), '0', 0,'C',false);
				
				//CP No.
				$pdf->SetXY(76,78);
				$cpno = splitstroverflow($contact, 13);
				$pdf->Cell(30,0,$cpno[0], '0', 0,'C',false);
	
				if($cpno[1])
				{		
					$pdf->Ln(3);
					$pdf->SetX(76);
					$pdf->Cell(30,0,$cpno[1], '0', 0,'C',false);	
				}
			}
			
			//----------------------------- Row 5 ----------------------------------
			if($n == 5)
			{
				//Birthday
				if($bday != '0000-00-00')
				{
					$pdf->SetXY(15,23);
					$pdf->Cell(50,0,date('F d, Y',strtotime(date('F d, Y',strtotime($bday)))), '0', 0,'C',false);
				}
				
				//Address
				$pdf->SetXY(25,15);
				$addr = splitstroverflow(ucwords(strtolower(utf8_decode($address))), 28);
				$pdf->Cell(30,0,$addr[0], '0', 0,'C',false);
				//display text overflow
				if($addr[1])
				{		
					$pdf->Ln(2.5);
					$pdf->SetX(25);
					$pdf->Cell(30,0,$addr[1], '0', 0,'C',false);	
				}
				if($addr[2])
				{		
					$pdf->Ln(2.5);
					$pdf->SetX(25);
					$pdf->Cell(30,0,$addr[2], '0', 0,'C',false);	
				}
				if($addr[3])
				{		
					$pdf->Ln(2.5);
					$pdf->SetX(25);
					$pdf->Cell(30,0,$addr[3], '0', 0,'C',false);	
				}
				
				//Blood Type
				$pdf->SetXY(15,28.3);
				$pdf->Cell(50,0,strtoupper($blood_type), '0', 0,'C',false);
				
				//GSIS
				$pdf->SetXY(15,33);
				$pdf->Cell(50,0,strtoupper($gsis), '0', 0,'C',false);
				
				//PAGIBIG
				$pdf->SetXY(15,38);
				$pdf->Cell(50,0,strtoupper($pagibig), '0', 0,'C',false);
				
				//PHILHEALTH
				$pdf->SetXY(15,43.5);
				$pdf->Cell(50,0,strtoupper($philhealth), '0', 0,'C',false);
				
				//PHILHEALTH
				$pdf->SetXY(15,48.5);
				$pdf->Cell(50,0,strtoupper($tin), '0', 0,'C',false);
				
				//in case of emergency
				$pdf->SetXY(3,75.5);
				$pdf->Cell(60,0,strtoupper($emergency), '0', 0,'C',false);
				
				//CP No.
				$pdf->SetXY(18,78);
				$cpno = splitstroverflow($contact, 13);
				$pdf->Cell(30,0,$cpno[0], '0', 0,'C',false);
	
				if($cpno[1])
				{		
					$pdf->Ln(3);
					$pdf->SetX(18);
					$pdf->Cell(30,0,$cpno[1], '0', 0,'C',false);	
				}
			}
			//======================== END Column 1 | Right to Left ==============================
			
			
			//======================== START Column 2 | Right to Left ==============================	
			
			//----------------------------- Row 1 ----------------------------------
			///Birthday
			if($n == 6)
			{
				//Birthday
				if($bday != '0000-00-00')
				{
					$pdf->SetXY(247,123.5);
					$pdf->Cell(50,0,date('F d, Y',strtotime(date('F d, Y',strtotime($bday)))), '0', 0,'C',false);
				}
				
				//Address
				$pdf->SetXY(257,115);
				$addr = splitstroverflow(ucwords(strtolower(utf8_decode($address))), 28);
				$pdf->Cell(30,0,$addr[0], '0', 0,'C',false);
				//display text overflow
				if($addr[1])
				{		
					$pdf->Ln(2.5);
					$pdf->SetX(257);
					$pdf->Cell(30,0,$addr[1], '0', 0,'C',false);	
				}
				if($addr[2])
				{		
					$pdf->Ln(2.5);
					$pdf->SetX(257);
					$pdf->Cell(30,0,$addr[2], '0', 0,'C',false);	
				}
				if($addr[3])
				{		
					$pdf->Ln(2.5);
					$pdf->SetX(257);
					$pdf->Cell(30,0,$addr[3], '0', 0,'C',false);	
				}
				
				//Blood Type
				$pdf->SetXY(247,128.5);
				$pdf->Cell(50,0,strtoupper($blood_type), '0', 0,'C',false);
				
				//GSIS
				$pdf->SetXY(247,133.5);
				$pdf->Cell(50,0,strtoupper($gsis), '0', 0,'C',false);
				
				//PAGIBIG
				$pdf->SetXY(247,138.5);
				$pdf->Cell(50,0,strtoupper($pagibig), '0', 0,'C',false);
				
				//PHILHEALTH
				$pdf->SetXY(247,144);
				$pdf->Cell(50,0,strtoupper($philhealth), '0', 0,'C',false);
				
				//TIN
				$pdf->SetXY(247,149);
				$pdf->Cell(50,0,strtoupper($tin), '0', 0,'C',false);
				
				//in case of emergency
				$pdf->SetXY(235,176.3);
				$pdf->Cell(60,0,strtoupper($emergency), '0', 0,'C',false);
				
				//CP No.
				$pdf->SetXY(250,178.5);
				$cpno = splitstroverflow($contact, 13);
				$pdf->Cell(30,0,$cpno[0], '0', 0,'C',false);
	
				if($cpno[1])
				{		
					$pdf->Ln(3);
					$pdf->SetX(250);
					$pdf->Cell(30,0,$cpno[1], '0', 0,'C',false);	
				}
			}
			
			//----------------------------- Row 2 ----------------------------------
					
			//----------------------------- Row 2 ----------------------------------
			if($n == 7)
			{
				//Birthday
				if($bday != '0000-00-00')
				{
					$pdf->SetXY(189,123.5);
					$pdf->Cell(50,0,date('F d, Y',strtotime(date('F d, Y',strtotime($bday)))), '0', 0,'C',false);
				}
				
				//Address
				$pdf->SetXY(199,115);
				$addr = splitstroverflow(ucwords(strtolower(utf8_decode($address))), 28);
				$pdf->Cell(30,0,$addr[0], '0', 0,'C',false);
				//display text overflow
				if($addr[1])
				{		
					$pdf->Ln(2.5);
					$pdf->SetX(199);
					$pdf->Cell(30,0,$addr[1], '0', 0,'C',false);	
				}
				if($addr[2])
				{		
					$pdf->Ln(2.5);
					$pdf->SetX(199);
					$pdf->Cell(30,0,$addr[2], '0', 0,'C',false);	
				}
				if($addr[3])
				{		
					$pdf->Ln(2.5);
					$pdf->SetX(199);
					$pdf->Cell(30,0,$addr[3], '0', 0,'C',false);	
				}
				
				//Blood Type
				$pdf->SetXY(189,128.5);
				$pdf->Cell(50,0,strtoupper($blood_type), '0', 0,'C',false);
				
				//GSIS
				$pdf->SetXY(189,133.5);
				$pdf->Cell(50,0,strtoupper($gsis), '0', 0,'C',false);
				
				//PAGIBIG
				$pdf->SetXY(189,138.5);
				$pdf->Cell(50,0,strtoupper($pagibig), '0', 0,'C',false);
				
				//PHILHEALTH
				$pdf->SetXY(189,144);
				$pdf->Cell(50,0,strtoupper($philhealth), '0', 0,'C',false);
				
				//tin
				$pdf->SetXY(189,149);
				$pdf->Cell(50,0,strtoupper($tin), '0', 0,'C',false);
				
				//in case of emergency
				$pdf->SetXY(177,176.3);
				$pdf->Cell(60,0,strtoupper($emergency), '0', 0,'C',false);
				
				//CP No.
				$pdf->SetXY(192,178.5);
				$cpno = splitstroverflow($contact, 13);
				$pdf->Cell(30,0,$cpno[0], '0', 0,'C',false);
	
				if($cpno[1])
				{		
					$pdf->Ln(3);
					$pdf->SetX(192);
					$pdf->Cell(30,0,$cpno[1], '0', 0,'C',false);	
				}
			}
			
			//----------------------------- Row 3 ----------------------------------
			if($n == 8)
			{
				//Birthday
				if($bday != '0000-00-00')
				{
					$pdf->SetXY(131,123.5);
					$pdf->Cell(50,0,date('F d, Y',strtotime(date('F d, Y',strtotime($bday)))), '0', 0,'C',false);
				}
				
				//Address
				$pdf->SetXY(141,115);
				$addr = splitstroverflow(ucwords(strtolower(utf8_decode($address))), 28);
				$pdf->Cell(30,0,$addr[0], '0', 0,'C',false);
				//display text overflow
				if($addr[1])
				{		
					$pdf->Ln(2.5);
					$pdf->SetX(141);
					$pdf->Cell(30,0,$addr[1], '0', 0,'C',false);	
				}
				if($addr[2])
				{		
					$pdf->Ln(2.5);
					$pdf->SetX(141);
					$pdf->Cell(30,0,$addr[2], '0', 0,'C',false);	
				}
				if($addr[3])
				{		
					$pdf->Ln(2.5);
					$pdf->SetX(141);
					$pdf->Cell(30,0,$addr[3], '0', 0,'C',false);	
				}
				
				//Blood Type
				$pdf->SetXY(131,128.5);
				$pdf->Cell(50,0,strtoupper($blood_type), '0', 0,'C',false);
				
				//GSIS
				$pdf->SetXY(131,133.5);
				$pdf->Cell(50,0,strtoupper($gsis), '0', 0,'C',false);
				
				//PAGIBIG
				$pdf->SetXY(131,138.5);
				$pdf->Cell(50,0,strtoupper($pagibig), '0', 0,'C',false);
				
				//PHILHEALTH
				$pdf->SetXY(131,144);
				$pdf->Cell(50,0,strtoupper($philhealth), '0', 0,'C',false);
				
				//PHILHEALTH
				$pdf->SetXY(131,149);
				$pdf->Cell(50,0,strtoupper($tin), '0', 0,'C',false);
				
				//in case of emergency
				$pdf->SetXY(119,176.3);
				$pdf->Cell(60,0,strtoupper($emergency), '0', 0,'C',false);
				
				//CP No.
				$pdf->SetXY(134,178.5);
				$cpno = splitstroverflow($contact, 13);
				$pdf->Cell(30,0,$cpno[0], '0', 0,'C',false);
	
				if($cpno[1])
				{		
					$pdf->Ln(3);
					$pdf->SetX(134);
					$pdf->Cell(30,0,$cpno[1], '0', 0,'C',false);	
				}
			}
			
			//----------------------------- Row 4 ----------------------------------
			if($n == 9)
			{
				//Birthday
				if($bday != '0000-00-00')
				{
					$pdf->SetXY(73,123.5);
					$pdf->Cell(50,0,date('F d, Y',strtotime(date('F d, Y',strtotime($bday)))), '0', 0,'C',false);
				}
				
				//Address
				$pdf->SetXY(83,115);
				$addr = splitstroverflow(ucwords(strtolower(utf8_decode($address))), 28);
				$pdf->Cell(30,0,$addr[0], '0', 0,'C',false);
				//display text overflow
				if($addr[1])
				{		
					$pdf->Ln(2.5);
					$pdf->SetX(83);
					$pdf->Cell(30,0,$addr[1], '0', 0,'C',false);	
				}
				if($addr[2])
				{		
					$pdf->Ln(2.5);
					$pdf->SetX(83);
					$pdf->Cell(30,0,$addr[2], '0', 0,'C',false);	
				}
				if($addr[3])
				{		
					$pdf->Ln(2.5);
					$pdf->SetX(3);
					$pdf->Cell(30,0,$addr[3], '0', 0,'C',false);	
				}
				
				//Blood Type
				$pdf->SetXY(73,128.5);
				$pdf->Cell(50,0,strtoupper($blood_type), '0', 0,'C',false);
				
				//GSIS
				$pdf->SetXY(73,133.5);
				$pdf->Cell(50,0,strtoupper($gsis), '0', 0,'C',false);
				
				//PAGIBIG
				$pdf->SetXY(73,138.5);
				$pdf->Cell(50,0,strtoupper($pagibig), '0', 0,'C',false);
				
				//PHILHEALTH
				$pdf->SetXY(73,144);
				$pdf->Cell(50,0,strtoupper($philhealth), '0', 0,'C',false);
				
				//PHILHEALTH
				$pdf->SetXY(73,149);
				$pdf->Cell(50,0,strtoupper($tin), '0', 0,'C',false);
				
				//in case of emergency
				$pdf->SetXY(61,176.3);
				$pdf->Cell(60,0,strtoupper($emergency), '0', 0,'C',false);
				
				//CP No.
				$pdf->SetXY(76,178.5);
				$cpno = splitstroverflow($contact, 13);
				$pdf->Cell(30,0,$cpno[0], '0', 0,'C',false);
	
				if($cpno[1])
				{		
					$pdf->Ln(3);
					$pdf->SetX(76);
					$pdf->Cell(30,0,$cpno[1], '0', 0,'C',false);	
				}
			}
			
			//----------------------------- Row 5 ----------------------------------
			if($n == 10)
			{
				//Birthday
				if($bday != '0000-00-00')
				{
					$pdf->SetXY(15,123.5);
					$pdf->Cell(50,0,date('F d, Y',strtotime(date('F d, Y',strtotime($bday)))), '0', 0,'C',false);
				}
				
				//Address
				$pdf->SetXY(25,115);
				$addr = splitstroverflow(ucwords(strtolower(utf8_decode($address))), 28);
				$pdf->Cell(30,0,$addr[0], '0', 0,'C',false);
				//display text overflow
				if($addr[1])
				{		
					$pdf->Ln(2.5);
					$pdf->SetX(25);
					$pdf->Cell(30,0,$addr[1], '0', 0,'C',false);	
				}
				if($addr[2])
				{		
					$pdf->Ln(2.5);
					$pdf->SetX(25);
					$pdf->Cell(30,0,$addr[2], '0', 0,'C',false);	
				}
				if($addr[3])
				{		
					$pdf->Ln(2.5);
					$pdf->SetX(25);
					$pdf->Cell(30,0,$addr[3], '0', 0,'C',false);	
				}
				
				//Blood Type
				$pdf->SetXY(15,128.5);
				$pdf->Cell(50,0,strtoupper($blood_type), '0', 0,'C',false);
				
				//GSIS
				$pdf->SetXY(15,133.5);
				$pdf->Cell(50,0,strtoupper($gsis), '0', 0,'C',false);
				
				//PAGIBIG
				$pdf->SetXY(15,138.5);
				$pdf->Cell(50,0,strtoupper($pagibig), '0', 0,'C',false);
				
				//PHILHEALTH
				$pdf->SetXY(15,144);
				$pdf->Cell(50,0,strtoupper($philhealth), '0', 0,'C',false);
				
				//tin
				$pdf->SetXY(15,149);
				$pdf->Cell(50,0,strtoupper($tin), '0', 0,'C',false);
				
				//in case of emergency
				$pdf->SetXY(3,176.3);
				$pdf->Cell(60,0,strtoupper($emergency), '0', 0,'C',false);
				
				//CP No.
				$pdf->SetXY(18,178.5);
				$cpno = splitstroverflow($contact, 13);
				$pdf->Cell(30,0,$cpno[0], '0', 0,'C',false);
	
				if($cpno[1])
				{		
					$pdf->Ln(3);
					$pdf->SetX(18);
					$pdf->Cell(30,0,$cpno[1], '0', 0,'C',false);	
				}
			}
			//======================== END Column 2 | Right to Left ==============================
			
			$n++;
		}
		

		// Output
		$pdf->Output('pdf-report/back-id.pdf', 'F'); 
		return 'pdf-report/back-id.pdf';	
	}
	//--------------------------------------------------------------------------------------
	function generated_id_preview($results)
	{
		$this->load->library('fpdf');
		
		//define('FPDF_FONTPATH',$this->config->item('fonts_path'));//
					
		$this->load->library('fpdi');

		$this->front_id($results);
		$this->back_id($results);
	
		$pre = array('pdf-report/front-id.pdf', 'pdf-report/back-id.pdf');//,'pdf-report/back-id.pdf'
		
		$this->load->library('concat_pdf','L');
					
		$this->concat_pdf->setFiles($pre);
		$this->concat_pdf->default_orientation = 'L';
		$this->concat_pdf->concat();
			
		$this->concat_pdf->Output('pdf-report/id_preview.pdf', 'F'); 
		
		//delete generated pdf file afterwards
		unlink('pdf-report/front-id.pdf');
		unlink('pdf-report/back-id.pdf');
		
		return 'pdf-report/id_preview.pdf';	
	}
	//-----------------------------------------------------------------------------------------------	

}


