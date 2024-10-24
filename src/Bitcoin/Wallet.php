<?php
declare(strict_types=1);

namespace ThiagoCamelo\Bitkeys\Bitcoin;

use ThiagoCamelo\Bitkeys\KeyPair;

class Wallet
{
    private KeyPair $keyPair;

    public function __construct(KeyPair $keyPair)
    {
        $this->keyPair = $keyPair;
    }

    private function getCoordinates(): array
    {
        $publicKeyHex = bin2hex($this->keyPair->getPublicKey()->getEncodedCoordinates());

        $x = substr($publicKeyHex, 2, 64);
        $y = substr($publicKeyHex, 66, 64);

        return [$x, $y];
    }

    public function getCompressedPublicKey(): string
    {
        [$x, $y] = $this->getCoordinates();

        // Verificar se y é par ou ímpar para a chave comprimida
        $y_par = (hexdec($y[strlen($y) - 1]) % 2) === 0;

        // Chave pública comprimida
        $compressedPublicKey = ($y_par ? '02' : '03') . $x;

        return $compressedPublicKey;
    }

    public function getUncompressedPublicKey(): string
    {
        [$x, $y] = $this->getCoordinates();

        // Chave pública não comprimida
        $uncompressedPublicKey = '04' . $x . $y;

        return $uncompressedPublicKey;
    }

}
