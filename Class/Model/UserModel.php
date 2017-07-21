<?php

    namespace Model;
    use \Db\Connection;

    class UserModel
    {
        private $id;
        private $email;
        private $hash;
        private $fname;
        private $lname;
        private $dob;
        private $gender;

        public function __construct($id)
        {
            $this->id = $id;
            $db = Connection::getInstance();
            $data = $db->getUserDataById($id);
            $this->email = $data['email'];
            $this->hash = $data['hash'];
            $this->fname = $data['fname'];
            $this->lname = $data['lname'];
            $this->dob = explode('-',$data['dob']);
            $this->gender = $data['gender'];
        }

        /**
         * @return string
         */
        public function getEmail()
        {
            return $this->email;
        }

        /**
         * @param string $email
         */
        public function setEmail($email)
        {
            $this->email = $email;
        }

        /**
         * @return string
         */
        public function getHash()
        {
            return $this->hash;
        }

        /**
         * @param string $hash
         */
        public function setHash($hash)
        {
            $this->hash = $hash;
        }

        /**
         * @return string
         */
        public function getFname()
        {
            return $this->fname;
        }

        /**
         * @param string $fname
         */
        public function setFname($fname)
        {
            $this->fname = $fname;
        }

        /**
         * @return string
         */
        public function getLname()
        {
            return $this->lname;
        }

        /**
         * @param string $lname
         */
        public function setLname($lname)
        {
            $this->lname = $lname;
        }

        /**
         * @return array
         */
        public function getDob()
        {
            return $this->dob;
        }

        /**
         * @param array $dob
         */
        public function setDob($dob)
        {
            $this->dob = $dob;
        }

        /**
         * @return int
         */
        public function getGender()
        {
            return $this->gender;
        }

        /**
         * @param int $gender
         */
        public function setGender($gender)
        {
            $this->gender = $gender;
        }
    }