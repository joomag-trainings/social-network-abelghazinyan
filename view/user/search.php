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
        <div class="containerBox">
            <?php
                if (isset($userList)) {
                    foreach ($userList as $userBox) {
                        $this->addUserBox($userBox);
                    }
                } else {
                    echo "<h1>No results</h1>";
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
        page++;
        key = findGetParameter('key');
        xhttp.open("GET", "../public/index.php?page=search&action=get&key=" + key + "&result=" + page);
        xhttp.send();

        }
    };
</script>
