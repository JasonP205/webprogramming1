<?php 
require "../login/checkAdmin.php"; 
include '../includes/DatabaseConnection.php';
include '../includes/DatabaseFunctions.php';

try{ 
    if (isset($_POST['fullName'])) {
        editMember($pdo,
            $_POST['userId'],
            $_POST['fullName'],
            $_POST['email'],
            $_POST['phoneNumber'],
            $_POST['address'],
            $_POST['roleId']);
            header('Location: user_management.php');
    } else {
        $selectedUser = getUserById($pdo, $_POST['userId']);
        $roles = getAllRoles($pdo);
        $title = "Edit Member";
        ob_start();
        include '../templates/admin/editMemberForm.html.php';
        $content = ob_get_clean();
        include '../templates/admin/admin_layout.html.php';
    }
} catch (Exception $e){
    session_start();
    $_SESSION['errorEditFail'] = "Cannot edit member information at this time. Please try again later.";
    header('Location: user_management.php');
    exit();
}