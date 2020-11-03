<?php

if(isset($_POST["signin-submit"])){
    
    $firstName = $_POST['first-name'];
    $lastName = $_POST['last-name'];
    $phoneNumber = $_POST['phone'];
    $emergencyName = $_POST['em_name'];
    $emergencyPhone = $_POST['em_phone'];
    $email = $_POST['email'];
    $password = $_POST['pass'];
    $password2 = $_POST['pass2'];
    $riderdef = 1;

    require 'db.action.php';


    if(empty($firstName) || empty($lastName) || empty($phoneNumber) || empty($email) || empty($password) || empty($password2)|| empty($emergencyName)|| empty($emergencyPhone)){
        header("Location: /systemsAnalysisTeamProject/webFiles/signup.php?error=emptyfields&first=".$firstName."&last=".$lastName."&phone=".$phoneNumber."&mail=".$email);
        exit();
    }else if(!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z]*$/", $firstName) && !preg_match("/^[a-zA-Z]*$/", $lastName) && !preg_match("/^[0-9]{11}$/", $phoneNumber) && !preg_match("/^[a-zA-Z]*$/", $emergencyName) && !preg_match("/^[0-9]*$/", $emergencyPhone) ){
        header("Location: /systemsAnalysisTeamProject/webFiles/signup.php?error=invalidemailfirstlastphoneemnameemphone");
        exit();
    }else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        header("Location: /systemsAnalysisTeamProject/webFiles/signup.php?error=invalidemail&first=".$firstName."&last=".$lastName."&phone=".$phoneNumber ."&emname=".$emergencyName."&emphone=".$emergencyPhone);
        exit();
    }else if(!preg_match("/^[a-zA-Z]*$/", $firstName)){
        header("Location: /systemsAnalysisTeamProject/webFiles/signup.php?error=invalidfirstName&last=".$lastName."&phone=".$phoneNumber."&mail=".$email."&emname=".$emergencyName."&emphone=".$emergencyPhone);
        exit();
    }else if(!preg_match("/^[a-zA-Z]*$/", $lastName)){
        header("Location: /systemsAnalysisTeamProject/webFiles/signup.php?error=invalidlastName&first=".$firstName."&phone=".$phoneNumber."&mail=".$email."&emname=".$emergencyName."&emphone=".$emergencyPhone);
        exit();
    }else if(!preg_match("/^[a-zA-Z]*$/", $emergencyName)){
        header("Location: /systemsAnalysisTeamProject/webFiles/signup.php?error=invalidemergency&first=".$firstName."&phone=".$phoneNumber."&mail=".$email."&emphone=".$emergencyPhone);
        exit();
    }else if(!preg_match("/^[0-9]*$/", $emergencyPhone)){
        header("Location: /systemsAnalysisTeamProject/webFiles/signup.php?error=invalidemphone&first=".$firstName."&last=".$lastName."&mail=".$email."&emname=".$emergencyName);
        exit();
        
    }else if(!preg_match("/^[0-9]*$/", $phoneNumber)){
        header("Location: /systemsAnalysisTeamProject/webFiles/signup.php?error=invalidphone&first=".$firstName."&last=".$lastName."&mail=".$email."&emname=".$emergencyName."&emphone=".$emergencyPhone);
        exit();
    }else if(strlen($password) < 8 || !preg_match('@[A-Z]@', $password) || !preg_match('@[a-z]@', $password) || !preg_match('@[0-9]@', $password)|| !preg_match('@[^\w]@', $password)){
        header("Location: /systemsAnalysisTeamProject/webFiles/signup.php?error=passwordweak&first=".$firstName."&last=".$lastName."&phone=".$phoneNumber."&mail=".$email ."&emname=".$emergencyName."&emphone=".$emergencyPhone);
        exit();    
    }else if($password !== $password2 ){
        header("Location: /systemsAnalysisTeamProject/webFiles/signup.php?error=passwordcheck&first=".$firstName."&last=".$lastName."&phone=".$phoneNumber."&mail=".$email ."&emname=".$emergencyName."&emphone=".$emergencyPhone);
        exit();
    }else{
        $sql = "SELECT * FROM CLIENT WHERE EMAIL=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("Location: /systemsAnalysisTeamProject/webFiles/signup.php?error=stmtfailed");
            exit();            
        }else{
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $resultData = mysqli_stmt_num_rows($stmt);
            if($resultData > 0){
                header("Location: /systemsAnalysisTeamProject/webFiles/signup.php?error=emailtaken");
                exit(); 
            }else{

            $sql = "INSERT INTO CLIENT(FIRST_NAME, LAST_NAME, EMAIL, PASSWORD, PHONE, RIDER_LVL, EMERGENCY_NAME, EMERGENCY_PHONE) VALUES(?,?,?,?,?,?,?,?)";
            $stmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt,$sql)){
                    header("Location: /systemsAnalysisTeamProject/webFiles/signup.php?error=stmtfailed");
                    exit();            
                }else{
                    $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
                    mysqli_stmt_bind_param($stmt, "ssssiiss", $firstName,$lastName,$email,$hashedPwd,$phoneNumber, $riderdef,$emergencyName,$emergencyPhone);
                    mysqli_stmt_execute($stmt);
                    header("Location: /systemsAnalysisTeamProject/webFiles/home.php?signup=success");
                    exit();            
                }
            }

        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    echo"here4";

}else{
    header("Location: /systemsAnalysisTeamProject/webFiles/signup.php?failedbecauseofme");
    exit();
}