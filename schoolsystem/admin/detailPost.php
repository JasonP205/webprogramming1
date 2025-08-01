<?php
require "../login/checkAdmin.php"; 
include '../includes/DatabaseConnection.php';
include '../includes/DatabaseFunctions.php';    
try {
$postId = $_GET['postId'];
$comments = getCommentsByPostId($pdo, $postId);
$selectedPost = getPostById($pdo, $postId);
$selectedPost['totalComments'] = totalCommentOfPost($pdo, $postId);
$selectedPost['totalReactions'] = totalReactionOfPost($pdo, $postId);
$title = 'Detail Post';
ob_start();
include '../templates/detailPost.html.php';
$content = ob_get_clean();
include '../templates/admin/admin_layout.html.php';
} catch (Exception $e) {
    $_SESSION['error'] = 'Error retrieving post details: ' . $e->getMessage();
    header( 'location: ../admin/admin_home.php',);
    exit();
}
?>

