<?php
function percent($num_amount, $num_total) 
{
	$count1 = $num_amount / $num_total;
	$count2 = $count1 * 100;
	//$count3 = 100 – $count2;
	$count3 = 100 - $count2;
	//$count = number_format($count3, 0);
	return $count3;
}
