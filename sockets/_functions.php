<?php
function buffer2hex($data)
{
	static $from = '';
	static $to = '';

	static $width = 16; # number of bytes per line

	static $pad = '.'; # padding for non-visible characters

	if ($from==='')
	{
		for ($i=0; $i<=0xFF; $i++)
		{
		$from .= chr($i);
		$to .= ($i >= 0x20 && $i <= 0x7E) ? chr($i) : $pad;
		}
	}

	$hex = str_split(bin2hex($data), $width*2);
	$chars = str_split(strtr($data, $from, $to), $width);

	$offset = 0;
	$retorno = "";
	foreach ($hex as $i => $line)
	{
		$implosion = implode(' ', str_split($line,2));
		$retorno .= $implosion;
		log_info("app_crx1", sprintf('%6X', $offset).' : ' . $implosion . ' [' . $chars[$i] . ']');
		$offset += $width;
	}
	return $implosion;
}