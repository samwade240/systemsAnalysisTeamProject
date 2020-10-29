<?php
    require 'header.php';
    require '../webFiles/actions/db.action.php';
?>


<html>

<head>
    <meta charset="utf-8">
    <title>Register</title>
    <link rel="stylesheet" href="/systemsAnalysisTeamProject/webFiles/news.css">
    <link href="https://fonts.googleapis.com/css?family=Cardo:400,700|Oswald" rel="stylesheet">       

</head>


<body>

<br>
<br>

<?php

echo "<div class='boxHeader'>
        <h1>News</h1>    
      </div>";

echo "<br>";
echo "<br>";
echo "<br>";

    $sql = "SELECT * FROM NEWS ORDER BY DATE_POSTED DESC";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("Location: ../webFiles/news.php?error=sqlerror");
        exit();            
    }else{
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        echo "<div class='news-container'>";
        while($row = mysqli_fetch_assoc($result)){
            echo "<div class='newsPost'>
                    <p>".
                    date("d/m/Y", strtotime($row['DATE_POSTED']))
                    ."</p>".
                    $row['NEWS_POST']
                  ."</div>";
        }
        echo "</div>";
    }    



?>

</body>



<footer>
    contact information:
    <br>
    Email: Temporary@gmail.com <br>
    Location: 1234 East Main Street Charleston, South Carolina
</footer>


</html>