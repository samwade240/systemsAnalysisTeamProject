<?php

if(isset($_POST['login-submit'])){
    
    require 'db.action.php';
    $email = $_POST['email'];
    $password = $_POST['pass'];

    if(empty($email) || empty($password)){
        header("Location: ../login.php?error=emptyfields");
        exit();
    }else{
        
    }


}else{
    header("Location: ../login.php");
    exit();
} 