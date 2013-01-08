<?php

function form_office_dropdown()
{
	$ci = & get_instance();
	
	$options = $ci->options->office_options();
	
	$selected = ($ci->input->post('office_id')) ? 
				$ci->input->post('office_id') : 
				$ci->session->userdata('office_id');

	$js = ' id="office_id"';
	
	return form_dropdown('office_id', $options, $selected, $js);	
}

function form_year_dropdown()
{
	$ci = & get_instance();
	
	$options 		= $ci->options->year_options(2009, 2020);//2010 - 2020
	$selected 		= ($ci->input->post('year')) ? $ci->input->post('year') : date('Y');

	$js = ' id="year"';
	
	return form_dropdown('year', $options, $selected, $js);	
}

function form_month_dropdown()
{
	$ci = & get_instance();
	
	$options 		= $ci->options->month_options();
	$selected 		= ($ci->input->post('month')) ? $ci->input->post('month') : date('m');

	$js = ' id="month"';
	
	return form_dropdown('month', $options, $selected, $js);	
}

function form_period_from_dropdown()
{
	$ci = & get_instance();
	
	$options 		= $ci->options->days_options();
	$selected 		= ($ci->input->post('period_from')) ? $ci->input->post('period_from') : '01';

	$js = ' id="period_from"';
	
	return form_dropdown('period_from', $options, $selected, $js);	
}

function form_period_to_dropdown()
{
	$ci = & get_instance();
	
	$options 		= $ci->options->days_options();
	$selected 		= ($ci->input->post('period_to')) ? $ci->input->post('period_to') : '15';

	$js = ' id="period_to"';
	
	return form_dropdown('period_to', $options, $selected, $js);	
}