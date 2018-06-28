<?php
require_once "../libs/Init.php";
Init::_init(true);

use libs\Document;
use libs\DocumentInfo;

var_dump($_POST['content']);

$user = $_SESSION['username'];
$content = $_POST['content'];
$name = $_POST['fileName'];

$documentInfo = new DocumentInfo($user, $user."/".$name);
$documentInfo->insert();

$document = new Document($documentInfo, $content);
$document->writeFile();

$_SESSION['created'] = 'true';
header('Location: ../create.php');
exit();
?>
