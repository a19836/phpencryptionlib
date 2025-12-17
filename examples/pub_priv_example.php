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

#shell:$ php example.php

include __DIR__ . "/PublicPrivateKeyHandler.php";

echo "<pre>";

$text = "This is only a test to see if this works... blab ble AHAHA LOL :)";
$private_pem_key = "-----BEGIN ENCRYPTED PRIVATE KEY-----
MIIFLTBXBgkqhkiG9w0BBQ0wSjApBgkqhkiG9w0BBQwwHAQIPGKnP2rqijkCAggA
MAwGCCqGSIb3DQIJBQAwHQYJYIZIAWUDBAEqBBDsMsc6pgl4drGE2CF/ferlBIIE
0Fq9529U7I97vAckpWIDoHMBZaYs0aDlsi9JnBruTUpegs6ejB0uHAbAs/kZN2vH
cTKExqf93KEMJUX9fuEL136cVOsPnzZ3dEbAxR8FAsjVzCn88GvmYvogWsuGqpta
VMj7aJO52Rq+msqipOYjhInyz0vwk07+BNmWEjyQrFYvPgJZs4ACswNmeI/7f+de
anGy2+phlUCVgHtmX4noBDnUnsRX6OW3H9E2DcAmg0yWDSuFpxISd7WHEJfa9f0A
DUPLtZ+gIR2NWMpvpkXWz130dc3HQigS3CgbWXzbm2txPiJTOfU/+I+E6juf88//
ZaqBzh5IzKWSGhmvS0dZ202yJz396mjCn4YJ7lwKLt3Ivq/YRbfIQuSUV077TjWb
TIz6Wfr6oqXNKLRJZKiHhg/II2LZ4EQwRFDn+DdKR9ijfP+/oLsKe3JcxTHgHrgl
isABLxzrc2kP/A1u0uNgtPOCVFNmjrnU4G86KaWfyO6eFP11JKrdZwuTSIqO3NkW
5MDHiK3UQ5o21Yp4ZhDvE1zjEyOXQTSmZXZmgtTbLhcJsnV+GDbdjxGONPIcNQ5y
rx8b5m4BjjlC172yaW0gp73knU7Z/fWfWCMFgpz81YhVnTvDjs1TSiaNHrRJBXhV
QX9WpDgAq9CaygQm8iYqE3GRBFuy4HS1/Ie+v4NocxfXQYbbYvqCCaw50r4Ogxeo
2YJtCJtDPuHNbo4lFR+hqGmpEfqFPoT1l1VVI4PhHTvdlRbFz+0ttr+rOtkQbA94
iGtLSWK7yQCdus30W9oGPKO3XZ99VnyBP1PeLqhBbUm7gXrDS4CxibIoTzgzXo47
P1C786M1MkAq5crg/c+xdyG5r07WIXOfrZLOqO+gNSMwv1GTNJ4+Hou7c0jfZUNb
UWaW2e8uMx8hmdPaGdiYIj2m68Z9TmrSfzgnmh/89Lwkd/NH5A8kP3Dn3OyhB7+J
4MwSDc3u9zzyqxzD2CzH/YoUnpk0muliG1GapyBH+43f0ke9y0jcMkHvzYR+0Cfi
mNA2Runp1a0OilmPT5a22QuM6A/LyLrUUVnO+p00me2nzWgUQprhCIJHOsccMaA8
H4TKhoPkDXUU+l0SQA6jecJb1L6YXT4RnAdy11iNNPAcv3diJTSY01J1ZEF27mDK
IUt5E2KFsDvUmu7CGddj0o0QdphmOX7eMMVYEDpvLOYvDzP6BRxbqh+MjGBndfcB
oOr9reomg72kCqvKbOcqC6X5RBm652c6cuQe8jPNKhqEMUnGaLvHui66r/6Kf0U4
ScOaot8fLu3IZDd+NQv3tCrOZoi1riBg3ekHYxEoCSCzSRPlSR8kcGMkIcdojmJK
bpBvTIrP0CbGARlYE0J5fAs9YEZ8HxXIyQIq/MXvW0fLOSzXxc2IF1ukIbxo6soc
lNDe2nNg54QKz9t37ODCnrXkSbmBbKTIedxr/6jIA6mRXCgc9RTLa5iLbmyHuZf8
48jtmk/mngdJjDTaM6VG3oo9tHqlmvdz01tldJZ8arwB9m4t/6QEN1uuo0CCSC+V
l55HnHF7MvA/LVpUG2gdaWlIxD8M1EocIweALBnEJ4lC5LoakH+T+T+jz2VGTP8O
ZglxxLRSxaa00jPxFTzOsm7mb22zBat4//3+Tyc0Pwez
-----END ENCRYPTED PRIVATE KEY-----";
$public_pem_key = "-----BEGIN PUBLIC KEY-----
MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAkG9U3uS10nR6VWqDUonn
9xhJnyQMbtOVb72vOigqvG1UssunCmNwpHwhBcfleksgu1P1PHT73PEYapSZ6jh/
hUNO1w4ZmuMKIKFVTHnKhC9cRStLnKaoT0nrPW2CVsfZFt+6x2v9WlSuWeGx2bpe
M0rmDIs3pQ9cC9RkdHiJ4Yt8w05b1rPybKQU/mI5vaxA8c4pdEJmRCt7h0yrjGhJ
QSUtcAeCCW9sQvCh1uYhF9N/qLTyI4NgEhXrCUjvLFqrVJfOIWB6Y+XZEWaxdvmG
ouEicb+/CUumKr+//qNp9r1yUxgVzAREl/NtvidDLreJv015mot/vD647l1/7Ru1
bwIDAQAB
-----END PUBLIC KEY-----";
$passphrase = "hello";

$PublicPrivateKeyHandler = new PublicPrivateKeyHandler(true);

echo "String to test: $text\n\n\n";

$encoded_string = $PublicPrivateKeyHandler->encryptRSA($text, $private_pem_key, $passphrase);
echo "Encoded string: $encoded_string\n\n\n";

$decoded_string = $PublicPrivateKeyHandler->decryptRSA($encoded_string, $public_pem_key);
echo "Decoded string: $decoded_string\n";

echo "</pre>";
?>
