<?php

function selected_index($id, $selected)
{
	if ($id == $selected)
	{
		return  'selected = "selected"';
	}
	else {
			
		return '';
	}
}

