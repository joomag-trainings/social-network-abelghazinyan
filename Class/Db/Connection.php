<?php

    namespace Db;

    class Connection
    {
        private static $instance;
        private $connection;
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

        public function validUser($email)
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
    }