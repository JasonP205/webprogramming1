<?php
require "login/checkLogin.php";
include 'includes/DatabaseConnection.php';
include 'includes/DatabaseFunctions.php';
session_start();
try {
    if (isset($_FILES['userAvatar'])) {
        updateImage($pdo, 'user', 
        'userAvatar', 
        $_FILES['userAvatar']['tmp_name'], 
        'userId', 
        $_SESSION['userId']);
        $updatedUser = getUserById($pdo, $_SESSION['userId']);
        $_SESSION['userAvatar'] = $updatedUser['userAvatar'];
        $_SESSION['message'] = 'Avatar changed successfully.';
        handleHeader($pdo, 
        $_SESSION['userId'], 
        'admin/information.php', 
        'member/information.php');

    }
} catch (PDOException $e) {
    $error = 'Unable to change avatar. Please try again.';
}
?>