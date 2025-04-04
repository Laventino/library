<?php
function extractBracketedContent($string) {
    // Check if string starts with "["
    if (strpos($string, '[') === 0) {
        // Find the position of the closing "]"
        $endPos = strpos($string, ']');
        
        if ($endPos !== false) {
            // Extract content between [ and ]
            $content = substr($string, 1, $endPos - 1);
            return $content;
        }
    }
    
    // Return false or null if no bracketed content found
    return false;
}

// Example usage:
$testString1 = "[Hello] World";
$testString2 = "[No] brackets here";
$testString3 = "[Only opening bracket";

$result1 = extractBracketedContent($testString1); // Returns "Hello"
echo $result1;
$result2 = extractBracketedContent($testString2); // Returns false
echo $result2;
$result3 = extractBracketedContent($testString3); // Returns false
echo $result3;
