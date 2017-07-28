<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Profile</title>
    <link rel = "stylesheet"
          type = "text/css"
          href = "../Styles/ProfileFormStyle.css" />
    <link rel = "stylesheet"
          type = "text/css"
          href = "../Styles/HeaderStyle.css" />
</head>
<body>
<?php require "../view/templates/header.php"?>
<div class="body">


        <div class="avatarBox">
            <div class="avatar">
                <img src="<?php echo $user->getAvatarPath() ?>">
            </div>
            <div class="upload">
                <form method="post" enctype="multipart/form-data">
                    <input type="hidden" name="form" value="profile">
                    <input type="file" name="file" id="file"><br><br>
                    <input type="submit" value="Upload" class="uploadImage">
                    <span style="color:crimson;font-size: 15px;float:left;margin-left:300px"><?php echo $uploader->getImageError();?></span>
                </form>

            </div>
        </div>
        <div
    <div class="edit">
        <form method="post">
            <input type="hidden" name="form" value="form">
            <label for="fname">First Name</label> <input type="text" name="fname" id="fname" value="<?= $user->getFname()?>"><br><br>
            <label for="lname">Last  Name</label><input type="text" name="lname" id="lname" value="<?= $user->getLname()?>"><br><br>
            <label>Birthday</label><?php require "../view/templates/dateInput.php" ?><br><br>
            <style>
                #date {
                    width:410px;
                    pading:auto;
                    float:right}
                select {
                   -webkit-appearance: none;
                   -moz-appearance: none;
                   background-image: url("data:image/svg+xml;utf8,<svg fill='black' height='24' viewBox='0 0 24 24' width='24' xmlns='http://www.w3.org/2000/svg'><path d='M7 10l5 5 5-5z'/><path d='M0 0h24v24H0z' fill='none'/></svg>");
                   background-repeat: no-repeat;
                   background-position-x: 100%;
                   background-position-y: 5px;
                   border:1px #BDBDBD solid;
                   font-size: 20px;
                   color:#34495e;
                   background-color: #BDBDBD;
                   font-family: "DejaVu Sans";
                   padding-right: 2rem;
                }
            </style>
            <label for="city">City</label><input type="text" id="city" name="city" placeholder="Enter City" value="<?= $user->getCity()?>"><br><br>
            <label for="work">Work</label><input type="text" id="work" name="work" placeholder="Enter Work" value="<?= $user->getWork()?>"><br><br>
            <label for="education">Education</label><input type="text" id="education" name="education" placeholder="Enter Education" value="<?= $user->getEducation()?>"><br><br>
            <div class="centergender">
                <label for="male">Male</label> <input type="radio" id="male" name="gender" value="male"
                    <?php if($user->getGender()==1) echo "checked";?>>
                <label for="female">Female</label><input type="radio" id="female" name="gender" value="female"
                    <?php if($user->getGender()==0) echo "checked";?>><br>
            </div>
            <input class="submit" type="submit" value="Submit Changes">
            <br>
            <br>
        </form>
    </div>


</div>
</body>
</html>