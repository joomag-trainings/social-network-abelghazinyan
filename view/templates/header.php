<?php
    if ($_SERVER['REQUEST_METHOD']=='POST') {
        if(isset($_POST['search' ])) {
            if ($_POST['search'] != NULL) {
                $key = $_POST['search'];
                $url = "../public/index.php?page=search&action=search&key={$key}";
                header("Location:" . $url);
            }
        }
    }

?>
<div class="header">
    <div class="block">
        <div class="search">
            <form method="post">
                <input class="searchinput" name="search" type="text" placeholder="SEARCH">
            </form>
        </div>

    <div class="nav">
        <a href="index.php?page=user&action=timeline"><div class="navButton"><img src="../Assets/nav/home.png"></div></a>
        <div class="navButton"><img src="../Assets/nav/message.png"></div>
        <div class="navButton"><img src="../Assets/nav/notification.png"></div>
        <?php
            $id = $_COOKIE['id'];
            echo "<a href='index.php?page=user&action=profile&id={$id}'>";
        ?>
        <div class="navButton"><img src="../Assets/nav/profile.png"></div></a>
    </div>
    <a class="logout" href="index.php?page=authentication&action=logout">EXIT</a>

    </div>

</div>
<?php
    $connection = \Db\Connection::getInstance();
    if ($connection->getNotification($_COOKIE['id'],\Db\Connection::$NOTIFICATION_TYPE_REQUEST)) {

        $userHeader = new \Model\UserModel($connection->getNotificationSender($_COOKIE['id'],\Db\Connection::$NOTIFICATION_TYPE_REQUEST));

        echo "<div class='userBox'>";
        echo "<div class='avatar'>";
        echo "<img src='../Profile/profile.jpg'>";
        echo "</div>";
        echo "<div class='aboutUser'>";
        echo "<h3>Friend Request from</h3>";
        echo "<a href='../public/index.php?page=user&action=profile&id={$userHeader->getId()}'>";

        echo "<h1>{$userHeader->getFname()} {$userHeader->getLname()}</h1>";
        echo "</a>";
        echo "<a href='../public/index.php?page=user&action=acceptrequest&id={$userHeader->getId()}'>Accept</a>";
        echo "    ";
        echo "<a href='../public/index.php?page=user&action=removerequest&id={$userHeader->getId()}'>Remove</a>";
        echo "</div>";
        echo "</div>";

    }
?>
<style>
    body {
        padding: 0px;
        margin:0px;
        background-color: #BDBDBD;
    }
    .body {
        width:1000px;
        height:800px;
        margin:auto;
        margin-top:50px;
        background-color: #FAFAFA;
    }

    .userBox {
        position: relative;
        width:400px;
        height:100px ;
        margin:auto;
        padding: 5px;
        background-color: #E0E0E0;
        margin-top:10px;
    }

    .avatar {
        position:absolute;
        float: left;
        width:100px;
        height: 100px;
        height: 100px;
    }

    div.avatar > img {
        max-width:100%;
        min-width:100%;
        max-height:100%;
    }

    .aboutUser {
        position: absolute;
        left:110px;
        font-family: "DejaVu Sans";
        float:left;
        width: 300px;
        height:100px;
    }

    h1 {
        font-size: 20px;
        color: #2c3e50;
        text-align: center;
    }

    h3 {
        margin-top:2px;
        font-size: 10px;
        color: #34495e;
    }
</style>