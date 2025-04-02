<?php

$dirPath = './test';

function updateImageExtensions($dirPath) {
    $iterator = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($dirPath, RecursiveDirectoryIterator::SKIP_DOTS),
        RecursiveIteratorIterator::SELF_FIRST
    );

    $imageExtensions = ['png', 'webp']; // Add more if needed

    foreach ($iterator as $file) {
        if ($file->isDir()) {
            continue;
        }

        $filePath = $file->getPathname();
        $extension = strtolower($file->getExtension());

        if (in_array($extension, $imageExtensions)) {
            $newFilePath = $file->getPath() . DIRECTORY_SEPARATOR . $file->getBasename(".$extension") . '.jpg';
            if (rename($filePath, $newFilePath)) {
                echo "Renamed: $filePath -> $newFilePath\n";
            } else {
                echo "Failed to rename: $filePath\n";
            }
        }
    }
}

updateImageExtensions($dirPath);