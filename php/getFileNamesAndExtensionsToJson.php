<?php
function getFilesToJson($folderPath) {
    $filesData = [];
    
    // Create recursive directory iterator
    $directory = new RecursiveDirectoryIterator($folderPath);
    $iterator = new RecursiveIteratorIterator($directory);
    
    foreach ($iterator as $file) {
        // Skip directories
        if ($file->isDir()) continue;
        
        $filename = $file->getFilename();
        $extension = $file->getExtension();
        $path = $file->getPathname();
        $relativePath = str_replace($folderPath, '', $path);
        
        $filesData[] = [
            'filename' => $filename,
            'name' => pathinfo($filename, PATHINFO_FILENAME),
            'extension' => $extension ? ".$extension" : '',
            'path' => $path,
            'relative_path' => ltrim($relativePath, DIRECTORY_SEPARATOR)
        ];
    }
    
    // Windows-style sorting (natural sort, case-insensitive)
    usort($filesData, function($a, $b) {
        return strnatcasecmp($a['filename'], $b['filename']);
    });
    
    
    return json_encode($filesData, JSON_PRETTY_PRINT);
}

// Usage example:
$folderPath = '.\test\test-1-2-2\test_b';
$jsonOutput = getFilesToJson($folderPath);

// Output to browser
header('Content-Type: application/json');
echo $jsonOutput;

// Or save to file
file_put_contents('files.json', $jsonOutput);
?>