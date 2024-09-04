<?php
$type = "";
$secret = "the_25mission";
echo "set Type = 'exit' to quit\n";

while($type != "exit")
{
    // Prompt the user for input
    echo "Type: ";
    $type = trim(fgets(STDIN));
    if($type != "exit")
    {
        echo "Location: ";
        $location = trim(fgets(STDIN));

        $hash = md5($type.$location.$secret);
        echo "$hash\n";
    }
}
?>
