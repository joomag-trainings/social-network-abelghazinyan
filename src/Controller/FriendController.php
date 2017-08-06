<?php
    /**
     * Created by PhpStorm.
     * User: abelghazinyan
     * Date: 7/28/17
     * Time: 12:53 AM
     */

    namespace Controller;
    use \Db\Connection;
    use \Model\UserModel;
    use Slim\Http\Request;
    use Slim\Http\Response;
    use Slim\Views\PhpRenderer;
    use Slim\Container;
    use Controller\AbstractController;
    use \Service\NotificationManager;
    use \Model\Notification;

    class FriendController extends AbstractController
    {

        private $connection;
        const PAGE_SIZE=6;
        public function __construct($container)
        {
            parent::__construct($container);
            $this->connection = Connection::getInstance();
        }

        public function actionAcceptrequest(Request $request, Response $response, $args)
        {
            $senderId = $args['senderId'];
            $id = $_COOKIE['id'];
            NotificationManager::removeFriendRequest($_COOKIE['id'],$senderId);
            $this->connection->addFriend($id,$senderId);

            $notification = new Notification();
            $notification->setRecieverId($senderId);
            $notification->setSenderId($_COOKIE['id']);
            $notification->setType(Notification::NOTIFICATION_TYPE_POST);
            $notification->setText("Accepted your request");
            NotificationManager::makeNotification($notification);

            header("Location:/social-network/public/index.php/profile={$id}");
            exit;
        }

        public function actionRemoveRequest(Request $request, Response $response, $args)
        {
            $senderId = $args['senderId'];
            $id = $_COOKIE['id'];
            NotificationManager::removeFriendRequest($_COOKIE['id'],$senderId);

            $notification = new Notification();
            $notification->setRecieverId($senderId);
            $notification->setSenderId($_COOKIE['id']);
            $notification->setType(Notification::NOTIFICATION_TYPE_POST);
            $notification->setText("Rejected your request");
            NotificationManager::makeNotification($notification);

            header("Location:http://localhost/social-network/public/index.php/profile={$id}");
            exit;
        }

        public function actionRequest(Request $request, Response $response, $args) {
            $id = $args['id'];
            $notificationManager = new NotificationManager();
            $notification = new Notification();
            $notification->setType(Notification::NOTIFICATION_TYPE_REQUEST);
            $notification->setText("Hello World!");
            $notification->setSenderId($_COOKIE['id']);
            $notification->setRecieverId($id);
            $notificationManager->makeNotification($notification);
            header("Location:/social-network/public/index.php/profile={$id}");
            exit;
        }

        public function addUserBox(UserModel $user) {
            $message =
                "<a href='http://localhost/social-network/public/index.php/profile={$user->getId()}'>" .
                "<div class='userBox'>" .
                "<div class='avatar'>" .
                "<img src='{$user->getAvatarPath()}'>" .
                "</div>" .
                "<div class='aboutUser'>" .
                "<h1>{$user->getFname()} {$user->getLname()}</h1>";
            if ($user->getCity()!=null) {
                $message .= "<h2>From {$user->getCity()}</h2>";
            } if ($user->getWork()!=null) {
                $message .= "<h2>Works at {$user->getWork()}</h2>";
            } if ($user->getEducation()!=null) {
                $message .= "<h2>Studied at {$user->getEducation()}</h2>";
            }
            $message .= "</div>";
            $message .= "</div>";
            $message .= "</a>";
            echo $message;
            return $message;
        }

        public function actionGet(Request $request, Response $response, $args) {
            $page = $args['page'];
            $id = $args['id'];
            $start = ($page -1) * self::PAGE_SIZE;
            $offset = self::PAGE_SIZE;
            $user = new UserModel($id);
            $friendList = $user->getFriendList();
            if (!empty($friendList)) {
                $friendList = array_slice($friendList, $start, $offset);
                if (!empty($friendList)) {
                    foreach ($friendList as $friendID) {
                        $list[] = $this->connection->getUserDataById($friendID);
                    }
                    foreach ($list as $user) {
                        $userList[] = new UserModel($user['id']);
                    }
                    if (isset($userList)) {
                        foreach ($userList as $userBox) {
                            $this->addUserBox($userBox);
                        }
                    }
                }
            }

            return $response;
        }

        public function actionShow(Request $request, Response $response, $args)
        {
            $id = $args['id'];

            if ($this->connection->getUserDataById($id) == null) {
                $uri = "social-network/public/index.php/error";
                return $response = $response->withRedirect($uri);
            }

            $offset = self::PAGE_SIZE;
            $user = new UserModel($id);
            $friendList = $user->getFriendList();
            if (!empty($friendList)) {
                $friendList = array_slice($friendList, 0, $offset);
                if (!empty($friendList)) {
                    foreach ($friendList as $friendID) {
                        $list[] = $this->connection->getUserDataById($friendID);
                    }
                    foreach ($list as $userRow) {
                        $userList[] = new UserModel($userRow['id']);
                    }
                }
            }

            $viewRenderer = $this->container->get('view');

            $response = $viewRenderer->render(
                $response,
                "/user/friends.phtml",
                [
                    'userList' => $userList,
                    'class' => $this
                ]
            );

            return $response;
        }
    }