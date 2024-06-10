<?php
$directoryToMonitor = ".."; // you can modify this to be more specific
$latest_mtime = 0;
$rii = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directoryToMonitor));
foreach ($rii as $file) {
    if ($file->isDir()){ 
        continue;
    }
    $mtime = $file->getMTime();
    if($mtime > $latest_mtime) {
        $latest_mtime = $mtime;
    }
}
echo $latest_mtime;
?>

