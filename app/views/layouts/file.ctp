<?php
header('Content-type: ' . $file['Submission']['type']);
if(!isset($inpage)) header('Content-Disposition: attachment; filename="'.$file['Submission']['filename'].'"');
header("Content-length:". $file['Submission']['size']);
header("Cache-control: private");
echo $content_for_layout;
die();
?>