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
    \Helper\Debug::consoleLog($page ." . " . $action);

    if (!empty($_GET['id'])) {
        $controller->$action($_GET['id']);
    } else if (!empty($_GET['key'])){
        if (!empty($_GET['result'])) {
            $controller->$action($_GET['key'],$_GET['result']);
        }
    } else {
        $controller->$action();
    }
