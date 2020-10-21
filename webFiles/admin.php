<?php
    require 'header.php';
    require '../webFiles/actions/db.action.php';
?>


    <h1>Welcome!</br>
    <h2><?php echo("{$_SESSION['adminFIRST']} "."{$_SESSION['adminLAST']}"."<br />");?></h2>



    <?php
        $sql = "SELECT * FROM APPOINTMENT WHERE CLIENT_ID=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../client.php?error=sqlerror");
            exit();            
        }else{
            mysqli_stmt_bind_param($stmt, "s", $_SESSION["adminID"]);
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