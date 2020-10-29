<?php
        

if(isset($_POST["change-submit"])){

    require 'db.action.php';

    $firstName = $_POST['first-nameToChange'];
    $lastName = $_POST['last-nameToChange'];
    $phoneNumber = $_POST['phoneToChange'];
    $email = $_POST['emailToChange'];
    $password = $_POST['passToChange'];
    $password2 = $_POST['passToChange2'];
    $ID = $_POST['uid'];


    $sqlStart="UPDATE CLIENT SET ";
    $sql="";
    if (!empty($firstName)) $sql .= " FIRST_NAME='$firstName',";
    if (!empty($lastName)) $sql .= " LAST_NAME='$lastName',";
    if (!empty($phoneNumber)) $sql .= " PHONE='$phoneNumber,'";
    if (!empty($email)) $sql .= " EMAIL='$email,'";
    if (!empty($password)) $sql .= " PASSWORD='$password,'";

    $sql .= " WHERE ID=" . $ID;

    if ($sql != "") {
        $sql = substr($sql, 0, -1) . ";";
        $sqlCommand = $sqlStart.$sql;
        mysqli_stmt_execute($sqlCommand);

    } else {
        // no fields to update
    }    

}else{
    header("Location: ../webFiles/signup.php?failedbecauseofme");
    exit();
}