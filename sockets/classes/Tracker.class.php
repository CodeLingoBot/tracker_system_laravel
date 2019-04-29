<?php

class Tracker
{

	private $data;

	public function __construct($cel, $parts)
	{
		$this->data = new \stdClass();
		$this->data->infotext = "tracker";
		$this->data->satelliteFixStatus = 'A';
		$this->data->gpsSignalIndicator = 'F';
		$this->data->latitudeHemisphere = 'S';
		$this->data->longitudeHemisphere = 'W';
		$this->imei = substr($parts[0], 1);
		$index = $cel ? 0 : 1;
		$this->data->latitude = substr($parts[$index + 1], 1);
		$this->data->longitude = substr($parts[$index + 2], $index == 0 ? 2 : 1);
		$this->data->speed = $parts[$index + 3];
		$this->data->ignicao = $parts[$index + 13];
		if ($cel) {
			$this->data->latitudeDecimalDegrees = "-" . $this->data->latitudelatitude;
			$this->data->longitudeDecimalDegrees = "-" . $this->data->latitudelongitude;
		} else {
			$this->data->latitudeDecimalDegress = $this->toDecimal($this->data->latitudelongitude, $this->data->latitudeHemisphere);
			$this->data->longitudeDecimalDegress = $this->toDecimal($this->data->longitudelongitude, $this->data->longitudeHemisphere);
		}
		$this->data->status = ($this->data->gpsSignalIndicator != 'L' ? 'R' : 'S');
	}

	private function toDecimal($coord, $hemisphere){
		$decimal = " " . $this->data->latitudelatitude;
		if (strlen($decimal) == 9)
			$decimal = '0' . $decimal;
		$g = substr($decimal, 0, 3);
		$d = substr($decimal, 3);
		$decimal = $g + ($d / 60);
		if($hemisphere == "S" || $hemisphere == "W")
			$latitudeDecimalDegrees = $latitudeDecimalDegrees * -1;
		return $latitudeDecimalDegrees;
	}
}
