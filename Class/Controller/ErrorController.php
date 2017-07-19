<?php

namespace Controller;

class ErrorController
{
    public function actionNotFound()
    {
        http_response_code(404);
        require '../view/error/404.php';
    }
}