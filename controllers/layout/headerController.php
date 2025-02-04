<?php 
include "./views/layout/header.php";

ob_start();

if(session_id() == '') {
    $myAccount = "Mon compte";
    session_start();
}

if (isset($_SESSION["user_id"])) {
    $myAccount = $_SESSION["user_firstname"];
    include "./views/layout/headerLogged.php"; 
} else {
    include "./views/layout/headerVisitor.php"; 
}

$content = ob_get_contents();

$content = str_replace("Mon compte", $myAccount, $content);  
ob_end_clean();

echo $content;
?>
