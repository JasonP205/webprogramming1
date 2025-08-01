<?php
require "../login/checkAdmin.php"; 
session_start();
$title="Information Panel";
ob_start();
include '../templates/information.html.php';
$content = ob_get_clean();
include '../templates/admin/admin_layout.html.php';
?>