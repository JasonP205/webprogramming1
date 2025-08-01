<?php
require "../login/checkAdmin.php"; 
try{
    include '../includes/DatabaseConnection.php';
    include '../includes/DatabaseFunctions.php';
    deleteModule($pdo, $_POST['moduleId']);
    header('location: module_management.php'); 
} catch (PDOException $e) {
    session_start();
    $_SESSION['error'] = 'Cannot delete this module because it is being used by some posts.'. $e ->getMessage();
    $title = 'Error';
    header('location: module_management.php'); 

}
include '../templates/admin/admin_layout.html.php';
?>