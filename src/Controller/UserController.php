<?php
    /**
     * Created by PhpStorm.
     * User: abelghazinyan
     * Date: 7/19/17
     * Time: 12:08 PM
     */

    namespace Controller;
    use Db\Connection;
    use Helper\Debug;
    use \Helper\ImageUploader;
    use Model\UserModel;
    use Model\Notification;
    use Service\NotificationManager;
    use Model\Post;
    use Service\PostManager;
    use Service\PostDrawer;
    use Slim\Http\Request;
    use Slim\Http\Response;
    use Slim\Views\PhpRenderer;
    use Slim\Container;

    class UserController extends AbstractController
    {
        private $connection;
        const TIMELINE_UPDATE_SIZE = 1;

        public function __construct($container)
        {
            parent::__construct($container);
            $this->connection = Connection::getInstance();
        }

        public function actionProfile (Request $request, Response $response, $args)
        {
            $id = $args['id'];

            if ($this->connection->getUserDataById($id) == null) {
                $uri = "social-network/public/index.php/error";
                return $response = $response->withRedirect($uri);
            }

            $user = new UserModel($id);

            $viewRenderer = $this->container->get('view');

            $response = $viewRenderer->render(
                $response,
                "/user/profile.phtml",
                [
                    'user' => $user,
                    'connection' => $this->connection
                ]
            );

            return $response;

        }

        public function actionUpdatetimeline(Request $request, Response $response, $args)
        {
            $page = $args['page'];
            $start = ($page - 1) * (self::TIMELINE_UPDATE_SIZE) + PostDrawer::POST_COUNT;
            $offset = self::TIMELINE_UPDATE_SIZE;
            PostDrawer::drawTimeline($start, $offset);
            return $response;
        }

        public function actionTimeline(Request $request, Response $response, $args)
        {

            if ($request->getParam('form') == 'post') {
                $text = $request->getParam('text');
                $uploader = new ImageUploader('post',$request);
                $target_dir = $uploader->upload();

                if ($uploader->getImageError() == '' && $target_dir != null) {
                    $path = $target_dir;
                } else {
                    $path = null;
                }

                $post = new Post();
                $post->setImagePath($path);
                $post->setPosterId($_COOKIE['id']);
                $post->setText($text);
                if ($text != null || $path != null) {
                    PostManager::makePost($post);
                }
                header("Location:/social-network/public/index.php/timeline");
                exit;
            }

            $viewRenderer = $this->container->get('view');

            $response = $viewRenderer->render(
                $response,
                "/user/timeline.phtml",
                [

                ]
            );

            return $response;
        }

        public function actionRemovePhoto(Request $request, Response $response, $args)
        {
            $userID = $args['id'];
            $photoID = $args['photo_id'];
            if ($userID == $_COOKIE['id']) {
                $this->connection->removePhoto($photoID);
            }
            header("Location:/social-network/public/index.php/photos={$userID}");
            exit;
        }

        public function addPhoto($photo) {
            echo
            "<a href='/social-network/public/index.php/photos={$photo['user_id']}&remove={$photo['id']}'>
            <div class='pic'>
            <img src='{$photo['path']}'>
            </div>
            </a>";
        }

        public function actionPhotos (Request $request, Response $response, $args)
        {

            $id = $args['id'];

            if ($this->connection->getUserDataById($id) == null) {
                $uri = "social-network/public/index.php/error";
                return $response = $response->withRedirect($uri);
            }

            $uploader = new ImageUploader('image',$request);
            $target_dir = $uploader->upload();
            if ($uploader->getImageError() == '' && $target_dir != null) {
                $this->connection->addPhoto($id,$target_dir);
                header("Location:/social-network/public/index.php/photos={$id}");
                exit;
            }
            $userId = $id;
            $user = new UserModel($id);
            $photos = $user->getPhotos($id);

            $viewRenderer = $this->container->get('view');

            $response = $viewRenderer->render(
                $response,
                "/user/photos.phtml",
                [
                    'uploader' => $uploader,
                    'photos' => $photos,
                    'userId' => $userId,
                    'class' => $this
                ]
            );

            return $response;

        }

        public function actionForm (Request $request, Response $response, $args)
        {

            $id = $args['id'];

            if ($this->connection->getUserDataById($id) == null) {
                $uri = "social-network/public/index.php/error";
                return $response = $response->withRedirect($uri);
            }

            $uploader = new ImageUploader('profile',$request);
            $target_dir = $uploader->upload();
            if ($uploader->getImageError() == '' && $target_dir != null) {
                $this->connection->setUserAvatar($id,$target_dir);
                header("Location:/social-network/public/index.php/edit_profile={$id}");
                exit;
            }
            $user = new UserModel($id);
            $postFname = $request->getParam('fname');
            $postLname = $request->getParam('lname');
            $postYears = $request->getParam('years');
            $postMonths = $request->getParam('months');
            $postDays = $request->getParam('days');
            $error = '';
            if ($request->getParam('form') == 'form') {

                if(!isset($postFname)) {
                    $error = "First name is required";
                } else {
                    $fname = $postFname;
                }

                if(!isset($postLname)) {
                    $error = "Last name is required";
                } else {
                    $lname = $postLname;
                }
                if(!isset($postYears)) {
                    $error = "Enter year";
                } else {
                    $years = $postYears;

                }
                if(!isset($postMonths)) {
                    $error = "Enter month";
                } else {
                    $months = $postMonths;
                }
                if(!isset($postDays)) {
                    $error = "Enter day";
                } else {
                    $days = $postDays;
                }
                $city = $request->getParam('city');
                $work = $request->getParam('work');
                $education = $request->getParam('education');
                if ($request->getParam('gender') == 'male') {
                    $gender = 1;
                } else {
                    $gender = 0;
                }
                if ($error === '') {
                    $date = $days . " " . $months . " " . $years;
                    $dob = date('d-m-Y', strtotime($date));
                }
                $id = $_COOKIE['id'];
                if ($error == '') {
                    $this->connection->updateUser($id,$fname,$lname,$dob,$gender,$city,$work,$education);
                    header("Location:/social-network/public/index.php/profile={$id}");
                    exit;
                }



            }

            $viewRenderer = $this->container->get('view');

            $response = $viewRenderer->render(
                $response,
                "/user/profileform.phtml",
                [
                    'user' => $user,
                    'connection' => $this->connection,
                    'uploader' => $uploader,
                    'error' => $error
                ]
            );

            return $response;
        }
    }