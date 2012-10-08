<?php

/**
 * Options for dropdown list
 * hour 01-24
 *
 * @return array
 */
function hour_options( $add_blank = FALSE )
{
	$hour = 1; 
	
	if ( $add_blank == TRUE)
	{
		$options[''] = '';
	}
	
	while($hour != 25)
	{
		//Add leading zero to month
		$x = sprintf("%02d", $hour);
		
		$options[$x] = $x;
	
		$hour ++; 
	}
	
	return $options;
	
}

/**
 * Options for dropdown list
 * hour 01-24
 *
 * @return array
 */
function minute_options( $add_blank = FALSE )
{
	$minute = 0; 
	
	if ( $add_blank == TRUE)
	{
		$options[''] = '';
	}
	
	while($minute != 60)
	{
		//Add leading zero to month
		$x = sprintf("%02d", $minute);
		
		$options[$x] = $x;
	
		$minute += 30; 
	}
	
	return $options;
	
}

/**
 * Options for dropdown list
 * 
 *
 * @return array
 */
function schedule_options( $add_blank = FALSE )
{
	$s = new Schedule();
		
	$rows = $s->order_by('name')->get();
	
	$minute = 0; 
	
	if ( $add_blank == TRUE)
	{
		$options[''] = '';
	}
	
	foreach ($rows as $row)
	{
		$options[$row->id] = $row->name;
	
		$minute ++; 
	}
	
	return $options;
	
}

function user_options( $add_blank = FALSE )
{
	$u = new User_m();
	
	$u->where('username !=', 'mannysoft');

	$rows = $u->order_by('username')->get();
	
	$minute = 0; 
	
	if ( $add_blank == TRUE)
	{
		$options[''] = '';
	}
	
	foreach ($rows as $row)
	{
		$options[$row->id] = $row->username.' -- '.$row->lname.', '.$row->fname;	
	}
	
	return $options;
	
}