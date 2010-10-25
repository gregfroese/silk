<?php
/*
* Smarty plugin
*/
function smarty_function_date_diff($params, &$smarty) {
	extract($params);
	if( empty( $date1 )) {
		$date1 = date('Y-m-d H:i:s'); //ues current time for the calcs
	}
	if( empty( $date2 )) {
		$date2 = date('Y-m-d H:i:s'); //ues current time for the calcs
	}
	$date1Parts = date_parse( $date1 );
	$date2Parts = date_parse( $date2 );
	// make a unix timestamp for the given date
	$targetDate = mktime($date1Parts["hour"], $date1Parts["minute"], $date1Parts["second"], $date1Parts["month"], $date1Parts["day"], $date1Parts["year"], -1);
	
	$the_countdown_date = mktime($date2Parts["hour"], $date2Parts["minute"], $date2Parts["second"], $date2Parts["month"], $date2Parts["day"], $date2Parts["year"], -1);
	
	$difference = $the_countdown_date - $targetDate;
	if ($difference < 0) $difference = 0;
	
	$days_left = floor($difference/60/60/24);
	$hours_left = floor(($difference - $days_left*60*60*24)/60/60);
	$minutes_left = floor(($difference - $days_left*60*60*24 - $hours_left*60*60)/60);
	$seconds_left = floor(($difference - $days_left*60*60*24 - $hours_left*60*60 - $minutes_left*60));
	  
	// OUTPUT
//	echo "Today's date ".date("F j, Y, g:i a")."<br/>";
//	echo "Countdown date ".date("F j, Y, g:i a",$the_countdown_date)."<br/>";
	$result = "";
	if( $days_left ) {
		$result .= "$days_left days $hours_left hours $minutes_left minutes $seconds_left seconds";
	} elseif( $hours_left ) {
		$result .= "$hours_left hours $minutes_left minutes $seconds_left seconds";
	} elseif( $minutes_left ) {
		$result .= "$minutes_left minutes $seconds_left seconds";
	} elseif( $seconds_left ) {
		$result .= "$seconds_left seconds";
	} else {
		$result .= "Overdue";
	}
	
	return $result;
}