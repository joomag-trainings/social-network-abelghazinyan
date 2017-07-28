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
<?php require "../view/templates/header.php"?>
<div class="body">

    <h1>Photos</h1>
    <?php
        if ($userId === $_COOKIE['id']) {
            echo
            "<div class='upload'>
                <form method='post' enctype='multipart/form-data'>
                    <input type='hidden' name='form' value='image'>
                    <input type='file' name='file' id='file'><br><br>
                    <input type='submit' value='Upload' class='uploadImage'>
                    <span style='color:crimson;font-size: 15px;float:left;margin-left:300px'>{$uploader->getImageError()}</span>
                </form>
            </div>";
        }
    ?>

    <br>
    <div class="containerBox">
        <?php
            if (!empty($photos)) {
                foreach ($photos as $photo) {
                    $this->addPhoto($photo);
                }
            } else {
                echo "<h1>No photos</h1>";
            }
        ?>
    </div>
</div>
</body>
</html>