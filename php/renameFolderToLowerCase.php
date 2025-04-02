<?php
function renameFoldersToLowercase($dir, $resolveConflicts = true) {
    if (!is_dir($dir)) {
        die("Error: Directory does not exist: $dir");
    }

    $handle = opendir($dir);
    if (!$handle) {
        die("Error: Cannot open directory: $dir");
    }

    while (false !== ($item = readdir($handle))) {
        if ($item == '.' || $item == '..') {
            continue;
        }

        $oldPath = $dir . DIRECTORY_SEPARATOR . $item;
        $newName = strtolower($item);
        $newPath = $dir . DIRECTORY_SEPARATOR . $newName;

        if (is_dir($oldPath) && $item !== $newName) {
            if (file_exists($newPath)) {
                if ($resolveConflicts) {
                    // Append number to make unique
                    $counter = 1;
                    $tempString = '_temp_folder_' . $counter;
                    $uniqueNewPath = $newPath . $tempString;
                    while (file_exists($uniqueNewPath)) {
                        $counter++;
                        $tempString = '_temp_folder_' . $counter;
                        $uniqueNewPath = $newPath . $tempString;
                    }
                    
                    if (rename($oldPath, $uniqueNewPath)) {
                        if (!file_exists($newPath)) {
                            if (rename($uniqueNewPath, $newPath)) {
                                echo "Resolved conflict: Renamed '$item' to '" . basename($newPath) . "'\n";
                            }
                        } else {
                            echo "Resolved conflict: Renamed '$item' to '" . basename($uniqueNewPath) . "'\n";
                        }
                    } else {
                        echo "Error: Failed to resolve conflict for '$item'\n";
                    }
                } else {
                    echo "Warning: Skipping '$item' - '$newName' already exists\n";
                }
            } else {
                if (rename($oldPath, $newPath)) {
                    echo "Success: Renamed '$item' to '$newName'\n";
                } else {
                    echo "Error: Failed to rename '$item' to '$newName'\n";
                }
            }
        }
    }

    closedir($handle);
}

// Configuration
$targetDirectory = '.\test';
$resolveConflicts = true; // Set to false to skip conflicts instead of resolving

// Run the function
renameFoldersToLowercase($targetDirectory, $resolveConflicts);

echo "Process completed.\n";
?>