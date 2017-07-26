<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profile</title>
    <link rel = "stylesheet"
          type = "text/css"
          href = "../Styles/NotificationsPageStyle.css" />
    <link rel = "stylesheet"
          type = "text/css"
          href = "../Styles/HeaderStyle.css" />
    <link rel = "stylesheet"
          type = "text/css"
          href = "../Styles/NotificationColumnStyle.css" />

</head>
<body>
<?php
    require "../view/templates/header.php";
?>
<div class="body">
    <div class="notificationColumn">
    <?php
        use \Service\NotificationDrawer;
        NotificationDrawer::drawNotificationColumn($_COOKIE['id'],1,50);
    ?>
    </div>
</div>

</body>
</html>