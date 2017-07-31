<?php

    namespace Service;


    use Model\UserModel;
    use Model\Post;
    use Db\Connection;

    class PostManager
    {
        public static function makePost(Post $post)
        {
            $connection = Connection::getInstance()->getConnection();
            $posterId = $post->getPosterId();
            $text = $post->getText();
            $imagePath = $post->getImagePath();
            $statement = $connection->prepare(
                "INSERT INTO posts (id, posterId, time, text, path)
                          VALUES (NULL, :posterId, now(), :text, :path)"
            );
            $statement->bindParam('posterId',$posterId);
            $statement->bindParam('text',$text);
            $statement->bindParam('path',$imagePath);
            $statement->execute();
        }

        /**
         * @param $from
         * @param $till
         * @return Post|null
         */
        public static function getPosts($from,$till)
        {
            $user = new UserModel($_COOKIE['id']);
            $list = $user->getFriendList();
            $list[] = $_COOKIE['id'];
            $connection = Connection::getInstance()->getConnection();
            $from--;
            $string = implode(",",$list);
            $statement=$connection->prepare("SELECT * FROM posts WHERE posterId IN ({$string}) ORDER BY time DESC LIMIT {$till} OFFSET {$from}");
            $statement->execute();
            $res = $statement->fetchAll(\PDO::FETCH_ASSOC);

            $posts = null;
            foreach ($res as $ntf) {
                $post = new Post();
                $post->setId($ntf['id']);
                $post->setPosterId($ntf['posterId']);
                $post->setText($ntf['text']);
                $post->setTime($ntf['time']);
                $post->setImagePath($ntf['path']);
                $posts[] = $post;
            }
            return $posts;
        }
    }