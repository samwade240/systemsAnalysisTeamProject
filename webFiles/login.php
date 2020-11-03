
<head>
    <meta charset="utf-8">
    <title>Login Page</title>
    <link rel="stylesheet" href="/systemsAnalysisTeamProject/webFiles/login.css">
</head>

<ul>
    <li><a href="/systemsAnalysisTeamProject/webFiles/home.php">Home</a></li>
    <li style="float:right; border-left:1px solid #bbb;" ><a href="/systemsAnalysisTeamProject/webFiles/signup.php"> Sign Up</a></li>
</ul>


<main>
    <?php
                if(isset($_GET['error'])){
                    if($_GET['error'] == "emptyfields"){
                        echo '<p>Fill in all fields!</p>';
                    }else if($_GET['error'] == "wrongpwd"){
                        echo '<p>Wrong Password!</p>';
                    }else if($_GET['error'] == "wrongemail"){
                        echo '<p>Wrong Password!</p>';
                    }
                }
    ?>
    <div class="login-box">
        <section>
            <h1>Log In</h1>
            <form action="/systemsAnalysisTeamProject/webFiles/actions/login.action.php" method="post">
            <div class="textbox">
            <input type="text" name="email" placeholder="Email">
            </div>
            <div class="textbox">
            <input type="password" name="pass" placeholder="Password" autocomplete="new-password">
            </div>
            <button type="submit" name="login-submit" class="btn">Log In</button>
            </form>

        </section>
    </div>
</main>