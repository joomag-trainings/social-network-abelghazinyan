<?php
    /**
     * Created by PhpStorm.
     * User: abelghazinyan
     * Date: 7/26/17
     * Time: 2:50 PM
     */

    namespace Controller;
    use \Service\NotificationDrawer;

    class NotificationController
    {
        public function actionShow() {
            require '../view/user/notifications.php';
        }

        public function actionAddcolumn($page) {
            $pageSize = 6;
            $from = $page*$pageSize;
            $message = NotificationDrawer::drawNotificationColumn($_COOKIE['id'],$from, $pageSize);
            print $message;
        }
    }