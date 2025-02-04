<?php

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
        include './controller/deconnexionController.php';
        renderDisconnect();
        break;

    default:
        include './controller/errorController.php';
}
?>
