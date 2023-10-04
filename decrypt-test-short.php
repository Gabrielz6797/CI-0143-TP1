<?php
// Start the timer
$start = hrtime(true);

// List of target hashcodes to match against
$targetHashcodes = [
    'e633f4fc79badea1dc5db970cf397c8248bac47cc3acf9915ba60b5d76b0e88f',
    // Hola
    '08361fe455add186bdecf969165380e1fcd5280cf372ef2eb9fba7f4d9c2933e',
    // HolaPerroRojo
    'a1db0351d0e4dce5903b4ea65add8d9d01516c4def937fe4f54a3a704cd8c2f9',
    // AzulAzulGato
    'a949f18a2b0bc1ca29fec75f03c5ec39f42a455a634ce1436503ebe431bce0d4',
    // RojoRojoAdios
    '70e732eb47b37fc6939573c708335b5d856538435a32316542a5a7e8be465939',
    // AdiosHola
    '996c2d41bf91598383f3e73f456b0b5ef619ce9ad69c94fea53f0570abdac852',
    // PerroHolaGato
    '7069e90c206b0e2d349c46d3798730577338dbb0dca9dfd2f2f897c55e668e71',
    // Rojo
    '05f12759e01cee642c9fd3d52eb4cd29caf15f08650a2d8bc3988ac2ac20339f',
    // GatoRojoAzul
    'de99e21c1000411fb9a26a5fe4be0437d30d1fcfa9bc7663d27fbc02ebf12089',
    // GatoGato
    '1a594301006b76e97828ccae5388b91e2feb5c654895ab1dfb7c790c57cb3d90',
    // HolaGatoPerro
];

// Load the list of words from a text file
$wordList = file('test.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

if ($wordList === false) {
    die("Failed to open wordlist.txt");
}

// Function to compute the SHA-256 hashcode for a string
function computeSHA256($input)
{
    return hash('sha256', $input);
}

// Loop through each word in the list
foreach ($wordList as $word) {
    $hash = computeSHA256($word);
    if (in_array($hash, $targetHashcodes)) {
        echo "Match found for hashcode $hash, word: $word" . "\n"; // . "<br>";
    }

    echo $word . " " . $hash . "\n"; // . "<br>";

    // Generate combinations of two words
    foreach ($wordList as $word2) {
        $combinedHash = computeSHA256($word . $word2);
        if (in_array($combinedHash, $targetHashcodes)) {
            echo "Match found for hashcode $combinedHash, words: $word, $word2" . "\n"; // . "<br>";
        }

        echo $word, $word2 . " " . $combinedHash . "\n"; // . "<br>";
    }
}

// End the timer
$end = hrtime(true);

// Calculate the execution time
$executionTime = ($end - $start) / 1e9; // Convert to seconds

// Output the result
echo "Script execution time: " . $executionTime . " seconds";
?>