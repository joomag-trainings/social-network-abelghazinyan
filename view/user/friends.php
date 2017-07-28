<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profile</title>
    <link rel = "stylesheet"
          type = "text/css"
          href = "../Styles/FriendsPageStyle.css" />
    <link rel = "stylesheet"
          type = "text/css"
          href = "../Styles/HeaderStyle.css" />
</head>
<body>
<?php require "../view/templates/header.php"?>
<div class="body">
    <div class="containerBox">
        <?php
            if (isset($userList)) {
                echo "<h1>Friends</h1>";
                foreach ($userList as $userBox) {
                    $this->addUserBox($userBox);
                }
            } else {
                echo "<h1>No friends</h1>";
            }
        ?>
    </div>
</div>

</body>
</html>
<script>

    function findGetParameter(parameterName) {
        var result = null,
            tmp = [];
        var items = location.search.substr(1).split("&");
        for (var index = 0; index < items.length; index++) {
            tmp = items[index].split("=");
            if (tmp[0] === parameterName) result = decodeURIComponent(tmp[1]);
        }
        return result;
    }


    var container = document.getElementsByClassName('containerBox');
    var page = 1;
    window.onscroll = function(ev) {
        if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    container[0].innerHTML += this.responseText;
                }
            };
            var id = findGetParameter('id');
            page++;
            xhttp.open("GET", "../public/index.php?page=friend&action=get&key=" + id +"&result=" + page);
            xhttp.send();

        }
    };
</script>

