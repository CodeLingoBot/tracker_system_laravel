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