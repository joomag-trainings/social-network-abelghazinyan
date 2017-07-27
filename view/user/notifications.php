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
        $notifCount = 6;
        $from = 1;
        NotificationDrawer::drawNotificationColumn($_COOKIE['id'],$from,$notifCount);
    
    ?>
    </div>
</div>

</body>
<script>

    var notifBar = document.getElementsByClassName('notificationColumn');
    var page = 1;
    window.onscroll = function(ev) {
        if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                     notifBar[0].innerHTML += this.responseText;
                }
            };
            page++;
            console.log(page);
            xhttp.open("GET", "../public/index.php?page=notification&action=addcolumn&id=" + page);
            xhttp.send();

        }
    };

    var notifButton = document.getElementsByClassName('notifButtonColumn');

    for (i = notifButton.length-1 ; i>=0  ; i--) {
            if (notifButton[i] != null) {
                notifButton[i].addEventListener('click',function (e) {
                var xhttp = new XMLHttpRequest();
                var id = e.target.getAttribute('name');
                var type = e.target.getAttribute('id');
                if (type == 'notifAcceptColumn'){
                    xhttp.open("GET", "../public/index.php?page=user&action=acceptrequest&id=" + id);
                }
                if (type == 'notifRejectColumn'){
                     xhttp.open("GET", "../public/index.php?page=user&action=removerequest&id=" + id);
                }
                xhttp.send();
                e.target.parentNode.parentNode.parentNode.removeChild(e.target.parentNode.parentNode);
            });
        }
    }

</script>
</html>
