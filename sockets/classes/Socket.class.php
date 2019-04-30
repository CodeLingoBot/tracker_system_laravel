<?php

class Socket{
	public static function loop($address, $port, $function){
        while(true){
            try
            {
                if (($sock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP)) === false) {
                    log_info("app_crx1","socket_create() failed: reason: " . socket_strerror(socket_last_error()));
                }

                if (socket_bind($sock, $address, $port) === false) {
                    log_info("app_crx1","socket_bind() failed: reason: " . socket_strerror(socket_last_error($sock)));
                }

                if (socket_listen($sock, 5) === false) {
                    log_info("app_crx1","socket_listen() failed: reason: " . socket_strerror(socket_last_error($sock)));
                }

                do {
                    log_info("app_crx1","waiting");
                    if (($msgSock = socket_accept($sock)) === false) {
                        log_info("app_crx1","socket_accept() failed: reason: " . socket_strerror(socket_last_error($sock)));
                        break;
                    }
                    while(socket_recv($msgSock, $buffer, 2048, 0x40) !== 0) {
                        $function($buffer);
		                sleep(1);
                    }
                    socket_close($msgSock);
                } while (true);
                socket_close($sock);
            } catch (Exception $exception) {
                log_info("app_crx1","Exception: ". $exception->getMessage());
            }
        }
	}
}