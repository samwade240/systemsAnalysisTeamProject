<?php
    require 'header.php';
    require '../webFiles/actions/db.action.php';

    echo "<h2>Change Information for: </h2>";

    if(isset($_POST['change-submit'])){
        $first = $_POST['mFirst'];
        $last = $_POST['mLast'];
        $level = $_POST['mLevel'];
        $notes = $_POST['mNotes'];
        $email = $_POST['mEmail'];


        echo "<h2>".$first." ".$last."</h2>";

        echo "<div class='grid-container'>";
        echo "<form action='adminChangeInfo.php' method='post'";
        if($level == 1){
            echo "<div class='grid-item'> ";
            echo "<input type='hidden' name='mEmail' value='".$email."' >";
            echo " |
            <select name='riderlevel' id='riderlevel'>
                <optgroup label='Riding Level'>
                    <option value='1'>Beginner</option>
                    <option value='2'>Intermediate</option>
                    <option value='3'>Advanced</option>
                </optgroup>
            </select>".
            "<div class'textbox'><textarea name='notesToChange' value=".$notes." cols='50' rows='10'>".$notes."</textarea></div>
            <button type='submit' name='update-submit' class='btn'>Submit Changes</button>";

        }else if($level == 2){
            echo "<div class='grid-item'> ";
            echo "<input type='hidden' name='mEmail' value='".$email."' >";
            echo " |
            <select name='riderlevel' id='riderlevel'>
                <optgroup label='Riding Level'>
                    <option value='2'>Intermediate</option>
                    <option value='1'>Beginner</option>
                    <option value='3'>Advanced</option>
                </optgroup>
            </select>".
            "<div class'textbox'><textarea name='notesToChange' value=".$notes." cols='50' rows='10'>".$notes."</textarea></div>
            <button type='submit' name='update-submit' class='btn'>Submit Changes</button>";
        }else if($level == 3){
            echo "<div class='grid-item'> ";
            echo "<input type='hidden' name='mEmail' value='".$email."' >";
            echo " |
            <select name='riderlevel' id='riderlevel'>
                <optgroup label='Riding Level'>
                <option value='3'>Advanced</option>
                <option value='1'>Beginner</option>
                <option value='2'>Intermediate</option>
                </optgroup>
            </select>".
            "<div class'textbox'><textarea name='notesToChange' value=".$notes." cols='50' rows='10'>".$notes."</textarea></div>
            <button type='submit' name='update-submit' class='btn'>Submit Changes</button>";
        }
    

    }

    if(isset($_POST['update-submit'])){
        $rideChange = $_POST['riderlevel'];
        $note = $_POST['notesToChange'];
        $email = $_POST['mEmail'];

        $sql = "UPDATE  CLIENT SET RIDER_LVL=?, NOTES=? WHERE EMAIL='$email'";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sql)){
                header("Location: /systemsAnalysisTeamProject/webFiles/adminChangeInfo.php?error=stmtfailed");
                exit();
        }else{
                mysqli_stmt_bind_param($stmt, "is", $rideChange, $note);
                mysqli_stmt_execute($stmt);
                header("Location: /systemsAnalysisTeamProject/webFiles/admin.php");
                exit();
        }
    }

?>   