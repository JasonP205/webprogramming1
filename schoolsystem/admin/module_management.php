<?php
require "../login/checkAdmin.php"; 

try {
    include '../includes/DatabaseConnection.php';
    include '../includes/DatabaseFunctions.php';
    $modules = getAllModules($pdo);
    $title = "Module Management";
    ob_start();
    include '../templates/admin/admin_module.html.php';
    $content = ob_get_clean();

} catch (PDOException $e) {
    $title = 'Error';
    $content = 'Unable to connect to the database server.';
    $content .= '<p>Error message: ' . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . '</p>';
}
include '../templates/admin/admin_layout.html.php';
?>
