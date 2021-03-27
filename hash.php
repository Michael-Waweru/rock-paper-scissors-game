<?php
    $pass;
    $repass;
    //remains same all through the code
    $salt='php123';
    //rediect
    if(isset($_POST['cancel'])){
        header("Location: index.php");
        return;
    }
    $failure = false;
    $success = false;

    //if nothing is written, this code is skipped
    if(isset($_POST['pass']) && isset($_POST['repass'])){
        if(strlen($_POST['pass']) < 1 || strlen($_POST['repass']) < 1){
            $failure = "Please enter the password.";
        }
        else{
            $success = true;
            $pass = $_POST['pass'];
            $repass = $_POST['repass'];
            if($pass == $repass){ 
                $password = md5($pass.$salt);
                $file = fopen("pass.txt", "r");
                $check = fgets($file);
                fclose($file);
                if($check == $password){
                    $failure = "Password is same as the previous one.";
                }
                else{
                    $file = fopen("pass.txt", "w");
                    fwrite($file, $password);
                    $success = "Password set";
                }
            }
            else{
                $failure="Passwords do not match.";
            }
        }
    }    
?>

<!DOCTYPE html>
<html>
<head>
<title>99e54b30</title>
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
 integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

 <!-- Page CSS -->
 <link rel="stylesheet" href="somecss.css">
 
</head>
<body>
<div class="container">
    <main>
        <h1>Please enter a password.</h1>
        <form method="POST">
            <input type="password" id="pass" name="pass" placeholder="Please enter the password: "/>
            <br>
            <input type="password" id="pass" name="repass" placeholder="Please enter the password again: "/>
            <br>
            <input type="submit" name="cancel" value="Cancel" class="button"/>&nbsp
            <input type="submit" value="Set Password" class="button"/>
            <?php
                if($failure !== false){
                    echo('<p class="alert">'.htmlentities($failure)."</p>");
                }
                elseif($success !== false){
                    echo('<p class="alert">'.htmlentities($success)." <a href=./login.php>Login.</a></p>");
                    return;
                }
            ?>
        </form>
    </main>    
</body>
</html>