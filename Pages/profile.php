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
    ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profile</title>
    <link rel = "stylesheet"
          type = "text/css"
          href = "../Styles/ProfileStyle.css" />
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
        <div class="cover">
            <img src="../Assets/cover.png">
            <div class="profile">
                <img src="../Profile/profile.jpg">
            </div>
        </div>
        <h2>Abel Ghazinyan</h2>
        <div class="about">

            <ul>
                <li>Studies at MSU</li>
                <li>Worked at TUMO</li>
                <li>Studied at Physmath</li>
                <li>Does GYM and Street Workout</li>
            </ul>
        </div>
    </div>
</body>
</html>