<?php
function renameFilesRandomly($path, $extensions = []) {
    $iterator = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($path, RecursiveDirectoryIterator::SKIP_DOTS),
        RecursiveIteratorIterator::SELF_FIRST
    );

    foreach ($iterator as $file) {
        if ($file->isFile()) {
            $extension = strtolower($file->getExtension());
            if (in_array($extension, $extensions)) {
                $directory = $file->getPath();
                
                do {
                    $randomName = bin2hex(random_bytes(8)); // 16-character random name
                    $newName = $randomName . ($extension ? '.' . $extension : '');
                    $newPath = $directory . DIRECTORY_SEPARATOR . $newName;
                } while (file_exists($newPath));
                
                rename($file->getPathname(), $newPath);
                echo "Renamed '" . $file->getFilename() . "' to '$newName'\n";
            }
        }
    }
}


// Usage: specify the folder path
$targetDirectory = './test';
$extensions = ['mp4', 'jpg'];
renameFilesRandomly($targetDirectory, $extensions);