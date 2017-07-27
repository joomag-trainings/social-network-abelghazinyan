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
            $message ='';
            $notifications = NotificationManager::getNotifications($id,$from,$till);
            if ($notifications != null) {
                foreach ($notifications as $notification) {
                    if ($notification->getType() == Notification::NOTIFICATION_TYPE_REQUEST) {
                        $message .= self::drawFriendRequest($notification,self::NOTIFICATION_SHOW_TYPE_COLUMN);
                    } else if ($notification->getType() == Notification::NOTIFICATION_TYPE_POST) {
                        $message .= self::drawPost($notification,self::NOTIFICATION_SHOW_TYPE_COLUMN);
                    }
                }
            }
            return $message;
        }

        private static function drawFriendRequest(Notification $notification,$type)
        {
            $user = new UserModel($notification->getSenderId());
            $message =
                "<div class='notifBox{$type}' id='request'>".
                "div class='notifAvatar{$type}'>" .
                "<img src='../Profile/profile.jpg'>" .
                "</div>" .
                "<div class='notifAbout{$type}'>".
                "<h6 class='notifTime{$type}'>{$notification->getTime()}</h6>" .
                "<h3 class='notifText{$type}'>Sent you Friend Request</h3>" .
                "<a href='../public/index.php?page=user&action=profile&id={$user->getId()}'>" .
                "<h1 class='notifSender{$type}'>{$user->getFname()} {$user->getLname()}</h1>" .
                "</a>" .
                "<div class='notifButton{$type}' id='notifAccept{$type}' name='{$notification->getSenderId()}'>Accept</div>" .
                "    " .
                "<div class='notifButton{$type}' id='notifReject{$type}' name='{$notification->getSenderId()}'>Reject</div>".
                "</div>".
                "</div>";
                echo $message;
                return $message;
        }

        private static function drawPost(Notification $notification,$type)
        {
            $user = new UserModel($notification->getSenderId());
            $message =
                "<div class='notifBox{$type}'>".
                "<div class='notifAvatar{$type}'>".
                "<img src='../Profile/profile.jpg'>".
                "</div>".
                "<div class='notifAbout{$type}'>".
                "<h6 class='notifTime{$type}'>{$notification->getTime()}</h6>".
                "<h3 class='notifText{$type}'>{$notification->getText()}</h3>".
                "<a href='../public/index.php?page=user&action=profile&id={$user->getId()}'>".
                "<h1 class='notifSender{$type}'>{$user->getFname()} {$user->getLname()}</h1>".
                "</a>".
                "</div>".
                "</div>";
            echo $message;
            return $message;
        }
    }