<?php

if(isset($_POST['signup-submit'])){

    $firstName = $_POST['first-name'];
    $lastName = $_POST['last-name'];
    $phoneNumber = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['pass'];
    $password2 = $_POST['pass2'];


    if(empty($firstName) || empty($lastName) || empty($phoneNumber) || empty($email) || empty($password) || empty($password2)){
        header("Location: ../signup.php?error=emptyfields&first=".$firstName."&last=".$lastName."&phone=".$phoneNumber."&mail=".$email);
        exit();
    }else if(!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z]*$/", $firstName) && !preg_match("/^[a-zA-Z]*$/", $lastName) && !preg_match("/^[0-9]{11}$/", $phoneNumber)){
        header("Location: ../signup.php?error=invalidemailfirstlastphone");
        exit();
    }else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        header("Location: ../signup.php?error=invalidemail&first=".$firstName."&last=".$lastName."&phone=".$phoneNumber);
        exit();
    }else if(!preg_match("/^[a-zA-Z]*$/", $firstName)){
        header("Location: ../signup.php?error=invalidfirstName&last=".$lastName."&phone=".$phoneNumber."&mail=".$email);
        exit();
    }else if(!preg_match("/^[a-zA-Z]*$/", $lastName)){
        header("Location: ../signup.php?error=invalidlastName&first=".$firstName."&phone=".$phoneNumber."&mail=".$email);
        exit();
    }else if(!preg_match("/^[0-9]{11}$/", $phoneNumber)){
        header("Location: ../signup.php?error=invalidphone&first=".$firstName."&last=".$lastName."&mail=".$email);
        exit();
    }else if($password !== $password2 ){
        header("Location: ../signup.php?error=passwordcheck&first=".$firstName."&last=".$lastName."&phone=".$phoneNumber."&mail=".$email);
        exit();
    }else{
        $sql = "SELECT user FROM users WHERE usersid=?";
        $stmt;
    }


}else{
    header("Location: ../signup.php");
    exit();
}