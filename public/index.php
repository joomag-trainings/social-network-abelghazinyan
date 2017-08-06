<?php

    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;

    require '../vendor/autoload.php';


    $configuration = [
        'settings' => [
            'displayErrorDetails' => true,
            'addContentLengthHeader' => false,
            'determineRouteBeforeAppMiddleware' => true,
        ],
    ];
    $c = new \Slim\Container($configuration);
    $app = new \Slim\App($c);

    //Authentication routes
    $app->get('/', \Controller\AuthenticationController::class . ':actionShow')->setName("login");
    $app->post('/', \Controller\AuthenticationController::class . ':actionShow')->setName("login");
    $app->get('/logout', \Controller\AuthenticationController::class . ':actionLogout')->setName("login");

    //UserController routes
    $app->get('/profile={id}', \Controller\UserController::class . ':actionProfile')->setName("profile");
    $app->post('/profile={id}', \Controller\UserController::class . ':actionSearch')->setName("profile");

    //Photos
    $app->get('/photos={id}&remove={photo_id}', \Controller\UserController::class . ':actionRemovePhoto')->setName("photos");
    $app->get('/photos={id}', \Controller\UserController::class . ':actionPhotos')->setName("photos");
    $app->post('/photos={id}', \Controller\UserController::class . ':actionPhotos')->setName("photos");

    //Edit profile
    $app->get('/edit_profile={id}', \Controller\UserController::class . ':actionForm')->setName("edit");
    $app->post('/edit_profile={id}', \Controller\UserController::class . ':actionForm')->setName("edit");

    //Friends
    $app->get('/friends={id}&result={page}', \Controller\FriendController::class . ':actionGet')->setName("friends");
    $app->get('/friends={id}', \Controller\FriendController::class . ':actionShow')->setName("friends");
    $app->post('/friends={id}', \Controller\FriendController::class . ':actionSearch')->setName("friends");
    $app->get('/send_request={id}', \Controller\FriendController::class . ':actionRequest')->setName("friends");
    $app->get('/accept_request={senderId}', \Controller\FriendController::class . ':actionAcceptrequest')->setName("friends");
    $app->get('/remove_request={senderId}', \Controller\FriendController::class . ':actionRemoveRequest')->setName("friends");

    //Notifications
    $app->get('/notifications={page}', \Controller\NotificationController::class . ':actionAddcolumn')->setName("notifications");
    $app->get('/notifications', \Controller\NotificationController::class . ':actionShow')->setName("notifications");
    $app->post('/notifications', \Controller\NotificationController::class . ':actionSearch')->setName("notifications");

    //Search
    $app->get('/search={key}&result={page}', \Controller\SearchController::class . ':actionGet')->setName("search");
    $app->get('/search', \Controller\SearchController::class . ':actionSearchUser')->setName("search");

    //Timeline
    $app->get('/timeline={page}', \Controller\UserController::class . ':actionUpdatetimeline')->setName("timeline");
    $app->get('/timeline', \Controller\UserController::class . ':actionTimeline')->setName("timeline");
    $app->post('/timeline', \Controller\UserController::class . ':actionTimeline')->setName("timeline");

    //Error
    $app->get('/error', \Controller\ErrorController::class . ':actionNotFound')->setName('404');

    $container = $app->getContainer();
    $container['view'] = new \Slim\Views\PhpRenderer("../view/");

    $app->add(function (Request $request, Response $response, $next){

//        $response = $next($request, $response);
//        return $response;

        $route = $request->getAttribute('route');

        if( $route == null) {
            $uri = $request->getUri()->withPath($this->router->pathFor('404'));
            return $response = $response->withRedirect($uri);
        } else {

            $routeName = $route->getName();
            if ($routeName == "404") {
                $response = $next($request, $response);

                return $response;
            }

            if (!empty($_COOKIE['id']) && $routeName != "login") {

                $response = $next($request, $response);
                return $response;
            }

            if (empty($_COOKIE['id']) && $routeName == "login") {
                $response = $next($request, $response);
                return $response;
            } else {
                $uri = $request->getUri()->withPath($this->router->pathFor('login'));
                return $response = $response->withRedirect($uri);
            }
        }
    });

    $app->run();
