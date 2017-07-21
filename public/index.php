<?php
    spl_autoload_register(function ($className) {

        $classPath = str_replace('\\', '/', $className);

        $classPath = '../Class/' . $classPath . '.php';

        require $classPath;
    });

    if (empty($_GET['page'])) {
        $page = 'authentication';
    } else {
        $page = $_GET['page'];
    }

    if (empty($_GET['action'])) {
        $action = 'show';
    } else {
        $action = $_GET['action'];
    }

    $page = strtolower($page);
    $page = ucfirst($page);
    $page .= 'Controller';
    $page = 'Controller\\' . $page;


    $action = strtolower($action);
    $action = ucfirst($action);
    $action = 'action' . $action;

    $controller = new $page();

    if (!method_exists($controller, $action)) {
        header('Location: http://localhost/social-network/public/index.php?page=error&action=notFound');
        die;
    }

    if (empty($_GET['id'])) {
        $controller->$action();
    } else {
        $controller->$action($_GET['id']);
    }

