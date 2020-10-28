<?php
    require 'header.php'
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/systemsAnalysisTeamProject/webFiles/home.css">
    <link href="https://fonts.googleapis.com/css?family=Cardo:400,700|Oswald" rel="stylesheet">    <title>Rae Riding Lessons</title>    
</head>

<body>

    <?php
                if(isset($_GET['signup'])){
                    if($_GET['signup'] == "success"){
                        echo "<p class='success'>You Are Signed Up!</p>";
                    }
                }else if(isset($_GET['login'])){
                    if($_GET['login'] == "success"){
                        echo "<p class='success'>You Are Logged In!</p>";
                    }
                }
    ?>

    <h1>Rae <br> Riding Lessons</h1>


    <div class="slider-frame">
        <div class="slide-images">
            <div class="img-container" >
                <img src="/systemsAnalysisTeamProject/pictures/img2.jpg">
                <div class="border_box"></div>
            </div>
              <div class="img-container">
                  <img src="/systemsAnalysisTeamProject/pictures/img3.jpg">
                  <div class="border_box"></div>
                </div>
              <div class="img-container">
                <img src="/systemsAnalysisTeamProject/pictures/RaeRiding.png">
                <div class="border_box"></div>
              </div>
              <div class="img-container">
                  <img src="/systemsAnalysisTeamProject/pictures/img4.jpg">
                  <div class="border_box"></div>
                </div>

            </div>
        </div>


</body>

<footer>
    contact information:
    <br>
    Email: Temporary@gmail.com <br>
    Location: 1234 East Main Street Charleston, South Carolina
</footer>

</html>