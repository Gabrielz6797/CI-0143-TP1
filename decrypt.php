<?php
// List of target hashcodes to match against
$targetHashcodes = [
    '3f179ef6da45ff638a8a72a5d96d8fb40c5478543a9052cd88cf06143ff61881',
    'fb6f128d10e4f3388d2e989b6c2722c9b4bbaf3c822c3b0f9c0fcb8dd0518c81',
    'fd18763c780ff93fa9c6648d92ffda3adb99ae17ae1db56ad21220ccf13d238a',
    '0ea0cbcdeb022640b3d70e1f033555e1dc79ca051f3b58d4d8fc1bf04daba5ea',
    '7b94d207939b521f675776a5cb2576497e4e4837cf486b788962073b92f4a644',
    '1d43bb8159de5c25b5e16e87b262db58421bdfee1e435d1d6eb055701c72a33c',
    '06fe01aae776142d93e5e9a658ace8cfd7b3c262568a0af0dd4b079482b217cc',
    'f7894d2c6bed49e94564e40b7e5d52c17271ad214bc601d2c80270546b9c3540',
    '7886f1a4d9548ccd7028254f31f2e5ce9b86b965931a5b8d62d2de1d3547e44a',
    '1a76f4777bbb2e63189699d560063a9698e7ded82efd4f43a316acdf01b4e3ed',
];

// Load the list of words from a text file
$wordList = file('xato-net-10-million-passwords-1000000.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

if ($wordList === false) {
    die("Failed to open wordlist.txt");
}

// Function to compute the SHA-256 hashcode for a string
function computeSHA256($input) {
    return hash('sha256', $input);
}

// Loop through each word in the list
foreach ($wordList as $word) {
    $hash = computeSHA256($word);
    if (in_array($hash, $targetHashcodes)) {
        echo "Match found for hashcode $hash, word: $word" . "\n"; // . "<br>";
    }

    // Generate combinations of two words
    foreach ($wordList as $word2) {
        $combinedHash = computeSHA256($word . $word2);
        if (in_array($combinedHash, $targetHashcodes)) {
            echo "Match found for hashcode $combinedHash, words: $word, $word2" . "\n"; // . "<br>";
        }

        // Generate combinations of three words
        foreach ($wordList as $word3) {
            $combinedHash = computeSHA256($word . $word2 . $word3);
            if (in_array($combinedHash, $targetHashcodes)) {
                echo "Match found for hashcode $combinedHash, words: $word, $word2, $word3" . "\n"; // . "<br>";
            }
        }
    }
}
?>