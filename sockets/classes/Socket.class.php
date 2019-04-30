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
                    if (($msgsock = socket_accept($sock)) === false) {
                        log_info("app_crx1","socket_accept() failed: reason: " . socket_strerror(socket_last_error($sock)));
                        break;
                    }
                    do {
                        if (false === ($buffer = socket_read($msgsock))) {
                            log_info("app_crx1","socket_read() failed: reason: " . socket_strerror(socket_last_error($msgsock)));
                            break 2;
                        }
                        $function($buffer);
                    } while (true);
                    socket_close($msgsock);
                } while (true);
                socket_close($sock);
            } catch (Exception $exception) {
                log_info("app_crx1","Exception: ". $exception->getMessage());
            }
        }
	}
}