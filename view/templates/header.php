<?php
    if ($_SERVER['REQUEST_METHOD']=='POST') {
        if(isset($_POST['search' ])) {
            if ($_POST['search'] != NULL) {
                $key = $_POST['search'];
                $url = "../public/index.php?page=search&action=search&key={$key}&result=1";
                header("Location:" . $url);
            }
        }
    }

?>
<link rel = "stylesheet"
      type = "text/css"
      href = "../Styles/NotificationBarStyle.css" />
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
        <div id='notifButton' class="navButton"><img src="../Assets/nav/notification.png"></div>
        <?php
            $id = $_COOKIE['id'];
            echo "<a href='index.php?page=user&action=profile&id={$id}'>";
        ?>
        <div class="navButton"><img src="../Assets/nav/profile.png"></div></a>
    </div>
    <a class="logout" href="index.php?page=authentication&action=logout">EXIT</a>

    </div>
    <?php
        use \Service\NotificationDrawer;


    ?>
</div>
<div class="notificationBar" id="notifBar">
    <?php NotificationDrawer::drawNotificationBar($_COOKIE['id']); ?>
    <div class="seeAll">
        <a href="index.php?page=notification&action=show">
            <h6 class="smallText">SEE ALL NOTIFICATIONS</h6>
        </a>
    </div>
</div>
<script>

    button = document.getElementById('notifButton');
    bar = document.getElementById('notifBar');
    bar.style.visibility = 'hidden';
    var show = true;

    button.addEventListener('click',function () {
        if (show) {
           // refreshBar();
            bar.style.visibility = 'visible';
        } else {
            bar.style.visibility = 'hidden';
        }
        show = !show;
    });

    var notifButton = document.getElementsByClassName('notifButton');

    for (i=notifButton.length-1 ; i>=0  ; i--) {
        if (notifButton[i] != null) {
            notifButton[i].addEventListener('click',function (e) {
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {

                    }
                };
                var id = e.target.getAttribute('name');
                var type = e.target.getAttribute('id');
                if (type == 'notifAccept'){
                    xhttp.open("GET", "../public/index.php?page=user&action=acceptrequest&id=" + id);
                }
                if (type == 'notifReject'){
                    xhttp.open("GET", "../public/index.php?page=user&action=removerequest&id=" + id);
                }
                xhttp.send();
                e.target.parentNode.parentNode.parentNode.removeChild(e.target.parentNode.parentNode);
            });
        }
    }

</script>
<style>
    body {
        padding: 0px;
        margin:0px;
        background-color: #BDBDBD;
    }

    div.avatar > img {
        max-width:100%;
        min-width:100%;
        max-height:100%;
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

    .notificationBar {
        visibility: hidden;
        position: fixed;
        z-index: 3;
        width:300px;
        min-heigh:50px;
        left:800px;
        padding:5px;
        background-color: #2c3e50;
        box-shadow: 0 10px 10px -6px gray;
    }

    .seeAll {
        width:300px;
        height:20px;
        background-color: #34495e;
    }

    .smallText {
        color:antiquewhite;
        text-align: center;
        font-size: 10px;
        padding-top:5px;
        font-family: "DejaVu Sans";
    }

    .navButton {
        cursor: hand;
    }
</style>