<?php
require_once "libs/Init.php";
Init::_init();

use libs\Db;
use libs\DocumentInfo;

function findDocument($fileName)
{
    $username = $_SESSION['username'];
    $path = $fileName;

    $sql= "SELECT * FROM document WHERE content_url = ?";
    $stmt = (new Db())->getConn()->prepare($sql);
    $stmt->execute([$path]);

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $document = new DocumentInfo($row['owner'], $row['content_url']);
    $document->setLastUpdateUsername($row['last_update_user']);
    $document->setLastUpdateDate($row['last_update_date']);
    $document->setId($row['id']);

    return $document;
}

?>