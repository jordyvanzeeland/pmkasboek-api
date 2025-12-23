<?php

namespace App\Services;

class CryptoService{
    protected string $encryptMethod = 'AES-256-CBC';
    protected string $secretKey;
    protected string $secretIv;

    public function __construct(){
        $this->secretKey = config('app.crypto_secret_key');
        $this->secretIv  = config('app.crypto_secret_iv');
    }

    protected function key(): string{
        return hash('sha256', $this->secretKey);
    }

    protected function iv(): string{
        return substr(hash('sha256', $this->secretIv), 0, 16);
    }

    public function encrypt(string $value): string
    {
        $encrypted = openssl_encrypt($value, $this->encryptMethod, $this->key(), 0, $this->iv());
        return base64_encode($encrypted);
    }

    public function decrypt(string $value): string|false
    {
        return openssl_decrypt(base64_decode($value), $this->encryptMethod, $this->key(), 0, $this->iv());
    }
}