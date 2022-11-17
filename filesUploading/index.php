<?php
    $filesLogs = json_decode(file_get_contents('fileUploadLogs.json'), true);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Files Uploading</title>
    <style>
        td {
            border: 1px black solid;
            text-align: center;
            width: 33%;
        }
        table {
            width: 100%;
        }
        div {
            border: 1px black solid;
            padding: 10px;
            margin-bottom: 50px;
        }
    </style>
</head>
<body>
    <div>
        <form
                method="POST"
                action="fileUpload.php"
                enctype="multipart/form-data"
        >
            <input type="file" name="uploadedFile">
            <input type="submit" value="Upload">
        </form>
    </div>

    <div>
        <h2>Uploaded files</h2>

        <table>
            <tr>
                <td>Name</td>
                <td>Size (Bytes)</td>
                <td>Uploading date</td>
                <td>Methods</td>
            </tr>
            <?php foreach ($filesLogs as $fileLog): ?>
                <tr>
                    <td><?= $fileLog['name'] ?></td>
                    <td><?= $fileLog['size'] ?></td>
                    <td><?= $fileLog['dateCreated'] ?></td>
                    <td>
                        <form method="post" action="downloadFile.php">
                            <input type="hidden" name="filePath" value="<?= $fileLog['path']?> ">
                            <button type="submit">Download</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>