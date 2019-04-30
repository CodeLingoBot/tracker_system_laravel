<?php

function envia_comando($imei){
      $cnx = mysql_connect("cloudservice.cgejdsdl842e.sa-east-1.rds.amazonaws.com", "gpstracker", "d1$1793689")
      or die("Could not connect: " . mysql_error());
      mysql_select_db('tracker', $cnx);
      $res = mysql_query("SELECT c.command FROM command c WHERE c.imei = '$imei' ORDER BY date DESC LIMIT 1");
      while ($data = mysql_fetch_assoc($res)) {
            $send_cmd = $data['command'];
            socket_send($socket, $send_cmd, strlen($send_cmd), 0);
      }
      mysql_query("DELETE FROM command WHERE imei = $imei");
      mysql_query("insert into teste(id,string) values(null, '$send_cmd')", $cnx);
      mysql_close($cnx);
      printLog($fh, "Comandos do arquivo apagado: " . $send_cmd . " imei: " . $imei);
}

function gprsToGps($cord, $hemisphere)
{
      $novaCord = 0;
      strlen($cord) == 9 && $cord = '0' . $cord;
      $g = substr($cord, 0, 3);
      $d = substr($cord, 3);
      $novaCord = $g + ($d / 60);
      if ($hemisphere == "S")
            $novaCord = $novaCord * -1;
      if ($hemisphere == "W")
            $novaCord = $novaCord * -1;
      return $novaCord;
}

function hex_dump($data, $newline="\n")
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
    foreach ($hex as $i => $line)
    {
      lof_info(sprintf('%6X',$offset).' : '.implode(' ', str_split($line,2)) . ' [' . $chars[$i] . ']');
      $offset += $width;
    }
}