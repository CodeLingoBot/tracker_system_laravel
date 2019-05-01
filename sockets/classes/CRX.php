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
        $dataPosition = hexdec($hexArray[4]).'-'.hexdec($hexArray[5]).'-'.hexdec($hexArray[6]).' '.hexdec($hexArray[7]).':'.hexdec($hexArray[8]).':'.hexdec($hexArray[9]);
        $gpsQuantity = $hexArray[10];
        $lengthGps = hexdec(substr($gpsQuantity,0,1));
        $satellitesGps = hexdec(substr($gpsQuantity,1,1));
        $latitudeHemisphere = '';
        $longitudeHemisphere = '';
        $speed = hexdec($hexArray[19]);
        if(isset($hexArray[20]) && isset($hexArray[21])){
            $course = decbin(hexdec($hexArray[20]));
            while(strlen($course) < 8)
                $course = '0'.$course;
            $status = decbin(hexdec($hexArray[21]));
            while(strlen($status) < 8) $status = '0'.$status;
                $courseStatus = $course.$status;
            $gpsRealTime = substr($courseStatus, 2,1) == '0' ? 'F':'D';
            $gpsPosition = substr($courseStatus, 3,1) == '0' ? 'F':'L';
            $gpsPosition == 'F' ? 'S' : 'N';
            $latitudeHemisphere = substr($courseStatus, 5,1) == '0' ? 'S' : 'N';
            $longitudeHemisphere = substr($courseStatus, 4,1) == '0' ? 'E' : 'W';
        }
        $latHex = hexdec($hexArray[11].$hexArray[12].$hexArray[13].$hexArray[14]);
        $lonHex = hexdec($hexArray[15].$hexArray[16].$hexArray[17].$hexArray[18]);
        $latitudeDecimalDegrees = ($latHex*90)/162000000;
        $longitudeDecimalDegrees = ($lonHex*180)/324000000;
        if($latitudeHemisphere == 'S')
            $latitudeDecimalDegrees = $latitudeDecimalDegrees*-1;
        if($longitudeHemisphere == 'W')
            $longitudeDecimalDegrees = $longitudeDecimalDegrees*-1;
        $dados = array($gpsPosition, $latitudeDecimalDegrees, $longitudeDecimalDegrees, $latitudeHemisphere, $longitudeHemisphere, $speed, $dataPosition, 'tracker', '', 'S', $gpsRealTime);
        log_info("app_crx1", $dados);
        return false;
    }

    public function protocol13($buffer, $hexArray){
        $terminalInformation = decbin(hexdec($hexArray[4]));
        while(strlen($terminalInformation) < 8)
            $terminalInformation = '0'.$terminalInformation;
        $gasOil = substr($terminalInformation,0,1) == '0' ? 'S' : 'N';
        $gpsTrack = substr($terminalInformation,1,1) == '1' ? 'S' : 'N';
        $alarm = '';
        switch(substr($terminalInformation, 2, 3)){
            case '100': $alarm = 'help me'; break;
            case '011': $alarm = 'low battery'; break;
            case '010': $alarm = 'dt'; break;
            case '001': $alarm = 'move'; break;
            case '000': $alarm = 'tracker'; break;
        }
        $ativo = substr($terminalInformation,7,1) == '1' ? 'S' : 'S';
        $charge = substr($terminalInformation,5,1) == '1' ? 'S' : 'N';
        $acc = substr($terminalInformation,6,1) == '1' ? 'S' : 'N';
        $defense = substr($terminalInformation,7,1) == '1' ? 'S' : 'N';
        $voltageLevel = hexdec($hexArray[5]);
        $gsmSignal = hexdec($hexArray[6]);
        $alarmLanguage = hexdec($hexArray[7]);
        switch($alarmLanguage){
            case 0: $alarm = 'tracker'; break;
            case 1: $alarm = 'help me'; break;
            case 2: $alarm = 'dt'; break;
            case 3: $alarm = 'move'; break;
            case 4: $alarm = 'stockade'; break;
            case 5: $alarm = 'stockade'; break;
        }
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