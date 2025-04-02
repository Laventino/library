<?php
function getUniqueFileExtensions($directory) {
    $extensions = [];
    
    $iterator = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($directory)
    );
    
    foreach ($iterator as $file) {
        // Skip directories and dot files
        if ($file->isDir()) {
            continue;
        }
        
        $filename = $file->getFilename();
        $extension = pathinfo($filename, PATHINFO_EXTENSION);
        
        // Only add non-empty extensions
        if (!empty($extension)) {
            $extensions[strtolower($extension)] = true;
        }
    }
    
    // Return just the extension names (array keys)
    return array_keys($extensions);
}

// Usage example:
$folderPath = './test';
$uniqueExtensions = getUniqueFileExtensions($folderPath);

// Output the results
echo "Unique file extensions found:\n";
print_r($uniqueExtensions);
