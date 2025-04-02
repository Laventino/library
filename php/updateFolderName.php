<?php

$dirPath = './test'; // Replace with your directory path

function replaceSymbolsWithSpaces($name) {
    $symbols = ['!', '@', '#', '$', '%', '^', '&', '*', '(', ')', '_', '+', '=', '{', '}', '[', ']', '|', '\\', ':', ';', '"', "'", '<', '>', ',', '.', '?', '/', '~', '`'];
    $name = str_replace($symbols, ' ', $name);
    $name = preg_replace('/\s+/', ' ', $name);
    return trim($name);
}

if ($handle = opendir($dirPath)) {
    while (false !== ($folder = readdir($handle))) {
        if ($folder === '.' || $folder === '..') {
            continue;
        }
        $oldFolderPath = $dirPath . DIRECTORY_SEPARATOR . $folder;
        if (is_dir($oldFolderPath)) {
            $newFolderName = replaceSymbolsWithSpaces($folder);
            $newFolderPath = $dirPath . DIRECTORY_SEPARATOR . $newFolderName;
            if (rename($oldFolderPath, $newFolderPath)) {
                echo "Renamed: $folder -> $newFolderName\n";
            } else {
                echo "Failed to rename: $folder\n";
            }
        }
    }
    closedir($handle);
} else {
    echo "Unable to open directory: $dirPath\n";
}