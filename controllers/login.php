<?php

require_once "../libs/Init.php";
Init::_init(true);

use libs\User;
var_dump($_POST['username']);
$user = new User($_POST['username'], $_POST['password']);

$exists = $user->load();

if ($exists)
{
    $_SESSION['username'] = $user->getUsername();
    header('Location: ../index.php');
}
else
{
    header('Location: ../login.php?exists=0');
}

?>