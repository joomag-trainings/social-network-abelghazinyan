<?php

    namespace Controller;

    use Slim\Container;
    use Slim\Http\Request;
    use Slim\Http\Response;
    use Slim\Views\PhpRenderer;

    /**
     * Class AbstractController
     * @package Core
     */
    abstract class AbstractController
    {
        protected $container;

        /**
         * AbstractController constructor.
         * @param Container $container
         */
        public function __construct(Container $container)
        {
            $this->container = $container;
        }

        public function actionSearch(Request $request, Response $response, $args)
        {
            $search = $request->getParam('search');
            if(isset($search)) {
                if ($search != NULL) {
                    $key = $search;
                    $url = "http://localhost/social-network/public/index.php/search={$key}";
                    header("Location:" . $url);
                    exit;
                }
            }
        }
    }