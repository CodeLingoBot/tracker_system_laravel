<?php
class CRX{

    public $imei;
    private static $config;

    public function protocol01($buffer, $hexArray){
        $this->imei = '';
        for($i=4; $i<12; $i++){
            $this->imei = $this->imei.$hexArray[$i];
        }
        $this->imei = substr($this->imei, 1, 15);
        return $this->command(
            '78 78 05 01 '.strtoupper($hexArray[12]).' '.strtoupper($hexArray[13]),
            0x01,
            $buffer[12].$buffer[13]
        );
    }

    private function command($command, $hex, $bufferConcat){
        $newString = chr(0x05).chr($hex).$bufferConcat;
        $crc16 = $this->getCrc16($newString, strlen($newString));
        $crc16h = floor($crc16/256);
        $crc16l = $crc16 - $crc16h*256;
        $crc = dechex($crc16h).' '.dechex($crc16l);
        $command = $command. ' ' . $crc . ' 0D 0A';
        $commandArr = explode(' ', $command);
        $command = '';
        for($i=0; $i<count($commandArr); $i++){
            $command .= chr(hexdec(trim($commandArr[$i])));
        }
        return $command;
    }

    public function protocol12($buffer, $hexArray){
        $gpsQuantity = $hexArray[10];
        $latitudeHemisphere = NULL;
        $longitudeHemisphere = NULL;
        if(isset($hexArray[20]) && isset($hexArray[21])){
            $course = decbin(hexdec($hexArray[20]));
            while(strlen($course) < 8)
                $course = '0'.$course;
            $status = decbin(hexdec($hexArray[21]));
            while(strlen($status) < 8) $status = '0'.$status;
                $courseStatus = $course.$status;
            $gpsRealTime = substr($courseStatus, 2,1) == '0' ? 'F':'D';
            $gpsPosition = substr($courseStatus, 3,1) == '0' ? 'S':'N';
            $latitudeHemisphere = substr($courseStatus, 5, 1) == '0' ? 'S' : 'N';
            $longitudeHemisphere = substr($courseStatus, 4, 1) == '0' ? 'E' : 'W';
        }
        $latHex = hexdec($hexArray[11].$hexArray[12].$hexArray[13].$hexArray[14]);
        $lonHex = hexdec($hexArray[15].$hexArray[16].$hexArray[17].$hexArray[18]);
        $latitudeDecimalDegrees = ($latHex*90)/162000000;
        $longitudeDecimalDegrees = ($lonHex*180)/324000000;
        if($latitudeHemisphere == 'S')
            $latitudeDecimalDegrees = $latitudeDecimalDegrees*-1;
        if($longitudeHemisphere == 'W')
            $longitudeDecimalDegrees = $longitudeDecimalDegrees*-1;
        DB::insert('location_information', [
                'data_position' => hexdec($hexArray[4]).'-'.hexdec($hexArray[5]).'-'.hexdec($hexArray[6]).' '.hexdec($hexArray[7]).':'.hexdec($hexArray[8]).':'.hexdec($hexArray[9]),
                'length_gps' => hexdec(substr($gpsQuantity,0,1)),
                'satelite_gps' => hexdec(substr($gpsQuantity,1,1)),
                'speed' => hexdec($hexArray[19]),
                'latitude_hemisphere' => $latitudeHemisphere,
                'longitude_hemisphere' => $longitudeHemisphere,
                'course' => $course,
                'status' => $status,
                'course_status' => $courseStatus,
                'gps_real_time' => $gpsRealTime,
                'latitude_decimal' => $latitudeDecimalDegrees,
                'longitude_decimal' => $longitudeDecimalDegrees,
                'imei' => $this->imei
            ]
        );
        return false;
    }

    public function protocol13($buffer, $hexArray){
        $terminalInformation = decbin(hexdec($hexArray[4]));
        while(strlen($terminalInformation) < 8)
            $terminalInformation = '0'.$terminalInformation;
        switch(substr($terminalInformation, 2, 3)){
            case '100': $alarmTerminal = 'help me'; break;
            case '011': $alarmTerminal = 'low battery'; break;
            case '010': $alarmTerminal = 'dt'; break;
            case '001': $alarmTerminal = 'move'; break;
            case '000': $alarmTerminal = 'tracker'; break;
            default: $alarmTerminal = null; break;
        };
        switch(hexdec($hexArray[7])){
            case 0: $alarmLanguage = 'tracker'; break;
            case 1: $alarmLanguage = 'help me'; break;
            case 2: $alarmLanguage = 'dt'; break;
            case 3: $alarmLanguage = 'move'; break;
            case 4: $alarmLanguage = 'stockade'; break;
            case 5: $alarmLanguage = 'stockade'; break;
            default: $alarmLanguage = null; break;
        }
        DB::insert('terminal_information',
            [
                'gas_oil' =>  substr($terminalInformation,0,1) == '0',
                'gps_track' => substr($terminalInformation,1,1) == '1',
                'active' => substr($terminalInformation,7,1) == '1',
                'charge' => substr($terminalInformation,5,1) == '1',
                'acc' => substr($terminalInformation,6,1) == '1',
                'defense' => substr($terminalInformation,7,1) == '1',
                'voltage' => hexdec($hexArray[5]),
                'gsm_signal' => hexdec($hexArray[6]),
                'alarm_terminal' => $alarmTerminal,
                'alarm_language' => $alarmLanguage,
                'imei' => $this->imei
            ]
        );
        $commandArr = array();
        if(strlen($hexArray[9]) == 4 && count($hexArray) == 10){
            $hexArray[9] = substr($terminalInformation,0,2);
            $hexArray[] = substr($terminalInformation,2,2);
        }
        return $this->command(
            '78 78 05 13 '.strtoupper($hexArray[9]).' '.strtoupper($hexArray[10]),
            0x13,
            $buffer[9].$buffer[10]
        );
    }

    public function protocol15($buffer, $hexArray){
        $message = '';
        for($i=9; $i<count($hexArray)-8; $i++){
            $message .= chr(hexdec($hexArray[$i]));
        }
        $alerta = '';
        if(strpos($message, 'Already') > -1){
            $alerta = 'Bloqueio já efetuado!';
        }
        if(strpos($message, 'DYD=Suc') > -1){
            $alerta = 'Bloqueio efetuado!';
        }
        if(strpos($message, 'HFYD=Su') > -1){
            $alerta = 'Desbloqueio efetuado!';
        }
        log_info("app_crx1", $alert);
        return false;
    }

    private function getCrc16($pData, $nLength) {
        $fcs = 0xffff;
        $i = 0;
        while($nLength>0){
            $fcs = ($fcs >> 8) ^ self::config('crc16')[($fcs ^ ord($pData{$i})) & 0xff];
            $nLength--;
            $i++;
        }
        return ~$fcs & 0xffff;
    }

    public static function config($key){
        if (empty(self::$config))
            self::$config = include 'config/crx1.php';
        return self::$config[$key];
    }
}