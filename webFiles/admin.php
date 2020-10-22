<?php
    require 'header.php';
    require '../webFiles/actions/db.action.php';
?>
    <style><?php require 'admin.css'?></style>


    <h1>Welcome!</br>
    <h2><?php echo("{$_SESSION['adminFIRST']} "."{$_SESSION['adminLAST']}"."<br />");?></h2>



    <?php
        $sql = "SELECT * FROM APPOINTMENT WHERE EMPLOYEE_ID=?";
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
                $arr[0] = "Not scheduled yet";
            }
            $_SESSION['userRIDEDAYSMALLEST'] = min($arr);   
        }
    ?>

    <h2>Your Next Class is on: <?php echo("{$_SESSION['userRIDEDAYSMALLEST']} "."<br />");?></h2>

    <?php

        class Cli{
            public $first;
            public $last;
            public $email;
            public $phone;
            public $riderLvl;
            public $notes; 
        }

        echo "<form method= 'POST'> 
                 <div class='textbox'>
                 <input type='text' name='search' placeholder='Client Lookup'>
                 </div>
                <button type='submit' name='search-submit' class='searchbtn'>Search</button>
              </form>";

        if(isset($_POST['search-submit'])){
            $search = mysqli_real_escape_string($conn, $_POST['search']);
            $sql = "SELECT * FROM CLIENT WHERE FIRST_NAME LIKE '%$search%' OR LAST_NAME LIKE '%$search%' OR EMAIL LIKE '%$search%' OR PHONE LIKE '%$search%'";
            $result = mysqli_query($conn, $sql);
            $queryResult =  mysqli_num_rows($result);

            if($queryResult > 0){

                $firstNames = array();
                $lastNames = array();
                $emails = array();
                $phoneNumbers = array();
                $riderLevels = array();
                $arr = array();
                while($row = mysqli_fetch_assoc($result)){
                    $tmp = new Cli();
                    $tmp->first = $row['FIRST_NAME'];
                    $tmp->last = $row['LAST_NAME'];
                    $tmp->email = $row['EMAIL'];
                    $tmp->phone = $row['PHONE'];
                    $tmp->riderLvl = $row['RIDER_LVL'];
                    $tmp->notes = $row['NOTES'];
                    $arr[] = $tmp;
                }
    
                foreach($arr as $value){
                    echo "<div class='grid-container'>";
                    echo "<form method='post'";
                    if($value->riderLvl == 1){
                        echo "<div class='grid-item'> " . $value->first ." " . $value->last ." | " . $value->email ." | " . $value->phone .
                        " |   
                        <select name='riderlevel' id='riderlevel'>
                            <optgroup label='Riding Level'>
                                <option value='1'>Beginner</option>
                                <option value='2'>Intermediate</option>
                                <option value='3'>Advanced</option>
                            </optgroup>
                        </select>".
                        "<div class'textbox'><textarea name='notesToChange' value=".$value->notes." cols='50' rows='10'></textarea></div>  
                        <button type='submit' name='change-submit' class='btn'>Submit Changes</button>";

                    }else if($value->riderLvl == 2){
                        echo "<div class='grid-item'> " . $value->first ." " . $value->last ." | " . $value->email ." | " . $value->phone .
                        " |   
                        <select name='riderlevel' id='riderlevel'>
                            <optgroup label='Riding Level'>
                                <option value='2'>Intermediate</option>
                                <option value='1'>Beginner</option>
                                <option value='3'>Advanced</option>
                            </optgroup>
                        </select>".
                        "<div class'textbox'><textarea name='notesToChange' value=".$value->notes." cols='50' rows='10'></textarea></div>  
                        <button type='submit' name='change-submit' class='btn'>Submit Changes</button>";
                    }else if($value->riderLvl == 3){
                        echo "<div class='grid-item'> " . $value->first ." " . $value->last ." | " . $value->email ." | " . $value->phone .
                        " |   
                        <select name='riderlevel' id='riderlevel'>
                            <optgroup label='Riding Level'>
                            <option value='3'>Advanced</option>
                            <option value='1'>Beginner</option>
                            <option value='2'>Intermediate</option>
                            </optgroup>
                        </select>".
                        "<div class'textbox'><textarea name='notesToChange' value=".$value->notes." cols='50' rows='10'></textarea></div>  
                        <button type='submit' name='change-submit' class='btn'>Submit Changes</button>";
                    }
                    echo "</form>";
                    echo "</div>";

                    if(isset($_POST['change-submit'])){
                        $rideChange = $_POST['riderlevel'];
                        $note = $_POST['notesToChange'];

                        $sql = "UPDATE  CLIENT SET RIDER_LVL=?, NOTES=? WHERE EMAIL='$value->email'";
                        $stmt = mysqli_stmt_init($conn);
                        if(!mysqli_stmt_prepare($stmt,$sql)){
                                header("Location: ../admin.php?error=stmtfailed");
                                exit();            
                        }else{
                                mysqli_stmt_bind_param($stmt, "is", $rideChange, $note);
                                mysqli_stmt_execute($stmt);
                                header("Location: ../webFiles/admin.php");
                                exit();            
                        }                        


                        unset($_POST['change-submit']);
                    }
                }
            }else{
                echo "There are no results matching your search.";
                $sql = "SELECT * FROM CLIENT ";
                $stmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt, $sql)){
                    header("Location: ../admin.php?error=sqlerror");
                    exit();            
                }else{
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    $firstNames = array();
                    $lastNames = array();
                    $emails = array();
                    $phoneNumbers = array();
                    $riderLevels = array();
                    $arr = array();
                    while($row = mysqli_fetch_assoc($result)){
                        $tmp = new Cli();
                        $tmp->first = $row['FIRST_NAME'];
                        $tmp->last = $row['LAST_NAME'];
                        $tmp->email = $row['EMAIL'];
                        $tmp->phone = $row['PHONE'];
                        $tmp->riderLvl = $row['RIDER_LVL'];
                        $tmp->notes = $row['NOTES'];
                        $arr[] = $tmp;
                    }
        
                    foreach($arr as $value){                    echo "<div class='grid-container'>";
                        echo "<form method='post'";
                        if($value->riderLvl == 1){
                            echo "<div class='grid-item'> " . $value->first ." " . $value->last ." | " . $value->email ." | " . $value->phone .
                            " |   
                            <select name='riderlevel' id='riderlevel'>
                                <optgroup label='Riding Level'>
                                    <option value='1'>Beginner</option>
                                    <option value='2'>Intermediate</option>
                                    <option value='3'>Advanced</option>
                                </optgroup>
                            </select>".
                            "<div class'textbox'><textarea name='notesToChange' value=".$value->notes." cols='50' rows='10'></textarea></div>  
                            <button type='submit' name='change-submit' class='btn'>Submit Changes</button>";
    
                        }else if($value->riderLvl == 2){
                            echo "<div class='grid-item'> " . $value->first ." " . $value->last ." | " . $value->email ." | " . $value->phone .
                            " |   
                            <select name='riderlevel' id='riderlevel'>
                                <optgroup label='Riding Level'>
                                    <option value='2'>Intermediate</option>
                                    <option value='1'>Beginner</option>
                                    <option value='3'>Advanced</option>
                                </optgroup>
                            </select>".
                            "<div class'textbox'><textarea name='notesToChange' value=".$value->notes." cols='50' rows='10'></textarea></div>  
                            <button type='submit' name='change-submit' class='btn'>Submit Changes</button>";
                        }else if($value->riderLvl == 3){
                            echo "<div class='grid-item'> " . $value->first ." " . $value->last ." | " . $value->email ." | " . $value->phone .
                            " |   
                            <select name='riderlevel' id='riderlevel'>
                                <optgroup label='Riding Level'>
                                <option value='3'>Advanced</option>
                                <option value='1'>Beginner</option>
                                <option value='2'>Intermediate</option>
                                </optgroup>
                            </select>".
                            "<div class'textbox'><textarea name='notesToChange' value=".$value->notes." cols='50' rows='10'></textarea></div>  
                            <button type='submit' name='change-submit' class='btn'>Submit Changes</button>";
                        }
                        echo "</form>";
                        echo "</div>";
    
                        if(isset($_POST['change-submit'])){
                            $rideChange = $_POST['riderlevel'];
                            $note = $_POST['notesToChange'];
    
                            $sql = "UPDATE  CLIENT SET RIDER_LVL=?, NOTES=? WHERE EMAIL='$value->email'";
                            $stmt = mysqli_stmt_init($conn);
                            if(!mysqli_stmt_prepare($stmt,$sql)){
                                    header("Location: ../admin.php?error=stmtfailed");
                                    exit();            
                            }else{
                                    mysqli_stmt_bind_param($stmt, "is", $rideChange, $note);
                                    mysqli_stmt_execute($stmt);
                                    header("Location: ../webFiles/admin.php");
                                    exit();            
                            }                        
    
    
                            unset($_POST['change-submit']);
                        }

                    }
        
                }
            }
        }else{       
            $sql = "SELECT * FROM CLIENT ";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql)){
                header("Location: ../admin.php?error=sqlerror");
                exit();            
            }else{
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                $firstNames = array();
                $lastNames = array();
                $emails = array();
                $phoneNumbers = array();
                $riderLevels = array();
                $arr = array();
                while($row = mysqli_fetch_assoc($result)){
                    $tmp = new Cli();
                    $tmp->first = $row['FIRST_NAME'];
                    $tmp->last = $row['LAST_NAME'];
                    $tmp->email = $row['EMAIL'];
                    $tmp->phone = $row['PHONE'];
                    $tmp->riderLvl = $row['RIDER_LVL'];
                    $tmp->notes = $row['NOTES'];
                    $arr[] = $tmp;
                }
    
                foreach($arr as $value){
                    echo "<div class='grid-container'>";
                    echo "<form method='post'";
                    if($value->riderLvl == 1){
                        echo "<div class='grid-item'> " . $value->first ." " . $value->last ." | " . $value->email ." | " . $value->phone .
                        " |   
                        <select name='riderlevel' id='riderlevel'>
                            <optgroup label='Riding Level'>
                                <option value='1'>Beginner</option>
                                <option value='2'>Intermediate</option>
                                <option value='3'>Advanced</option>
                            </optgroup>
                        </select>".
                        "<div class'textbox'><textarea name='notesToChange' value=".$value->notes." cols='50' rows='10'></textarea></div>  
                        <button type='submit' name='change-submit' class='btn'>Submit Changes</button>";

                    }else if($value->riderLvl == 2){
                        echo "<div class='grid-item'> " . $value->first ." " . $value->last ." | " . $value->email ." | " . $value->phone .
                        " |   
                        <select name='riderlevel' id='riderlevel'>
                            <optgroup label='Riding Level'>
                                <option value='2'>Intermediate</option>
                                <option value='1'>Beginner</option>
                                <option value='3'>Advanced</option>
                            </optgroup>
                        </select>".
                        "<div class'textbox'><textarea name='notesToChange' value=".$value->notes." cols='50' rows='10'></textarea></div>  
                        <button type='submit' name='change-submit' class='btn'>Submit Changes</button>";
                    }else if($value->riderLvl == 3){
                        echo "<div class='grid-item'> " . $value->first ." " . $value->last ." | " . $value->email ." | " . $value->phone .
                        " |   
                        <select name='riderlevel' id='riderlevel'>
                            <optgroup label='Riding Level'>
                            <option value='3'>Advanced</option>
                            <option value='1'>Beginner</option>
                            <option value='2'>Intermediate</option>
                            </optgroup>
                        </select>".
                        "<div class'textbox'><textarea name='notesToChange' value=".$value->notes." cols='50' rows='10'></textarea></div>  
                        <button type='submit' name='change-submit' class='btn'>Submit Changes</button>";
                    }
                    echo "</form>";
                    echo "</div>";

                    if(isset($_POST['change-submit'])){
                        $rideChange = $_POST['riderlevel'];
                        $note = $_POST['notesToChange'];

                        $sql = "UPDATE  CLIENT SET RIDER_LVL=?, NOTES=? WHERE EMAIL='$value->email'";
                        $stmt = mysqli_stmt_init($conn);
                        if(!mysqli_stmt_prepare($stmt,$sql)){
                                header("Location: ../admin.php?error=stmtfailed");
                                exit();            
                        }else{
                                mysqli_stmt_bind_param($stmt, "is", $rideChange, $note);
                                mysqli_stmt_execute($stmt);
                                header("Location: ../webFiles/admin.php");
                                exit();            
                        }                        


                        unset($_POST['change-submit']);
                    }



                }
    
            }
        }


 

    ?>