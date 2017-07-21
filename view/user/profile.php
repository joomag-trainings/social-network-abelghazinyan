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
        <h2><?php echo $user->getFname(). ' ' . $user->getLname() ?></h2>
        <a class="logout" href="index.php?page=user&action=form">Edit</a>
        <div class="about">

            <ul>
                <li>Date of Birth:
                    <?php
                        $date = $user->getDob();
                        $dateObj   = DateTime::createFromFormat('!m', $date[1]);
                        $monthName = $dateObj->format('F');
                        echo $date[0] . " " . $monthName . " " . $date[2];
                    ?>
                </li>
                <li>Gender:
                    <?php
                        if ($user->getGender() == 1) {
                            echo " Male";
                        } else {
                            echo " Female";
                        }
                    ?>
                </li>
            </ul>
        </div>
    </div>
</body>
</html>