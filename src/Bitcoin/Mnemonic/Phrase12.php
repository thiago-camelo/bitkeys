<?php

declare(strict_types=1);

namespace ThiagoCamelo\Bitkeys\Bitcoin\Mnemonic;

use ThiagoCamelo\Bitkeys\Bitcoin\Mnemonic\Contracts\EntropyInterface;
use ThiagoCamelo\Bitkeys\Bitcoin\Mnemonic\Contracts\PhraseInterface;
use ThiagoCamelo\Bitkeys\Bitcoin\Mnemonic\Contracts\WordListInterface;

class Phrase12 implements PhraseInterface
{
    private array $wordlist;
    private array $words;

    public function __construct(WordListInterface $wordlist, EntropyInterface $entropy)
    {
        $this->wordlist = $wordlist->getWords();
        $this->setEntropy($entropy);
    }

    private function setEntropy(EntropyInterface $entropy): void
    {
        for ($i = 0; $i < strlen($entropy->getEntropyWithChecksum()); $i += 11) {
            $index = bindec(substr($entropy->getEntropyWithChecksum(), $i, 11));
            $this->words[] = $this->wordlist[$index];
        }
    }

    public function getMnemonic(): string
    {
        return join(' ', $this->words);
    }

    // getKeyPair > implementar

}
