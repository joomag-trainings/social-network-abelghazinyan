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
    <title>Photos</title>
    <link rel = "stylesheet"
          type = "text/css"
          href = "../Styles/PhotosStyle.css" />
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
    <h1>Photos</h1>
    <br>
    <div class="pic">
        <img src="../Assets/1.jpg">
    </div>
    <div class="pic">
        <img src="../Assets/2.jpg">
    </div>
    <div class="pic">
        <img src="../Assets/3.jpg">
    </div>
    <div class="pic">
        <img src="../Assets/4.jpg">
    </div>
    <div class="pic">
        <img src="../Assets/5.jpg">
    </div>
    <div class="pic">
        <img src="../Assets/6.jpg">
    </div>
    <div class="pic">
        <img src="../Assets/7.jpg">
    </div>
</div>
</body>
</html>