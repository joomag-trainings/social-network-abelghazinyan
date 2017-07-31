<?php

    namespace Model;

    class Notification
    {
        const NOTIFICATION_TYPE_REQUEST='request';
        const NOTIFICATION_TYPE_POST='post';
        private $id;
        private $time;
        private $senderId;
        private $type;
        private $recieverId;
        private $text;
        private $notificationTypes = [self::NOTIFICATION_TYPE_POST,self::NOTIFICATION_TYPE_REQUEST];


        /**
         * @return mixed
         */
        public function getId()
        {
            return $this->id;
        }

        /**
         * @param mixed $id
         */
        public function setId($id)
        {
            $this->id = $id;
        }

        /**
         * @return mixed
         */
        public function getTime()
        {
            return $this->time;
        }

        /**
         * @param mixed $time
         */
        public function setTime($time)
        {
            $this->time = $time;
        }

        /**
         * @return mixed
         */
        public function getSenderId()
        {
            return $this->senderId;
        }

        /**
         * @param mixed $senderId
         */
        public function setSenderId($senderId)
        {
            $this->senderId = $senderId;
        }

        /**
         * @return mixed
         */
        public function getType()
        {
            return $this->type;
        }

        /**
         * @param mixed $type
         */
        public function setType($type)
        {
            if(in_array($type,$this->notificationTypes)) {
                $this->type = $type;
            } else {
                die("WRONG NOTIFICATION TYPE");
            }
        }

        /**
         * @return mixed
         */
        public function getRecieverId()
        {
            return $this->recieverId;
        }

        /**
         * @param mixed $recieverId
         */
        public function setRecieverId($recieverId)
        {
            $this->recieverId = $recieverId;
        }

        /**
         * @return mixed
         */
        public function getText()
        {
            return $this->text;
        }

        /**
         * @param mixed $text
         */
        public function setText($text)
        {
            $this->text = $text;
        }


    }