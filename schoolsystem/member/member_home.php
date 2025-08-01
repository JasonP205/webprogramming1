<?php
require "../login/checkMember.php"; 
include '../includes/DatabaseConnection.php';
include '../includes/DatabaseFunctions.php';
$title = "Welcome Bluewich Forum";
$posts = getAllPosts($pdo);
foreach ($posts as &$post) {
    $post['totalComments'] = totalCommentOfPost($pdo, $post['postId']);
    $post['totalReactions'] = totalReactionOfPost($pdo, $post['postId']);
}
unset($post);
$likedPost = getLikedPostByUser($pdo, $_SESSION['userId']);
$modules = getAllModules($pdo);
ob_start();
include '../templates/member/member_home.html.php';
$content = ob_get_clean();
include '../templates/member/member_layout.html.php';