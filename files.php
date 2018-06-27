<?php
// To - do index page
require_once "libs/Init.php";
Init::_init();

use libs\User;
use libs\DocumentInfo;
use libs\Db;

$user = new User("");
if (isset($_SESSION['username']) && $_SESSION['username'])
{
    $user->setUsername($_SESSION['username']);
    $user->load();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="image/group.png" type="image/png"/>
    <title>Групова работа</title>
    <link href="style/files.css" rel="stylesheet" type="text/css">
	<link href="style/nav.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php include ("navigation.php"); ?>

<div class="main">
    <?php

    $username  = $user->getUsername();

    $sql= "SELECT `owner`,`content_url` FROM `document`  WHERE `id` IN (SELECT `id_document` FROM `user_document` WHERE `username`= ? )";
    $stmt = (new Db())->getConn()->prepare($sql);
	$stmt->execute(["$username"]);

    if($stmt->rowCount() > 0) {
        echo "<table>";
        echo "<tr><th colspan=" . "3" . ">Име на документа</th></tr>";

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$content_url = $row['content_url'];
            $owner = $row['owner'];
            $str = substr($row['content_url'], strlen($owner) + 1);
            echo "<tr><td id=\"" . "file" . "\">" . $str . "</td><td><button onclick='location.href=`edit.php?file=" . $content_url . "`'>" . "Редактиране" . "</button></td>";

        }

        echo "</table>";
    } else {
        echo "<p> Все още нямате споделени файлове!</p>";
    }
    ?>

</div>
</body>
</html>