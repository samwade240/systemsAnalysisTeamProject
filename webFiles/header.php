<?php
    session_start();
?>


<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/systemsAnalysisTeamProject/webFiles/home.css">
    <link href="https://fonts.googleapis.com/css?family=Cardo:400,700|Oswald" rel="stylesheet">       
</head>

<ul>
    <li><a href="/systemsAnalysisTeamProject/webFiles/home.php">Home</a></li>
    <li><a href="/systemsAnalysisTeamProject/webFiles/news.php">News</a></li>
    <li><a href="/systemsAnalysisTeamProject/webFiles/register.php">Register</a></li>

    <?php
    if(isset($_SESSION['userID'])){    
        echo '<li><a href="/systemsAnalysisTeamProject/webFiles/actions/client.php">Client Page</a></li>';
        echo '<form action="../webFiles/actions/logout.action.php" method="post">
        <button type="submit" name="logout-submit" class="logoutbtn">Log Out</button>
        </form>'; 
    }else{
        echo '<form action="../webFiles/login.php" method="post">
        <button type="submit" name="submit" class="logoutbtn">Log In</button>
        </form>';     
    }
    ?>

</ul>