<?php
require 'login/checkLogin.php';
include 'includes/DatabaseConnection.php';
include 'includes/DatabaseFunctions.php';
$postId = $_POST['postId'];
try {
    if(isset($_POST['commentContent'])) {
        addComment($pdo,
            $_POST['postId'],
            $_SESSION['userId'],
            $_POST['commentContent'],
            $_FILES['commentImage']['tmp_name']);
        handleHeader($pdo, $_SESSION['userId'],'admin/detailPost.php?postId=' . $_POST['postId'], 'member/detailPost.php?postId=' . $_POST['postId']);
        exit;
    }
} catch (Exception $e) {
    $_SESSION['errorUploadComment'] = 'An error occurred while processing your request: ' . $e->getMessage();
    handleHeader($pdo, $_SESSION['userId'],'admin/detailPost.php?postId=' . $_POST['postId'], 'member/detailPost.php?postId=' . $_POST['postId']);
    exit;
}
?>