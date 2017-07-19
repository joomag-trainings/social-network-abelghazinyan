<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel = "stylesheet"
          type = "text/css"
          href = "../Styles/LoginStyle.css" />
</head>
<body>
    <div class="header">

        <div class="login">
        <form name="signIn" method="post">
            <input type="hidden" name="form" value="signIn">
            <input type="text" name="email" id="email" placeholder="E-Mail"
                   value="<?php echo htmlspecialchars($this->getUser());?>">
            <span style="color:crimson;font-size: 15px;background-color: #ecf0f1"><?php echo $this->getUserError();?></span>
            <input type="password" name="password" id="password" placeholder="Password">
            <span style="color:crimson;font-size: 15px;background-color: #ecf0f1" ><?php echo $this->getPasswordError();?></span>
            <input class="submit" type="submit" value="SIGN IN">

        </form>
        </div>
    </div>

    <div class="signup">
        <h1>Create an Account</h1>
        <form name="signUp" method="post">
            <input type="hidden" name="form" value="signUp">
            <input type="text" name="fname" placeholder="First Name"
                   value="<?php echo htmlspecialchars($this->signUp->getFirstName());?>">
            <input type="text" name="lname" placeholder="Last Name"
                   value="<?php echo htmlspecialchars($this->signUp->getLastName());?>"><br><br>
            <input type="text" id="long" name="email" placeholder="E-Mail"
                   value="<?php echo htmlspecialchars($this->signUp->getEmail());?>"><br><br>
            <?php require "../view/templates/dateInput.php" ?><br>
            <input type="password" id="long" name="pswd" placeholder="New Password"
                   value="<?php echo htmlspecialchars($this->signUp->getPassword());?>"><br><br>
            <input type="password" id="long" name="cnfpswd" placeholder="Confirm Password"><br><br>
            <div class="signupcenter">
            <label for="male">Male</label> <input type="radio" id="male" name="gender" value="male"
                                                    <?php if($this->signUp->getGender()==='male') echo "checked";?>>
            <label for="female">Female</label><input type="radio" id="female" name="gender" value="female"
                                                    <?php if($this->signUp->getGender()==='female') echo "checked";?>><br><br>
            <input class="submit" type="submit" value="SIGN UP">
            <span style="color:crimson;font-size: 15px;background-color: #ecf0f1" >   <?php echo $this->signUp->getError();?></span>
            </div>
         </form>
    </div>


</body>
</html>