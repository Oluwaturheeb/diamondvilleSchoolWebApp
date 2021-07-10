<?php

class Utils{
	public static function date ($c = false) {
		if ($c) return date('D, jS \of F Y', @strtotime($c));
		return date('D, jS \of F Y');
	}
	
	public static function time () {
		return date('h:ia');
	}
	
	public static function datetime ($time = false) {
		if ($time) {
			if (!is_numeric($time)) 
				$time = @strtotime($time);
				
			return date('j F Y h:ia', $time);
		} else {
			return self::date() .' '. self::time();
		}
	}

	/*

	this method generates meta keyword for seo
	and it accepts either string or array as args

	*/

	public static function tags ($str, $class = 'tag', $tag = true) {
		if ($str) {
			if (!is_array($str))
				$str = explode(', ', $str);

			$ss = '';
			foreach ($str as $s) {
				$uc = ucfirst($s);;
				if ($tag)
					$ss .= "<div class='{$class}'>{$uc}</div>";
				else
					$ss .= "<span class='{$class}'>{$uc}</span>";
			}

			return $ss;
		}
		return false;
	}

	public static function meta (...$keys) {
		$meta = '';
		if (empty($keys)) {
			$keys = [['author' => 'Muhammad-Turheeb'], 'Tlight', 'Tlight php module', 'Tlight OOP & PDO', 'Tlight - Created by Muhammad-Turheeb'];
		}

		foreach ($keys as $key) {
			if (is_array($key)) {
				foreach ($key as $k => $v) {
					$k = ucfirst($k);
					$v = ucfirst($v);
					$meta .= "<meta name='$k' content='$v'>\n";
				}
			} else {
				$key = ucfirst($key);
				$meta .= "<meta name='keyword' content='$key'>\n";
			}
		}
		return $meta;
	}
	
    public static function time_to_ago ($time, $check = false){
		if ($check)
			$time = strtotime($time);
		$sec = time() - $time;
		$min = round($sec / 60);
		$hr = round($sec / 3600);
		$day = round($sec / 86400);
		$m = round($sec/ 2592000);

		if($min < 1){
			$time = 'now';
		}else if($min <= 59){
			$time = "{$min}mins ago";
		}else if($hr == 1){
			$time = '1hr ago';
		}else if($hr <= 23){
			$time = "{$hr}hrs ago";
		}else if($day == 1){
			$time = 'Yesterday';
		}else if($day <= 30){
			$time = "{$day}days ago";
		}elseif ($m <= 11) {
			$time = $m . 'mth ago';
		}elseif ($m >= 12){
			$time = date('D, j/n/Y', $time);
		}
		return $time;
	}
	
	public static function slug($str){
	    return strtolower(str_replace([',', '*', '_', '#', ' '], '-', $str));
	}
	
	public static function shortContent($str, $count = 10){
		$add = $count + 1;
		if(is_numeric($count)){
			if(str_word_count($str) > $count){
				$str = explode(' ', $str, $add);
				return implode(' ', array_slice($str, 0, -1)). '...';
			}else{
				$str = explode(' ', $str, $add);
				return implode(' ', array_slice($str, 0, -1));
			}
		}
	}
	
	public static function arr2str($arr, $sep = ', '){
		return @implode($sep, $arr);
	}
	
	public static function strToArray($arr, $sep = ', ') {
		return explode($sep, $arr);
	}
	
	/* 
	* this method is for searching in a multi dimensional array
	*/
	
	public static function mArraySearch ($str, $arr, $where = true) {
		if(is_array($arr[0])) {
			for($i = 0; $i < count($arr); $i++) {
				if ($where) {
					if(array_key_exists($str, $arr[$i])) {
						return $arr[$i];
					}
				} else {
					if(array_key_exists($str, $arr[$i])) {
						return $arr[$i];
					}
				}
			}
		}
	}

	public static function arr_flat ($args, $fn = 'value') {
		$a = [];

		switch ($fn) {
			case 'value':
				for ($i = 0; $i < count($args); $i++) {
					foreach ($args[$i] as $key => $value) {
						array_push($a, $value);
					}
				}
				break;
			case 'key':
				for ($i = 0; $i < count($args); $i++) {
					foreach ($args[$i] as $key => $value) {
						array_push($a, $key);
					}
				}
				break;
			case 'all':
				$k = []; $val = [];
				for ($i = 0, $j = 1; $i < count($args); $i++, $j++) {
					foreach ($args[$i] as $key => $value) {
						array_push($k, $key);
						array_push($val, $value);
					}
				}
				array_push($a, $k, $val);
				$to = [];

				for ($i = 0; $i < count($a); $i++) {
					foreach ($a[$i] as $key => $value) {
						array_push($to, $value);
					}
				}
				$a = $to;
				break;
		}
		
		return $a;
	}
	
	/**
	 * @param string | array | object
	 * @return json string
	 *  */
	public static function json($str){
		return json_encode($str);
	}

	/**
	 * @param array || object
	 * @return array || object */
	public static function djson($array, $opt = OBJ) {
		if ($opt == ARR) return (array) json_decode($array, 1);
		else return json_decode($array, false);
	}

	/**
	 * @param array || object
	 * @return object */
	public static function toObj($item) {
		if (!$item) return;
		if (is_string($item)) error('Utils error, Array is expected for toObj');
		return self::djson(self::json($item));
	}

	/**
	 * @param array || object
	 * @return array */
	public static function toArr($item) {
		if (!$item) return;

		return self::djson(self::json($item), ARR);
	}
	
	public static function gen() {
		if(NUM) return random_int(1, 999999999);
		else return uuid(64);
	}

	public static function getMediaType($file) {
		$file = mime_content_type($file);
		$img = array('image/pjpeg', 'image/jpeg', 'image/gif', 'image/bmp', 'image/png');
		$video = array('video/mpeg', 'video/mp4', 'video/quicktime', 'video/mpg', 'video/x-msvideo', 'video/x-ms-wmv', 'video/3ggp');
		$audio = array('audio/mid', 'audio/mp4', 'audio/mp3', 'audio/ogg', 'audio/wav', 'audio/3gpp', 'audio/mpeg');

		if (array_search($file, $img)) {
			return 'image';
		} elseif (array_search($file, $video)) {
			return 'video';
		} elseif (array_search($file, $audio)) {
			return 'audio';
		}
		  
		return false;
	}
	
	public static function collection ($arr, $str) {
		if ($str && count($arr)) {
			$col = [];
			foreach($arr as $key => $val) {
				$key = array_keys((array)$val);
				if (in_array($str, $key)) {
					$col[] = $val->$str;
				}
			}
			return $col;
		}
	}
	

	/*public static function content_html($text, $file){
		$check = stristr($text, 'upload_');

		if($check){
		    if(!is_array($file)){
		        $file = array($file);
		    }
			
			for($i = 0, $j = 1; $i < count($file); $i++, $j++){
				if(self::getMediaType($file[$i]) == 'video'){
					$text = str_ireplace("upload_$j", '<video class="img-fluid" controls><source src="'.$file[$i].'" type="video/mp4"/></video>', $text);
				}elseif(self::getMediaType($file[$i]) == 'audio'){
					$text = str_ireplace("upload_$j", '<audio class="img-fluid" controls><source src="'.$file[$i].'" type="audio/mp3"/></audio>', $text);
				}elseif(self::getMediaType($file[$i]) == 'image'){
					$text = str_ireplace("upload_$j", '<img class="img-fluid" src="'.$file[$i].'">', $text);
				}
				

				if($j == count($file)){
					return $text;
				}
			}
		}
		return $text;
	}*/
    
    public static function mediaHtml ($src) {
        if(self::getMediaType($src) == 'video'){
            $text = '<video class="img-fluid" controls><source src="' . $src . '" type="video/mp4"/></video>';
        }elseif(self::getMediaType($src) == 'audio'){
            $text = '<audio class="img-fluid" controls><source src="' . $src . '" type="audio/mp3"/></audio>';
        }elseif(self::getMediaType($src) == 'image'){
            $text ='<img class="img-fluid" src="' . $src.'">';
        }
        return $text;
    }
    
	public static function age($time){
		$mydate = strtotime($time);
		$year = 60 * 60 * 24 * 365;
		$cal = time() - $mydate;
		$age = floor($cal / $year);
		return $age;
 }
 
	public static function r_copy($src,$dst) { 
		$dir = opendir($src); 
			// suppress error if dst is already created
		if (!is_dir($dst)) mkdir($dst);
		
		while (false !== ($file = readdir($dir))) {
			if (($file != '.') && ($file != '..')) {
				if (is_dir($src . '/' . $file)) self::r_copy($src . '/' . $file, $dst . '/' . $file);
				else copy($src . '/' . $file,$dst . '/' . $file);
			}
		}
		closedir($dir); 
	}
	
	public static function r_delete ($folder) {
		$dir = opendir($folder);
		while (false !== ($file = readdir($dir))) {
			if (($file != '.') && ($file != '..')) {
				$file = $folder . $file;

				if (is_dir($file)) {
					if (!rmdir($file))
						self::r_delete($file);
				} else unlink($file);
			}
		}
		closedir($dir);
	}

	public static function haversineDistance ($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371000) {
		// convert from degrees to radians
		$latFrom = deg2rad($latitudeFrom);
		$lonFrom = deg2rad($longitudeFrom);
		$latTo = deg2rad($latitudeTo);
		$lonTo = deg2rad($longitudeTo);
	  
		$latDelta = $latTo - $latFrom;
		$lonDelta = $lonTo - $lonFrom;
	  
		$angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
		  cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
		return $angle * $earthRadius;
	  }

	public static function vincentyDistance ($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo) {
		$earthRadius = 6371000;
		// convert from degrees to radians
		$latFrom = deg2rad($latitudeFrom);
		$lonFrom = deg2rad($longitudeFrom);
		$latTo = deg2rad($latitudeTo);
		$lonTo = deg2rad($longitudeTo);
	  
		$lonDelta = $lonTo - $lonFrom;
		$a = pow(cos($latTo) * sin($lonDelta), 2) +
		  pow(cos($latFrom) * sin($latTo) - sin($latFrom) * cos($latTo) * cos($lonDelta), 2);
		$b = sin($latFrom) * sin($latTo) + cos($latFrom) * cos($latTo) * cos($lonDelta);
	  
		$angle = atan2(sqrt($a), $b);
		return $angle * $earthRadius;
	}

	/* public static function calculateDistance ($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo) {
		$theta = $longitudeFrom - $longitudeTo;
		$dist = sin(deg2rad($latitudeFrom)) * sin(deg2rad($latitudeTo)) +  cos(deg2rad($latitudeFrom)) * cos(deg2rad($latitudeTo)) * cos(deg2rad($theta));
		$dist = acos($dist);
		$dist = rad2deg($dist);
		$miles = $dist * 60 * 1.1515;

		$distance = ($miles * 1.609344);
		return $distance;
	} */

	public static function calculateDistance ($latitudeOne='', $longitudeOne='', $latitudeTwo='', $longitudeTwo='',$distanceUnit ='',$round=false,$decimalPoints='') {
        if (!$decimalPoints)   {
            $decimalPoints = '3';
        }

        if (!$distanceUnit) {
            $distanceUnit = 'KM';
        }

        $distanceUnit = strtolower($distanceUnit);
        $pointDifference = $longitudeOne - $longitudeTwo;
        $toSin = (sin(deg2rad($latitudeOne)) * sin(deg2rad($latitudeTwo))) + (cos(deg2rad($latitudeOne)) * cos(deg2rad($latitudeTwo)) * cos(deg2rad($pointDifference)));
        $toAcos = acos($toSin);
        $toRad2Deg = rad2deg($toAcos);

        $toMiles  =  $toRad2Deg * 60 * 1.1515;
        $toKilometers = $toMiles * 1.609344;
        $toNauticalMiles = $toMiles * 0.8684;
        $toMeters = $toKilometers * 1000;
        $toFeets = $toMiles * 5280;
        $toYards = $toFeets / 3;

		switch (strtoupper($distanceUnit)) {
			case 'ML'://miles
					$toMiles  = ($round == true ? round($toMiles) : round($toMiles, $decimalPoints));
					return $toMiles;
				break;
			case 'KM'://Kilometers
				$toKilometers  = ($round == true ? round($toKilometers) : round($toKilometers, $decimalPoints));
				return $toKilometers;
				break;
			case 'MT'://Meters
				$toMeters  = ($round == true ? round($toMeters) : round($toMeters, $decimalPoints));
				return $toMeters;
				break;
			case 'FT'://feets
				$toFeets  = ($round == true ? round($toFeets) : round($toFeets, $decimalPoints));
				return $toFeets;
				break;
			case 'YD'://yards
				$toYards  = ($round == true ? round($toYards) : round($toYards, $decimalPoints));
				return $toYards;
				break;
			case 'NM'://Nautical miles
				$toNauticalMiles  = ($round == true ? round($toNauticalMiles) : round($toNauticalMiles, $decimalPoints));
				return $toNauticalMiles;
				break;
		}
    }
} 