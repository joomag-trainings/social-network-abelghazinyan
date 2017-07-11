<?php
    $emailSignIn = '';
    $pswdSignIn = '';
    $emailSignUp = '';
    $firstName = '';
    $lastName = '';
    $pswdNew = '';
    $pswdConfirm = '';
    $gender = '';

    $emailErr = $passwordErr = '';

    $signUpErr = '';
    $errCount = 0;
    function cleanData($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if ($_SERVER['REQUEST_METHOD']==='POST') {
        if ($_POST['form'] == 'signIn') {
            if (empty($_POST['email'])) {
                $emailErr = 'Email is required';
            } else {
                if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                    $emailErr = "Invalid email format";
                } else {
                    $emailSignIn = cleanData($_POST['email']);
                }
            }
            if (empty($_POST['password'])) {
                $passwordErr = 'Password is required';
            } else {
                $pswdSignIn = cleanData($_POST['password']);
            }
        }
        if ($_POST['form'] == 'signUp') {
            if (empty($_POST['fname'])) {
                if ($errCount === 0) {
                    $signUpErr = 'First name is required';
                }
                $errCount++;
            } else {
                if (!preg_match("/^[a-zA-Z ]*$/",$_POST['fname'])) {
                    if ($errCount === 0) {
                        $signUpErr = "Only letters allowed";
                        $errCount++;
                    }
                } else {
                    $firstName = cleanData($_POST['fname']);
                }
            }
            if (empty($_POST['lname'])) {
                if ($errCount === 0) {
                    $signUpErr = 'Last name is required';
                }
                $errCount++;
            } else {
                if (!preg_match("/^[a-zA-Z ]*$/",$_POST['lname'])) {
                    if ($errCount === 0) {
                        $signUpErr = "Only letters allowed";
                        $errCount++;
                    }
                } else {
                    $lastName = cleanData($_POST['lname']);
                }
            }
            if (empty($_POST['email'])) {
                if ($errCount === 0) {
                    $signUpErr = 'Email is required';
                }
                $errCount++;
            } else {
                if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                    if ($errCount === 0) {
                        $signUpErr = "Invalid email format";
                        $errCount++;
                    }
                } else {
                    $emailSignUp = cleanData($_POST['email']);
                }
            }
            if (empty($_POST['pswd'])) {
                if ($errCount === 0) {
                    $signUpErr = 'Password is required';
                }
                $errCount++;
            } else {
                if (strlen($_POST['pswd']) < 8) {
                    if ($errCount === 0) {
                        $signUpErr = 'Password must be minimum 8 symbols long';
                        $errCount++;
                    }
                } else {
                    $pswdNew = cleanData($_POST['pswd']);
                }
            }
            if (empty($_POST['cnfpswd'])) {
                if ($errCount === 0) {
                    $signUpErr = 'You must confirm the Password';
                }
                $errCount++;
            } else {
                $pswdConfirm = cleanData($_POST['cnfpswd']);
                if (strcmp($_POST['pswd'],$pswdConfirm)) {
                    if ($errCount === 0) {
                        $signUpErr = 'Passwords don\'t match';
                        $errCount++;
                    }
                }
            }
            if (empty($_POST['gender'])) {
                if ($errCount === 0) {
                    $signUpErr = 'You must specify your gender';
                }
                $errCount++;
            } else {
                $gender = cleanData($_POST['gender']);
            }



        }
    }

    ?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel = "stylesheet"
          type = "text/css"
          href = "LoginStyle.css" />
</head>
<body>
    <div class="header">

        <div class="login">
        <form name="signIn" method="post">
            <input type="hidden" name="form" value="signIn">
            <input type="text" name="email" id="email" placeholder="E-Mail"
                   value="<?php echo htmlspecialchars($emailSignIn);?>">
            <span style="color:crimson;font-size: 15px;background-color: #ecf0f1""><?php echo $emailErr;?></span>
            <input type="password" name="password" id="password" placeholder="Password">
            <span style="color:crimson;font-size: 15px;background-color: #ecf0f1"" ><?php echo $passwordErr;?></span>
            <input class="submit" type="submit" value="SIGN IN">

        </form>
        </div>
    </div>
    <div class="signup">
        <h1>Create an Account</h1>
        <form name="signUp" method="post">
            <input type="hidden" name="form" value="signUp">
            <input type="text" name="fname" placeholder="First Name"
                   value="<?php echo htmlspecialchars($firstName);?>">
            <input type="text" name="lname" placeholder="Last Name"
                   value="<?php echo htmlspecialchars($lastName);?>"><br><br>
            <input type="text" id="long" name="email" placeholder="E-Mail"
                   value="<?php echo htmlspecialchars($emailSignUp);?>"><br><br>
            <input type="password" id="long" name="pswd" placeholder="New Password"
                   value="<?php echo htmlspecialchars($pswdNew);?>"><br><br>
            <input type="password" id="long" name="cnfpswd" placeholder="Confirm Password"><br><br>
            <div class="signupcenter">
            <label for="male">Male</label> <input type="radio" id="male" name="gender" value="male"
                                                    <?php if($gender==='male') echo "checked";?>>
            <label for="female">Female</label><input type="radio" id="female" name="gender" value="female"
                                                    <?php if($gender==='female') echo "checked";?>><br><br>
            <input class="submit" type="submit" value="SIGN UP">
            <span style="color:crimson;font-size: 15px;background-color: #ecf0f1" >   <?php echo $signUpErr;?></span>
            </div>
         </form>
    </div>

</body>
</html>