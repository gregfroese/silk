<?php
/*
* Smarty plugin
* -------------------------------------------------------------
* Type: function
* Name: date_diff
* Version: 2.0
* Date: June 22, 2008
* Author: Matt DeKok
* Purpose: factor difference between two dates in days, weeks,
*          or years
* Input: date1 = "yyyy/mm/dd" or "yyyy-mm-dd"
*        date2 = "yyyy/mm/dd" or "yyyy-mm-dd" or $smarty.now
*        assign = name of variable to assign difference to
* Examples: {date_diff date1="5/12/2003" date2=$smarty.now}
*           {date_diff date1="5/12/2003" date2="5/10/2008" assign="diff"}{$diff}
* -------------------------------------------------------------
*/
function smarty_function_date_diff($params, &$smarty) {
	extract($params);
	if( empty( $date1 )) {
		$date1 = date('Y-m-d H:i:s'); //ues current time for the calcs
	}
	if( empty( $date2 )) {
		$date2 = date('Y-m-d H:i:s'); //ues current time for the calcs
	}
	// Get the current date
	//$current_date = date('Y-m-d H:i:s');
	
	// Extract from $current_date
	$current_year = substr($date2,0,4);
	$current_month = substr($date2,5,2);
	$current_day = substr($date2,8,2);
	
	// Extract from $data_ref
	$ref_year = substr($date1,0,4);
	$ref_month = substr($date1,5,2);
	$ref_day = substr($date1,8,2);

	// create a string yyyymmdd 20071021
	$tempMaxDate = $current_year . $current_month . $current_day;
	$tempDataRef = $ref_year . $ref_month . $ref_day;
	
	$tempDifference = $tempMaxDate-$tempDataRef;
	// If the difference is GT 10 days show the date
	if($tempDifference >= 10){
		echo $data_ref;
	} else {
		// Extract $current_date H:m:ss
		$current_hour = substr($date2,11,2);
		$current_min = substr($date2,14,2);
		$current_seconds = substr($date2,17,2);
		
		// Extract $data_ref Date H:m:ss
		$ref_hour = substr($date1,11,2);
		$ref_min = substr($date1,14,2);
		$ref_seconds = substr($date1,17,2);

		$dDf = $current_day - $ref_day;
		$hDf = $current_hour-$ref_hour;
		$mDf = $current_min-$ref_min;
		$sDf = $current_seconds-$ref_seconds;
		
		// Show time difference ex: 2 min 54 sec ago.
		$result = "";
		
//		var_dump( $dDf, $hDf, $mDf, $sDf );
		if($dDf <= 1 ) {
			if( $dDf == 1 && $hDf < 0 ) {
				$hDf = $hDf + 24;
				if($mDf < 0){
					$mDf = 60 + $mDf;
					$hDf = $hDf - 1;
				}
				$result .= $hDf. ' hr ' . $mDf . ' min to go';
			} elseif( $dDf == 0 ) {
				if($hDf > 0) {
					if($mDf < 0){
						$mDf = 60 + $mDf;
						$hDf = $hDf - 1;
						$result .= $mDf . ' min to go';
					} else {
						$result .= $hDf. ' hr ' . $mDf . ' min to go';
					}
				} else {
					if( $hDf == 0 ) {
						if($mDf>0){
							//make sure seconds are not negative
							if( $sDf<0 ) {
								$sDf = $sDf + 60;
							}
							$result .= $mDf . ' min ' . $sDf . ' sec to go';
						} else {
							if( $mDf == 0 ) {
								if( $sDf > 0 ) {
									$result .= $sDf . ' sec to go';
								} else {
									$result .= "Overdue";
								}
							} else {
								$result .= "Overdue";
							}								
						}
					} else {
						$result .= "Overdue";
					}
				}
			} else {
				$result .= "Overdue";
			}
		} else {
			$result .= $dDf . ' days to go';
		}
		
		if($assign != null) {
	      $smarty->assign($assign,$result);
	   } else {
	      return $result;
	   }
	}
}