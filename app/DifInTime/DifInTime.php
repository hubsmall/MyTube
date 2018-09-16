<?php

namespace App\DifInTime;


 class DifInTime  
{
    public static function calculateDiff($timeString){

    	$local_time = time();
		$offset = 3;
		$local_time += 3 * 3600;  // смещение по мосткве относителньо гринвича

		$timeStringUnix = strtotime($timeString);


		$dif = $local_time - $timeStringUnix;
		$my_time_string = '';
		if($dif < 60) {
			// но тут внутри надо проверть чтобы поставить падеж правильный
			if($dif % 10 === 1){
				$my_time_string = $dif . ' секунду назад';
			}
			else if($dif % 10 >= 2 && $dif % 10 <= 4){
				$my_time_string = $dif . ' секунды назад';
			}
			else if(($dif % 10 >= 5 && $dif % 10 <= 9) || $dif % 10 === 0){
				$my_time_string = $dif . ' секунд назад';
			}
			if($dif>=11 && $dif<=20) {
				$my_time_string = $dif . ' секунд назад';
			}   

		}
		else if($dif >= 60 && $dif < 3600) {
			// но тут внутри надо проверть чтобы поставить падеж правильный 
			//$my_time_string = round($dif/60) . ' минут назад';

			if(round($dif/60) % 10 === 1){
				$my_time_string = round($dif/60) . ' минуту назад';
			}
			else if(round($dif/60) % 10 >= 2 && round($dif/60) % 10 <= 4){
				$my_time_string = round($dif/60) . ' минуты назад';
			}
			else if((round($dif/60) % 10 >= 5 && round($dif/60) % 10 <= 9) || round($dif/60) % 10 === 0){
				$my_time_string = round($dif/60) . ' минут назад';
			}
			if((round($dif/60) >= 11 && round($dif/60) <= 20)){
				$my_time_string = round($dif/60) . ' минут назад';
			} 
		}
		else if($dif >= 3600 && $dif < 86400) {
			// но тут внутри надо проверть чтобы поставить падеж правильный 
			//$my_time_string = round($dif/60/60) . ' часов назад';

			if(round($dif/60/60) % 10 === 1){
				$my_time_string = round($dif/60/60) . ' час назад';
			}
			else if(round($dif/60/60) % 10 >= 2 && round($dif/60/60) % 10 <= 4){
				$my_time_string = round($dif/60/60) . ' часа назад';
			}
			else if((round($dif/60/60) % 10 >= 5 && round($dif/60/60) % 10 <= 9) || round($dif/60/60) % 10 === 0){
				$my_time_string = round($dif/60/60) . ' часов назад';
			}
			if((round($dif/60/60) >= 11 && round($dif/60/60)  <= 20)){
				$my_time_string = round($dif/60/60) . ' часов назад';
			} 
		}
		else if($dif >= 86400) {
			// но тут внутри надо проверть чтобы поставить падеж правильный 
			//$my_time_string = round($dif/60/60/24) . ' дней назад';
			if(round($dif/60/60/24) % 10 === 1){
				$my_time_string = round($dif/60/60/24) . ' день назад';
			}
			else if(round($dif/60/60/24) % 10 >= 2 && round($dif/60/60/24) % 10 <= 4){
				$my_time_string = round($dif/60/60/24) . ' дня назад';
			}
			else if((round($dif/60/60/24) % 10 >= 5 && round($dif/60/60/24) % 10 <= 9) || round($dif/60/60/24) % 10 === 0){
				$my_time_string = round($dif/60/60/24) . ' дней назад';
			}
			if((round($dif/60/60/24)  >= 11 && round($dif/60/60/24)  <= 20) ){
				$my_time_string = round($dif/60/60/24) . ' дней назад';
			}
		}
		return $my_time_string;
    }
}