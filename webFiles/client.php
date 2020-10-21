<?php
    require 'header.php';
    require '../webFiles/actions/db.action.php';
?>


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
            <form action="actions/changeInfo.action.php" method="post">
            <div class="textbox">
            <input type="text" name="first-nameToChange" placeholder=<?php echo($_SESSION['userFIRST']); ?>>
            </div>
            <div class="textbox">
            <input type="text" name="last-nameToChange" placeholder=<?php echo($_SESSION['userLAST']); ?>>
            </div>
            <div class="textbox">
            <input type="text" name="phoneToChange" placeholder=<?php echo($_SESSION['userPHONE']); ?>>
            </div>
            <div class="textbox">
            <input type="text" name="emailToChange" placeholder=<?php echo($_SESSION['userEMAIL']); ?>>
            </div>
            <div class="textbox">
            <input type="password" name="passToChange" placeholder="Enter new Password">
            </div>
            <div class="textbox">
            <input type="password" name="passToChange2" placeholder="Re-enter Password">
            </div>
            <button type="submit" name="change-submit" class="btn">Change Information</button>
            </form>

        </section>
    </div>
