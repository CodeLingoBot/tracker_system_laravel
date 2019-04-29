<?php

class Hex{

	public $hex;
	
	public function __construct($hex, $isString = false)
	{
		if ($isString){
			$this->hex = '';
			for ($i = 0; $i < strlen($hex); $i++)
				$this->hex .= substr('0' . dechex(ord($hex[$i])), -2);
			$this->hex = strToUpper($this->hex);
		} else {
			$this->hex = $hex;
		}
	}

	public function __toString(){
		$string = '';
		for ($i = 0; $i < strlen($this->hex) - 1; $i += 2) {
			$string .= chr(hexdec($this->hex[$i] . $this->hex[$i + 1]));
		}
		return $string;
	}

	public static function dump($data)
	{
		$to = '';
		$from = '';
		$width = 50; # number of bytes per line
		$pad = '.'; # padding for non-visible characters
		if ($from === '') {
			for ($i = 0; $i <= 0xFF; $i++) {
				$from .= chr($i);
				$to .= ($i >= 0x20 && $i <= 0x7E) ? chr($i) : $pad;
			}
		}
		$hex = str_split(bin2hex($data), $width * 2);
		$offset = 0;
		$retorno = '';
		foreach ($hex as $i => $line) {
			$retorno .= implode(' ', str_split($line, 2));
			$offset += $width;
		}
		return $retorno;
	}
}