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
    <link href="style/index.css" rel="stylesheet" type="text/css">

</head>
<body>
<?php include ("navigation.php"); ?>

<div class="main">
    <?php

    $username  = $user->getUsername();

    $sql= "SELECT * FROM `document`  WHERE `owner` = '$username' ORDER BY `last_update_date` DESC";
    $stmt = (new Db())->getConn()->query($sql);

    if($stmt->rowCount() > 0) {
        echo "<table>";
        echo "<tr><th>Име на документа</th><th>Редактиран от</th><th>Дата на последна редакция</th></tr>";

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $content_url = $row['content_url'];
            $str = substr($row['content_url'], strlen($username) + 1);
            echo "<tr><td><a href='edit.php?file=" . $row['content_url'] . "'>" . $str . "</a></td><td>" . $row['last_update_user'] . "</td><td>" . $row['last_update_date'] . "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "<p> Все още нямате добавени документи.</p>";
    }
    ?>

</div>
</body>
</html>