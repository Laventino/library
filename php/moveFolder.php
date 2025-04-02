<?php
// Source folder path
$sourceFolder = '../test/test-1-2-1/test_b';

// Destination folder path
$destinationFolder = '../test/test-1-2-2/test_a';

// Check if the source folder exists
if (is_dir($sourceFolder)) {
    // Check if the destination folder already exists (optional)
    if (is_dir($destinationFolder)) {
        echo "Error: The destination folder already exists.";
    } else {
        // Move the folder
        if (rename($sourceFolder, $destinationFolder)) {
            echo "Folder moved successfully!";
        } else {
            echo "Error: Failed to move the folder.";
        }
    }
} else {
    echo "Error: The source folder does not exist.";
}
?>