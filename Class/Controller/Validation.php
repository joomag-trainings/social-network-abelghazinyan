<?php

    namespace Controller;

    class Validation
    {
        static public function cleanData($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        static public function validateName($text)
        {
            if (preg_match("/^[a-zA-Z ]*$/",$text)) {
               return true;
            } else {
               return false;
            }
        }

        static public function validateEmail($text)
        {
            if (filter_var($text, FILTER_VALIDATE_EMAIL)) {
                return true;
            } else {
                return false;
            }
        }

        static public function validateNewPassword($password)
        {
            if (strlen($password) < 8) {
                return false;
            } else {
                return true;
            }
        }
    }