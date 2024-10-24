<?php
declare(strict_types=1);

namespace ThiagoCamelo\Bitkeys;

use phpseclib3\Crypt\EC\PrivateKey;

class KeyPair
{
    public function __construct(
        private PrivateKey $privateKey
    ) {
    }

    public function getPrivateKey(): PrivateKey
    {
        return $this->privateKey;
    }

    public function getPrivatePem(): string
    {
        return $this->privateKey->toString('PKCS8');
    }

    public function getPublicKey(): mixed
    {
        return $this->privateKey->getPublicKey();
    }

}
