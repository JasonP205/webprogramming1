<?php 
require "login/checkLogin.php";
include 'includes/DatabaseConnection.php';
include 'includes/DatabaseFunctions.php';
$userId = $_POST['userId'];
if ($_SESSION['userId']== $userId) {
    session_start();
    session_unset();
    session_destroy();
    deleteUser($pdo, $userId);
    header('Location: index.php');
    exit();
} else {
    deleteUser($pdo, $userId);
    $_SESSION['message'] = 'User deleted successfully.';
    header('Location: admin/user_management.php');
}
