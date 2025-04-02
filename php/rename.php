<?php
$oldFolderPath = './test/test-a-2------ ------113 - Copy 3';
$newFolderName = 'test-1-2-4';
renameFolder($oldFolderPath, $newFolderName);
function renameFolder($oldFolderPath, $newFolderName) {
    try {
        $directoryPath = dirname($oldFolderPath);
        $newFolderPath = $directoryPath . '/' . $newFolderName;
        if (!is_dir($oldFolderPath)) return false;
        if (!rename($oldFolderPath, $newFolderPath)) return false;
    } catch (Exception $e) {
        return false;
    }
    return true;
}
?>