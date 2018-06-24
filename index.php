<?php
// To - do index page
require_once "libs/Init.php";
Init::_init();

use libs\User;

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
    <title>Group work</title>
    <link href="style/style.css" rel="stylesheet" type="text/css">

</head>
<body>
<?php include ("navigation.php"); ?>
<div>Recent files: </div>
<ul>
    <li>a.txt</li>
    <li>b.txt</li>
</ul>
</ul>
</body>
</html>