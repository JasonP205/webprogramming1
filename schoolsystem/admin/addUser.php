<?php
require "../login/checkAdmin.php"; 

try{
    include '../includes/DatabaseConnection.php';
    include '../includes/DatabaseFunctions.php';

    if (isset($_POST['username'])){
        if (isExistingUser($pdo, $_POST['username'])) {
                session_start();
                $_SESSION['error'] = "Username already exists. Please choose a different username.";
                header('Location: user_management.php');
                exit();
            }
        addNewUser($pdo,
        $_POST['username'],
        $_POST['password'],
        $_POST['fullName'],
        $_POST['DoB'],
        $_POST['email'],
        $_POST['phoneNumber'],
        $_POST['address'],
        $_FILES['userAvatar']['tmp_name'],
        $_POST['roleId']);
        $_SESSION['message'] = "User added successfully.";
        header('Location: user_management.php');

    } else{
        $roles = getAllRoles($pdo);
        $title = "Add Module";
        ob_start();
        include '../templates/admin/addModule.html.php';
        $content = ob_get_clean();
    }

} catch (PDOException $e) {
    $title = 'Error';
    $content = 'Unable to connect to the database server.';
    $content .= '<p>Error message: ' . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . '</p>';
}
include '../templates/admin/admin_layout.html.php';
?>