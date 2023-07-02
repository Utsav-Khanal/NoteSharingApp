<?php
include("connection.php");
error_reporting(0);
session_start();
$user = $_SESSION['email'];

if ($user == true) {

} 
else 
{
  
    header('location:login.php');
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/panel.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
     <!-- Boxicons CSS -->
     <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />

</head>
<body>

<!-- navbar -->
<nav class="navbar">
      <div class="logo_item">
        <i class="bx bx-menu" id="sidebarOpen"></i>
        <p>NoteSharingApp</p>
      </div>

      <div class="navbar_content">
        <i class="bi bi-grid"></i>
        <i class='bx bx-sun' id="darkLight"></i>

        <!-- <i class='bx bx-bell'></i> -->
        <img src="images/user2.jpg" alt="" class="user-pic" onclick="toggleMenu()" />

        <div class="sub-menu-wrap" id="subMenu">
          <div class="sub-menu">
              <div class="user-info">
                  <img src="images/user2.jpg">

                  <!--PHP fetching User's FirstName and LastName-->
                  <?php
                  $email = $_SESSION['email'];
                  $query = "SELECT * FROM register WHERE email = '$email'";
                  $data = mysqli_query($conn, $query);
                  $total = mysqli_num_rows($data);

                  if($total !=0)
                  {
                    while($result = mysqli_fetch_assoc($data)){
                      echo "
                      <h3>".$result['firstname'] . " ".$result['lastname'] ." </h3>
                      ";
                    }
                  }
                  ?>

              </div>
              
              <div class="email-fecth">
               <?php
                  $email = $_SESSION['email'];
                  $query = "SELECT * FROM register WHERE email = '$email'";
                  $data = mysqli_query($conn, $query);
                  $total = mysqli_num_rows($data);

                  if($total !=0)
                  {
                    while($result = mysqli_fetch_assoc($data)){
                      echo "
                      <p style='text-align: center; font-size: 12px;'>".$result['email']." </p>
                      ";
                      
                    }
                  }

                  ?>
              </div>
              <hr>

              <a href="edit_profile.php" class="sub-menu-link">
                  <img src="images/profile.png">
                  <p>Edit Profile</p>
                  <span>></span>
              </a>

              <a href="logout.php" class="sub-menu-link">
                  <img src="images/Logout.png">
                  <p>Logout</p>
                  <span>></span>
              </a>

          </div>
      </div>

    </nav>

    <!-- sidebar -->
    <nav class="sidebar">
      <div class="menu_content">
        <ul class="menu_items">
          <a href="panel.php"><div class="menu_title menu_dahsboard"></div></a>
        
          <!-- start -->
          <li class="item">
            <div href="#" class="nav_link submenu_item">
              <span class="navlink_icon">
                <i class="bx bx-home-alt"></i>
              </span>
              <span class="navlink">Home</span>
              <i class="bx bx-chevron-right arrow-left"></i>
            </div>

            <ul class="menu_items submenu">
              <a href="edit_profile.php" class="nav_link sublink">Edit Profile</a>
        
            </ul>
          </li>
          <!-- end -->

          <ul class="menu_items">
          <li class="item">
            <a href="viewNotes.php" class="nav_link">
              <span class="navlink_icon">
                <i class='bx bx-note'></i>
              </span>
              <span class="navlink">View Notes</span>
            </a>
          </li>
        </ul>

        <ul class="menu_items">
          <li class="item">
          <a href="uploadNotes.php" class="nav_link">
              <span class="navlink_icon">
                <i class='bx bx-note'></i>
              </span>
              <span class="navlink">Upload Notes</span>
            </a>
          </li>
        </ul>

        <ul class="menu_items">
          <li class="item">
            <a href="logout.php" class="nav_link">
              <span class="navlink_icon">
                <i class='bx bx-log-out'></i>
              </span>
              <span class="navlink">Logout</span>
            </a>
          </li>
        </ul>

        <!-- Sidebar Open / Close -->
        <div class="bottom_content">
          <div class="bottom expand_sidebar">
            <span> Expand</span>
            <i class='bx bx-log-in' ></i>
          </div>
          <div class="bottom collapse_sidebar">
            <span> Collapse</span>
            <i class='bx bx-log-out'></i>
          </div>
        </div>
      </div>
    </nav>

              <!--Edit Profile Section-->
        <form action="" method="POST" enctype="multipart/form-data">

          <div class="edit-profile-container">
    
            <h2>Edit Profile</h2>
                  
            <div class="user-edit-info">
              <img src="images/user2.jpg">
            </div> 

             <div class="login-form">
        
            <div class="input-name">
            <i class="fa fa-envelope email"></i>
                <input type="text" placeholder="Email" class="text-name" id="login-email" name="email" value="<?php echo (isset($_POST['email']))?$_POST['email']:""?>">
                
              </div>

            <div class="input-name">
            <i class="fa fa-user lock"></i>
                <input type="text" placeholder="FirstName" class="text-name" id="login-email" name="fname" value="<?php echo (isset($_POST['fname']))?$_POST['fname']:""?>">
            </div>

            <div class="input-name">
            <i class="fa fa-user lock"></i>
                <input type="text" placeholder="LastName" class="text-name" id="login-pass" name="lname" value="<?php echo (isset($_POST['lname']))?$_POST['lname']:""?>">
            </div>

            <div class="input-name">
            <i class="fa fa-lock lock"></i>
                <input type="password" placeholder="Password" class="text-name" id="login-pass" name="pass" value="<?php echo (isset($_POST['pass']))?$_POST['pass']:""?>">
            </div>

            <div class="input-name">
            <i class="fa fa-lock lock"></i>
                <input type="password" placeholder="Confirm Password" class="text-name" id="login-pass" name="conpass" value="<?php echo (isset($_POST['conpass']))?$_POST['conpass']:""?>">
            </div>

            <div class="input-name">
            <input type="submit" id="login-btn" name="update" value="Update">
            </div>

        </form>
     </div>
    </div>
    <!--JavaScript-->
    <script src="js/panel.js"></script>
    
</body>
</html>

<?php

if(isset($_POST['update']))
{

$email = $_POST['email'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$pass = md5($_POST['pass']);
$conpass = md5($_POST['conpass']);

if( empty($email) || empty($fname) || empty($lname) || empty($pass) || empty($conpass))
    {
       echo"<div style='text-align: center;'>";
       echo"<font color='red'>Please fill out all fields:";
       echo"</div>";

    }
    else{
        if($pass !== $conpass){
            echo "<div style='text-align: center;'>";
            echo "<font color='red'>Password Don't Match";
            echo "</div>";
        }
        else{
            if($_SESSION['email'] == $email)
            {
                $query = "UPDATE register SET email ='$email', firstname = '$fname', lastname = '$lname', password = '$pass', confirmpassword = '$conpass' WHERE email = '$email'";
                $data = mysqli_query($conn, $query);

                if($data)
                {
                    echo "<script>alert('Data Updated')</script>";
                    ?>
                    <META HTTP-EQUIV="Refresh" CONTENT="0; URL=http://localhost/noteSharingApp/panel.php">

                    <?php
                }
            }
            else{

                echo"<script>alert('You are not authorized to change this user data')</script>";

                }
        }
    }

}

?>
