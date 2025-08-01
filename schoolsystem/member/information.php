<?php
require "../login/checkMember.php"; 
session_start();
$title="Information Panel";
ob_start();
include '../templates/information.html.php';
$content = ob_get_clean();
include '../templates/member/member_layout.html.php';
?>