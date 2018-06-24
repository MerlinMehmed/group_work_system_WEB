<?php
require_once "../libs/Init.php";
Init::_init(true);

use libs\DocumentInfo;

$document = new DocumentInfo($_POST['owner'], $_POST['documentUrl']);

$document->load();

?>