<?php
function buffer2hex($data)
{
	$from = '';
	$to = '';
	$width = 50;
	$pad = '.';
	if ($from ==='')
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
	$retorno = '';
	foreach ($hex as $i => $line)
	{
		$retorno .= implode(' ', str_split($line,2));
		$offset += $width;
	}
	sprintf($retorno);
	return $retorno;
}