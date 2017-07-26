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

            <?php
                if (isset($userList)) {
                    foreach ($userList as $userBox) {
                        $this->addUserBox($userBox);
                    }
                } else {
                    echo "<h1>Sorry search returned with 0 result.</h1>";
                }
                if ($page == $lastpage) {
                    $nextpage = $lastpage;
                } else {
                    $nextpage = $page + 1;
                }
                if ($page == 1) {
                    $prevtpage = 1;
                } else {
                    $prevtpage = $page - 1;

                }
                echo "<div class='pageSelect'>";
                if($page != 1) {
                    echo "<a class='selector1' href='../public/index.php?page=search&action=search&key={$key}&result=1'><<</a>";
                    echo "<a class='selector2' href='../public/index.php?page=search&action=search&key={$key}&result={$prevtpage}'><</a>";
                }
                echo "<span class='selector3'>$page</span>";
                if ($page !=$lastpage) {
                    echo "<a class='selector4' href='../public/index.php?page=search&action=search&key={$key}&result={$nextpage}'>></a>";
                    echo "<a class='selector5' href='../public/index.php?page=search&action=search&key={$key}&result={$lastpage}'>>></a>";
                }
                echo "</div>";
            ?>


</div>

</body>
</html>