<?php
require "../login/checkAdmin.php"; 

include '../includes/DatabaseConnection.php';
include '../includes/DatabaseFunctions.php';   
try{
    if (isset($_POST['moduleName'])){
        editModule($pdo, $_POST['moduleId'],
        $_POST['moduleName'],
        strtoupper($_POST['moduleCode']),
        $_POST['description']);
        if (isset($_FILES['moduleImage']) && $_FILES['moduleImage']['error'] == UPLOAD_ERR_OK) {
            updateImage($pdo, 'module', 
            'moduleImage', 
            $_FILES['moduleImage']['tmp_name'], 
            'moduleId', 
            $_POST['moduleId']);
        }
        header('location: module_management.php'); 
    } else {
        $module = getModuleById($pdo, $_POST['moduleId']);
        $title = "Edit Module";
        ob_start();
        include '../templates/admin/admin_editModule.html.php';
        $content = ob_get_clean();
        }
} catch (PDOException $e) {
        $title = 'Error';
        $content = 'Unable to connect to the database server.';
        $content .= '<p>Error message: ' . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . '</p>';
}
include '../templates/admin/admin_layout.html.php';
?>