<?php
    /**
     * Created by PhpStorm.
     * User: abelghazinyan
     * Date: 7/19/17
     * Time: 12:08 PM
     */

    namespace Controller;
    use Db\Connection;
    use Helper\Debug;
    use \Helper\ImageUploader;
    use Model\UserModel;
    use Model\Notification;
    use Service\NotificationManager;
    use Model\Post;
    use Service\PostManager;
    use Service\PostDrawer;

    class UserController
    {
        private $connection;
        const TIMELINE_UPDATE_SIZE = 1;

        public function __construct()
        {
            $this->connection = Connection::getInstance();
        }

        public function actionProfile ($id)
        {
            $user = new UserModel($id);
            require '../view/user/profile.php';
        }

        public function actionUpdatetimeline($page)
        {
            $start = ($page - 1) * (self::TIMELINE_UPDATE_SIZE) + PostDrawer::POST_COUNT;
            $offset = self::TIMELINE_UPDATE_SIZE;
            $message = PostDrawer::drawTimeline($start, $offset);
            return $message;
        }
        public function actionTimeline()
        {
            if ($_SERVER['REQUEST_METHOD']==='POST') {
                if ($_POST['form'] == 'post') {
                    $text = $_POST['text'];
                    $uploader = new ImageUploader('post');
                    $target_dir = $uploader->upload();
                    \Helper\Debug::consoleLog($uploader->getImageError());
                    if ($uploader->getImageError() == '' && $target_dir != null) {
                        $path = $target_dir;
                    } else {
                        $path = null;
                    }

                    $post = new Post();
                    $post->setImagePath($path);
                    $post->setPosterId($_COOKIE['id']);
                    $post->setText($text);
                    if ($text != null || $path != null) {
                        PostManager::makePost($post);
                    }
                    header("Location:../public/index.php?page=user&action=timeline&id={$_COOKIE['id']}");
                }
            }
            require '../view/user/timeline.php';
        }

        public function actionRemovephoto($userID,$photoID)
        {
            if ($userID == $_COOKIE['id']) {
                $this->connection->removePhoto($photoID);
            }
            header("Location:../public/index.php?page=user&action=photos&id={$userID}");
        }

        private function addPhoto($path) {
            echo
            "<a href='index.php?page=user&action=removephoto&key={$path['user_id']}&result={$path['id']}'>
            <div class='pic'>
            <img src='{$path['path']}'>
            </div>
            </a>";
        }

        public function actionPhotos ($id)
        {
            $uploader = new ImageUploader('image');
            $target_dir = $uploader->upload();
            if ($uploader->getImageError() == '' && $target_dir != null) {
                $this->connection->addPhoto($id,$target_dir);
                header("Location:../public/index.php?page=user&action=photos&id={$id}");
            }
            $userId = $id;
            $user = new UserModel($id);
            $photos = $user->getPhotos($id);
            require '../view/user/photos.php';
        }

        public function actionRemovenotification($id)
        {
            NotificationManager::removeNotificationById($id);
        //    header("Location:../public/index.php?page=user&action=profile&id={$id}");
            return true;
        }

        public function actionAcceptrequest($senderId)
        {
            $id = $_COOKIE['id'];
            NotificationManager::removeFriendRequest($_COOKIE['id'],$senderId);
            $this->connection->addFriend($id,$senderId);

            $notification = new Notification();
            $notification->setRecieverId($senderId);
            $notification->setSenderId($_COOKIE['id']);
            $notification->setType(Notification::NOTIFICATION_TYPE_POST);
            $notification->setText("Accepted your request");
            NotificationManager::makeNotification($notification);

          //  header("Location:../public/index.php?page=user&action=profile&id={$id}");
            return true;
        }

        public function actionRemoveRequest($senderId)
        {
            $id = $_COOKIE['id'];
            NotificationManager::removeFriendRequest($_COOKIE['id'],$senderId);

            $notification = new Notification();
            $notification->setRecieverId($senderId);
            $notification->setSenderId($_COOKIE['id']);
            $notification->setType(Notification::NOTIFICATION_TYPE_POST);
            $notification->setText("Rejected your request");
            NotificationManager::makeNotification($notification);

            header("Location:../public/index.php?page=user&action=profile&id={$id}");
            return true;
        }

        public function actionRequest($id) {
            $notificationManager = new NotificationManager();
            $notification = new Notification();
            $notification->setType(Notification::NOTIFICATION_TYPE_REQUEST);
            $notification->setText("Hello World!");
            $notification->setSenderId($_COOKIE['id']);
            $notification->setRecieverId($id);
            $notificationManager->makeNotification($notification);
            header("Location:../public/index.php?page=user&action=profile&id={$id}");
        }

        public function actionForm ($id)
        {
            $uploader = new ImageUploader('profile');
            $target_dir = $uploader->upload();
            if ($uploader->getImageError() == '' && $target_dir != null) {
                $this->connection->setUserAvatar($id,$target_dir);
                header("Location:../public/index.php?page=user&action=form&id={$id}");
            }
            $user = new UserModel($id);

            if ($_SERVER['REQUEST_METHOD']==='POST') {
                if ($_POST['form'] == 'form') {
                    $error = '';

                    if(!isset($_POST['fname'])) {
                        $error = "First name is required";
                    } else {
                        $fname = $_POST['fname'];
                    }

                    if(!isset($_POST['fname'])) {
                        $error = "Last name is required";
                    } else {
                        $lname = $_POST['lname'];
                    }
                    if(!isset($_POST['years'])) {
                        $error = "Enter year";
                    } else {
                        $years = $_POST['years'];

                    }
                    if(!isset($_POST['months'])) {
                        $error = "Enter month";
                    } else {
                        $months = $_POST['months'];
                    }
                    if(!isset($_POST['days'])) {
                        $error = "Enter day";
                    } else {
                        $days = $_POST['days'];
                    }
                    $city = $_POST['city'];
                    $work = $_POST['work'];
                    $education = $_POST['education'];
                    if ($_POST['gender'] == 'male') {
                        $gender = 1;
                    } else {
                        $gender = 0;
                    }
                    if ($error === '') {
                        $date = $days . " " . $months . " " . $years;
                        $dob = date('d-m-Y', strtotime($date));
                    }
                    $id = $_COOKIE['id'];
                    var_dump($error);
                    if ($error == '') {
                        $this->connection->updateUser($id,$fname,$lname,$dob,$gender,$city,$work,$education);
                        header("Location:index.php?page=user&action=profile&id={$id}");
                    }



                }
            }

            require '../view/user/profileform.php';
        }
    }