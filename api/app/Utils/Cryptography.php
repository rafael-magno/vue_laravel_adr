<?php

namespace App\Utils;

class Cryptography
{
    const METHOD = 'aes-256-ofb';
    const HMAC_HASH = 'sha256';
    const HMAC_HASH_SIZE = 32;

    public static function encode(string $text): string
    {
        $ivlen = openssl_cipher_iv_length(self::METHOD);
        $iv = openssl_random_pseudo_bytes($ivlen);

        $cipherTextRaw = openssl_encrypt(
            $text,
            self::METHOD,
            env('CRYPT_KEY'),
            OPENSSL_RAW_DATA,
            $iv
        );

        $hmac = hash_hmac(
            self::HMAC_HASH,
            $cipherTextRaw,
            env('CRYPT_KEY'),
            true
        );

        $cipherText = base64_encode($iv . $hmac . $cipherTextRaw);

        return str_replace(['+', '/'], ['(', ')'], $cipherText);
    }

    public static function decode(string $text): string
    {
        $text = str_replace(['(', ')'], ['+', '/'], $text);
        $text = base64_decode($text);
        $ivlen = openssl_cipher_iv_length(self::METHOD);

        if (strlen($text) > $ivlen) {
            $iv = substr($text, 0, $ivlen);
            $hmac = substr($text, $ivlen, self::HMAC_HASH_SIZE);
            $cipherTextRaw = substr($text, $ivlen + self::HMAC_HASH_SIZE);

            $calcmac = hash_hmac(
                self::HMAC_HASH,
                $cipherTextRaw,
                env('CRYPT_KEY'),
                true
            );

            if (hash_equals($hmac, $calcmac)) {
                return openssl_decrypt(
                    $cipherTextRaw,
                    self::METHOD,
                    env('CRYPT_KEY'),
                    OPENSSL_RAW_DATA,
                    $iv
                );
                ;
            }
        }

        return base64_encode(random_bytes($ivlen));
    }
}
