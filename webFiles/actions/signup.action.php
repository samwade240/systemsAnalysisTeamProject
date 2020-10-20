<?php

if(isset($_POST["signin-submit"])){
    
    $firstName = $_POST['first-name'];
    $lastName = $_POST['last-name'];
    $phoneNumber = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['pass'];
    $password2 = $_POST['pass2'];

    require 'db.action.php';


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
    }else if(!preg_match("/^[0-9]*$/", $phoneNumber)){
        header("Location: ../signup.php?error=invalidphone&first=".$firstName."&last=".$lastName."&mail=".$email);
        exit();
    }else if($password !== $password2 ){
        header("Location: ../signup.php?error=passwordcheck&first=".$firstName."&last=".$lastName."&phone=".$phoneNumber."&mail=".$email);
        exit();
    }else{
        $sql = "SELECT * FROM CLIENT WHERE EMAIL=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("Location: ../signup.php?error=stmtfailed");
            exit();            
        }else{
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $resultData = mysqli_stmt_num_rows($stmt);
            if($resultData > 0){
                header("Location: ../signup.php?error=emailtaken");
                exit(); 
            }else{
            header("Location: ../signup.php?error=stmtfailed");

            $sql = "INSERT INTO CLIENT(FIRST_NAME, LAST_NAME, EMAIL, PASSWORD, PHONE) VALUES(?,?,?,?,?)";
            $stmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt,$sql)){
                    header("Location: ../signup.php?error=stmtfailed");
                    exit();            
                }else{
                    $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
                    mysqli_stmt_bind_param($stmt, "ssssi", $firstName,$lastName,$email,$hashedPwd,$phoneNumber);
                    mysqli_stmt_execute($stmt);
                    header("Location: ../signup.php?signup=success");
                    exit();            
                }
            }

        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    echo"here4";

}else{
    header("Location: ../signup.php?failedbecauseofme");
    exit();
}