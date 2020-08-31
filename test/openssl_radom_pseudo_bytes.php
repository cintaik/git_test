<?php
	echo "<pre>";

	for ($i = 1; $i <= 4; $i++) {
	    $bytes = openssl_random_pseudo_bytes($i, $cstrong);
	    $hex   = bin2hex($bytes);

	    echo "Lengths: Bytes: $i and Hex: " . strlen($hex) . PHP_EOL . "<br>";
	    echo "\$hex : <br>";
	    var_dump($hex);
	    echo "\$cstrong : <br>";
	    var_dump($cstrong);

	    echo "<hr>";

	    echo PHP_EOL; // PHP_EOL adalah baris baru
	}

	echo "</pre>";
	$length = 32;
	echo "{$length} Bytes / 256 bits<br>";
	$bytes = openssl_random_pseudo_bytes($length, $cstrong);
	$hex   = bin2hex($bytes);
	$encrypt_key = base64_encode($bytes);
	$decrypt_key = base64_decode($encrypt_key);
	echo "Lengths: Bytes: {$length} and Hex: " . strlen($hex) . PHP_EOL . "<br>";
    echo "\$hex : <br>";
    var_dump($hex);
    echo "<br>";
    echo "\$bytes : ";
    echo "<br>";
    var_dump($bytes);
    echo "<br>";
    echo "\$cstrong : ";
    echo "<br>";
    var_dump($cstrong);
    echo "<br><br>";

    echo "\$encrypt_key : ";
    echo "<br>";
    var_dump($encrypt_key);
    echo "<br>";
    echo "\$decrypt_key : ";
    echo "<br>";
    var_dump($decrypt_key);
    echo "<br>";
?>
