<?php

    namespace Service;


    use Model\Post;
    use Model\UserModel;

    class PostDrawer
    {
        const POST_COUNT = 5;

        public static function drawTimeline($from,$till)
        {
            $message = '';
            $posts = PostManager::getPosts($from,$till);
            if ($posts != null) {
                foreach ($posts as $post) {
                    $message .= self::drawPost($post);
                }
            }
            echo $message;
        }

        public static function drawPost(Post $post)
        {
            $user = new UserModel($post->getPosterId());
            $message =
                "<div class='containerBox'>
                    <div class='avatarBox'>
                        <img src='{$user->getAvatarPath()}'>
                    </div>
                        <h1 class='poster'>{$user->getFname()} {$user->getLname()}</h1>
                        <h6 class='time'>{$post->getTime()}</h6>";
            if ($post->getText() != null) {
                $message .=
                    "<div class='textBox'>
                        <p>{$post->getText()}</p>
                    </div>";
            }
            if ($post->getImagePath() != null) {
                $message .=
                    "<div class='postBox'>
                        <img src='{$post->getImagePath()}'>
                    </div>";
            }
            $message .= "</div>";
            return $message;
        }

    }