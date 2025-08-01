<?php
require "../login/checkMember.php"; 
include '../includes/DatabaseConnection.php';
include '../includes/DatabaseFunctions.php';

if (isset($_POST['subject'])){
    if ($_SESSION['userId']==$_POST['to']) {
        $_SESSION['message'] = "You cannot send a mail to yourself!";
        header('location:mail.php');
        exit();
    }
    sendMail($pdo, $_SESSION['userId'], 
        $_POST['to'], 
        $_POST['subject'], 
        $_POST['message']);
    $_SESSION['message'] = "Mail sent successfully!";
    header('location:mail.php');
}
$receiver = getAllUsers($pdo);
$title = "Mailbox";
$sentsMail= getAllSentMailOfUser($pdo, $_SESSION['userId']);
$receivedMail = getAllReceivedMailOfUser($pdo, $_SESSION['userId']);
ob_start();
include '../templates/mail.html.php';
$content = ob_get_clean();
include '../templates/member/member_layout.html.php';