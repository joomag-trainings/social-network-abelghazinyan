<?php

    namespace Db;

    class Connection
    {
        private static $instance;
        private $connection;
        public static $NOTIFICATION_TYPE_REQUEST = "request";

        private function __construct()
        {
            $config = parse_ini_file('../config/config.ini');

            $this->connection = new \PDO("mysql:host=localhost;dbname={$config['dbname']}",$config['username'],$config['password']);
        }

        public static function getInstance()
        {
            if (self::$instance === null) {
                self::$instance = new Connection();
            }
            return self::$instance;
        }

        public function validUserById($id)
        {
            $statement=$this->connection->prepare("SELECT * FROM users where id= '{$id}'");
            $statement->execute();
            $res = $statement->fetchAll(\PDO::FETCH_ASSOC);

            if (!empty($res)) {
                return true;
            } else {
                return false;
            }
        }

        public function validUserByEmail($email)
        {
            $statement=$this->connection->prepare("SELECT * FROM users where email= '{$email}'");
            $statement->execute();
            $res = $statement->fetchAll(\PDO::FETCH_ASSOC);

            if (!empty($res)) {
                return true;
            } else {
                return false;
            }
        }

        public function getHash($email)
        {
            $statement=$this->connection->prepare("SELECT * FROM users where email= '{$email}'");
            $statement->execute();
            $res = $statement->fetchAll(\PDO::FETCH_ASSOC);
            return $res[0]["hash"];
        }

        public function registerUser($email, $hash, $fname, $lname, $dob, $gender)
        {
            $statement = $this->connection->prepare(
                "INSERT INTO users (id, email, hash, fname, lname, dob, gender)
                          VALUES (NULL, :email, :hash, :fname, :lname, :dob, :gender)"
            );
            $statement->bindParam('email',$email);
            $statement->bindParam('hash',$hash);
            $statement->bindParam('fname',$fname);
            $statement->bindParam('lname',$lname);
            $statement->bindParam('dob',$dob);
            $statement->bindParam('gender',$gender);
            $statement->execute();
        }

        public function getUserDataById($id)
        {
            $statement=$this->connection->prepare("SELECT * FROM users where id= '{$id}'");
            $statement->execute();
            $res = $statement->fetchAll(\PDO::FETCH_ASSOC);
            return $res[0];
        }

        public function getUserId($email)
        {
            $statement=$this->connection->prepare("SELECT * FROM users where email= '{$email}'");
            $statement->execute();
            $res = $statement->fetchAll(\PDO::FETCH_ASSOC);
            return $res[0]['id'];
        }

        public function updateUser($id , $fname, $lname, $dob, $gender, $city, $work, $education)
        {
            $statement = $this->connection->prepare(
                "UPDATE users SET fname='{$fname}', lname='{$lname}', dob='{$dob}', 
                          gender='{$gender}'
                          WHERE id='{$id}'"
            );
            $statement->execute();
            if ($city === NULL) {
                $statement = $this->connection->prepare("UPDATE users SET city='NULL' WHERE id='{$id}'");
                $statement->execute();
            } else {
                $statement = $this->connection->prepare("UPDATE users SET city='{$city}' WHERE id='{$id}'");
                $statement->execute();
            }
            if ($work === NULL) {
                $statement = $this->connection->prepare("UPDATE users SET work='NULL' WHERE id='{$id}'");
                $statement->execute();
            } else {
                $statement = $this->connection->prepare("UPDATE users SET work='{$work}' WHERE id='{$id}'");
                $statement->execute();
            }
            if ($education === NULL) {
                $statement = $this->connection->prepare("UPDATE users SET education='NULL' WHERE id='{$id}'");
                $statement->execute();
            } else {
                $statement = $this->connection->prepare("UPDATE users SET education='{$education}' WHERE id='{$id}'");
                $statement->execute();
            }
        }

        public function getUsersByName ($name)
        {
            $statement=$this->connection->prepare("SELECT * FROM users where fname='{$name}' OR lname='{$name}'");
            $statement->execute();
            $res = $statement->fetchAll(\PDO::FETCH_ASSOC);
            return $res;
        }

        public function getUsersByFullName ($fname,$lname)
        {
            $statement=$this->connection->prepare("SELECT * FROM users where fname='{$fname}' OR lname='{$lname}' OR fname='{$lname}' OR lname='{$fname}' ");
            $statement->execute();
            $res = $statement->fetchAll(\PDO::FETCH_ASSOC);
            return $res;
        }

        public function sendFriendRequest($id)
        {
            $type = self::$NOTIFICATION_TYPE_REQUEST;
            $id2 = $_COOKIE['id'];
            $statement = $this->connection->prepare(
                "INSERT INTO notifications (id_1, id_2, type)
                          VALUES (:id_1, :id_2, :type)"
            );
            $statement->bindParam('id_1',$id);
            $statement->bindParam('id_2',$id2);
            $statement->bindParam('type',$type);
            $statement->execute();
        }

        public function getNotification($id,$type)
        {
            $statement=$this->connection->prepare("SELECT * FROM notifications where id_1='{$id}' AND type='$type' ");
            $statement->execute();
            $res = $statement->fetchAll(\PDO::FETCH_ASSOC);
            if (!empty($res)) {
                return true;
            } else {
                return false;
            }
        }

        public function getNotificationSender($id,$type)
        {
            $statement=$this->connection->prepare("SELECT * FROM notifications where id_1='{$id}' AND type='$type' ");
            $statement->execute();
            $res = $statement->fetchAll(\PDO::FETCH_ASSOC);
            return $res[0]['id_2'];
        }

        public function removeNotification($id,$senderId,$type)
        {
            $statement=$this->connection->prepare("DELETE FROM notifications where id_1='{$id}' AND id_2='{$senderId}' AND type='$type' ");
            $statement->execute();
        }

        public function addFriend($id_1,$id_2)
        {
            $statement = $this->connection->prepare(
                "INSERT INTO friendlist (id_1, id_2)
                          VALUES (:id_1, :id_2)"
            );
            $statement->bindParam('id_1',$id_1);
            $statement->bindParam('id_2',$id_2);
            $statement->execute();

            $statement = $this->connection->prepare(
                "INSERT INTO friendlist (id_1, id_2)
                          VALUES (:id_1, :id_2)"
            );
            $statement->bindParam('id_1',$id_2);
            $statement->bindParam('id_2',$id_1);
            $statement->execute();
        }

        public function deleteFriend($id_1,$id_2)
        {
            $statement=$this->connection->prepare("DELETE FROM friendlist where id_1='{$id_1}' AND id_2='{$id_2}' ");
            $statement->execute();
            $statement=$this->connection->prepare("DELETE FROM friendlist where id_1='{$id_2}' AND id_2='{$id_1}' ");
            $statement->execute();
        }

        public function getFriendList($id)
        {
            $statement=$this->connection->prepare("SELECT * FROM friendlist where id_1='{$id}'");
            $statement->execute();
            $res = $statement->fetchAll(\PDO::FETCH_ASSOC);
            $list = null;
            foreach ($res as $row) {
                $list[] = $row['id_2'];
            }
            return $list;
        }
    }