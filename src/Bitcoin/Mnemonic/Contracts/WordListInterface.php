<?php

declare(strict_types=1);

namespace ThiagoCamelo\Bitkeys\Bitcoin\Mnemonic\Contracts;

interface WordListInterface
{
    public function getWords(): array;
}
