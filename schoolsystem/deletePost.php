<?php
require "login/checkLogin.php";
include 'includes/DatabaseConnection.php';
include 'includes/DatabaseFunctions.php';
$postId = $_GET['postId'];  
if (isset($postId)) {
    try {
        deletePost($pdo, $postId);
        $_SESSION['message'] = 'Post deleted successfully.';
        handleHeader($pdo,
        $_SESSION['userId'],
        'admin/admin_home.php',
        'member/member_home.php');
        exit();
    } catch (PDOException $e) {
        $_SESSION['error'] = 'Cannot delete this post because it is being used by some comments. ' . $e->getMessage();
        handleHeader($pdo,
        $_SESSION['userId'],
        'admin/admin_home.php',
        'member/member_home.php');
        exit();
    }
} else {
    $_SESSION['error'] = 'No post ID provided.';
    handleHeader($pdo,
        $_SESSION['userId'],
        'admin/admin_home.php',
        'member/member_home.php');
    exit();
}
?>