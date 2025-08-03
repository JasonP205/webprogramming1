<?php
require "../login/checkAdmin.php"; 

try{
    include '../includes/DatabaseConnection.php';
    include '../includes/DatabaseFunctions.php';

    if (isset($_POST['moduleName'])){
        addModule($pdo,
        strtoupper($_POST['moduleCode']),
        $_POST['moduleName'],
        $_FILES['moduleImage']['tmp_name'],
        $_POST['description']);
        $_SESSION['message'] = 'Module added successfully.';
        header('Location: module_management.php');
    } else{
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