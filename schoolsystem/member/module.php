<?php
require "../login/checkLogin.php";
try {
    include '../includes/DatabaseConnection.php';
    include '../includes/DatabaseFunctions.php';
    $modules = getAllModules($pdo);
    $title = "View Module";
    ob_start();
    include '../templates/member/module.html.php';
    $content = ob_get_clean();

} catch (PDOException $e) {
    $title = 'Error';
    $output = 'Unable to connect to the database server.';
    $output .= '<p>Error message: ' . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . '</p>';
}
include '../templates/member/member_layout.html.php';
?>
