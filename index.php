<?php
session_start();

$url = parse_url($_SERVER['REQUEST_URI']);
$path = isset($url['path']) ? $url['path'] : '/';


switch ($path) {
    case '/':
    case '/accueil':
        include './controller/indexController.php';
        break;
    case '/my-account':
    case '/account':
        include './pages/myAccount.php';
        renderMyAccount();
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
        include "./controller/categoryController.php";

    default:
        include './controller/errorController.php';
}
?>
