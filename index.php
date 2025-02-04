<?php
session_start();

$url = parse_url($_SERVER['REQUEST_URI']);
$path = isset($url['path']) ? $url['path'] : '/';


switch ($path) {
    case '/':
    case '/accueil':
        include './pages/indexPage.php';
        break;
    case '/my-account':
    case '/account':
        include './pages/myAccountPage.php';
        break;

    case '/disconnect':
    case '/disco':
        include './controller/account/disconnectController.php';
        break;

    case '/login':
        include './controller/account/loginController.php';
        break;

        
    case '/register':
        include './controller/account/registerController.php';
        break;

    case "/add-category":
        include './pages/categoryPage.php';
break;
    default:
        include './controller/errorController.php';
}

