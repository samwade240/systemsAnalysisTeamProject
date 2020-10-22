<?php
    require 'header.php';
    require '../webFiles/actions/db.action.php';
?>
    <style><?php require 'client.css'?></style>


    <h1>Welcome!</br>
    <h2><?php echo("{$_SESSION['userFIRST']} "."{$_SESSION['userLAST']}"."<br />");?></h2>



    <?php
        $sql = "SELECT * FROM APPOINTMENT WHERE CLIENT_ID=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../client.php?error=sqlerror");
            exit();            
        }else{
            mysqli_stmt_bind_param($stmt, "s", $_SESSION["userID"]);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $arr = array();
            $timezone = date_default_timezone_set('America/New_York');
            $currDate = date('Y-m-d', time());

            while($row = mysqli_fetch_assoc($result)){

                if($row['RIDE_DAY'] > $currDate){
                    $arr[]=$row['RIDE_DAY'];   
                }
            }
            if(empty($arr)){
                $arr[0] = "The next day you sign up for";
            }
            $_SESSION['userRIDEDAYSMALLEST'] = min($arr);   
        }
    
    ?>

    <h2>Your Next Class is on: <?php echo("{$_SESSION['userRIDEDAYSMALLEST']} "."<br />");?></h2>

    <div class="login-box">
        <section>
            <h1>Change Information</h1>
            <form  method="post">
            <input type="hidden" name="uid" value=<?php echo($_SESSION['userFIRST']); ?>>
            <div class="textbox">
            <input type="text" name="first-nameToChange" value=<?php echo($_SESSION['userFIRST']); ?>>
            </div>
            <div class="textbox">
            <input type="text" name="last-nameToChange" value=<?php echo($_SESSION['userLAST']); ?>>
            </div>
            <div class="textbox">
            <input type="text" name="phoneToChange" value=<?php echo($_SESSION['userPHONE']); ?>>
            </div>
            <div class="textbox">
            <input type="text" name="emNameToChange" value=<?php echo($_SESSION['userEMNAME']); ?>>
            </div>
            <div class="textbox">
            <input type="text" name="emPhoneToChange" value=<?php echo($_SESSION['userEMPHONE']); ?>>
            </div>
            <div class="textbox">
            <input type="text" name="emailToChange" value=<?php echo($_SESSION['userEMAIL']); ?>>
            </div>
            <div class="textbox">
            <input type="password" name="passToChange" placeholder="Enter new Password" autocomplete="new-password">
            </div>
            <div class="textbox">
            <input type="password" name="passToChange2" placeholder="Re-enter Password" autocomplete="new-password">
            </div>
            <button type="submit" name="change-submit" class="btn">Change Information</button>
            </form>
        </section>
    </div>

<?php
    if(isset($_POST['change-submit'])){
                
    $firstName = $_POST['first-nameToChange'];
    $lastName = $_POST['last-nameToChange'];
    $phoneNumber = $_POST['phoneToChange'];
    $emName = $_POST['emNameToChange'];
    $emPhone = $_POST['emPhoneToChange'];
    $email = $_POST['emailToChange'];
    $password = $_POST['passToChange'];
    $password2 = $_POST['passToChange2'];

    require '../webFiles/actions/db.action.php';

    if(!empty($firstName) && preg_match("/^[a-zA-Z]*$/", $firstName)){
        $sql = "UPDATE CLIENT SET FIRST_NAME=? WHERE ID=" . $_SESSION['userID'];
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("Location: ../client.php?error=stmtfailedFirst");
            exit();            
        }else{
            mysqli_stmt_bind_param($stmt, "s", $firstName);
            mysqli_stmt_execute($stmt);
        }
    }   
    if(!empty($lastName) && preg_match("/^[a-zA-Z]*$/", $lastName)){
        $sql = "UPDATE CLIENT SET LAST_NAME=? WHERE ID=" . $_SESSION['userID'];
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("Location: ../client.php?error=stmtfailedLast");
            exit();            
        }else{
            mysqli_stmt_bind_param($stmt, "s", $lastName);
            mysqli_stmt_execute($stmt);
        }
    }   
    if(!empty($emName) && preg_match("/^[a-zA-Z]*$/", $emName)){
        $sql = "UPDATE CLIENT SET LAST_NAME=? WHERE ID=" . $_SESSION['userID'];
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("Location: ../client.php?error=stmtfailedemname");
            exit();            
        }else{
            mysqli_stmt_bind_param($stmt, "s", $emName);
            mysqli_stmt_execute($stmt);
        }
    }  
    if(!empty($emPhone) && preg_match("/^[0-9]*$/", $emPhone)){
        $sql = "UPDATE CLIENT SET PHONE=? WHERE ID=" . $_SESSION['userID'];
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("Location: ../client.php?error=stmtfailedemphone");
            exit();            
        }else{
            mysqli_stmt_bind_param($stmt, "s", $emPhone);
            mysqli_stmt_execute($stmt);
        }
    }    
    if(!empty($phoneNumber) && preg_match("/^[0-9]*$/", $phoneNumber)){
        $sql = "UPDATE CLIENT SET PHONE=? WHERE ID=" . $_SESSION['userID'];
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("Location: ../client.php?error=stmtfailedPhone");
            exit();            
        }else{
            mysqli_stmt_bind_param($stmt, "s", $phoneNumber);
            mysqli_stmt_execute($stmt);
        }
    }   
    if(!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)){
        $sql = "UPDATE CLIENT SET EMAIL=? WHERE ID=" . $_SESSION['userID'];
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("Location: ../client.php?error=stmtfailedEmail");
            exit();            
        }else{
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
        }
        }       
    if(!empty($password) && !empty($password2) && $password == $password2){
        $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
        $sql = "UPDATE CLIENT SET PASSWORD=? WHERE ID=" . $_SESSION['userID'];
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("Location: ../client.php?error=stmtfailedPass");
            exit();            
        }else{
            mysqli_stmt_bind_param($stmt, "s", $hashedPwd);
            mysqli_stmt_execute($stmt);
        }
    }   

    header("Location: ../client.php");
    exit();
}
        


