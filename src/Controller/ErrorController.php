<?php

namespace Controller;
use Slim\Http\Request;
use Slim\Http\Response;

class ErrorController extends AbstractController
{
    public function __construct($container)
    {
        parent::__construct($container);
    }

    public function actionNotFound(Request $request, Response $response, $args)
    {

        $viewRenderer = $this->container->get('view');

        $response = $viewRenderer->render(
            $response,
            "/error/404.php",
            [
            ]
        );

        return $response;
    }
}