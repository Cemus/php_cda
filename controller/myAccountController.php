<?php

include './controller/headerController.php';


if(!isset($_SESSION['user_id'])){
    header(header:'location:/');
    exit;
}

include './vue/viewMyAccount.php';

include './vue/layout/footer.php';

