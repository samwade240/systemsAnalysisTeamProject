<?php

if(isset($_POST['login-submit'])){
    
    require 'db.action.php';
    $email = $_POST['email'];
    $password = $_POST['pass'];

    if(empty($email) || empty($password)){
        header("Location: ../login.php?error=emptyfields");
        exit();
    }else{
        $sql = "SELECT * FROM CLIENT WHERE EMAIL=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../login.php?error=sqlerror");
            exit();            
        }else{
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $row = mysqli_fetch_assoc($result);
            if($row){
                $pwdCheck = password_verify($password, $row['PASSWORD']);
                if($pwdCheck == false){
                    header("Location: ../login.php?error=wrongpwd");
                    exit();          
                }else if($pwdCheck == true){
                    session_start();
                    $_SESSION['userID'] = $row['ID'];
                    $_SESSION['userEMAIL'] = $row['EMAIL'];
                    $_SESSION['userFIRST'] = $row['FIRST_NAME'];
                    $_SESSION['userLAST'] = $row['LAST_NAME'];
                    $_SESSION['userPHONE'] = $row['PHONE'];

                    
                    header("Location: ../home.php?login=success");
                    exit();         
                }
            }else{
                header("Location: ../login.php?error=wrongpwd");
                exit();            
            }
        }
    }


}else{
    header("Location: ../login.php");
    exit();
} 