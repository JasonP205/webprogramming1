<?php
require "login/checkLogin.php";
include 'includes/DatabaseConnection.php';
include 'includes/DatabaseFunctions.php';
$commentId = $_GET['commentId'];
$postId = $_GET['postId'];  
if (isset($postId)) {
    try {
        deleteComment($pdo, $commentId);
        $_SESSION['message'] = 'Comment deleted successfully.';
        handleHeader($pdo, $_SESSION['userId'],'admin/detailPost.php?postId=' . $postId, 'member/detailPost.php?postId=' . $postId);
        exit();
    } catch (PDOException $e) {
        $_SESSION['error'] = 'Cannot delete this post because it is being used by some comments. ' . $e->getMessage();
        handleHeader($pdo, $_SESSION['userId'],'admin/detailPost.php?postId=' . $postId, 'member/detailPost.php?postId=' . $postId);
        exit();
    }
} else {
    $_SESSION['error'] = 'No post ID provided.';
    handleHeader($pdo, $_SESSION['userId'],'admin/detailPost.php?postId=' . $postId, 'member/detailPost.php?postId=' . $postId);
    exit();
}
?>