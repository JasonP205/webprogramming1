<?php
require "login/checkLogin.php";
include 'includes/DatabaseConnection.php';
include 'includes/DatabaseFunctions.php';
try{
    if (isset($_POST['fullName'])) {
        

        updateProfile($pdo, $_SESSION['userId'],
        $_POST['fullName'],
        $_POST['password'],
        $_POST['DoB'],
        $_POST['email'], 
        $_POST['phoneNumber'], 
        $_POST['address'],
        $_FILES['userAvatar']['tmp_name']);
        $updatedUser = getUserById($pdo, $_SESSION['userId']);
        $_SESSION['fullName'] = $updatedUser['fullName'];
        $_SESSION['password'] = $updatedUser['password'];
        $_SESSION['DoB'] = $updatedUser['DoB'];
        $_SESSION['email'] = $updatedUser['email'];
        $_SESSION['phoneNumber'] = $updatedUser['phoneNumber'];
        $_SESSION['address'] = $updatedUser['address'];
        $_SESSION['userAvatar'] = $updatedUser['userAvatar'];
        $_SESSION['message'] = 'Profile updated successfully.';
        handleHeader($pdo, $_SESSION['userId'],'admin/information.php','member/information.php');
    }
} catch (Exception $e) {
    session_start();
    $_SESSION['errorUpdateFail'] = 'Cannot update profile at this time. Please try again later. Error: ' . $e->getMessage();
    handleHeader($pdo, $_SESSION['userId'],'admin/information.php','member/information.php');
    exit();
}


?>