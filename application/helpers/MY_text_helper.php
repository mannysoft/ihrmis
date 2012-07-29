<?php

function is_zero($text = 0)
{
	if ($text == 0)
	{
		return '';
	}
	else if($text == '0000-00-00')
	{
		return '';
	}
	else
	{
		return $text;
	}
}

