<?php

$file = $_POST['filePath'];

if (file_exists($file)) {
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.basename($file) . '"');
    header('Content-Length:' . filesize($file));
    readfile($file);

    die('Success');
} else {
    die('File not found');
}
