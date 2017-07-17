<?php

    include '../Classes/Authentication.php';
    include '../Classes/Registration.php';

    $authenticator = new Authentication('email','password','signIn');
    $registrator = new Registration('signUp');

    if ($authenticator->checkIfRemembered()) {
       // header("Location:profile.php");
        //exit;
    } elseif ($authenticator->readInputs()) {
        if ($authenticator->verifyUser()) {

            $authenticator->rememberUser();
            header("Location:profile.php");
            exit;
        }
    }

    if ($registrator->verifyForm()) {
        $registrator->registerUser();
    }


    ?>

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
                   value="<?php echo htmlspecialchars($authenticator->getUser());?>">
            <span style="color:crimson;font-size: 15px;background-color: #ecf0f1"><?php echo $authenticator->getUserError();?></span>
            <input type="password" name="password" id="password" placeholder="Password">
            <span style="color:crimson;font-size: 15px;background-color: #ecf0f1" ><?php echo $authenticator->getPasswordError();?></span>
            <input class="submit" type="submit" value="SIGN IN">

        </form>
        </div>
    </div>
    <div class="signup">
        <h1>Create an Account</h1>
        <form name="signUp" method="post">
            <input type="hidden" name="form" value="signUp">
            <input type="text" name="fname" placeholder="First Name"
                   value="<?php echo htmlspecialchars($registrator->getFirstName());?>">
            <input type="text" name="lname" placeholder="Last Name"
                   value="<?php echo htmlspecialchars($registrator->getLastName());?>"><br><br>
            <input type="text" id="long" name="email" placeholder="E-Mail"
                   value="<?php echo htmlspecialchars($registrator->getEmail());?>"><br><br>
            <input type="password" id="long" name="pswd" placeholder="New Password"
                   value="<?php echo htmlspecialchars($registrator->getPassword());?>"><br><br>
            <input type="password" id="long" name="cnfpswd" placeholder="Confirm Password"><br><br>
            <div class="signupcenter">
            <label for="male">Male</label> <input type="radio" id="male" name="gender" value="male"
                                                    <?php if($registrator->getGender()==='male') echo "checked";?>>
            <label for="female">Female</label><input type="radio" id="female" name="gender" value="female"
                                                    <?php if($registrator->getGender()==='female') echo "checked";?>><br><br>
            <input class="submit" type="submit" value="SIGN UP">
            <span style="color:crimson;font-size: 15px;background-color: #ecf0f1" >   <?php echo $registrator->getError();?></span>
            </div>
         </form>
    </div>

</body>
</html>