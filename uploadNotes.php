<?php
include("connection.php");
error_reporting(0);
session_start();
$user = $_SESSION['email'];

if ($user == true) {
} else {
    header('location:login.php');
}

?>

<!--HTML-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- Boxicons CSS -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/panel.css" />
    <link rel="stylesheet" href="css/style.css" />

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

                        if ($total != 0) {
                            while ($result = mysqli_fetch_assoc($data)) {
                                echo "
                      <h3>" . $result['firstname'] . " " . $result['lastname'] . " </h3>
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

                        if ($total != 0) {
                            while ($result = mysqli_fetch_assoc($data)) {
                                echo "
                      <p style='text-align: center; font-size: 12px;'>" . $result['email'] . " </p>
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
                <a href="panel.php">
                    <div class="menu_title menu_dahsboard"></div>
                </a>

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
                        <i class='bx bx-log-in'></i>
                    </div>
                    <div class="bottom collapse_sidebar">
                        <span> Collapse</span>
                        <i class='bx bx-log-out'></i>
                    </div>
                </div>
        </div>
    </nav>

    <!--Upload Notes-->

    <!--Edit Profile Section-->
    <form action="" method="POST" enctype="multipart/form-data">

        <div class="edit-profile-container">

            <h2>Upload Notes</h2>
            <p id="success"></p>
            <p id="uploadErr"></p>

            <div class="login-form">

                <div class="input-name">
                    <input type="text" placeholder="Title" class="text-name" id="login-email" name="title">

                </div>

                <div class="input-name">
                    <input type="text" placeholder="Description" class="text-name" id="login-email" name="desc">
                </div>

                <div class="input-name">
                    <input type="file" placeholder="Description" name="file">
                </div>

                <div class="input-name">
                    <input type="submit" id="login-btn" name="update" value="Upload Notes">
                </div>

    </form>
    </div>
    </div>

    <!--JavaScript Link-->
    <script src="js/panel.js"></script>

</body>
</html>

<?php

if($_POST['update']){
    $title = $_POST['title'];
    $_SESSION['email'] = $userId;
    $description = $_POST['desc'];
    $file = $_FILES['file'] ['name'];
    $tmpname = $_FILES['file'] ['tmp_name'];
    $folder = "notes/".$file;
    move_uploaded_file($tmpname,$folder);

    if($title != "" && $description != "" && $file != "")
    {
        
        $query = "INSERT INTO notes VALUES ('','$title','$description','$folder')";
        $data = mysqli_query($conn,$query);

        if($data)
        {
            // echo "Note Uploaded";

            echo "
                    <script>
                    const fieldErr = document.getElementById('success');
                    fieldErr.innerHTML='Note Uploaded';
                    </script>
                    
                    ";
        }
    }
    else{
        echo "
        <script>
                    const fieldErr = document.getElementById('uploadErr');
                    fieldErr.innerHTML='Note Upload Failed';
                    </script>
        ";
    }
}



?>

