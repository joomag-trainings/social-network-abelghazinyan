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
                "<img src='../Profile/profile.jpg'>" .
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

        public function actionGet($key,$page) {

            $start = ($page - 1) * self::PAGE_SIZE;
            $offset = self::PAGE_SIZE;
            $overalUsers = null;
            $message = '';
            $fullKey = explode(' ',$key);
            if (sizeof($fullKey) === 1) {
                $list = $this->connection->getUsersByName($fullKey[0],$start,$offset);
                $overalUsers =  $this->connection->getTotalCountOfUsersByName($fullKey[0]);
                foreach ($list as $user) {
                    $userList[] = new UserModel($user['id']);
                }
            } else {
                $list = $this->connection->getUsersByFullName($fullKey[0],$fullKey[1],$start,$offset);
                $overalUsers =  $this->connection->getTotalCountOfUsersByFullName($fullKey[0],$fullKey[1]);
                foreach ($list as $user) {
                    $userList[] = new UserModel($user['id']);
                }
            }
            $lastpage = ceil($overalUsers / self::PAGE_SIZE);
            if (isset($userList)) {
                foreach ($userList as $userBox) {
                    $message .= $this->addUserBox($userBox);
                }
            }
            print $message;
        }

        public function actionSearch($key,$page)
        {
            $start = ($page - 1) * self::PAGE_SIZE;
            $offset = self::PAGE_SIZE;
            $overalUsers = null;
            $fullKey = explode(' ',$key);
            if (sizeof($fullKey) === 1) {
                $list = $this->connection->getUsersByName($fullKey[0],$start,$offset);
                $overalUsers =  $this->connection->getTotalCountOfUsersByName($fullKey[0]);
                foreach ($list as $user) {
                    $userList[] = new UserModel($user['id']);
                }
            } else {
                $list = $this->connection->getUsersByFullName($fullKey[0],$fullKey[1],$start,$offset);
                $overalUsers =  $this->connection->getTotalCountOfUsersByFullName($fullKey[0],$fullKey[1]);
                foreach ($list as $user) {
                    $userList[] = new UserModel($user['id']);
                }
            }
            require '../view/user/search.php';
        }

    }