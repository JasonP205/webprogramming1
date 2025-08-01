<?php
require "login/checkLogin.php";
require 'includes/DatabaseConnection.php';
require 'includes/DatabaseFunctions.php';

$postId = $_GET['postId'];
$commentId = $_GET['commentId'];
try {
    if (isset($_POST['commentContent'])) {
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
        $title = 'Edit Comment';
        $selectedPost = getPostById($pdo, $postId);
        $selectedComment = getCommentById($pdo, $commentId);
        ob_start();
        include 'templates/editComment.html.php';
        $content = ob_get_clean();
        if($_SESSION['roleId'] == 1) {
            include 'templates/admin/admin_layout.html.php';
            exit();
        } else {
            include 'templates/member/member_layout.html.php';
            exit();
        }
    }
} catch (Exception $e){
    echo $e->getMessage();
}