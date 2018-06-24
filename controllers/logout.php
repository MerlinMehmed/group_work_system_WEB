<?php

session_start();
$_SESSION['username'] = null;
unset($_SESSION['username']);
session_destroy();
header("Location: ../homepage.html");
exit();

?>