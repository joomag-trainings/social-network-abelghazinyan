<?php
    /**
     * Created by PhpStorm.
     * User: abelghazinyan
     * Date: 7/19/17
     * Time: 12:08 PM
     */

    namespace Controller;
    use \Helper\ImageUploader;
    use Model\UserModel;

    class UserController
    {
        public function actionProfile ($id)
        {
            $user = new UserModel($id);
            require '../view/user/profile.php';
        }

        public function actionTimeline ()
        {
            require '../view/user/timeline.php';
        }

        public function actionPhotos ()
        {
            require '../view/user/photos.php';
        }

        public function actionForm ()
        {
            $uploader = new ImageUploader('profile',"/var/www/html/social-network/Profile/");
            $uploader->upload();
            require '../view/user/profileform.php';
        }
    }