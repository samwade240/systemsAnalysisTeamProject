<?php
    require '../header.php';
    require 'db.action.php';
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
            $count = 0;
            while($row = mysqli_fetch_assoc($result)){
                    $arr[]=$row;   
                    $count++;
            }

            $tmp = $arr[0]['RIDE_DAY'];
            $lowest = strtotime($tmp);
            while($count > 0){
                $tmp = $arr[$count]['RIDE_DAY'];
                $toCheck = strtotime($tmp);
                if($lowest > $toCheck){
                    $lowest = $toCheck;
                }
                $count--;
            }

            $_SESSION['userRIDEDAY'] = $tmp;   

        }
    
    ?>

    <h2>Your Next Class is on: <?php echo("{$_SESSION['userRIDEDAY']} "."<br />");?></h2>