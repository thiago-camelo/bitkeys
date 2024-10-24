<?php

declare(strict_types=1);

namespace ThiagoCamelo\Bitkeys\Bitcoin\Mnemonic;

class Phrase
{
    private array $wordlist;
    private array $words;

    public function __construct(WordList $wordlist, Entropy $entropy)
    {
        $this->wordlist = $wordlist->getWords();
        $this->setEntropy($entropy);
    }

    private function setEntropy(Entropy $entropy): void
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

}
