<?php

    spl_autoload_register(function ($classname) {
        include_once $classname . '.php';
    });

    class Authentication
    {
        private $emailErr, $emailSignIn, $passwordErr, $passwordSignIn;
        private $formUser, $formPassword, $formName;
        private $dataBase;

        public function __construct($formUser, $formPassword, $formName)
        {
            $this->formUser = $formUser;
            $this->formPassword = $formPassword;
            $this->formName = $formName;
            $this->emailErr = $this->emailSignIn = $this->passwordErr = $this->passwordSignIn = '';
            $this->dataBase = new DataBase();
            $this->dataBase->readDataBase();
        }

        public function readInputs()
        {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if ($_POST['form'] == $this->formName) {
                    if (empty($_POST[$this->formUser])) {
                        $this->emailErr = 'Email is required';
                    } else {
                        if (!Validation::validateEmail($_POST[$this->formUser])) {
                            $this->emailErr = "Invalid email format";
                        } else {
                            $this->emailSignIn = Validation::cleanData($_POST[$this->formUser]);
                        }
                    }
                    if (empty($_POST[$this->formPassword])) {
                        $this->passwordErr = 'Password is required';
                    } else {
                        $this->passwordSignIn = Validation::cleanData($_POST[$this->formPassword]);
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
                if ($_POST['form'] == $this->formName) {
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

        public function rememberUser()
        {
            setcookie('user', $this->emailSignIn);
        }

        static public function forgetUser()
        {
            unset($_COOKIE['user']);
            setcookie('user', null, 1);
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
                } else {
                    $this->forgetUser();
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