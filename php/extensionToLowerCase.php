<?php
function lowercaseExtensions($directory) {
    if (!is_dir($directory)) {
        echo "Directory does not exist: $directory\n";
        return;
    }

    $items = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($directory, RecursiveDirectoryIterator::SKIP_DOTS),
        RecursiveIteratorIterator::SELF_FIRST
    );

    foreach ($items as $item) {
        if ($item->isDir()) {
            continue;
        }

        $path = $item->getPathname();
        $fileInfo = pathinfo($path);
        
        if (!isset($fileInfo['extension'])) {
            continue;
        }
        
        $currentExtension = $fileInfo['extension'];
        $lowerExtension = strtolower($currentExtension);
        
        if ($currentExtension !== $lowerExtension) {
            $newPath = $fileInfo['dirname'] . DIRECTORY_SEPARATOR . $fileInfo['filename'] . '.' . $lowerExtension;

            // Handle filename conflicts
            if (file_exists($newPath)) {
                $counter = 1;
                $baseName = $fileInfo['filename'];
                
                // Keep trying new names until we find one that doesn't exist
                do {
                    $newPath = $fileInfo['dirname'] . DIRECTORY_SEPARATOR . 
                              $baseName . '_' . $counter . '.' . $lowerExtension;
                    $counter++;
                } while (file_exists($newPath));
                
                echo "Warning: Original target exists. Renaming to: $newPath\n";
            }
            
            if (rename($path, $newPath)) {
                echo "Renamed: $path to $newPath\n";
            } else {
                echo "Error renaming: $path\n";
            }
        }
    }
}

$targetDirectory = './test';
lowercaseExtensions($targetDirectory);

echo "Extension lowercase conversion complete.\n";
?>