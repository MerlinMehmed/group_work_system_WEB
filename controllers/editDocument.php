<?php

use libs\Document;

include 'findDocument.php';

$fileName = $_GET['file'];

$documentInfo = findDocument($fileName);
$document = new Document($documentInfo, null);
$document -> loadContent();

?>