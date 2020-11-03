<?php
    require 'header.php';
    require '/systemsAnalysisTeamProject/webFiles/actions/db.action.php';
?>
    <style><?php require 'admin.css'?></style>


    <h1>Welcome!</br>
    <h2><?php echo("{$_SESSION['adminFIRST']} "."{$_SESSION['adminLAST']}"."<br />");?></h2>



    <?php
        $sql = "SELECT * FROM APPOINTMENT WHERE EMPLOYEE_ID=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: /systemsAnalysisTeamProject/webFiles/admin.php?error=sqlerror");
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

        function display($conn){
            $sql = "SELECT * FROM CLIENT ";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql)){
                header("Location: /systemsAnalysisTeamProject/webFiles/admin.php?error=sqlerror");
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
                        "<div class'textbox'><textarea name='notesToChange' value=".$value->notes." cols='50' rows='10'>".$value->notes."</textarea></div>
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
                        "<div class'textbox'><textarea name='notesToChange' value=".$value->notes." cols='50' rows='10'>".$value->notes."</textarea></div>
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
                        "<div class'textbox'><textarea name='notesToChange' value=".$value->notes." cols='50' rows='10'>".$value->notes."</textarea></div>
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
                                header("Location: /systemsAnalysisTeamProject/webFiles/admin.php?error=stmtfailed");
                                exit();
                        }else{
                                mysqli_stmt_bind_param($stmt, "is", $rideChange, $note);
                                mysqli_stmt_execute($stmt);
                                exit();
                        }


                        unset($_POST['change-submit']);
                    }

                }

            }
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
                                header("Location: /systemsAnalysisTeamProject/webFiles/admin.php?error=stmtfailed");
                                exit();
                        }else{
                                mysqli_stmt_bind_param($stmt, "is", $rideChange, $note);
                                mysqli_stmt_execute($stmt);
                                header("Location: /systemsAnalysisTeamProject/webFiles/admin.php");
                                exit();
                        }


                        unset($_POST['change-submit']);
                    }
                }
            }else{
                echo "There are no results matching your search.";
                display($conn);
            }
        }else{
            display($conn);
        }
    ?>
    <form method="post">
        <div class="Datetextbox">
            <input type="text" name="date" placeholder="Enter In Days Available in the format: YYYY-MM-DD">
        </div>

        <select name='riderlevel' id='riderlevel' class="selectRidLev">
            <optgroup label='Riding Level'>
                <option value='1'>Beginner</option>
                <option value='2'>intermediate</option>
                <option value='3'>Advanced</option>
            </optgroup>
        </select>

        <select name='daytype' id='daytype' class="selectDayType">
            <optgroup label='Day Type'>
                <option value='1'>Single Rider</option>
                <option value='2'>Group Lesson</option>
            </optgroup>
        </select>

        <button type='submit' name='date-submit' class='Datebtn'>Submit Date</button>
    </form>
    <?php
        if(isset($_POST['date-submit'])){
            $dateToAdd = $_POST['date'];
            $level = $_POST['riderlevel'];
            $type = $_POST['daytype'];
            $one = 1;
            $null = NULL;

            $sql = "INSERT INTO APPOINTMENT(`ID`, `DAY_LVL`, `DAY_TYPE`, `CLIENT_ID`, `CLIENT_ID2`, `EMPLOYEE_ID`, `CLIENT_NAME`, `CLIENT_CONTACT`, `CLIENT_NAME2`, `CLIENT_CONTACT2`, `RIDE_DAY`, `CANCELED`, `CANCELLATION_REASON`)
            VALUE(?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt,$sql)){
                echo "here";
                exit();
            }else{
                mysqli_stmt_bind_param($stmt, "sssssssssssss",$null, $level, $type, $null, $null, $one, $null, $null, $null, $null, $dateToAdd, $one, $null);
                mysqli_stmt_execute($stmt);
                echo "Executed";
                exit();
            }

        }
    ?>

    <form method="post">
        <div class="emailBox">
            <h3>Email:</h3>
            <div>          
                <input type="text" name="subject" placeholder="Subject Line">
            </div>
            <textarea name="emailContent"  cols="110" rows="10"></textarea>
            <button type='submit' name='emailSend-submit' class='btn'>Send Email</button>
        </div>
    </form>
    <?php

        if(isset($_POST['emailSend-submit'])){
            $subject = $_POST['subject'];
            $content = $_POST['emailContent']; 

            $sql = "SELECT * FROM CLIENT";
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sql)){
                header("Location: /systemsAnalysisTeamProject/webFiles/admin.php?error=sqlerror");
                exit();            
            }else{
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                while($row = mysqli_fetch_assoc($result)){
                    $to = $row['EMAIL'];
                    mail($to, $subject, $content);
                }
            }
        }
    
    ?>

    <form method="post">
        <div class="newsBox">
            <h3>News Post:</h3>
            <textarea name="newspost"  cols="110" rows="10"></textarea>
            <button type='submit' name='newsSend-submit' class='btn'>Post</button>
        </div>
    </form>
    <?php
        if(isset($_POST['newsSend-submit'])){

            $newsPost = $_POST['newspost'];
            $timezone = date_default_timezone_set('America/New_York');
            $currDate = date('Y-m-d', time());

            $sql = "INSERT INTO NEWS(NEWS_POST, DATE_POSTED) VALUE (?,?)";
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sql)){
                exit();
            }else{
                mysqli_stmt_bind_param($stmt, "ss",$newsPost, $currDate);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
            }
        }
    ?>

<h2>Email/Text Notification Settings:</h2>
    <div class="toggle">
        <form method="post">
            <select name='emailToggle' id='emailToggle' class='togg'>
                <optgroup label='Email Toggle'>
                    <option value='1'>Recieve Email On</option>
                    <option value='2'>Recieve Email Off</option>
                </optgroup>
            </select>
            <br>
            <select name='textToggle' id='textToggle' class='togg'>
                <optgroup label='Text Toggle'>
                    <option value='1'>Recieve Text On</option>
                    <option value='2'>Recieve Text Off</option>
                </optgroup>
            </select>
            <button type='submit' name='toggle-submit' class='toggbtn'>Submit Notification Preferences</button>
        </form>
    </div>

<?php
    if(isset($_POST['toggle-submit'])){
        $emailtoggle = $_POST['emailToggle'];
        $texttoggle = $_POST['textToggle'];

        $sql = "UPDATE EMPLOYEE SET EMAIL_TOGGLE=? , TEXT_TOGGLE=? WHERE EMAIL='" . $_SESSION['adminEMAIL']. "'";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sql)){
                echo" ERROR HERE";
                exit();
        }else{
                mysqli_stmt_bind_param($stmt, "ii", $emailtoggle, $texttoggle);
                mysqli_stmt_execute($stmt);
                exit();
        }
    }
?>