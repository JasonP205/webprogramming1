<?php
require "../login/checkMember.php"; 
include '../includes/DatabaseConnection.php';
include '../includes/DatabaseFunctions.php';    

$postId = $_GET['postId'];
$comments = getCommentsByPostId($pdo, $postId);
$selectedPost = getPostById($pdo, $postId);
$selectedPost['totalComments'] = totalCommentOfPost($pdo, $postId);
$selectedPost['totalReactions'] = totalReactionOfPost($pdo, $postId);
$title = 'Detail Post';
ob_start();
include '../templates/detailPost.html.php';
$content = ob_get_clean();
include '../templates/member/member_layout.html.php';
?>