<?php

function getFileInfo(SplFileInfo $file) {
    return [
        'pathname' => $file->getPathname(),
        'path' => $file->getPath(),
        'filename' => $file->getFilename(),
        'basename' => $file->getBasename('.' . $file->getExtension()),
        'extension' => $file->getExtension(),
        'type' => $file->isDir() ? 'dir' : 'file',
    ];
}

function scanDirectory($dir) {
    $result = [];

    $iterator = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($dir, RecursiveDirectoryIterator::SKIP_DOTS),
        RecursiveIteratorIterator::SELF_FIRST
    );

    foreach ($iterator as $file) {
        $result[] = getFileInfo($file);
    }

    return $result;
}

// Specify the directory to scan
$directory = 'D:\laravel 11\reverb';

// Scan the directory and collect file/folder information
// $fileInfo = scanDirectory($directory);

// // Convert the data to JSON
// $jsonData = json_encode($fileInfo, JSON_PRETTY_PRINT);

// Specify the output JSON file path
$jsonFilePath = 'folder_info.json';

// Write the JSON data to the file
// if (file_put_contents($jsonFilePath, $jsonData)) {
//     echo "File/folder information has been saved to $jsonFilePath" . PHP_EOL;
// } else {
//     echo "Failed to write JSON data to $jsonFilePath" . PHP_EOL;
// }

// Example: Load and search the JSON data
$loadedData = json_decode(file_get_contents($jsonFilePath), true);

// Search for a specific file or folder
$searchPath = "D:\\laravel 11\\reverb\\app";
$type = null;
$nested = true;
$found = array_filter($loadedData, function ($item) use ($searchPath, $type, $nested) {
    return (isset($nested) ? str_starts_with($item['path'], $searchPath) : $item['path'] === $searchPath) && (!$type || $item['type'] === $type);
});

$jsonFilePath = 'log.json';
$jsonData = json_encode($found, JSON_PRETTY_PRINT);
if (file_put_contents($jsonFilePath, $jsonData)) {
    echo "File/folder information has been saved to $jsonFilePath" . PHP_EOL;
} else {
    echo "Failed to write JSON data to $jsonFilePath" . PHP_EOL;
}