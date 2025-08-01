<?php
require "../login/checkAdmin.php"; 
try{
    include '../includes/DatabaseConnection.php';
    include '../includes/DatabaseFunctions.php';

    if (isset($_POST['username'])){
        addNewUser($pdo,
        $_POST['username'],
        $_POST['password'],
        $_POST['fullName'],
        $_POST['DoB'],
        $_POST['email'],
        $_POST['phoneNumber'],
        $_POST['address'],
        $_FILES['userAvatar']['tmp_name'],
        $_POST['roleId']);
        header('Location: user_management.php');
    } else{
        $roles = getAllRoles($pdo);
        $users = getAllUsers($pdo);
        $title = "User Management";
        ob_start();
        include '../templates/admin/userManagement.html.php';
        $content = ob_get_clean();
    }

} catch (PDOException $e) {
    $title = 'Error';
    $content = 'Unable to connect to the database server.';
    $content .= '<p>Error message: ' . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . '</p>';
}
include '../templates/admin/admin_layout.html.php';
?>