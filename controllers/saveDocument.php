<?php
require_once "../libs/Init.php";
Init::_init(true);

use libs\Document;
use libs\DocumentInfo;
use libs\Db;

var_dump($_POST['content']);

$name = $_POST['fileName'];
$user = $_SESSION['username'];
$filePath = $user."/".$name;
$content = $_POST['content'];

$documentInfo = new DocumentInfo($user, $filePath);
$documentInfo->load();

$document = new Document($documentInfo, $content);
$document->writeFile();

$documentInfo->load();

$stmt = (new Db())->getConn()->prepare("UPDATE `document` SET last_update_user = '".$user."', last_update_date = '".date("Y-m-d h:i:sa")."' WHERE content_url = ?");
$stmt->execute([$filePath]);

$users1 = $_POST['user1'];
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
	
header('Location: ../edit.php?file='.$filePath);
exit();
?>
