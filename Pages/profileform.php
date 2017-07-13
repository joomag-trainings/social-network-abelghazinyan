<?php

    if ($_SERVER['REQUEST_METHOD']==='GET') {
        if (isset($_GET)) {
            if (!empty($_GET['logout']) && $_GET['logout'] === 'LogOut') {
                unset($_COOKIE['user']);
                unset($_COOKIE['pswd']);
                setcookie('user', null, 1);
                setcookie('pswd', null, 1);
                header('Location:login.php');
                exit;
            }
        }
    }


    $imageError = '';
    if ($_SERVER['REQUEST_METHOD']==='POST') {
        if ($_POST['form'] === 'profile') {
            echo "<pre>";
            var_dump($_FILES);
            echo "</pre>";
            $target_dir = "/var/www/html/social-network/Profile/";
            $target_file = $target_dir . basename($_FILES["file"]["name"]);
            echo $target_file;
            $uploadOk = 1;
            $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
            if(isset($_POST["submit"])) {
                $check = getimagesize($_FILES["file"]["tmp_name"]);
                if($check !== false) {
                    $uploadOk = 1;
                } else {
                    $imageError = "File is not an image.";
                    $uploadOk = 0;
                }
            }

            if (file_exists($target_file)) {
                $uploadOk = 0;
            }

            if ($_FILES["file"]["size"] > 500000) {
                $imageError = "Sorry, your file is too large.";
                $uploadOk = 0;
            }

            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif" ) {
                $imageError = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }
          //  rename("/var/www/html/social-network/Profile/profile.jpg","/var/www/html/social-network/Profile/profileOld.jpg");

            if ($uploadOk == 0) {
                $imageError = "Sorry, your file was not uploaded.";

            } else {

                if (!move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
                   // rename("/var/www/html/social-network/Profile/profile.jpg","/var/www/html/social-network/Profile/profile.jpg");
                    $imageError = "Sorry, there was an error uploading your file.";
                }else {
                   // $name = "Profile/" . basename($_FILES["file"]["name"]);
                   // rename($name,"/var/www/html/social-network/Profile/profile.jpg");
                }

            }
        }
    }



    ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Profile</title>
    <link rel = "stylesheet"
          type = "text/css"
          href = "../Styles/ProfileFormStyle.css" />
    <link rel = "stylesheet"
          type = "text/css"
          href = "../Styles/HeaderStyle.css" />
</head>
<body>
<div class="header">
    <div class="nav">
        <a class="navButton" href="timeline.php">Timeline</a>
        <a class="navButton" href="photos.php">Photos</a>
        <a class="navButton" href="profile.php">Profile</a>
    </div>
    <form method="get">
        <input class="logout" name="logout" type="submit" value="LogOut">
    </form>
</div>
<div class="body">

    <div class="profile">
        <img src="../Profile/profile.jpg">
    </div>
    <div class="edit">
        <form method="post" enctype="multipart/form-data">
            <input type="hidden" name="form" value="profile">
            <input type="file" name="file" id="file">
            <input type="submit" value="Upload">
        </form>
        <span style="color:crimson;font-size: 15px;"><?php echo $imageError;?></span>
    <form method="post"><br><br><br><br><br>
        <input type="hidden" name="form" value="form">
        <label for="fname">First Name</label> <input type="text" name="fname" id="fname" value="Abel"><br><br>
        <label for="lname">Last  Name</label><input type="text" name="lname" id="lname" value="Ghazinyan"><br><br>
        <label for="email">E-Mail</label><input type="text"  id="email" name="email" placeholder="E-Mail" value="ghazinyan.abel@gmail.com"><br><br>
        <label for="oldpswd">Old Password</label><input type="password"  id="oldpswd" name="oldpswd" placeholder="Old Password" value="12345678987654"><br><br>
        <label for="newpswd">New Password</label><input type="password"  id="newpswd"name="newpswd" placeholder="New Password"><br><br>
        <label for="cnfpswd">Confirm Password</label><input type="password" id="cnfpswd" name="cnfpswd" placeholder="Confirm New Password"><br><br>
        <label for="college">College</label><input type="text" id="college" name="college" placeholder="Enter College" value="Moscow State University"><br><br>
        <label for="highscl">High School</label><input type="text" id="highscl" name="highscl" placeholder="Enter High School" value="Physmath High School"><br><br>
        <label for="work">Work</label><input type="text" id="work" name="work" placeholder="Enter Work" value="Game Developer at TUMO"><br><br>
        <div class="centergender">
            <label for="male">Male</label> <input type="radio" id="male" name="gender" value="male" checked>
            <label for="female">Female</label><input type="radio" id="female" name="gender" value="female"><br>

        </div>
        <input class="submit" type="submit" value="Submit Changes">
        <br>
        <br>
    </form>
    </div>

</div>
</body>
</html>