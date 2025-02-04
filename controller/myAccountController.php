<?php

include './controller/headerController.php';


if(!isset($_SESSION['user_id'])){
    header(header:'location:index.php');
    exit;
}

include './vue/viewMyAccount.php';

include './vue/layout/footer.php';

