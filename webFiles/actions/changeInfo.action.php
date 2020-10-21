<?php

if(isset($_POST["change-submit"])){
    
    $firstName = $_POST['first-nameToChange'];
    $lastName = $_POST['last-nameToChange'];
    $phoneNumber = $_POST['phoneToChange'];
    $email = $_POST['emailToChange'];
    $password = $_POST['passToChange'];
    $password2 = $_POST['passToChange2'];

    require 'db.action.php';

    if(!empty($firstName) && preg_match("/^[a-zA-Z]*$/", $firstName)){
        $query = "UPDATE CLIENT SET FIRST_NAME=? WHERE ID=?";
        $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt,$sql)){
                header("Location: ../client.php?error=stmtfailedFirst");
                exit();            
            }else{
                mysqli_stmt_bind_param($stmt, "si", $firstName,$_SESSION['userID']);
                mysqli_stmt_execute($stmt);
            }
    }
    if(!empty($lastName) && preg_match("/^[a-zA-Z]*$/", $lastName)){
        $query = "UPDATE CLIENT SET LAST_NAME=? WHERE ID=?";
        $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt,$sql)){
                header("Location: ../client.php?error=stmtfailedLast");
                exit();            
            }else{
                mysqli_stmt_bind_param($stmt, "si", $lastName,$_SESSION['userID']);
                mysqli_stmt_execute($stmt);
            }
    }
    if(!empty($phoneNumber) && preg_match("/^[0-9]*$/", $phoneNumber)){
        $query = "UPDATE CLIENT SET PHONE=? WHERE ID=?";
        $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt,$sql)){
                header("Location: ../client.php?error=stmtfailedPhone");
                exit();            
            }else{
                mysqli_stmt_bind_param($stmt, "si", $phoneNumber,$_SESSION['userID']);
                mysqli_stmt_execute($stmt);
            }
    }
    if(!empty($password) && !empty($password2) && $password == $password2){
        $query = "UPDATE CLIENT SET PASSWORD=? WHERE ID=?";
        $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt,$sql)){
                header("Location: ../client.php?error=stmtfailedPass");
                exit();            
            }else{
                $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
                mysqli_stmt_bind_param($stmt, "si", $hashedPwd,$_SESSION['userID']);
                mysqli_stmt_execute($stmt);
            }
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    echo"here4";

}else{
    header("Location: ../client.php?failed");
    exit();
}