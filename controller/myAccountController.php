<?php

include './controller/layout/headerController.php';


if(!isset($_SESSION['user_id'])){
    header(header:'location:/');
    exit;
}

include './vue/viewMyAccount.php';

include './controller/layout/footerController.php';

