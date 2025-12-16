<?php
/*
 * Copyright (c) 2025 Bloxtor (http://bloxtor.com) and Joao Pinto (http://jplpinto.com)
 * 
 * Multi-licensed: BSD 3-Clause | Apache 2.0 | GNU LGPL v3 | HLNC License (http://bloxtor.com/LICENSE_HLNC.md)
 * Choose one license that best fits your needs.
 *
 * Original PHP Encryption Lib Repo: https://github.com/a19836/phpencryptionlib/
 * Original Bloxtor Repo: https://github.com/a19836/bloxtor
 *
 * YOU ARE NOT AUTHORIZED TO MODIFY OR REMOVE ANY PART OF THIS NOTICE!
 */
?>
<style>
h1 {margin-bottom:0; text-align:center;}
h5 {font-size:1em; margin:40px 0 10px; font-weight:bold;}
p {margin:0 0 20px; text-align:center;}

.note {text-align:center;}
.note span {text-align:center; margin:0 20px 20px; padding:10px; color:#aaa; border:1px solid #ccc; background:#eee; display:inline-block; border-radius:3px;}
.note li {margin-bottom:5px;}

.code {display:block; margin:10px 0; padding:0; background:#eee; border:1px solid #ccc; border-radius:3px; position:relative;}
.code:before {content:"php"; position:absolute; top:5px; left:5px; display:block; font-size:80%; opacity:.5;}
.code textarea {width:100%; height:300px; padding:30px 10px 10px; display:inline-block; background:transparent; border:0; resize:vertical; font-family:monospace;}

.statement {margin-bottom:5px; padding:3px; background:#eee; border:1px solid #ccc; border-radius:3px; display:inline-block;}
</style>
<h1>PHP Encryption Lib</h1>
<p>Encrypts and Decrypts data</p>
<div class="note">
		<span>
		This library is used to securely encrypt and decrypt data using multiple encryption strategies.<br/>  
		It allows you to transform raw content into encrypted hashes and safely restore the original content when needed.<br/>
		<br/>
		The library provides <b>three encryption engines</b>, each suited for different security and use-case requirements:<br/>
		<ul style="display:inline-block; text-align:left;">
			<li><b>Crypto Key Handler</b>: Encrypts and decrypts strings, JSON data, and serialized objects using a hexadecimal binary key.</li>
			<li><b>OpenSSL Cipher Handler</b>: Encrypts and decrypts strings, arrays, or objects using a secure SSL cipher (default is <b>AES-128-CBC</b>) combined with a salt value.</li>
			<li><b>Public / Private Key Handler</b>: Encrypts and decrypts strings using asymmetric encryption based on public and private key pairs (RSA files).</li>
		</ul>
		<br/>
		This flexible architecture allows developers to choose the most appropriate encryption method depending on security needs, data type, and application context.
		</span>
</div>

<div>
	<h5>Crypto Key Handler</h5>
	<p style="text-align:left;">You can see an example <a href="lib/encryption/crypto_example.php" target="crypto_example">here</a>.</p>
	<p style="text-align:left;">Methods:</p>
	<ul>
		<li>Create a key: <span class="statement">$key = CryptoKeyHandler::getKey();</span></li>
		<li>Encrypts a text: <span class="statement">$cipher_bin = CryptoKeyHandler::encryptText($text, $key);</span></li>
		<li>Decrypts a previous encrypted text: <span class="statement">$text = CryptoKeyHandler::decryptText($cipher_bin, $key);</span></li>
		<li>Encrypts json: <span class="statement">$cipher_bin = CryptoKeyHandler::encryptJsonObject($array, $key);</span></li>
		<li>Decrypts json: <span class="statement">$array = CryptoKeyHandler::decryptJsonObject($cipher_bin, $key);</span></li>
		<li>encrypts serialized object: <span class="statement">$cipher_bin = CryptoKeyHandler::encryptSerializedObject($array, $key);</span></li>
		<li>Decrypts serialized object: <span class="statement">$array = CryptoKeyHandler::decryptSerializedObject($cipher_bin, $key);</span></li>
		<li>Prepare cipher_bin to be saved/sent to a DB or file or email or other: <span class="statement">$cipher_text = CryptoKeyHandler::binToHex($cipher_bin);</span></li>
		<li>Prepare key to be saved/sent to a DB or file or email or other: <span class="statement">$key_str = CryptoKeyHandler::binToHex($key);</span></li>
	</ul>
	<p style="text-align:left;">Sample:</p>
	<div class="code">
		<textarea readonly>
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
		</textarea>
	</div>
</div>

<div>
	<h5>OpenSSL Cipher Handler</h5>
	<p style="text-align:left;">You can see an example <a href="lib/encryption/openssl_example.php" target="openssl_example">here</a>.</p>
	<p style="text-align:left;">Methods:</p>
	<ul>
		<li>Encrypts text: <span class="statement">$cipher_text = OpenSSLCipherHandler::encryptText($text, $salt);</span></li>
		<li>Decrypts text: <span class="statement">$text = OpenSSLCipherHandler::decryptText($cipher_text, $salt);</span></li>
		<li>Encrypts variable: <span class="statement">$cipher_var = OpenSSLCipherHandler::encryptVariable($var, $salt);</span></li>
		<li>Decrypts variable: <span class="statement">$decrypted_var = OpenSSLCipherHandler::decryptVariable($cipher_var, $salt);</span></li>
		<li>Encrypts array: <span class="statement">$cipher_array = OpenSSLCipherHandler::encryptArray($array, $salt);</span></li>
		<li>Decrypts array: <span class="statement">$decrypted_array = OpenSSLCipherHandler::decryptArray($cipher_array, $salt);</span></li>
	</ul>
	<p style="text-align:left;">Sample:</p>
	<div class="code">
		<textarea readonly>
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
		</textarea>
	</div>
</div>

<div>
	<h5>Public / Private Key Handler</h5>
	<p style="text-align:left;">You can see an example <a href="lib/encryption/pub_priv_example.php" target="pub_priv_example">here</a>.</p>
	<p style="text-align:left;">Methods:</p>
	<ul>
		<li>Encrypts text based in RSA file: <span class="statement">$encoded_string = $PublicPrivateKeyHandler->encryptString($text, $private_key_file, $passphrase);</span></li>
		<li>Decrypts text based in RSA file: <span class="statement">$decoded_string = $PublicPrivateKeyHandler->decryptString($encoded_string, $public_key_file);</span></li>
		<li>Encrypts text based in RSA string: <span class="statement">$encoded_string = $PublicPrivateKeyHandler->encryptRSA($text, $private_pem_key, $passphrase);</span></li>
		<li>Decrypts text based in RSA string: <span class="statement">$decoded_string = $PublicPrivateKeyHandler->decryptRSA($encoded_string, $public_pem_key);</span></li>
	</ul>
	<p style="text-align:left;">Sample:</p>
	<div class="code">
		<textarea readonly>
//set RSA files and passphrase
$public_key_file = "/tmp/.app_pub_key.pem";
$private_key_file = "/tmp/.app_priv_key.pem";
$passphrase = "the passphrase when the rsa keys were created";

$PublicPrivateKeyHandler = new PublicPrivateKeyHandler($is_2048_bits_key = true);

$text = "This is only a test to see if this works... blab ble AHAHA LOL :)";
$encoded_string = $PublicPrivateKeyHandler->encryptString($text, $private_key_file, $passphrase);

$decoded_string = $PublicPrivateKeyHandler->decryptString($encoded_string, $public_key_file);

echo $decoded_string == $text ? "OK" : "ERROR";
		</textarea>
	</div>
</div>

