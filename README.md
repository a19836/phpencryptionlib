# PHP Encryption Lib

> Original Repos:   
> - PHP Encryption Lib: https://github.com/a19836/phpencryptionlib/   
> - Bloxtor: https://github.com/a19836/bloxtor/

## Overview

**PHP Encryption Lib** is a PHP library designed to securely encrypt and decrypt data using multiple encryption strategies.   
It supports symmetric and asymmetric encryption mechanisms and works with strings, arrays, JSON, and serialized objects.     
   
The library provides **3 encryption engines**, each suited for different security and use-case requirements.   

This flexible architecture allows developers to choose the most appropriate encryption method depending on security needs, data type, and application context.   
The library is ideal for applications that require secure data storage, transmission, or token-based communication. 

To see a working example, open [index.php](index.php) on your server.

---

## Encryption Engines

### Crypto Key Handler
- Encrypts and decrypts strings, JSON, and serialized objects
- Uses a hexadecimal binary key
- Suitable for lightweight symmetric encryption

### OpenSSL Cipher Handler
- Encrypts and decrypts strings, arrays, or objects
- Uses OpenSSL with **AES-128-CBC**, but you can also change it
- Supports salt-based encryption for improved security

### Public / Private Key Handler
- Encrypts and decrypts strings using asymmetric encryption
- Based on public and private key pairs
- Ideal for secure data exchange scenarios

---

## Use Cases

- Secure data storage
- Encrypted configuration values
- Secure communication between services
- Token and payload encryption

---

## Usage

### Crypto Key Handler

> You can see an example [here](lib/encryption/crypto_example.php).

**Methods:**
- Create a key: `$key = CryptoKeyHandler::getKey();`
- Encrypts a text: `$cipher_bin = CryptoKeyHandler::encryptText($text, $key);`
- Decrypts a previous encrypted text: `$text = CryptoKeyHandler::decryptText($cipher_bin, $key);`
- Encrypts json: `$cipher_bin = CryptoKeyHandler::encryptJsonObject($array, $key);`
- Decrypts json: `$array = CryptoKeyHandler::decryptJsonObject($cipher_bin, $key);`
- encrypts serialized object: `$cipher_bin = CryptoKeyHandler::encryptSerializedObject($array, $key);`
- Decrypts serialized object: `$array = CryptoKeyHandler::decryptSerializedObject($cipher_bin, $key);`
- Prepare cipher_bin to be saved/sent to a DB or file or email or other: `$cipher_text = CryptoKeyHandler::binToHex($cipher_bin);`
- Prepare key to be saved/sent to a DB or file or email or other: `$key_str = CryptoKeyHandler::binToHex($key);`

**Usage example:**
```php
include __DIR__ . "/lib/encryption/CryptoKeyHandler.php";

$message = "Hello, My name is John Piri... :)\n*&^%$#@!";

$key = CryptoKeyHandler::getKey(); //create a key
$key_str = CryptoKeyHandler::binToHex($key); //converts hash binary to hexadecimal text
$decrypted_key = CryptoKeyHandler::hexToBin($key_str); //converts hexadecimal key to binary

$cipher_bin = CryptoKeyHandler::encryptText($message, $key); //encrypts string
$cipher_text = CryptoKeyHandler::binToHex($cipher_bin); //converts hash binary to hexadecimal text

$cipher_bin = CryptoKeyHandler::hexToBin($cipher_text); //converts hash hexadecimal text to binary
$decrypted_message = CryptoKeyHandler::decryptText($cipher_bin, $decrypted_key); //decrypts a previous encrypted string

echo $decrypted_message == $message ? "OK" : "ERROR";
```

### OpenSSL Cipher Handler

> You can see an example [here](lib/encryption/openssl_example.php).

**Methods:**
- Encrypts text: `$cipher_text = OpenSSLCipherHandler::encryptText($text, $salt);`
- Decrypts text: `$text = OpenSSLCipherHandler::decryptText($cipher_text, $salt);`
- Encrypts variable: `$cipher_var = OpenSSLCipherHandler::encryptVariable($var, $salt);`
- Decrypts variable: `$decrypted_var = OpenSSLCipherHandler::decryptVariable($cipher_var, $salt);`
- Encrypts array: `$cipher_array = OpenSSLCipherHandler::encryptArray($array, $salt);`
- Decrypts array: `$decrypted_array = OpenSSLCipherHandler::decryptArray($cipher_array, $salt);`

**Usage example:**
```php
include __DIR__ . "/lib/encryption/OpenSSLCipherHandler.php";

$salt = "some string here. whatever you want!!!";

//Hashing strings:
$text = "some message to be encrypted";
$cipher_text = OpenSSLCipherHandler::encryptText($text, $salt);
$decrypted_text = OpenSSLCipherHandler::decryptText($cipher_text, $salt);

echo $decrypted_text == $text ? "OK" : "ERROR";

echo "&lt;br/>";

//Hashing vars, arrays, objects:
$var = array(
	"text1" => "some message 1 to be encrypted",
	"text2" => "some text 2 to be encrypted",
);
$cipher_var = OpenSSLCipherHandler::encryptVariable($var, $salt);
$decrypted_var = OpenSSLCipherHandler::decryptVariable($cipher_var, $salt);

echo $decrypted_var == $var ? "OK" : "ERROR";
```

### Public / Private Key Handler

> You can see an example [here](lib/encryption/pub_priv_example.php).

**Methods:**
- Encrypts text based in RSA file: `$encoded_string = $PublicPrivateKeyHandler->encryptString($text, $private_key_file, $passphrase);`
- Decrypts text based in RSA file: `$decoded_string = $PublicPrivateKeyHandler->decryptString($encoded_string, $public_key_file);`
- Encrypts text based in RSA string: `$encoded_string = $PublicPrivateKeyHandler->encryptRSA($text, $private_pem_key, $passphrase);`
- Decrypts text based in RSA string: `$decoded_string = $PublicPrivateKeyHandler->decryptRSA($encoded_string, $public_pem_key);`

**Usage example:**
```php
//set RSA files and passphrase
$public_key_file = "/tmp/.app_pub_key.pem";
$private_key_file = "/tmp/.app_priv_key.pem";
$passphrase = "the passphrase when the rsa keys were created";

$PublicPrivateKeyHandler = new PublicPrivateKeyHandler($is_2048_bits_key = true);

$text = "This is only a test to see if this works... blab ble AHAHA LOL :)";
$encoded_string = $PublicPrivateKeyHandler->encryptString($text, $private_key_file, $passphrase);

$decoded_string = $PublicPrivateKeyHandler->decryptString($encoded_string, $public_key_file);

echo $decoded_string == $text ? "OK" : "ERROR";
```

