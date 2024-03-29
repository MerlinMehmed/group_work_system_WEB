<?php
require_once "../libs/Init.php";
Init::_init(true);

use libs\Document;
use libs\DocumentInfo;
use libs\Db;

var_dump($_POST['content']);

$user = $_SESSION['username'];
$content = $_POST['content'];
$name = $_POST['fileName'];

$documentInfo = new DocumentInfo($user, $user."/".$name);
$documentInfo->insert();

$document = new Document($documentInfo, $content);
$document->writeFile();

$documentInfo->load();

$users1 = $_POST['user1'];
var_dump($_POST['user1']);
if (!empty($users1))
{
	foreach ($users1 as $userToBeAdded) {
		$documentInfo->addRight($userToBeAdded);
	}
}

$users2 = $_POST['user2'];
if (!empty($users2))
{
	foreach ($users2 as $userToBeRemoved) {
		$documentInfo->removeRight($userToBeRemoved);
	}
}

header('Location: ../ownFiles.php');
exit();
?>
