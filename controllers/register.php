<?php

require_once "../libs/Init.php";
Init::_init(true);

use libs\User;

$user = new User($_POST['username'], $_POST['password']);
$user->setEmail($_POST['email']);
$success = $user->insert();

if ($success)
{
    header('Location: ../index.php');
}
else
{
    header('Location: ../register.php?exists=true');
}

?>