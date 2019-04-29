<?php

class Serial{
	

	public static function set($imei, $serial){
		$con = mysql_connect("cloudservice.cgejdsdl842e.sa-east-1.rds.amazonaws.com", "gpstracker", "d1$1793689");
		if ($con !== false) {
			mysql_select_db('tracker', $con);

			mysql_query("UPDATE bem SET serial_tracker = '$serial' WHERE imei = '$imei'", $con);

			mysql_close($con);
		} else {
			echo "Erro: " . mysql_error($con);
		}
	}

	public static function get($imei){
		$con = mysql_connect("cloudservice.cgejdsdl842e.sa-east-1.rds.amazonaws.com", "gpstracker", "d1$1793689");
		$serial = '';
		if ($con !== false) {
			mysql_select_db('tracker', $con);

			$res = mysql_query("select serial_tracker from bem where imei = '$imei'", $con);
			if ($res !== false) {
				$dataRes = mysql_fetch_assoc($res);
				$serial = $dataRes['serial_tracker'];
			}
			mysql_close($con);
		}
		return $serial;
	}

	public static function command($send_cmd, $conn_imei){
		$sizeData = 0;
		$serial = self::get($conn_imei);

		$serial = str_replace(' ', '', $serial);

		$decSerial = hexdec($serial);

		$decSerial = $decSerial + 1;

		if ($decSerial > 65535) {
			$decSerial = 1;
		}

		$serial = dechex($decSerial);

		while (strlen($serial) < 4) $serial = '0' . $serial;

		$serial = substr($serial, 0, 2) . ' ' . substr($serial, 2, 2);

		$sizeData = dechex(11 + strlen($send_cmd));

		while (strlen($sizeData) < 2) $sizeData = '0' . $sizeData;

		$lengthCommand = dechex(4 + strlen($send_cmd));

		while (strlen($lengthCommand) < 2) $lengthCommand = '0' . $lengthCommand;

		$temp = $sizeData . ' 80 ' . $lengthCommand . ' 00 00 00 00 ' . $send_cmd . ' ' . $serial;

		$sendCommands = array();

		$crc = crcx25($temp);

		$crc = str_replace('ffff', '', dechex($crc));

		$crc = strtoupper(substr($crc, 0, 2)) . ' ' . strtoupper(substr($crc, 2, 2));

		$sendcmd = '78 78 ' . $temp . ' ' . $crc . ' 0D 0A';

		$sendCommands = explode(' ', $sendcmd);

		$sendcmd = '';
		for ($i = 0; $i < count($sendCommands); $i++) {
			if ($i < 9 || $i >= 10) {
				$sendcmd .= chr(hexdec(trim($sendCommands[$i])));
			} else {
				$sendcmd .= trim($sendCommands[$i]);
			}
		}

		return $sendcmd;
	}
}