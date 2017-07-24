<?php

    namespace Controller;
    use \Helper\Registration;
    use \Helper\Validation;
    use \Db\Connection;

    class AuthenticationController
    {
        private $emailErr;
        private $emailSignIn;
        private $passwordErr;
        private $passwordSignIn;
        private static  $formUser = 'email';
        private static $formPassword = 'password';
        private static $formName = 'signIn';
        private $dataBase;
        private $signUp;

        public function __construct()
        {
            $this->emailErr = '';
            $this->emailSignIn = '';
            $this->passwordErr = '';
            $this->passwordSignIn = '';
            $this->dataBase = Connection::getInstance();
            $this->signUp = new Registration();
        }

        public function actionShow()
        {
            if ($this->checkIfRemembered()) {
                $id = $_COOKIE['id'];
                header("Location:../public/index.php?page=user&action=profile&id={$id}");
            } elseif ($this->readInputs()) {
                if ($this->verifyUser()) {
                    $this->actionLogin();
                    $id = $this->dataBase->getUserId($this->emailSignIn);
                    header("Location:../public/index.php?page=user&action=profile&id={$id}");
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
                        if ($this->dataBase->validUserByEmail($this->emailSignIn)) {
                            if (password_verify($this->passwordSignIn, $this->dataBase->getHash($this->emailSignIn))) {
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
            setcookie('id', $this->dataBase->getUserId($this->emailSignIn));
        }

        public function actionLogout()
        {
            unset($_COOKIE['id']);
            setcookie('id', null, 1);
            header("Location:../public/index.php?page=authentication&action=show");
        }

        public function checkIfRemembered()
        {
            $login = false;

            if (isset($_COOKIE)) {
                $id= '';

                if (!empty($_COOKIE['id'])) {
                    $id = $_COOKIE['id'];
                }

                if ($this->dataBase->validUserById($id)) {

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