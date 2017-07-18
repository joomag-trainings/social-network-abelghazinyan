<?php


    class UserModel
    {
        private $firstName,$lastName,$email;
        private $age;

        function __construct()
        {
            $this->firstName = '';
            $this->lastName = '';
            $this->email = '';
            $this->age = 0;
        }
    }