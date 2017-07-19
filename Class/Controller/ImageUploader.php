<?php

    namespace Controller;

    class ImageUploader
    {
        private $imageError;
        private $formName;
        private $target_dir;

        public function __construct($formName,$target_dir)
        {
            $this->imageError = '';
            $this->formName = $formName;
            $this->target_dir = $target_dir;
        }

        public function upload()
        {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if ($_POST['form'] === $this->formName) {
                    //$target_dir = "/var/www/html/social-network/Profile/";
                    $target_file = $this->target_dir . basename($_FILES["file"]["name"]);
                    $uploadOk = 1;
                    $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
                    // Check if image file is a actual image or fake image
                    if (isset($_POST["submit"])) {
                        $check = getimagesize($_FILES["file"]["tmp_name"]);
                        if ($check !== false) {
                            $uploadOk = 1;
                        } else {
                            $this->imageError = "File is not an image.";
                            $uploadOk = 0;
                        }
                    }

                    if (file_exists($target_file)) {
                        $uploadOk = 0;
                    }

                    if ($_FILES["file"]["size"] > 500000) {
                        $this->imageError = "Sorry, your file is too large.";
                        $uploadOk = 0;
                    }

                    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                        && $imageFileType != "gif"
                    ) {
                        $this->imageError = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                        $uploadOk = 0;
                    }

                    if ($uploadOk == 0) {
                        $this->imageError = "Sorry, your file was not uploaded.";

                    } else {

                        if (!move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
                            $this->imageError = "Sorry, there was an error uploading your file.";
                        }

                    }
                }
            }
        }

        public function getImageError()
        {
            return $this->imageError;
        }
    }