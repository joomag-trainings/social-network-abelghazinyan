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
        private $city;
        private $work;
        private $education;
        private $friendList;
        private $avatarPath;

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
            $this->city = $data['city'];
            $this->work = $data['work'];
            $this->education = $data['education'];
            if ($data['avatar'] == null) {
                $this->avatarPath = "../../media/defaultAvatar.jpg";
            } else {
                $this->avatarPath = $data['avatar'];
            }
            $this->friendList = $db->getFriendList($id);
        }

        public function getBirthday()
        {
            $date = getDob();
            $dateObj   = DateTime::createFromFormat('!m', $date[1]);
            $monthName = $dateObj->format('F');
            $dob[0] = $this->dob[0];
            $dob[1] = $monthName;
            $dob[2] = $this->dob[2];
            return $dob;
        }

        public function getPhotos()
        {
            $connection = Connection::getInstance()->getConnection();
            $statement=$connection->prepare("SELECT * FROM photos where user_id= '{$this->id}'");
            $statement->execute();
            $res = $statement->fetchAll(\PDO::FETCH_ASSOC);

            return $res;
        }

        /**
         * @return mixed
         */
        public function getFriendList()
        {
            return $this->friendList;
        }


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

        /**
         * @return mixed
         */
        public function getCity()
        {
            return $this->city;
        }

        /**
         * @param mixed $city
         */
        public function setCity($city)
        {
            $this->city = $city;
        }

        /**
         * @return mixed
         */
        public function getWork()
        {
            return $this->work;
        }

        /**
         * @param mixed $work
         */
        public function setWork($work)
        {
            $this->work = $work;
        }

        /**
         * @return mixed
         */
        public function getEducation()
        {
            return $this->education;
        }

        /**
         * @param mixed $education
         */
        public function setEducation($education)
        {
            $this->education = $education;
        }

        /**
         * @return mixed
         */
        public function getAvatarPath()
        {
            return $this->avatarPath;
        }

        /**
         * @param mixed $avatarPath
         */
        public function setAvatarPath($avatarPath)
        {
            $this->avatarPath = $avatarPath;
        }

    }