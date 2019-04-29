<?php

class CRC{

	public static function get16(){
		function GetCrc16($pData, $nLength)
		{
			$crctab16 = null;
			$fcs = 0xffff;
			$i = 0;
			while ($nLength > 0) {
				$fcs = ($fcs >> 8) ^ $crctab16[($fcs ^ ord($pData{
					$i})) & 0xff];
				$nLength--;
				$i++;
			}
			return ~$fcs & 0xffff;
		}
	}

	public static function get25($data){
		//i explode() $data and make $content array
		$content = explode(' ', $data);
		//i count() the array to get data length
		$len = count($content);
		$n = 0;

		$crc = 0xFFFF;
		while ($len > 0) {
			$crc ^= hexdec($content[$n]);
			for ($i = 0; $i < 8; $i++) {
				if ($crc & 1) $crc = ($crc >> 1) ^ 0x8408;
				else $crc >>= 1;
			}
			$n++;
			$len--;
		}

		return (~$crc);
	}
}