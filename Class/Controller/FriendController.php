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

    class FriendController
    {

        private $connection;
        const PAGE_SIZE=6;
        public function __construct()
        {
            $this->connection = Connection::getInstance();
        }

        public function addUserBox(UserModel $user) {
            $message =
                "<a href='../public/index.php?page=user&action=profile&id={$user->getId()}'>" .
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

        public function actionGet($id,$page) {
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
        }

        public function actionShow($id)
        {
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
            require '../view/user/friends.php';
        }
    }