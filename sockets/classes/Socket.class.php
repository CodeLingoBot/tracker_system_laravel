<?php

class Socket{
	public static function loop($address, $port, $function){
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
				if (false === ($buf = socket_read($msgsock, 2048, PHP_NORMAL_READ))) {
					log_info("app_crx1","socket_read() failed: reason: " . socket_strerror(socket_last_error($msgsock)));
					break 2;
				}
				$function($buf);
			} while (true);
			socket_close($msgsock);
		} while (true);
		socket_close($sock);
	}
}