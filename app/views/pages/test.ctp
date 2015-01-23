<?php
$string = 'test.doc.doc';
$file_parts = pathinfo('dir/' . $_FILES['file']['name']);
pr($file_parts);
?>
