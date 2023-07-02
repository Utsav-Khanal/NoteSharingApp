<?php
session_start();
include("connection.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Login</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

<!--Login-->
<header>
<p style="color:white; text-align:left; font-size:20px; font-weight:bold;">NoteSharingApp</p>
        <nav class="nav">
            <ul class="nav_links">
                <li><a href="login.php">Login</a></li>
                <li><a href="register.php">Register</a></li>
            </ul>
        </nav>
    </header>
    
    <!--Login Form-->

    <div class="login-container">
        <h2>Login</h2>
        <p id="loginErr" style="font-size: 17px; font-weight:bold; color:red; text-align:center;"></p>
        <p id="success" style="font-size: 17px; font-weight:bold; color:green; text-align:center;"></p>
    <div class="login-form">
        
        <form action="" method="POST">
            <div class="input-name">
                <i class="fa fa-envelope email"></i>
                <input type="text" placeholder="Email" class="text-name" id="login-email" name="email" required>
            </div>

            <div class="input-name">
                <i class="fa fa-lock lock"></i>
                <input type="password" placeholder="Password" class="text-name" id="login-pass" name="pass" required>
            </div>

            <div class="input-name">
            <input type="submit" id="login-btn" name="login-btn" value="Login">
            <p>Don't have an account? <a class="login-link" href="register.php">Register</p></a>
            </div>

            
        </form>
     </div>
    </div>
<!--JavaScript-->
<script src="js/script.js"></script>
</body>
</html>

<?php

if(isset($_POST['login-btn']))
{
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $hashedPd = md5($pass);

    $query = "SELECT * FROM register WHERE email = '$email' && password = '$hashedPd'";
    $data = mysqli_query($conn, $query);
    $total = mysqli_num_rows($data);

    if($total == 1)
    {
        $_SESSION['email'] = $email;
        
        echo "
            <script>
            const success = document.getElementById('success');
            success.innerHTML='Successfull Login';
            </script>
            ";

            ?>
            <META HTTP-EQUIV="Refresh" CONTENT="0.3; URL=http://localhost/noteSharingApp/panel.php">

            <?php

        //header('location:panel.php');
    }
    else{
        // echo "<font color='red'>Login Failed";
            // echo "<div style='text-align: center;'>";
            // echo "<font color='red'>Login Failed";
            // echo "</div>";

            echo "
            <script>
            const loginErr = document.getElementById('loginErr');
            loginErr.innerHTML='Invalid Credential';
            </script>
            
            ";
    }
}

?>