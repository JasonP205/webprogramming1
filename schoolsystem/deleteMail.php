<?php
require "login/checkLogin.php";
include 'includes/DatabaseConnection.php';
include 'includes/DatabaseFunctions.php';
$mailId = $_GET['mailId'];
try {
    deleteMail($pdo, $mailId);
    $_SESSION['message'] = 'Mail deleted successfully.';
    handleHeader($pdo, $_SESSION['userId'], 'admin/mail.php', 'member/mail.php');
} catch (Exception $e){
    $_SESSION['error'] = 'Cannot delete mail at this time. Please try again later. Error: ' . $e->getMessage();
    handleHeader($pdo, $_SESSION['userId'], 'admin/mail.php', 'member/mail.php');
    exit();
}