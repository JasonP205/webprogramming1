<?php
require "../login/checkAdmin.php"; 
include '../includes/DatabaseConnection.php';
include '../includes/DatabaseFunctions.php';

$commentId = $_GET['commentId'];
$postId = $_GET['postId'];

if(isset($_POST['commentContent'])) {
    try {
        updateComment($pdo, $commentId, $_POST['commentContent'], $_FILES['commentImage']['tmp_name']);
        $_SESSION['message'] = 'Comment updated successfully.';
        handleHeader($pdo, $_SESSION['userId'], 'admin/detailPost.php?postId=' . $postId, 'member/detailPost.php?postId=' . $postId);
        exit;
    } catch (Exception $e) {
        $_SESSION['errorUploadComment'] = 'An error occurred while updating your comment: ' . $e->getMessage();
        handleHeader($pdo, $_SESSION['userId'], 'admin/detailPost.php?postId=' . $postId, 'member/detailPost.php?postId=' . $postId);
        exit;
    }
} else {
    $_SESSION['error'] = 'No comment content provided.';
    handleHeader($pdo, $_SESSION['userId'], 'admin/detailPost.php?postId=' . $postId, 'member/detailPost.php?postId=' . $postId);
    exit;
}