<?php
/*
Failų valdymo panelė.
1. Atvaizduokite formą, kuri leistų upload'inti .png ir .jpeg .webp failus į serverį. Failų dydžio limitas - 1MB.
Uploadintas failas turi atsirasti ./data direktorijoje su unikaliu pavadinimu.
Failo metaduomenys (failo pavadinimas, dydis, path'as, įkėlimo data) turėtų būti išsaugomi atskirame faile.
2. Pridėti puslapį, kuriame būtų atvaizduojami visi pauplodinti failai. Turėtų būti matoma:
- failo pavadinimas (kokį buvo priskyręs vartotojas)
- failo dydis
- įkėlimo data
Paspaudus ant tam tikro failo turėtų jį parsiųsti į vartotojo kompiuterį.
3. Prie kiekvieno failo pridėti mygtuką, kurį paspaudus, failas bus ištrintas iš ./data direktorijos, taip pat
iš failo, kuriame saugomi metaduomenys.
*/

$allowedFileTypes = [
    "image/png",
    "image/jpeg",
    "image/jpg",
    "image/webp",
];
$allowedFileSize = 1000000;
$uploadedFile = $_FILES['uploadedFile'];

// File validation
if (!in_array($uploadedFile['type'], $allowedFileTypes)) {
    die('Wrong file type');
}

if ($uploadedFile['size'] > $allowedFileSize) {
    die('File size is to large. Allowed size is 1MB');
}

if ($uploadedFile['error'] !== 0) {
    die('Error uploading file');
}

// File saving.
$uniqueFileName =  uniqid() . '_' . $uploadedFile['name'];
$fileSavePath = './data/' . $uniqueFileName;
$tempFilePath = $uploadedFile['tmp_name'];
$result = move_uploaded_file($tempFilePath, $fileSavePath);

if (!$result) {
    die('Something wrong! Call Senior!');
}
// Save metadata.
$fileMetaData = [
    'name' => $uploadedFile['name'],
    'size' => $uploadedFile['size'],
    'path' => $fileSavePath,
    'dateCreated' => date('Y/m/d H:i:s'),
];

$logsArray = json_decode(file_get_contents('fileUploadLogs.json'), true);
$logsArray[] = $fileMetaData;
file_put_contents('fileUploadLogs.json', json_encode($logsArray));
die('Success.');



