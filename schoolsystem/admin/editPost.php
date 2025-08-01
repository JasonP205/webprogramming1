<?php

require "../login/checkAdmin.php"; 
include '../includes/DatabaseConnection.php';
include '../includes/DatabaseFunctions.php';

$postId = $_GET['postId'];
$selectedPost = getPostById($pdo,$postId);
$modules = getAllModules($pdo);
try {
    if(isset($_POST['postTitle'])){
        editPost($pdo,
        $_POST['postId'],
        $_POST['postTitle'],
        $_POST['postContent'],
        $_FILES['image']['tmp_name'],
        $_POST['moduleId']);
        header('location: ../admin/admin_home.php');
        exit;
    } else {
        $title = 'Edit post';
        ob_start();
        include '../templates/editPostForm.html.php';
        $content = ob_get_clean();
        include '../templates/admin/admin_layout.html.php';
    }
}catch(Exception $e){
    $_SESSION['error'] = 'Can not edit this post at this time, please try later!';
    header('location: ../admin/admin_home.php');
    exit;
}
?>