
<?php

require 'header.php';
require '../webFiles/actions/db.action.php';

if(isset($_GET['date'])){
    $date = $_GET['date'];
}

if(isset($_POST['submit'])){
    $email = $_POST['email'];
    $cName = $_SESSION['userFIRST'].' '.$_SESSION['userLAST'];
    echo($cName);


    if($email == $_SESSION["userEMAIL"]){
        $sql = "UPDATE APPOINTMENT SET CLIENT_ID2='".$_SESSION['userID']."',CLIENT_NAME2='".$cName."',CLIENT_CONTACT2='".$_SESSION['userPHONE']."' WHERE RIDE_DAY='".$date."'";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../bookSolo.php?error=sqlerror");
            exit();
        }else{
            mysqli_stmt_execute($stmt);
            header("Location: ../webFiles/register.php?booking=success");
            exit();
        }
    }
}

?>
<!doctype html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title></title>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" href="/css/main.css">
</head>

<body>
<div class="container">
    <h1 class="text-center">Book for Date: <?php echo date('m/d/Y', strtotime($date)); ?></h1><hr>
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
           <?php echo isset($msg)?$msg:''; ?>
            <form action="" method="post" autocomplete="off">
                <div class="form-group">
                    <label for="">Confirm Email</label>
                    <input type="email" class="form-control" name="email">
                </div>
                <button class="btn btn-primary" type="submit" name="submit">Submit</button>
            </form>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>

</html>
