<?php
require_once "../libs/Init.php";
Init::_init(true);

use libs\DocumentInfo;

function findDocument($fileName)
{
    $_SESSION['user'] = 'polly';

    $username = $_SESSION['user'];
    $path = $username."/".$fileName;

    $sql= "SELECT * FROM documents WHERE cotentUrl = ?";
    $stmt = (new Db())->getConn()->prepare($sql);
    $result = $stmt->execute([$path]);

    $row = $result->fetch_assoc();

    $document = new DocumentInfo(row['owner'], row['contentUrl'], row['lastUpdateUsername'], row['lastUpdateDate']);

    return $document;
}

?>