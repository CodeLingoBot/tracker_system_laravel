<?php

class Socket{
	public static function loop($address, $port, $function){
        while(true){
            sleep(5);
            try
            {
                if (($socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP)) === false) {
                    log_info("socket","socket_create() failed: reason: " . socket_strerror(socket_last_error()));
                    continue;
                }

                if (socket_bind($socket, $address, $port) === false) {
                    log_info("socket","socket_bind() failed: reason: " . socket_strerror(socket_last_error($socket)));
                    continue;
                }

                if (socket_listen($socket, 5) === false) {
                    log_info("socket","socket_listen() failed: reason: " . socket_strerror(socket_last_error($socket)));
                    continue;
                }

                do {
                    log_info("socket","waiting");
                    if (($msgSock = socket_accept($socket)) === false) {
                        log_info("socket","socket_accept() failed: reason: " . socket_strerror(socket_last_error($socket)));
                        break;
                    }
                    while(socket_recv($msgSock, $buffer, 2048, 0x40) !== 0) {
                        $function($buffer, $msgSock);
                    }
                    log_info("socket","msgSock closed");
                    socket_close($msgSock);
                } while (true);
                log_info("socket","Closed");
                socket_close($socket);
            } catch (Exception $exception) {
                log_info("socket","Exception: ". $exception->getMessage());
            }
        }
	}
}