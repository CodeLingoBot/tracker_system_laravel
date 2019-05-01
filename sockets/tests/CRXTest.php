<?php

declare(strict_types=1);

include 'autoload.php';

use sockets\CRX;
use PHPUnit\Framework\TestCase;

final class CRXTest extends TestCase
{
    public function testProtocol01(): void
    {
        $crx = new CRX();
        $this->assertEquals(
            buffer2hex($crx->protocol01(explode(' ', '78 78 0d 01 03 58 73 50 71 52 47 62 00 25 f8 be 0d 0a'))),
            "78 78 05 01 00 25 c1 2c 0d 0a"
        );
        $this->assertEquals(
            $crx->imei,
            "358735071524762"
        );
    }
}