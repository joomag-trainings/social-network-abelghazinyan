<?php

    spl_autoload_register(function ($classname) {
        include_once $classname . '.php';
    });

    class Registration
    {
        private $signUpErr;
        private $firstName,$lastName,$emailSignUp,$pswdNew,$gender;
        private $formName;
        public function __construct($formName)
        {
            $this->signUpErr = '';
            $this->firstName = $this->lastName = $this->emailSignUp = $this->pswdNew = $this->gender = '';
            $this->formName = $formName;
        }

        public function verifyForm()
        {
            $errCount = 0;
            $request = false;
            if ($_SERVER['REQUEST_METHOD']==='POST') {
                if ($_POST['form'] == $this->formName) {
                    $request = true;
                    if (empty($_POST['fname'])) {
                        if ($errCount === 0) {
                            $this->signUpErr = 'First name is required';
                        }
                        $errCount++;
                    } else {
                        if (!Validation::validateName($_POST['fname'])) {
                            if ($errCount === 0) {
                                $this->signUpErr = "Only letters allowed";
                                $errCount++;
                            }
                        } else {
                            $this->firstName = Validation::cleanData($_POST['fname']);
                        }
                    }
                    if (empty($_POST['lname'])) {
                        if ($errCount === 0) {
                            $this->signUpErr = 'Last name is required';
                        }
                        $errCount++;
                    } else {
                        if (!Validation::validateName($_POST['lname'])) {
                            if ($errCount === 0) {
                                $this->signUpErr = "Only letters allowed";
                                $errCount++;
                            }
                        } else {
                            $this->lastName = Validation::cleanData($_POST['lname']);
                        }
                    }
                    if (empty($_POST['email'])) {
                        if ($errCount === 0) {
                            $this->signUpErr = 'Email is required';
                        }
                        $errCount++;
                    } else {
                        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                            if ($errCount === 0) {
                                $this->signUpErr = "Invalid email format";
                                $errCount++;
                            }
                        } else {
                            $this->emailSignUp = Validation::cleanData($_POST['email']);
                        }
                    }
                    if (empty($_POST['pswd'])) {
                        if ($errCount === 0) {
                            $this->signUpErr = 'Password is required';
                        }
                        $errCount++;
                    } else {
                        if (strlen($_POST['pswd']) < 8) {
                            if ($errCount === 0) {
                                $this->signUpErr = 'Password must be minimum 8 symbols long';
                                $errCount++;
                            }
                        } else {
                            $this->pswdNew = Validation::cleanData($_POST['pswd']);
                        }
                    }
                    if (empty($_POST['cnfpswd'])) {
                        if ($errCount === 0) {
                            $this->signUpErr = 'You must confirm the Password';
                        }
                        $errCount++;
                    } else {
                        $pswdConfirm = Validation::cleanData($_POST['cnfpswd']);
                        if (strcmp($_POST['pswd'],$pswdConfirm)) {
                            if ($errCount === 0) {
                                $this->signUpErr = 'Passwords don\'t match';
                                $errCount++;
                            }
                        }
                    }
                    if (empty($_POST['gender'])) {
                        if ($errCount === 0) {
                            $this->signUpErr = 'You must specify your gender';
                        }
                    } else {
                        $this->gender = Validation::cleanData($_POST['gender']);
                    }

                }
            }
            if ($this->signUpErr === '' && $request === true) {
                return true;
            } else {
                return false;
            }
        }

        public function registerUser ()
        {
            $dataBase = new DataBase();
            $dataBase->readDataBase();
            if($dataBase->validUser($this->emailSignUp)) {
                $this->signUpErr = 'Email is already in use!';
            } else {
                $string = $this->emailSignUp . ' ' . password_hash($this->pswdNew,PASSWORD_DEFAULT);
                $dataBase->addUser($string);
            }

        }

        public function getFirstName ()
        {
            return $this->firstName;
        }

        public function getLastName ()
        {
            return $this->lastName;
        }

        public function getEmail ()
        {
            return $this->emailSignUp;
        }

        public function getPassword ()
        {
            return $this->pswdNew;
        }

        public function getGender ()
        {
            return $this->gender;
        }

        public function getError ()
        {
            return $this->signUpErr;
        }
    }