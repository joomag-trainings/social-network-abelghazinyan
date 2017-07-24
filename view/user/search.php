<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profile</title>
    <link rel = "stylesheet"
          type = "text/css"
          href = "../Styles/SearchStyle.css" />
    <link rel = "stylesheet"
          type = "text/css"
          href = "../Styles/HeaderStyle.css" />
</head>
<body>
    <?php require "../view/templates/header.php"?>
<div class="body">
        <pre>
            <?php
                if (isset($userList)) {
                    foreach ($userList as $userBox) {
                        $this->addUserBox($userBox);
                    }
                } else {
                    echo "<h1>Sorry search returned with 0 result.</h1>";
                }
            ?>
        </pre>
</div>

</body>
</html>