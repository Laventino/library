<?php
function getVideoDuration($videoPath) {
    $command = "ffprobe -v error -show_entries format=duration -of default=noprint_wrappers=1:nokey=1 {$videoPath}";
    exec($command, $output, $returnCode);
    
    if ($returnCode !== 0 || empty($output)) {
        throw new Exception("Could not get video duration");
    }
    
    return (float)$output[0];
}

function extractFramesEvenly($videoPath, $outputDir, $frameCount = 5) {
    // Create output directory if it doesn't exist
    if (!file_exists($outputDir)) {
        mkdir($outputDir, 0777, true);
    }
    
    // Get video duration
    $duration = getVideoDuration($videoPath);
    
    // Calculate time intervals
    $interval = $duration / ($frameCount + 1); // +1 to avoid first/last frames
    
    // Extract frames
    $successCount = 0;
    for ($i = 1; $i <= $frameCount; $i++) {
        $time = $interval * $i;
        $outputFile = $outputDir . '/frame_' . $i . '.jpg';
        
        $command = "ffmpeg -ss " . escapeshellarg($time) . 
                  " -i " . escapeshellarg($videoPath) . 
                  " -frames:v 1 -q:v 2 -y " . escapeshellarg($outputFile) . 
                  " 2>&1";
        
        exec($command, $output, $returnCode);
        
        if ($returnCode === 0 && file_exists($outputFile)) {
            $successCount++;
        }
    }
    
    return $successCount;
}

$videoPath = "C:\\Users\\Asus\\Desktop\\library\\test\\video\\video-1.mp4";
$outputDir = "C:\\Users\\Asus\\Desktop\\library\\test\\video\\cover";
$frameCount = 5;
// $res = getVideoDuration($videoPath);
$res =extractFramesEvenly($videoPath, $outputDir, $frameCount);
echo $res;
?>