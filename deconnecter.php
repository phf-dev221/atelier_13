<?php 
session_start();
//var_dump($_SESSION['user']);
session_unset();
session_destroy();
header('location: inscription.php');
exit();

?>