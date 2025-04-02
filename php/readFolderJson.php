<?php
// Specify the output JSON file path
$jsonFilePath = 'folder_info.json';

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