<?php
require "login/checkLogin.php";
include 'includes/DatabaseConnection.php';
include 'includes/DatabaseFunctions.php';

$postId = $_GET['postId'];

try {
    likePost($pdo, $postId, $_SESSION['userId']);
    handleHeader($pdo, 
        $_SESSION['userId'], 
        'admin/admin_home.php', 
        'member/member_home.php');

} catch (Exception $e) {
    unlikePost($pdo, $postId, $_SESSION['userId']);
    handleHeader($pdo, 
        $_SESSION['userId'], 
        'admin/admin_home.php', 
        'member/member_home.php');
}