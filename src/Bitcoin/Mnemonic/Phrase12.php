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
    private string $passPhrase;
    

    public function __construct(WordListInterface $wordlist, EntropyInterface $entropy, string $passPhrase = '')
    {
        $this->wordlist = $wordlist->getWords();
        $this->passPhrase = $passPhrase;
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
    public function getSeed(): string
    {
        return hash_pbkdf2('sha512', $this->getMnemonic(), 'mnemonic' . $this->passPhrase, 2048, 64);
    }

}
