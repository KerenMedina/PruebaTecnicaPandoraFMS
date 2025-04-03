<?php
// Keren Medina Costa 03/04/2025

// the function search the position of the character 
// in the digits and convert every character to a decimal number
// multiplying the position by the base
function decode($digits, $initialScore)
{
    $base = strlen($digits);
    $finalScore = 0;
    $len = strlen($initialScore);

    for ($i = 0; $i < $len; $i++) {
        $pos = strpos($digits, $initialScore[$i]);
        $finalScore = $finalScore * $base + $pos; // Convert the digits to decimal 
    }

    return $finalScore;

}

$filename = "data.csv";
$results = [];
$names = [];
$finalScores = [];
$file = fopen($filename, "r"); // open the file for reading



// reading each line of the CSV file
while (($data = fgetcsv($file, 200, ",")) !== false) {
    [$name, $digits, $initialScore] = $data;
    
    $names[] = $name;

    $finalScore = decode($digits, $initialScore); // decode the initial score
    $finalScores[] = $finalScore;
}

fclose($file); // close the file

// associate the name and the score
foreach ($names as $index => $name) {
    $results[$name] = $finalScores[$index];
}

// order the results descending
arsort($results);

// show the results
foreach ($results as $name => $finalScore) {
    echo "$name,$finalScore<br>";
}

?>