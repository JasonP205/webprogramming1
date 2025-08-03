<?php
require "login/checkLogin.php";
include 'includes/DatabaseConnection.php';
include 'includes/DatabaseFunctions.php';
try{
    addNewPost($pdo,
        $_POST['postTitle'],
        $_POST['postContent'],
        $_FILES['image']['tmp_name'],
        $_SESSION['userId'],
        $_POST['moduleId']);
        $_SESSION['message'] = 'Post uploaded successfully.';
        handleHeader($pdo, $_SESSION['userId'], 'admin/admin_home.php', 'member/member_home.php');
} catch (Exception $e) {
    $_SESSION['errorUploadPost'] = 'Unable to upload post. Please try again.'. $e->getMessage();
    handleHeader($pdo, $_SESSION['userId'], 'admin/admin_home.php', '/member/member_home.php');
}
