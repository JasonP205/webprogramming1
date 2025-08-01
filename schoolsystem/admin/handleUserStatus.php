<?php 
require "../login/checkAdmin.php"; 
include '../includes/DatabaseConnection.php';
include '../includes/DatabaseFunctions.php';
session_start();
if (!isset($_SESSION['userId']) || $_SESSION['roleId'] != 1) {
    $_SESSION['error'] = "You do not have permission to access this page.";
    session_start();
    session_unset();
    session_destroy();
    header('Location: ../login/loginPage.html.php');
    exit();
}
$userId = $_GET['userId'];
$selectedUser = getUserById($pdo, $userId);
if ($userId == $_SESSION['userId']) {
    $_SESSION['error'] = "You cannot disable your own account.";
    header('Location: user_management.php');
    exit();
} elseif ($SelectedUser['roleId'] == 1 && $userId != $_SESSION['userId'])  {
    $_SESSION['error'] = "You cannot make change on others admin account.";
    header('Location: user_management.php');
    exit();
} else {
    handleUserStatus($pdo, $userId);
    header('Location: user_management.php'); 
}
?>