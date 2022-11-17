<?php

$fileIndex = $_GET['fileKey'];
$logsArray = json_decode(file_get_contents('fileUploadLogs.json'), true);
$fileForDelete = $logsArray[$fileIndex];

// 1. Istrinti failai is data diro.
unlink($fileForDelete['path']);

// 2. Istrinti failo masyva os fileUploadLogs masyvo.
unset($logsArray[$fileIndex]);
file_put_contents('fileUploadLogs.json', json_encode($logsArray));

header("Location: ./index.php");
die();

