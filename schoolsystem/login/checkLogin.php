<?php
session_start();

if (!isset($_SESSION['userId'])) {
    header('Location: /schoolsystem/login/loginPage.html.php'); 
}
?>
