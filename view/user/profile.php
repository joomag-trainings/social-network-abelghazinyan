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
    <?php require "../view/templates/header.php"?>
    <div class="body">
        <div class="cover">
            <img src="../Assets/cover.png">
            <div class="profile">
                <img src="../Profile/profile.jpg">
            </div>
        </div>
        <h2>Abel Ghazinyan</h2>
        <a class="logout" href="index.php?page=user&action=form">Edit</a>
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