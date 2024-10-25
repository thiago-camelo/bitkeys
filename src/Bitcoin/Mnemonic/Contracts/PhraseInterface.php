<?php

declare(strict_types=1);

namespace ThiagoCamelo\Bitkeys\Bitcoin\Mnemonic\Contracts;

interface PhraseInterface
{
    public function getMnemonic(): string;
    public function getSeed(): string;
}
