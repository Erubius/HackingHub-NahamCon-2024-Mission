<?php
// Specify the input and output files
$inputFile = 'wordlists/passwords-large.txt';
//$inputFile = '/usr/share/wordlists/seclists/Passwords/xato-net-10-million-passwords-10000.txt';
//$inputFile = '/usr/share/wordlists/seclists/Passwords/xato-net-10-million-passwords-100000.txt';
$outputFile = 'md5_passwords.txt';
$pairsFile = 'pairs.txt';
$type = 'listing';
$location = '/flag.txt';

// Open the input file for reading
$inputHandle = fopen($inputFile, 'r');
if (!$inputHandle) {
    die("Failed to open input file");
}

// Open the output file for writing
$outputHandle = fopen($outputFile, 'w');
if (!$outputHandle) {
    fclose($inputHandle);
    die("Failed to open output file");
}
// Open the output file for pairs
$pairHandle = fopen($pairsFile, 'w');
if (!$pairHandle) {
    fclose($inputHandle);
    fclose($outputHandle);
    die("Failed to open output file");
}

// Process each line in the input file
while (($line = fgets($inputHandle)) !== false) {
    // Trim the line to remove any extra whitespace or newline characters
    $line = trim($line);
    
    // Hash the line using md5
    $hashedLine = md5($type.$location.$line );
    
    // Write the hashed line to the output file
    fwrite($outputHandle, $hashedLine . PHP_EOL);

    // Write the hash, password pair
    fwrite($pairHandle, $line . ":" . $hashedLine . PHP_EOL);
}

// Close the file handles
fclose($inputHandle);
fclose($outputHandle);
fclose($pairHandle);

echo "Hashing complete. Check the output file for results.\n";
?>
