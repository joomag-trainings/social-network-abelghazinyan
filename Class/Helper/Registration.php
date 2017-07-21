<?php

    namespace Helper;
    use \Db\Connection;

    class Registration
    {
        private $signUpErr;
        private $firstName;
        private $lastName;
        private $emailSignUp;
        private $years;
        private $months;
        private $days;
        private $pswdNew;
        private $gender;
        private static $formName = 'signUp';
        public function __construct()
        {
            $this->signUpErr = '';
            $this->firstName = '';
            $this->lastName = '';
            $this->emailSignUp = '';
            $this->years = '';
            $this->months = '';
            $this->days = '';
            $this->pswdNew = '';
            $this->gender = '';
        }

        public function verifyForm()
        {
            $errCount = 0;
            $request = false;
            if ($_SERVER['REQUEST_METHOD']==='POST') {
                if ($_POST['form'] == self::$formName) {
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
                    if (empty($_POST['years'])) {
                        if ($errCount === 0) {
                            $this->signUpErr = 'Birth date is required';
                        }
                        $errCount++;
                    } else {
                        if (date("Y")-($_POST['years']) < 16) {
                            if ($errCount === 0) {
                                $this->signUpErr = 'You must be older than 16';
                                $errCount++;
                            }
                        } else {
                            $this->years = Validation::cleanData($_POST['years']);
                        }
                    }
                    if (empty($_POST['months'])) {
                        if ($errCount === 0) {
                            $this->signUpErr = 'Birth date is required';
                        }
                        $errCount++;
                    } else {
                        $this->months = Validation::cleanData($_POST['months']);
                    }
                    if (empty($_POST['days'])) {
                        if ($errCount === 0) {
                            $this->signUpErr = 'Birth date is required';
                        }
                        $errCount++;
                    } else {
                        $this->days = Validation::cleanData($_POST['days']);
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

        public function registerUser()
        {
            $dataBase = Connection::getInstance();
            if($dataBase->validUser($this->emailSignUp)) {
                $this->signUpErr = 'Email is already in use!';
            } else {
                $date = $this->days . " " . $this->months . " " . $this->years;
                $dob = date('d-m-Y', strtotime($date));
                if($this->gender === 'male') {
                    $gender = 1;
                } else {
                    $gender = 0;
                }
                $dataBase->registerUser(
                                        $this->emailSignUp,
                                        password_hash($this->pswdNew,PASSWORD_DEFAULT),
                                        $this->firstName,
                                        $this->lastName,
                                        $dob,
                                        $gender
                );
            }
        }

        public function getFirstName()
        {
            return $this->firstName;
        }

        public function getLastName()
        {
            return $this->lastName;
        }

        public function getEmail()
        {
            return $this->emailSignUp;
        }

        public function getYears()
        {
            return $this->years;
        }

        public function getMonths()
        {
            return $this->months;
        }

        public function getDays()
        {
            return $this->days;
        }

        public function getPassword()
        {
            return $this->pswdNew;
        }

        public function getGender()
        {
            return $this->gender;
        }

        public function getError()
        {
            return $this->signUpErr;
        }
    }