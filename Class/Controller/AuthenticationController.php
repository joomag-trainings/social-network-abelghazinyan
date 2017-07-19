<?php

    namespace Controller;

    class AuthenticationController
    {
        private $emailErr, $emailSignIn, $passwordErr, $passwordSignIn;
        private static  $formUser = 'email', $formPassword = 'password', $formName = 'signIn';
        private $dataBase;
        private $signUp;

        public function __construct()
        {
            $this->emailErr = $this->emailSignIn = $this->passwordErr = $this->passwordSignIn = '';
            $this->dataBase = new DataBase();
            $this->dataBase->readDataBase();
            $this->signUp = new Registration();
        }

        public function actionShow ()
        {
            if ($this->checkIfRemembered()) {
                header("Location:../public/index.php?page=user&action=profile");
            } elseif ($this->readInputs()) {
                if ($this->verifyUser()) {
                    $this->actionLogin();
                    header("Location:../public/index.php?page=user&action=profile");
                }
            }

            if ($this->signUp->verifyForm()) {
                $this->signUp->registerUser();
            }

            require '../view/login.php';

        }

        public function readInputs()
        {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if ($_POST['form'] == self::$formName) {
                    if (empty($_POST[self::$formUser])) {
                        $this->emailErr = 'Email is required';
                    } else {
                        if (!Validation::validateEmail($_POST[self::$formUser])) {
                            $this->emailErr = "Invalid email format";
                        } else {
                            $this->emailSignIn = Validation::cleanData($_POST[self::$formUser]);
                        }
                    }
                    if (empty($_POST[self::$formPassword])) {
                        $this->passwordErr = 'Password is required';
                    } else {
                        $this->passwordSignIn = Validation::cleanData($_POST[self::$formPassword]);
                    }
                }
            }

            if ($this->passwordErr === '' && $this->emailErr === '') {
                return true;
            } else {
                return false;
            }
        }

        public function verifyUser()
        {
            $logIn = false;
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if ($_POST['form'] == self::$formName) {
                    if ($this->emailErr === '' && $this->passwordErr === '') {
                        if ($this->dataBase->validUser($this->emailSignIn)) {
                            if (password_verify($this->passwordSignIn, $this->dataBase->getHash($this->emailSignIn))) {
                                ///////LOGINED///////
                                $logIn = true;
                            } else {
                                $this->passwordErr = 'Password/Email incorrect!';
                            }
                        } else {
                            $this->passwordErr = 'Password/Email incorrect!';
                        }
                    }
                }
            }
            return $logIn;
        }

        public function actionLogin()
        {
            setcookie('user', $this->emailSignIn);
        }

        public function actionLogout()
        {
            unset($_COOKIE['user']);
            setcookie('user', null, 1);
            header("Location:../public/index.php?page=authentication&action=show");
        }

        public function checkIfRemembered()
        {
            $login = false;

            if (isset($_COOKIE)) {
                $user = '';

                if (!empty($_COOKIE['user'])) {
                    $user = $_COOKIE['user'];
                }

                if ($this->dataBase->validUser($user)) {

                    $login = true;
                }

            }

            return $login;
        }

        public function getUserError()
        {
            return $this->emailErr;
        }

        public function getPasswordError()
        {
            return $this->passwordErr;
        }

        public function resetErrors()
        {
            $this->passwordErr = '';
            $this->emailErr = '';
        }

        public function getUser()
        {
            return $this->emailSignIn;
        }
    }