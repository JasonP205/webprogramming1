<?php
include '../includes/DatabaseConnection.php';
include '../includes/DatabaseFunctions.php';

if (isset($_POST['username'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    if (isExistingUser($pdo, $_POST['username'])){
        $user = getUserByUsername($pdo, $username);
        if (isActive($pdo, $user['userId']) == false) {
        session_start();
        $_SESSION['error'] = "Your account is currently deactivated. Please contact the administrator for assistance.";
        header('Location: loginPage.html.php');
        exit();
        }
    }
    
    


    if ($user && password_verify($password, $user['password'])) {
        session_start();
        $_SESSION['userId']=$user['userId'];
        $_SESSION['username']=$user['username'];
        $_SESSION['password']=$password;
        $_SESSION['fullName']=$user['fullName'];
        $_SESSION['DoB']=$user['DoB'];
        $_SESSION['email']=$user['email'];
        $_SESSION['phoneNumber']=$user['phoneNumber'];
        $_SESSION['roleName']=$user['roleName'];
        $_SESSION['userAvatar']=$user['userAvatar'];
        $_SESSION['createDate']=$user['createDate'];
        $_SESSION['roleId']=$user['roleId'];
        $_SESSION['address'] = $user['address'];
        $_SESSION['userStatus'] = $user['userStatus'];
        $_SESSION['isLogin'] = true;

        if ($_SESSION['roleId'] == 1) {
            header("Location: ../admin/admin_home.php");
        }   
        if ($_SESSION['roleId']==2) {
            header("Location: ../member/member_home.php");
        }   
        exit();
        
    }   else {
            session_start();
            $_SESSION['error'] = "Username or password is incorrect, please try again!";
            header('Location: loginPage.html.php');
            exit();
        }

    }
else {
    session_start();
    $_SESSION['error'] = "Username or password is incorrect, please try again!";
    header('Location: loginPage.html.php');
    exit();
}
