<?php
/**
 * Creates info.json files in first and second level directories with item counts
 * 
 * @param string $folderDir The directory to start from
 * @param string $rootDir Root project
 * @param array $excludeNames Files/folders to exclude by name
 * @param array $excludeExtensions File extensions to exclude
 */
function createInfoJsonFiles($folderDir, $rootDir, $excludeNames = [], $excludeExtensions = []) {
    // Add info.json to exclude names so we don't count it
    $excludeNames[] = 'info.json';
    
    // Open the root directory
    $dir = new DirectoryIterator($folderDir);
    
    foreach ($dir as $fileinfo) {
        // Skip excluded items, dot files, and non-directories
        if ($fileinfo->isDot() || 
            !$fileinfo->isDir() || 
            in_array($fileinfo->getFilename(), $excludeNames)) {
            continue;
        }
        
        $firstLevelDir = $fileinfo->getPathname();
        
        // Process first level directory
        processDirectory($firstLevelDir, $rootDir, $excludeNames, $excludeExtensions);
        
        // Now look for second level directories
        $subDir = new DirectoryIterator($firstLevelDir);
        foreach ($subDir as $subfileinfo) {
            if ($subfileinfo->isDot() || 
                !$subfileinfo->isDir() || 
                in_array($subfileinfo->getFilename(), $excludeNames)) {
                continue;
            }
            
            $secondLevelDir = $subfileinfo->getPathname();
            processDirectory($secondLevelDir, $rootDir, $excludeNames, $excludeExtensions);
        }
    }
}

/**
 * Processes a single directory to create info.json
 */
function processDirectory($directory, $rootDir, $excludeNames, $excludeExtensions) {
    $count = 0;
    $jsonPath = $directory . DIRECTORY_SEPARATOR . 'info.json';

    // Load existing data if file exists
    $existingData = [];
    if (file_exists($jsonPath)) {
        $existingData = json_decode(file_get_contents($jsonPath), true) ?: [];
    }

    // Count items in directory
    $dir = new DirectoryIterator($directory);
    foreach ($dir as $fileinfo) {
        if ($fileinfo->isDot()) continue;
        
        $filename = $fileinfo->getFilename();
        $extension = $fileinfo->getExtension();
        
        // Check if this item should be excluded
        if (in_array($filename, $excludeNames) || 
            in_array($extension, $excludeExtensions)) {
            continue;
        }
        
        $count++;
    }
    
    // Get relative path by removing the root directory part
    $relativePath = str_replace($rootDir, '', $directory);
    
    // Update only specific fields while preserving other existing data
    $updatedData = $existingData; // Start with existing data
    $updatedData['directory'] = basename($directory);
    $updatedData['path'] = $relativePath === '' ? '.' : $relativePath;
    $updatedData['item_count'] = $count;
    
    // Write to info.json
    file_put_contents($jsonPath, json_encode($updatedData, JSON_PRETTY_PRINT));
    
    echo (empty($existingData) ? "Created: " : "Updated: ") . "$jsonPath\n";
}

// Example usage:
$folderDirectory = 'C:\Users\Asus\Desktop\TestFile\test';
$rootDirectory = 'C:\Users\Asus\Desktop\TestFile';
$excludeNames = ['.git', '.DS_Store', 'node_modules']; // Names to exclude
$excludeExtensions = ['tmp', 'bak']; // Extensions to exclude

createInfoJsonFiles($folderDirectory, $rootDirectory, $excludeNames, $excludeExtensions);
?>