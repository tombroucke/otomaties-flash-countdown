<?php
/**
 * Sanitize date time value
 * @param $input
 * @return string
 */
function flash_countdown_sanitize_date_time($input)
{
	$date = new DateTime($input);
	return $date->format('Y-m-d H:i:s');
}

/**
 * Sanitize checkbox
 * @param $input
 * @return boolean
 */
function flash_countdown_sanitize_checkbox($checked)
{
	return ((isset($checked) && true == $checked) ? true : false);
}