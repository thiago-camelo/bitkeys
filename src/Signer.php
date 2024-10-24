<?php
declare(strict_types=1);

namespace ThiagoCamelo\Bitkeys;

class Signer
{
    private KeyPair $keyPair;

    public function __construct(KeyPair $keyPair)
    {
        $this->keyPair = $keyPair;
    }

    public function sign(string $message)
    {
        return $this->keyPair->getPrivateKey()->sign($message);
    }

    public function verify(string $message, $signature)
    {
        return $this->keyPair->getPublicKey()->verify($message, $signature);
    }

}
