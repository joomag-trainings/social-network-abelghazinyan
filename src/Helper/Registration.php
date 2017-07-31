<?php

    namespace Helper;
    use \Db\Connection;
    use Slim\Http\Request;

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

        public function verifyForm(Request $request)
        {
            $errCount = 0;
            $postMade = false;
            if ($request->getParam('form') == self::$formName) {
                $postMade = true;
                if (empty($request->getParam('fname'))) {
                    if ($errCount === 0) {
                        $this->signUpErr = 'First name is required';
                    }
                    $errCount++;
                } else {
                    if (!Validation::validateName($request->getParam('fname'))) {
                        if ($errCount === 0) {
                            $this->signUpErr = "Only letters allowed";
                            $errCount++;
                        }
                    } else {
                        $this->firstName = Validation::cleanData($request->getParam('fname'));
                    }
                }
                if (empty($request->getParam('lname'))) {
                    if ($errCount === 0) {
                        $this->signUpErr = 'Last name is required';
                    }
                    $errCount++;
                } else {
                    if (!Validation::validateName($request->getParam('lname'))) {
                        if ($errCount === 0) {
                            $this->signUpErr = "Only letters allowed";
                            $errCount++;
                        }
                    } else {
                        $this->lastName = Validation::cleanData($request->getParam('lname'));
                    }
                }
                if (empty($request->getParam('email'))) {
                    if ($errCount === 0) {
                        $this->signUpErr = 'Email is required';
                    }
                    $errCount++;
                } else {
                    if (!filter_var($request->getParam('email'), FILTER_VALIDATE_EMAIL)) {
                        if ($errCount === 0) {
                            $this->signUpErr = "Invalid email format";
                            $errCount++;
                        }
                    } else {
                        $this->emailSignUp = Validation::cleanData($request->getParam('email'));
                    }
                }
                if (empty($request->getParam('years'))) {
                    if ($errCount === 0) {
                        $this->signUpErr = 'Birth date is required';
                    }
                    $errCount++;
                } else {
                    if (date("Y")-($request->getParam('years')) < 16) {
                        if ($errCount === 0) {
                            $this->signUpErr = 'You must be older than 16';
                            $errCount++;
                        }
                    } else {
                        $this->years = Validation::cleanData($request->getParam('years'));
                    }
                }
                if (empty($request->getParam('months'))) {
                    if ($errCount === 0) {
                        $this->signUpErr = 'Birth date is required';
                    }
                    $errCount++;
                } else {
                    $this->months = Validation::cleanData($request->getParam('months'));
                }
                if (empty($request->getParam('days'))) {
                    if ($errCount === 0) {
                        $this->signUpErr = 'Birth date is required';
                    }
                    $errCount++;
                } else {
                    $this->days = Validation::cleanData($request->getParam('days'));
                }
                if (empty($request->getParam('pswd'))) {
                    if ($errCount === 0) {
                        $this->signUpErr = 'Password is required';
                    }
                    $errCount++;
                } else {
                    if (strlen($request->getParam('pswd')) < 8) {
                        if ($errCount === 0) {
                            $this->signUpErr = 'Password must be minimum 8 symbols long';
                            $errCount++;
                        }
                    } else {
                        $this->pswdNew = Validation::cleanData($request->getParam('pswd'));
                    }
                }
                if (empty($request->getParam('cnfpswd'))) {
                    if ($errCount === 0) {
                        $this->signUpErr = 'You must confirm the Password';
                    }
                    $errCount++;
                } else {
                    $pswdConfirm = Validation::cleanData($request->getParam('cnfpswd'));
                    if (strcmp($request->getParam('pswd'),$pswdConfirm)) {
                        if ($errCount === 0) {
                            $this->signUpErr = 'Passwords don\'t match';
                            $errCount++;
                        }
                    }
                }
                if (empty($request->getParam('gender'))) {
                    if ($errCount === 0) {
                        $this->signUpErr = 'You must specify your gender';
                    }
                } else {
                    $this->gender = Validation::cleanData($request->getParam('gender'));
                }

            }

            if ($this->signUpErr === '' && $postMade === true) {
                return true;
            } else {
                return false;
            }
        }

        public function registerUser(Request $request)
        {
            $dataBase = Connection::getInstance();
            if($dataBase->validUserByEmail($this->emailSignUp)) {
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