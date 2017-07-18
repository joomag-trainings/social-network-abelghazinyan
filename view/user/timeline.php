<?php

    include '../Class/AuthenticationControllerController.php';

    if ($_SERVER['REQUEST_METHOD']==='GET') {
        if (isset($_GET)) {
            if (!empty($_GET['logout']) && $_GET['logout'] === 'LogOut') {
                AuthenticationController::forgetUser();
                header('Location:login.php');

                exit;
            }
        }
    }
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Timeline</title>
    <link rel = "stylesheet"
          type = "text/css"
          href = "../../Styles/TimelineStyle.css" />
    <link rel = "stylesheet"
          type = "text/css"
          href = "../../Styles/HeaderStyle.css" />
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
    <div class="owner">
        <div class="profile">
            <img src="../../Profile/profile.jpg">

        </div>
        <h3>Abel Ghazinyan</h3>
        <i>02/07/2017</i>
    </div>
    <div class="post">
        <img src="../../Assets/post.jpg">
    </div>

    <div class="likeandshare">
        <br>
        <button class="submit">Like</button>
        <button class="submit">Share</button>

    </div>
    <div class="comment">
        <form>
            <input type="text" name="comment">
            <input type="submit" class="submit" value="Comment">
        </form>
    </div>

</div>
</body>
</html>