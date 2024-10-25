<?php

declare(strict_types=1);

namespace ThiagoCamelo\Bitkeys\Bitcoin\Mnemonic;

use ThiagoCamelo\Bitkeys\Bitcoin\Mnemonic\Contracts\WordListInterface;

class WordList implements WordListInterface
{
    private array $wordlist;
    
    public function __construct(string $fileName)
    {
        $filePath = ROOT_PATH . DIRECTORY_SEPARATOR . "assets/wordlist/{$fileName}";

        $wordlist = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        if (count($wordlist) !== 2048)
            throw new \Exception("Erro: O dicionário BIP-39 deve conter exatamente 2048 palavras.");

        $this->wordlist = $wordlist;
    }

    public function getWords(): array
    {
        return $this->wordlist;
    }

}
