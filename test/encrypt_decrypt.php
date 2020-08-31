<?php
    //$key is our base64 encoded 256bit key that we created earlier. You will probably store and define this key in a config file.
    
    $key = 'UclIN9LalPUrE4qeEoXDuuu+ZsUwLjS2HMGLDjHVDhE=';// panjang 32 bytes
    function generateKey($panjang=32){
        // menerapkan algoritma cryptographically strong untuk menghasilkan pseudo-random bytes
        // dengan default panjang 32 bytes atau 256 bit
        $bytes = openssl_random_pseudo_bytes($panjang, $cstrong);
        if (!$cstrong) {
            return false;
        }
        $key = base64_encode($bytes);
        return $key;
    }

    function my_encrypt($data, $key) {
        if ($key === false) {
            return false;
        }
        // decode $key menjadi hasil $bytes/$key
        $encryption_key = base64_decode($key);
        // Generate panjang vektor inisialisasi sandi menggunakan Algoritma Advanced Encryption Standard / Rijndael
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
        // Mengenkripsi data menggunakan Algoritma Advanced Encryption Standard (AES) 256 bits dalam mode CBC menggunakan enkripsi key dengan Algoritma Cryptographically Strong dan vektor inisialsiasi dengan Agoritma AES juga.
        $encrypted = openssl_encrypt($data, 'aes-256-cbc', $encryption_key, 0, $iv);
        // $iv sama pentingnya dengan $key untuk dekripsi, sehingga hasil $encrypted dan $iv harus disimpan dengan delimiter/pemisah ::
        return base64_encode($encrypted . '::' . $iv);

    }

    function my_decrypt($data, $key) {
        if ($key === false) {
            return false;
        }
        // decode $key menjadi hasil $bytes/$key
        $encryption_key = base64_decode($key);
        // Untuk dekripsi openssl, pisah $encrypted data dari $iv dengan delimiter "::" dengan maksimal elemen array 2
        list($encrypted_data, $iv) = explode('::', base64_decode($data), 2);
        // dekripsi $encrypted data menggunakan algoritma AES 256 bits dalam mode CBC menggunakan $encription_key dan vektor inisialisasi.
        return openssl_decrypt($encrypted_data, 'aes-256-cbc', $encryption_key, 0, $iv);
    }

    //our data to be encoded
    $password_plain = 'abc123';
    echo "\$password_plain : {$password_plain} <br>";

    //our data being encrypted. This encrypted data will probably be going into a database
    //since it's base64 encoded, it can go straight into a varchar or text database field without corruption worry
    $password_encrypted = my_encrypt($password_plain, $key);
    echo "\$password_encrypted : {$password_encrypted}<br>";

    //now we turn our encrypted data back to plain text
    $password_decrypted = my_decrypt($password_encrypted, $key);
    echo "\$password_decrypted : {$password_decrypted}<br>";