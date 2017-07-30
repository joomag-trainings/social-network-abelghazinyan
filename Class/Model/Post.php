<?php

    namespace Model;


    class Post
    {
        private $id;
        private $time;
        private $posterId;
        private $text;
        private $imagePath;

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
        public function getPosterId()
        {
            return $this->posterId;
        }

        /**
         * @param mixed $posterId
         */
        public function setPosterId($posterId)
        {
            $this->posterId = $posterId;
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

        /**
         * @return mixed
         */
        public function getImagePath()
        {
            return $this->imagePath;
        }

        /**
         * @param mixed $imagePath
         */
        public function setImagePath($imagePath)
        {
            $this->imagePath = $imagePath;
        }
    }