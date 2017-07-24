<?php
    /**
     * Created by PhpStorm.
     * User: abelghazinyan
     * Date: 7/23/17
     * Time: 9:59 PM
     */

    namespace Controller;
    use \Db\Connection;
    use \Model\UserModel;

    class SearchController
    {
        private $connection;
        public function __construct()
        {
            $this->connection = Connection::getInstance();
        }

        public function addUserBox(UserModel $user) {
            echo "<a href='../public/index.php?page=user&action=profile&id={$user->getId()}'>";
            echo "<div class='userBox'>";
            echo "<div class='avatar'>";
            echo "<img src='../Profile/profile.jpg'>";
            echo "</div>";
            echo "<div class='aboutUser'>";
            echo "<h1>{$user->getFname()} {$user->getLname()}</h1>";
            if ($user->getCity()!=null) {
                echo "<h2>From {$user->getCity()}</h2>";
            } if ($user->getWork()!=null) {
                echo "<h2>Works at {$user->getWork()}</h2>";
            } if ($user->getEducation()!=null) {
                echo "<h2>Studied at {$user->getEducation()}</h2>";
            }
            echo "</div>";
            echo "</div>";
            echo "</a>";
        }

        public function actionSearch($key)
        {
            $fullKey = explode(' ',$key);
            if (sizeof($fullKey) === 1) {
                $list = $this->connection->getUsersByName($fullKey[0]);
                foreach ($list as $user) {
                    $userList[] = new UserModel($user['id']);
                }
            } else {
                $list = $this->connection->getUsersByFullName($fullKey[0],$fullKey[1]);
                foreach ($list as $user) {
                    $userList[] = new UserModel($user['id']);
                }
            }
            require '../view/user/search.php';
        }

        public function actionFriendlist()
        {
            $user = new UserModel($_COOKIE['id']);
            $friendList = $user->getFriendList();
            foreach ($friendList as $friendID) {
                $list[] = $this->connection->getUserDataById($friendID);
            }
            foreach ($list as $user) {
                $userList[] = new UserModel($user['id']);
            }
            require '../view/user/search.php';
        }

    }