<?php

require "../login/checkAdmin.php"; 
include '../includes/DatabaseConnection.php';
include '../includes/DatabaseFunctions.php';

$posts = getAllPosts($pdo);
foreach ($posts as &$post) {
    $post['totalComments'] = totalCommentOfPost($pdo, $post['postId']);
    $post['totalReactions'] = totalReactionOfPost($pdo, $post['postId']);
}
unset($post);
$likedPost = getLikedPostByUser($pdo, $_SESSION['userId']);
$modules = getAllModules($pdo);
$title = "Welcome Bluewich Forum Admin Site";
ob_start();
include '../templates/admin/admin_home.html.php';
$content = ob_get_clean();
include '../templates/admin/admin_layout.html.php';