<?php

    class DataBase
    {
        private $dataBase;

        public function __construct()
        {
            $this->dataBase=null;
        }

        public function readDataBase()
        {
            if (!isset($this->dataBase)) {
                $handle = fopen('../Data_Base/DataBase', 'r');
                while (!feof($handle)) {
                    $line = fgets($handle);
                    $line = trim($line);
                    $words = explode(' ', $line);
                    if ($words[0] !== '') {
                        $this->dataBase[$words[0]] = $words[1];
                    }
                }
                fclose($handle);
            }
        }

        public function validUser($user)
        {
            if (key_exists($user, $this->dataBase)){
                return true;
            } else {
                return false;
            }
        }

        public function getHash($user)
        {
            return $this->dataBase[$user];
        }

        public function resetDataBase()
        {
            $this->dataBase = [];
        }

        function addUser($string)
        {
            $handle = fopen('../Data_Base/DataBase', 'a');
            fwrite($handle,$string);
            fwrite($handle,"\n");
            fclose($handle);
        }
    }