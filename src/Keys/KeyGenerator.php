<?php
declare(strict_types=1);

namespace ThiagoCamelo\Bitkeys\Keys;

use phpseclib3\Crypt\EC;
use phpseclib3\Crypt\EC\PrivateKey;
use ThiagoCamelo\Bitkeys\KeyPair;

class KeyGenerator
{
    private PrivateKey $privateKey;

    private function __construct()
    {
    }

    public static function generate(): KeyPair
    {
        $privateKey = EC::createKey('secp256k1');
        return new KeyPair($privateKey);
    }

    public function getPublicKey(): string
    {
        return $this->privateKey->getPublicKey()->toString('PKCS8');
    }

}
