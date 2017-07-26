<?php

    namespace Service;
    use Helper\Debug;
    use \Model\Notification;
    use \Db\Connection;

    class NotificationManager
    {
        public static function makeNotification(Notification $notification)
        {
            $connection = Connection::getInstance()->getConnection();
            $id1 = $notification->getRecieverId();
            $id2 = $notification->getSenderId();
            $type = $notification->getType();
            $text = $notification->getText();
            $statement = $connection->prepare(
                "INSERT INTO notifications (id, id_1, id_2, time, type, text)
                          VALUES (NULL, :id_1, :id_2, now(), :type, :text)"
            );
            $statement->bindParam('id_1',$id1);
            $statement->bindParam('id_2',$id2);
            $statement->bindParam('type',$type);
            $statement->bindParam('text',$text);
            $statement->execute();
        }

        /**
         * @param $id
         * @param $from
         * @param $till
         * @return array|Notification
         */
        public static function getNotifications($id,$from,$till)
        {
            $connection = Connection::getInstance()->getConnection();
            $from--;
            $statement=$connection->prepare("SELECT * FROM notifications where id_1='{$id}' ORDER BY time DESC LIMIT {$till} OFFSET {$from}");
            $statement->execute();
            $res = $statement->fetchAll(\PDO::FETCH_ASSOC);
            $notifications = null;
            foreach ($res as $ntf) {
                $notification = new Notification();
                $notification->setId($ntf['id']);
                $notification->setRecieverId($ntf['id_1']);
                $notification->setSenderId($ntf['id_2']);
                $notification->setText($ntf['text']);
                $notification->setTime($ntf['time']);
                $notification->setType($ntf['type']);
                $notifications[] = $notification;
            }
            return $notifications;
        }

        public static function removeNotification(Notification $notification)
        {
            $connection = Connection::getInstance()->getConnection();
            $id = $notification->getId();
            $statement=$connection->prepare("DELETE FROM notifications where id='$id'");
            $statement->execute();
        }

        public static function removeNotificationById($id)
        {
            $connection = Connection::getInstance()->getConnection();
            $statement=$connection->prepare("DELETE FROM notifications where id='$id'");
            $statement->execute();
        }

        public static function removeFriendRequest($id,$senderId)
        {
            $connection = Connection::getInstance()->getConnection();
            $type = Notification::NOTIFICATION_TYPE_REQUEST;
            $statement=$connection->prepare("DELETE FROM notifications where id_1='{$id}' AND id_2='{$senderId}' AND type='{$type}'");
            $statement->execute();
        }

        public static  function checkIfRequestSent($id)
        {
            $connection = Connection::getInstance()->getConnection();
            $type = Notification::NOTIFICATION_TYPE_REQUEST;
            $sender = $_COOKIE['id'];
            $statement=$connection->prepare("SELECT * FROM notifications where id_1='{$id}' AND id_2='{$sender}' AND type='{$type}'");
            $statement->execute();
            $res = $statement->fetchAll(\PDO::FETCH_ASSOC);
            if (!empty($res)) {
                return true;
            } else {
                return false;
            }
        }
    }