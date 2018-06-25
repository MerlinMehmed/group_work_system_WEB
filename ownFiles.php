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
    <link href="style/ownFiles.css" rel="stylesheet" type="text/css">

</head>
<body>
<?php include ("navigation.php"); ?>

<div class="main">
    <?php

    $username  = $user->getUsername();

    $sql= "SELECT `content_url` FROM `document`  WHERE `owner` = '$username' ORDER BY `last_update_date` DESC";
    $stmt = (new Db())->getConn()->query($sql);

	echo "<button id="."create".">"."Създаване на собствен файл"."</button>";
    echo "<table>";
    echo "<tr><th colspan="."3".">Име на документа</th></tr>";  

    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){

        $str = substr($row['content_url'],strlen($username)+1);
        echo "<tr><td id="."file".">".$str."</td><td><button>"."Редактиране"."</button></td><td><button>"."Изтриване"."</button></td></tr>";

    }
    echo "</table>";
	

    ?>

</div>
</body>
</html>