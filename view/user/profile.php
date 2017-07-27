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
        <div class="profile">
            <img src="../Profile/profile.jpg">
        </div>


        <div class="about">
            <div class="name">
            <h2><?php echo $user->getFname(). ' ' . $user->getLname() ?></h2>
            </div>
            <ul>
                <li>Birthday -
                    <?php
                        $date = $user->getDob();
                        $dateObj   = DateTime::createFromFormat('!m', $date[1]);
                        $monthName = $dateObj->format('F');
                        echo $date[0] . " " . $monthName . " " . $date[2];
                    ?>
                </li><br>
                <li>Gender -
                    <?php
                        if ($user->getGender() == 1) {
                            echo " Male";
                        } else {
                            echo " Female";
                        }
                    ?>
                </li><br>
                <li>City -
                    <?php
                        if ($user->getCity()==null) {
                            echo "Not specified";
                        } else {
                            echo $user->getCity();
                        }
                    ?>
                </li><br>
                <li>Work -
                    <?php
                        if ($user->getWork()==null) {
                            echo "Not specified";
                        } else {
                            echo $user->getWork();
                        }
                    ?>
                </li><br>
                <li>Education -
                    <?php
                        if ($user->getEducation()==null) {
                            echo "Not specified";
                        } else {
                            echo $user->getEducation();
                        }
                    ?>
                </li><br>
            </ul>
        </div>
        <div class="editdiv">
            <?php

                if( Service\NotificationManager::checkIfRequestSent($user->getId())) {
                    \Helper\Debug::consoleLog("Sent");
                } else {
                    \Helper\Debug::consoleLog("Not Sent");
                }

                if ($_COOKIE['id'] == $user->getId()) {
                    echo "<a class='edit' href='index.php?page=user&action=form&id={$_COOKIE['id']}'>Edit Profile</a>";
                } else if (!\Service\NotificationManager::checkIfRequestSent($user->getId()) && !$this->connection->checkIfFriend($user->getId())) {
                    echo "<a class='edit' href='index.php?page=user&action=request&id={$user->getId()}'>Send Request</a>";
                }
                if (\Service\NotificationManager::checkIfRequestSent($user->getId()) && !$this->connection->checkIfFriend($user->getId())){
                    echo "<a class='edit' href=''>Request Sent</a>";
                }
                if ($this->connection->checkIfFriend($user->getId())) {
                    echo "<a class='edit' href=''>Friends</a>";
                }
            ?>
        </div>
        <div class="buttons">
            <a class="edit" href="index.php?page=user&action=photos">Photos</a>
            <a class="edit" href="index.php?page=friend&action=show&id=<?php echo $user->getId() ?>">Friends</a>
        </div>
    </div>

</body>
</html>