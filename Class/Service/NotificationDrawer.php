<?php
    /**
     * Created by PhpStorm.
     * User: abelghazinyan
     * Date: 7/25/17
     * Time: 11:36 PM
     */

    namespace Service;
    use Helper\Debug;
    use Model\Notification;
    use Service\NotificationManager;
    use Model\UserModel;

    class NotificationDrawer
    {
        const NOTIFICATION_BAR_COUNT = 5;
        const NOTIFICATION_SHOW_TYPE_BAR = '';
        const NOTIFICATION_SHOW_TYPE_COLUMN = 'Column';
        public static function drawNotificationBar($id)
        {
            $notifications = NotificationManager::getNotifications($id,1,5);
            if ($notifications != null) {
                foreach ($notifications as $notification) {
                    if ($notification->getType() == Notification::NOTIFICATION_TYPE_REQUEST) {
                        self::drawFriendRequest($notification,self::NOTIFICATION_SHOW_TYPE_BAR);
                    } else if ($notification->getType() == Notification::NOTIFICATION_TYPE_POST) {
                        self::drawPost($notification,self::NOTIFICATION_SHOW_TYPE_BAR);
                    }
                }
            }
        }

        public static function drawNotificationColumn($id,$from,$till)
        {
            $notifications = NotificationManager::getNotifications($id,$from,$till);
            if ($notifications != null) {
                foreach ($notifications as $notification) {
                    if ($notification->getType() == Notification::NOTIFICATION_TYPE_REQUEST) {
                        self::drawFriendRequest($notification,self::NOTIFICATION_SHOW_TYPE_COLUMN);
                    } else if ($notification->getType() == Notification::NOTIFICATION_TYPE_POST) {
                        self::drawPost($notification,self::NOTIFICATION_SHOW_TYPE_COLUMN);
                    }
                }
            }
        }

        private static function drawFriendRequest(Notification $notification,$type)
        {
            $user = new UserModel($notification->getSenderId());
            echo "<div class='notifBox{$type}'>";
            echo "<div class='notifAvatar{$type}'>";
            echo "<img src='../Profile/profile.jpg'>";
            echo "</div>";
            echo "<div class='notifAbout{$type}'>";
            echo "<h6 class='notifTime{$type}'>{$notification->getTime()}</h6>";
            echo "<h3 class='notifText{$type}'>Sent you Friend Request</h3>";
            echo "<a href='../public/index.php?page=user&action=profile&id={$user->getId()}'>";
            echo "<h1 class='notifSender{$type}'>{$user->getFname()} {$user->getLname()}</h1>";
            echo "</a>";
            echo "<a class='notifButton{$type}' id='notifAccept{$type}' href='../public/index.php?page=user&action=acceptrequest&id={$user->getId()}'>Accept</a>";
            echo "    ";
            echo "<a class='notifButton{$type}' id='notifRemove{$type}' href='../public/index.php?page=user&action=removerequest&id={$user->getId()}'>Remove</a>";
            echo "</div>";
            echo "</div>";
        }

        private static function drawPost(Notification $notification,$type)
        {
            $user = new UserModel($notification->getSenderId());
            echo "<div class='notifBox{$type}'>";
            echo "<div class='notifAvatar{$type}'>";
            echo "<img src='../Profile/profile.jpg'>";
            echo "</div>";
            echo "<div class='notifAbout{$type}'>";
            echo "<h6 class='notifTime{$type}'>{$notification->getTime()}</h6>";
            echo "<h3 class='notifText{$type}'>{$notification->getText()}</h3>";
            echo "<a href='../public/index.php?page=user&action=profile&id={$user->getId()}'>";
            echo "<h1 class='notifSender{$type}'>{$user->getFname()} {$user->getLname()}</h1>";
            echo "</a>";
            echo "<a class='notifButton{$type}' id='notifRemove{$type}' href='../public/index.php?page=user&action=removenotification&id={$notification->getId()}'>Remove</a>";
            echo "</div>";
            echo "</div>";
        }
    }