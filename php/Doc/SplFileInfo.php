<?php
$file = new SplFileInfo('C:\Users\Asus\Desktop\library\php\Doc\SplFileInfo.php');

#Basic File Information Methods
echo "Filename: " . $file->getFilename() . "\n";
echo "Basename: " . $file->getBasename('.php') . "\n"; // Without extension
echo "Pathname: " . $file->getPathname() . "\n";
echo "Path: " . $file->getPath() . "\n";
echo "Full path: " . $file->getRealPath() . "\n";

# File Type and Status Methods
echo "isFile: " . $file->isFile() . "\n";
echo "isDir: " . $file->isDir() . "\n";
echo "isLink: " . $file->isLink() . "\n";
echo "isReadable: " . $file->isReadable() . "\n";
echo "isWritable: " . $file->isWritable() . "\n";
echo "isExecutable: " . $file->isExecutable() . "\n";
echo "getType: " . $file->getType() . "\n";

#File Metadata Methods
echo "getExtension: " . $file->getExtension() . "\n";
echo "getSize: " . $file->getSize() . "\n";
echo "Last modified: " . date('Y-m-d H:i:s', $file->getMTime()) . "\n";
echo "Last accessed: " . date('Y-m-d H:i:s', $file->getATime()) . "\n";
echo "Create time: " . date('Y-m-d H:i:s', $file->getCTime()) . "\n";
