<?php

class Point{


	private $latitude;
	private $longitude;
	
	public function __construct($latitude, $longitude)
	{
		$this->latitude = $latitude;
		$this->longitude = $longitude;
	}

	public function distance(Point $point, $miles = false){
		$pi80 = M_PI / 180;
		$lat1 = $this->latitude * $pi80;
		$lng1 = $this->longitude * $pi80;
		$lat2 = $point->latitude * $pi80;
		$lng2 = $point->longitude * $pi80;

		$r = 6372.797; // mean radius of Earth in km
		$dlat = $lat2 - $lat1;
		$dlng = $lng2 - $lng1;
		$a = sin($dlat / 2) * sin($dlat / 2) + cos($lat1) * cos($lat2) * sin($dlng / 2) * sin($dlng / 2);
		$c = 2 * atan2(sqrt($a), sqrt(1 - $a));
		$km = $r * $c;

		return ($miles ? ($km * 0.621371192) : $km);
	}
}