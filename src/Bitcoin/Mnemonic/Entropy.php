<?php
declare(strict_types=1);

namespace ThiagoCamelo\Bitkeys\Bitcoin\Mnemonic;

use ThiagoCamelo\Bitkeys\Bitcoin\Mnemonic\Contracts\EntropyInterface;

class Entropy implements EntropyInterface
{
    private string $entropy;

    public function __construct()
    {
        $this->entropy = random_bytes(16);
    }

    public function toHex(): string
    {
        return bin2hex($this->entropy);
    }

    private function getChecksum(): string
    {
        $hash = hash('sha256', $this->entropy);

        return substr($hash, 0, 1);
    }

    public function getEntropyWithChecksum(): string
    {
        $checksum = $this->getChecksum();

        $entropyBits = str_pad(gmp_strval(gmp_init($this->toHex(), 16), 2), 128, '0', STR_PAD_LEFT); // 128 bits da entropia
        $checksumBits = str_pad(gmp_strval(gmp_init($checksum, 16), 2), 4, '0', STR_PAD_LEFT); // 4 bits do checksum

        return $entropyBits . $checksumBits;
    }

}
