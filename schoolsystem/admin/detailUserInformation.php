<?php 
require "../login/checkAdmin.php"; 
include '../includes/DatabaseConnection.php';
include '../includes/DatabaseFunctions.php';    
session_start();
$userId =$_GET['userId'];
if ($userId == $_SESSION['userId']) {
    header('Location: ../admin/information.php');
    exit();
} 

$selectedUser = getUserById($pdo, $_GET['userId']);
$title = "User Information";
ob_start();
include '../templates/admin/detailUserInformation.html.php';
$content = ob_get_clean();
include '../templates/admin/admin_layout.html.php';
?>