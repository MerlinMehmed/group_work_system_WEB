<?php
require_once "../libs/Init.php";
Init::_init(true);

use libs\DocumentInfo;

function showFiles()
{
	$username = $_SESSION['user'];

	$sql= "SELECT * FROM user_document WHERE username = ?";
	$stmt = (new Db())->getConn()->prepare($sql);
	$result = $stmt->execute([$username]);

	$documentArray = array();

	while($row = $result->fetch_assoc()){
		$document = new DocumentInfo(row['owner'], row['contentUrl'], row['lastUpdateUsername'], row['lastUpdateDate']);
		$documentArray[] = $document;
	}

	return $documentArray;
}
?>