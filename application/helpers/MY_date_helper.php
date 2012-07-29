<?php

function convert_long_date($date = '', $month_middle = FALSE)
{
	
	
	if ($date == '')
	{
		return NULL;
	}
	
	list($year, $month, $day) = explode('-', $date);
		
	$long_date = date("F d, Y", mktime(0, 0, 0, $month, $day, $year));
	
	// We'll return something like 23-Jan-49
	if ($month_middle == TRUE)
	{
		$long_date = date("d-M-y", mktime(0, 0, 0, $month, $day, $year));
	}
	
	return $long_date;
}

