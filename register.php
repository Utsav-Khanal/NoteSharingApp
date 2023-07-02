<?php
include("connection.php");
error_reporting(0);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <header>
        <p style="color:white; text-align:left; font-size:20px; font-weight:bold;">NoteSharingApp</p>
        <nav class="nav">
            <ul class="nav_links">
                <li><a href="login.php">Login</a></li>
                <li><a href="register.php">Register</a></li>
            </ul>
        </nav>
    </header>

    <!--Registration-->
    <div class="container">
        <h2>Registration Form</h2>
        <p id="fieldErr" style="text-align:center; color:red; font-size:20px; font-weight:bold;"></p>
        <p id="success" style="text-align:center; color:green; font-size:20px; font-weight:bold;"></p>
        <div class="form-container">

            <form action="" method="POST">

                <div class="input-name">
                    <p id="fnameErr" style="text-align: left;"></p>
                    <i class="fa fa-user lock"></i>
                    <input type="text" placeholder="First Name" class="name" id="fname" name="fname" value="<?php echo (isset($_POST['fname']))?$_POST['fname']:""?>">
                    
                    <span>
                        <p id="lnameErr" style="text-align: left;"></p>
                        <i class="fa fa-user lock"></i>
                        <input type="text" placeholder="Last Name" class="name" id="lname" name="lname" value="<?php echo (isset($_POST['lname']))?$_POST['lname']:""?>">
                    </span>
                </div>

                <div class="input-name">
                    <p id="emailErr"></p>
                    <i class="fa fa-envelope email"></i>
                    <input type="email" placeholder="Email" class="text-name" id="email" name="email" value="<?php echo (isset($_POST['email']))?$_POST['email']:""?>">
                </div>

                <div class="input-name">
                    <p id="passwordErr"></p>
                    <i class="fa fa-lock lock"></i>
                    <input type="password" placeholder="Password" class="text-name" id="password" name="pass" value="<?php echo (isset($_POST['pass']))?$_POST['pass']:""?>">
                </div>

                <div class="input-name">
                    <i class="fa fa-lock lock"></i>
                    <input type="password" placeholder="Confirm Password" class="text-name" name="conpass" value="<?php echo (isset($_POST['conpass']))?$_POST['conpass']:""?>">
                </div>

                <div class="input-name">
                    <input type="radio" class="radio-button" name="gender" value="male">
                    <label class="radio-button">Male</label>

                    <input type="radio" class="radio-button" name="gender" value="female">
                    <label>Female</label>
                </div>

                <div class="input-name">
                    <input type="submit" class="reg-button" id="reg-button" value="Register" name="submit">
                    <p>Already have an account? <a class="login-link" href="login.php">Login</p></a>
                </div>

            </form>
        </div>
    </div>

    <script src="js/script.js"></script>

</body>

</html>

<?php
//Fetching Form Data
if (isset($_POST['submit'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $pass = md5($_POST['pass']);
    $conpass = md5($_POST['conpass']);
    $gender = $_POST['gender'];

    if (empty($fname) || empty($lname) || empty($email) || empty($pass) || empty($conpass) || empty($gender)) 
    {

            echo "
            <script>
            const fieldErr = document.getElementById('fieldErr');
            fieldErr.innerHTML='Please fill out all the fields';
            </script>
            
            ";

    } else {
                  //Check if password and confirm password match
        if ($pass !== $conpass) {
                    echo "
                    <script>
                    const fieldErr = document.getElementById('fieldErr');
                    fieldErr.innerHTML='Check password and Confirm Password';
                    </script>
                    
                    ";

        } else {
            $sql = "SELECT * FROM register WHERE email = '$email'";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) 
            {
                //Email already exists in database
                echo "
                    <script>
                    const fieldErr = document.getElementById('fieldErr');
                    fieldErr.innerHTML='Email already exists';
                    </script>
                    
                    ";
            }
             else 
             {
                $query = "INSERT INTO register VALUES ('', '$fname','$lname','$email','$pass','$conpass','$gender')";

                $data = mysqli_query($conn, $query);

                if ($data)
                {
                    echo "
                    <script>
                    const success = document.getElementById('success');
                    success.innerHTML='Registration Successfull';
                    </script>
                    
                    ";
                    ?>
                    <META HTTP-EQUIV="Refresh" CONTENT="2; URL= http://localhost/noteSharingApp/register.php">

                    <?php
                }
            }
        }
    }
}

?>