<?php

declare(strict_types=1);

namespace ThiagoCamelo\Bitkeys\Bitcoin\Mnemonic\Contracts;

interface EntropyInterface
{
    public function toHex(): string;
    public function getEntropyWithChecksum(): string;
}
