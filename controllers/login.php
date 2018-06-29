<?php

require_once "../libs/Init.php";
Init::_init(true);

use libs\User;
var_dump($_POST['username']);
$user = new User($_POST['username'], $_POST['password']);
$dbUser = new User($_POST['username'], "");
$exists = $dbUser->load();

var_dump($user);
var_dump($dbUser);
if($user->getPassword() != $dbUser->getPassword())
{
    echo 'not equals';
    header('Location: ../login.php?wrong=0');
    exit();
}
elseif ($exists)
{
    $_SESSION['username'] = $user->getUsername();
    header('Location: ../index.php');
    exit();
}
else
{
    header('Location: ../login.php?exists=0');
    exit();
}

?>