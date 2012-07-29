<?php

function office_name($id = '')
{
	if ( $id == '')
	{
		return '';
	}
	
	$ci = & get_instance();
	
	$office_name = $ci->Office->get_office_name($id);
	
	return $office_name;
	
}

