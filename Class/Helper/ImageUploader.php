<?php

    namespace Helper;

    class ImageUploader
    {
        private $imageError;
        private $formName;
        const IMAGE_PATH = "/var/www/html/social-network/media/";

        public function __construct($formName)
        {
            $this->imageError = '';
            $this->formName = $formName;
        }

        public function upload()
        {
            $returnTarget = null;
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if ($_POST['form'] === $this->formName && !empty($_FILES["file"]["tmp_name"])) {

                    $image = md5_file($_FILES["file"]["tmp_name"]);
                    $image = md5(mt_rand().$image);
                    $folder = $image[0] . $image[1] . "/". $image[2] . $image[3] ."/". $image[4] . $image[5] ."/";
                    $returnTarget = "/social-network/media/" . $folder . $image . "." . pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
                    $target_file = self::IMAGE_PATH . $folder . $image . "." . pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
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

                    if ($_FILES["file"]["size"] > 2000000) {
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
                        if (!file_exists(self::IMAGE_PATH . $image[0] . $image[1])) {
                            mkdir(self::IMAGE_PATH . $image[0] . $image[1], 0777, true);
                        }
                        if (!file_exists(self::IMAGE_PATH . $image[0] . $image[1] . "/". $image[2] . $image[3])) {
                            mkdir(self::IMAGE_PATH . $image[0] . $image[1] . "/". $image[2] . $image[3] , 0777, true);
                        }
                        if (!file_exists(self::IMAGE_PATH . $image[0] . $image[1] . "/". $image[2] . $image[3] ."/". $image[4] . $image[5])) {
                            mkdir(self::IMAGE_PATH . $image[0] . $image[1] . "/". $image[2] . $image[3] ."/". $image[4] . $image[5] , 0777, true);
                        }
                        if (!move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
                            $this->imageError = "Sorry, there was an error uploading your file.";
                        }

                    }
                }
            }
            return $returnTarget;
        }

        public function getImageError()
        {
            return $this->imageError;
        }
    }