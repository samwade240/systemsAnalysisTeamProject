
<head>
    <meta charset="utf-8">
    <title>Login Page</title>
    <link rel="stylesheet" href="login.css">
</head>

<ul>
    <li><a href="home.php">Home</a></li>
    <li style="float:right; border-left:1px solid #bbb;" ><a href="/systemsAnalysisTeamProject/webFiles/login.php"> Log In</a></li>
</ul>


<main>
    <div class="login-box">
        <section>
            <h1>Sign Up</h1>
            <form action="actions/signup.action.php" method="post">
            <div class="textbox">
            <input type="text" name="first-name" placeholder="First Name">
            </div>
            <div class="textbox">
            <input type="text" name="last-name" placeholder="Last Name">
            </div>
            <div class="textbox">
            <input type="text" name="phone" placeholder="Phone Number">
            </div>
            <div class="textbox">
            <input type="text" name="em_name" placeholder="Emergency Contact Name">
            </div>
            <div class="textbox">
            <input type="text" name="em_phone" placeholder="Emergency Contact Phone">
            </div>
            <div class="textbox">
            <input type="text" name="email" placeholder="Email">
            </div>
            <div class="textbox">
            <input type="password" name="pass" placeholder="Password" autocomplete="new-password">
            </div>
            <div class="textbox">
            <input type="password" name="pass2" placeholder="Re-enter Password" autocomplete="new-password">
            </div>
            <button type="submit" name="signin-submit" class="btn">Sign Up</button>
            </form>

        </section>
    </div>
</main>