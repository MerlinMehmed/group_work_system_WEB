<?php
require_once "../libs/Init.php";
Init::_init(true);

use libs\Db;

$file = $_GET['file'];
$stmt = (new Db())->getConn()->prepare("DELETE FROM `document` WHERE content_url = ?");
$stmt->execute([$file]);
header("Location: ../ownFiles.php");
exit();
?>
