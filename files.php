<?php
// To - do index page
require_once "libs/Init.php";
Init::_init();

use libs\User;
use libs\DocumentInfo;

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

</head>
<body>
<?php include ("navigation.php"); ?>

<div class="main">
    <?php include ("controllers/showOwnFiles.php");

    echo "<table>";
    echo "<tr><th colspan="."3".">Име на документа</th></tr>";
	echo "<tr><td id="."file".">"."lalalalalalala"."</td><td><button>"."Редактиране"."</button></td></tr>";


	echo "</table>";

    ?>

</div>
</body>
</html>