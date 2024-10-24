<?php

require 'vendor/autoload.php';

use ThiagoCamelo\Bitkeys\Bitcoin\Mnemonic\Phrase;
use ThiagoCamelo\Bitkeys\Bitcoin\Mnemonic\Entropy;
use ThiagoCamelo\Bitkeys\Bitcoin\Mnemonic\WordList;
use ThiagoCamelo\Bitkeys\Bitcoin\Wallet;
use ThiagoCamelo\Bitkeys\Keys\KeyGenerator;
use ThiagoCamelo\Bitkeys\Signer;

define('ROOT_PATH', __DIR__);

function println(string $message)
{
    print $message . PHP_EOL;
}


// // criação das chaves
// $start = microtime(true);

// $keyPair = KeyGenerator::generate();

// println($keyPair->getPrivatePem());

// $end = microtime(true);

// println(sprintf('Tempo para criação de chaves: %.8f', ($end - $start)));


// // testar assinatura
// $signer = new Signer($keyPair);

// $message = 'Hello world na assinatura digital';

// $signature = $signer->sign($message);

// var_dump($signature);

// $valid = $signer->verify($message, $signature);

// if (!$valid)
//     throw new \Exception('assinatura inválida');

// println('Assinatura válida');


// // criar wallet
// $wallet = new Wallet($keyPair);

// println('Chave Pública Comprimida: ' . $wallet->getCompressedPublicKey());

// println('Chave Pública Não Comprimida: ' . $wallet->getUncompressedPublicKey());


// $entropy = new Entropy();

// println($entropy->toHex());

// println($entropy->getEntropyWithChecksum());

// var_dump($_SERVER['PWD'] ?? $_SERVER['DOCUMENT_ROOT']);


$wordlist = new WordList('english.txt');
// $wordlist = new WordList('portuguese.txt');

$phrase = new Phrase($wordlist, new Entropy());

println($phrase->getMnemonic());



// proximo passo, gerar a seed a partir da frase mnemônica + passphrase
