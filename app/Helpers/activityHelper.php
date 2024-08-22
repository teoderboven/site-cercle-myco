<?php

/**
 * Format a DateTime object to display hours and minutes,
 * but omit minutes if they are zero.
 * 
 * @param DateTime $date The DateTime object to format.
 * @return string The formatted time as 'Hh' or 'HhMM'.
 */
if (!function_exists('displayHourTime')) {
	function displayHourTime(DateTime $date): string {
		$hours = $date->format('G');
		$minutes = $date->format('i');

		if($minutes === '00'){
			return $hours . 'h';
		}else{
			return $hours . 'h' . $minutes;
		}
	}
}

/**
 * Format an int that represents a duration (in minutes).
 * 
 * @param int $duration The duration in minutes to format.
 * @return string The formatted duration as 'Hh' or 'HhMM'.
 */
if (!function_exists('displayDuration')) {
	function displayDuration(int $duration): string{
		$hours = intdiv($duration, 60);
		$minutes = $duration%60;

		if($minutes){
			return $hours . 'h' . $minutes;
		}else{
			return $hours . 'h';
		}
	}
}

/**
 * Formats a phone number into a more readable format.
 * 
 * This function formats a phone number to ensure that the last six digits are grouped
 * in pairs. For Belgian numbers, the country code (+32) is replaced by a leading zero 
 * and is followed by a slash before the last six digits are formatted. For non-Belgian 
 * numbers, the country code is retained, and the format is adjusted accordingly.
 * 
 * @param string $phoneNumber The input phone number in international format.
 * @return string The formatted phone number.
 */
if (!function_exists('formatPhoneNumber')) {
	function formatPhoneNumber($phoneNumber) {
		// Remove all non-numeric characters except for the plus sign at the start
		$phoneNumber = preg_replace('/[^\d+]/', '', $phoneNumber);

		if (substr($phoneNumber, 0, 3) == '+32' || substr($phoneNumber, 0, 2) == '32') {
			//Belgian number -> replace country code by 0
			$phoneNumber = '0' . substr($phoneNumber, -9);
		}

		// Extract the last 6 digits for formatting
		$lastSixDigits = substr($phoneNumber, -6);
		$remainingPart = substr($phoneNumber, 0, -6);

		// Format the last six digits as xx.xx xx
		$formattedLastSix = preg_replace('/(\d{2})(\d{2})(\d{2})/', '$1.$2 $3', $lastSixDigits);

		return $remainingPart . '/' . $formattedLastSix;
	}
}

/**
 * Get the status of an activity based on its current state.
 *
 * @param object $activity The activity object containing details like isPassed, isOngoing, and daysUntilStart.
 * @return string The status of the activity as a string.
 */
if(!function_exists('getActivityStatus')){
	function getActivityStatus($activity): string{
		if($activity->cancelled){
			return '!! Sortie annulée !!';
		}
		if($activity->isPassed){
			return 'Cette sortie est passée';
		}
		if($activity->isOngoing){
			return 'Sortie en cours';
		}

		$daysUntilStart = $activity->daysUntilStart;
		if($daysUntilStart < 22){
			if($daysUntilStart === 0){
				return "Aujourd'hui!";
			}
			if($daysUntilStart === 1){
				return "Demain!";
			}
			if($daysUntilStart % 7 === 0){
				$weeks = $daysUntilStart / 7;
				return $weeks === 1 ? 'Dans une semaine' : "Dans $weeks semaines";
			}
			
			return "Dans $daysUntilStart jours";
		}

		if($activity->isNext){
			return 'Prochaine Sortie';
		}

		return '';
	}
}
