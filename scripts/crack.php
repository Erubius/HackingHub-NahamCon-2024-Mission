<?php
// Specify the file to read
$type = "contents";
$location = "/etc/hosts";
$filename = "/usr/share/wordlists/rockyou.txt";
$auth = "808508963a69d7daf87b0b61f59d43f5";
$count = 0;

// Check if the file exists and is readable
if (!file_exists($filename) || !is_readable($filename)) {
    die("File not found or is not readable.\n");
}
$file = fopen($filename, "r");


if ($file) 
{
    // Loop through each line of the file
    while (($line = fgets($file)) !== false) 
    {
        // Remove newline chars
        $line = trim($line);
        $hash = md5($type.$location.$line);

        // Compare the hash to the static hash
        if ($hash === $auth) 
        {
            echo "\n";
            echo "==========  Match found!  ==========\n";
            echo "Secret: $line\n";
            echo "====================================\n";
            fclose($file); 
            exit(0);
        }
        else
        {
            $count++;
        	echo "\rAttempt $count/14344392";
        }
    }

    fclose($file);
} 
else 
{
    echo "Error opening the file.\n";
}

?>
