<?php
require_once "../libs/Init.php";
Init::_init(true);

use libs\DocumentInfo;

function updateFile($fileName)
{
    $_SESSION['user'] = 'polly';

    $username = $_SESSION['user'];
    $path = $username."/".$fileName;

    $sql= "UPDATE documents SET lastUpdateUsername = '$username', lastUpdateDate = 'date('d-m-Y H:i:s')'  WHERE contentUrl = '$path'";
    $stmt = (new Db())->getConn()->prepare($sql);
    $result = $stmt->execute();

    $dataToWrite = $_POST['text'];
    $filePath = "users/" . $path;

    $fileHandle = fopen($filePath, 'w');
    fwrite($fileHandle, $dataToWrite);
    fclose($fileHandle);
}
?>