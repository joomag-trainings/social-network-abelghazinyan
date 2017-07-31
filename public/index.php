<?php

    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;

    require '../vendor/autoload.php';


    $configuration = [
        'settings' => [
            'displayErrorDetails' => true,
        ],
    ];
    $c = new \Slim\Container($configuration);
    $app = new \Slim\App($c);

    //Authentication routes
    $app->get('/', \Controller\AuthenticationController::class . ':actionShow');
    $app->post('/', \Controller\AuthenticationController::class . ':actionShow');
    $app->get('/logout', \Controller\AuthenticationController::class . ':actionLogout');

    //UserController routes
    $app->get('/profile={id}', \Controller\UserController::class . ':actionProfile');
    $app->post('/profile={id}', \Controller\UserController::class . ':actionSearch');

    //Photos
    $app->get('/photos={id}&remove={photo_id}', \Controller\UserController::class . ':actionRemovePhoto');
    $app->get('/photos={id}', \Controller\UserController::class . ':actionPhotos');
    $app->post('/photos={id}', \Controller\UserController::class . ':actionPhotos');

    //Edit profile
    $app->get('/edit_profile={id}', \Controller\UserController::class . ':actionForm');
    $app->post('/edit_profile={id}', \Controller\UserController::class . ':actionForm');

    //Friends
    $app->get('/friends={id}&result={page}', \Controller\FriendController::class . ':actionGet');
    $app->get('/friends={id}', \Controller\FriendController::class . ':actionShow');
    $app->post('/friends={id}', \Controller\FriendController::class . ':actionSearch');
    $app->get('/send_request={id}', \Controller\FriendController::class . ':actionRequest');
    $app->get('/accept_request={senderId}', \Controller\FriendController::class . ':actionAcceptrequest');
    $app->get('/remove_request={senderId}', \Controller\FriendController::class . ':actionRemoveRequest');

    //Notifications
    $app->get('/notifications={page}', \Controller\NotificationController::class . ':actionAddcolumn');
    $app->get('/notifications', \Controller\NotificationController::class . ':actionShow');
    $app->post('/notifications', \Controller\NotificationController::class . ':actionSearch');

    //Search
    $app->get('/search={key}&result={page}', \Controller\SearchController::class . ':actionGet');
    $app->get('/search={key}', \Controller\SearchController::class . ':actionSearchUser');
    $app->post('/search={key}', \Controller\SearchController::class . ':actionSearch');

    //Timeline
    $app->get('/timeline={page}', \Controller\UserController::class . ':actionUpdatetimeline');
    $app->get('/timeline', \Controller\UserController::class . ':actionTimeline');
    $app->post('/timeline', \Controller\UserController::class . ':actionTimeline');

    $container = $app->getContainer();
    $container['view'] = new \Slim\Views\PhpRenderer("../view/");

    $app->run();
