<?php

include './controllers/layout/headerController.php';


if(!isset($_SESSION['user_id'])){
    header(header:'location:/');
    exit;
}

include './views/viewMyAccount.php';

include './controllers/layout/footerController.php';

