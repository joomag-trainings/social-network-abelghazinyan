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

    class UserController
    {
        private $connection;

        public function __construct()
        {
            $this->connection = Connection::getInstance();
        }

        public function actionProfile ($id)
        {
            $user = new UserModel($id);
            require '../view/user/profile.php';
        }

        public function actionTimeline ()
        {
            require '../view/user/timeline.php';
        }

        public function actionPhotos ()
        {
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
            $uploader = new ImageUploader('profile',"/var/www/html/social-network/Profile/");
            $uploader->upload();
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
                   // die($id . " " . $fname . " " . $lname . " " . $dob . " " . $gender . " " . $city . " " . $work . " " . $education);

                }
            }

            require '../view/user/profileform.php';
        }
    }