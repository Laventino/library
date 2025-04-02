<?php
$iterator = new DirectoryIterator('/path/to/directory');
foreach ($iterator as $fileinfo) {
    // Work with each file/directory
    echo $fileinfo->getFilename() . "\n";
}

# Common            Methods
# -----------------------------------------------------------
# Method	        Description
# -----------------------------------------------------------
# isDot()	        Checks if current item is "." or ".."
# -----------------------------------------------------------
# isDir()	        Checks if current item is a directory
# -----------------------------------------------------------
# isFile()	        Checks if current item is a regular file
# -----------------------------------------------------------
# getFilename()	    Gets the filename
# -----------------------------------------------------------
# getPathname()	    Gets the full path and filename
# -----------------------------------------------------------
# getExtension()	Gets the file extension
# -----------------------------------------------------------
# getSize()	        Gets file size in bytes
# -----------------------------------------------------------
# getMTime()	    Gets last modification time
# -----------------------------------------------------------
