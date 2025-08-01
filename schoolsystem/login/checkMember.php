<?php
session_start();

if (!isset($_SESSION['userId']) || $_SESSION['roleId'] != 2) {
    session_unset();
    session_destroy();
    header('Location: /schoolsystem/login/loginPage.html.php'); 
}
?>
