<?php

class Socket{
	public static function loop($address, $port, $function){
        while(true){
            try
            {
                if (($socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP)) === false) {
                    log_info("app_crx1","socket_create() failed: reason: " . socket_strerror(socket_last_error()));
                    continue;
                }

                if (socket_bind($socket, $address, $port) === false) {
                    log_info("app_crx1","socket_bind() failed: reason: " . socket_strerror(socket_last_error($socket)));
                    continue;
                }

                if (socket_listen($socket, 5) === false) {
                    log_info("app_crx1","socket_listen() failed: reason: " . socket_strerror(socket_last_error($socket)));
                    continue;
                }

                do {
                    log_info("app_crx1","waiting");
                    if (($msgSock = socket_accept($socket)) === false) {
                        log_info("app_crx1","socket_accept() failed: reason: " . socket_strerror(socket_last_error($socket)));
                        break;
                    }
                    while(socket_recv($msgSock, $buffer, 2048, 0x40) !== 0) {
                        $function($buffer, $msgSock);
                    }
                    socket_close($msgSock);
                } while (true);
                socket_close($socket);
            } catch (Exception $exception) {
                log_info("app_crx1","Exception: ". $exception->getMessage());
            }
            sleep(5);
        }
	}
}