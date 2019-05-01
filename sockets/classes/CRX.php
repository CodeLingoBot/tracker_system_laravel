<?php
namespace sockets;

class CRX{

    public $imei;
    private $config;

    public function __construct(){
        $this->config = include 'config/crx1.php';
    }

    public function protocol01($hexArray){
        $this->imei = '';
        for($i=4; $i<12; $i++){
            $this->imei = $this->imei.$hexArray[$i];
        }
        $this->imei = substr($this->imei, 1, 15);
        $commandArr = array();
        $command = '78 78 05 01 '.strtoupper($hexArray[12]).' '.strtoupper($hexArray[13]);
        $newString = chr(0x05).chr(0x01).$hexArray[12].$hexArray[13];
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

    private function getCrc16($pData, $nLength) {
        $fcs = 0xffff;
        $i = 0;
        while($nLength>0){
            $fcs = ($fcs >> 8) ^  $this->config['crc16'][($fcs ^ ord($pData{$i})) & 0xff];
            $nLength--;
            $i++;
        }
        return ~$fcs & 0xffff;
    }
}