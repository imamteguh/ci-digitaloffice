<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['day_type'] = 'long';

$config['template'] = '
	{table_open}<table class="calendar">{/table_open}
	{heading_previous_cell}<th><a class="btn btn-primary btn-sm" href="{previous_url}">&lt;&lt;</a></th>{/heading_previous_cell}
	{heading_title_cell}<th colspan="5"><center><h4>{heading}</h4></center></th>{/heading_title_cell}
	{heading_next_cell}<th><a class="btn btn-primary btn-sm" style="float:right" href="{next_url}">&gt;&gt;</a></th>{/heading_next_cell}
	{week_day_cell}<th class="day_header">{week_day}</th>{/week_day_cell}
	{cal_cell_content}<a href="laporan/" class="day_listing">{day}</a>{/cal_cell_content}
	{cal_cell_content_today}<div class="highlight"><a href="{content}">{day}</a></div>{/cal_cell_content_today}
	{cal_cell_no_content}<a href="laporan/" class="day_listing">{day}</a>{/cal_cell_no_content}
	{cal_cell_no_content_today}<div class="today"><span class="day_listing">{day}</span></div>{/cal_cell_no_content_today}
';

$config['show_next_prev'] = TRUE;

$config['next_prev_url'] = base_url().'index.php/laporan/index/';

/*
{cal_cell_content}<a href="{content}">{day}</a>{/cal_cell_content}
{cal_cell_content_today}<div class="highlight"><a href="{content}">{day}</a></div>{/cal_cell_content_today}

	{cal_cell_content}<span class="day_listing">{day}</span>&nbsp;&bull; {content}&nbsp;{/cal_cell_content}
	{cal_cell_content_today}<div class="today"><span class="day_listing">{day}</span>&bull; {content}</div>{/cal_cell_content_today}
*/

/* End of file calendar.php */
/* Location: ./application/config/calendar.php */