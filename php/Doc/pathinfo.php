<?php
$info = pathinfo('/path/to/your/file.txt');

echo "Directory: " . $info['dirname'] . "\n";
echo "Filename: " . $info['basename'] . "\n";
echo "Extension: " . $info['extension'] . "\n";
echo "Filename without extension: " . $info['filename'] . "\n";