<?php

    namespace Controller;
    use Controller\AbstractController;
    use Helper\Registration;
    use Helper\Validation;
    use \Db\Connection;
    use Slim\Http\Request;
    use Slim\Http\Response;
    use Slim\Views\PhpRenderer;
    use Slim\Container;

    class AuthenticationController extends AbstractController
    {
        private $emailErr;
        private $emailSignIn;
        private $passwordErr;
        private $passwordSignIn;
        public static  $formUser = 'email';
        public static $formPassword = 'password';
        public static $formName = 'signIn';
        private $dataBase;
        public $signUp;


        public function __construct(Container $container)
        {
            parent::__construct($container);
            $this->emailErr = '';
            $this->emailSignIn = '';
            $this->passwordErr = '';
            $this->passwordSignIn = '';
            $this->dataBase = Connection::getInstance();
            $this->signUp = new Registration();
        }

        public function actionShow(Request $request, Response $response, $args)
        {
            if ($this->checkIfRemembered()) {
                $id = $_COOKIE['id'];
                header("Location:http://localhost/social-network/public/index.php/profile={$id}");
                exit;
            } elseif ($this->readInputs($request)) {
                if ($this->verifyUser($request)) {
                    $this->actionLogin();
                    $id = $this->dataBase->getUserId($this->emailSignIn);
                    header("Location:http://localhost/social-network/public/index.php/profile={$id}");
                    exit;
                }
            }
            if ($this->signUp->verifyForm($request)) {
                $this->signUp->registerUser($request);
            }

            $viewRenderer = $this->container->get('view');

            $handler = $this;

            $response = $viewRenderer->render(
                $response,
                "/login.phtml",
                [
                    'handler' => $handler
                ]
            );

            return $response;

        }

        public function readInputs(Request $request)
        {
            if ($request->getParam('form') == self::$formName) {
                if (empty($request->getParam(self::$formUser))) {
                    $this->emailErr = 'Email is required';
                } else {
                    if (!Validation::validateEmail($request->getParam(self::$formUser))) {
                        $this->emailErr = "Invalid email format";
                    } else {
                        $this->emailSignIn = Validation::cleanData($request->getParam(self::$formUser));
                    }
                }
                if (empty($request->getParam(self::$formPassword))) {
                    $this->passwordErr = 'Password is required';
                } else {
                    $this->passwordSignIn = Validation::cleanData($request->getParam(self::$formPassword));
                }

                if ($this->passwordErr === '' && $this->emailErr === '') {
                    return true;
                } else {
                    return false;
                }
            }
        }

        public function verifyUser(Request $request)
        {
            $logIn = false;
            if ($request->getParam('form') == self::$formName) {
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
            header("Location:http://localhost/social-network/public/index.php/");
            exit;
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