<?php

include 'model/category.php';
include './model/account.php';
include './utils/connexion.php';
include './env.php';
include "./utils/utils.php";
include './vendor/autoload.php';

$bdd = connexion();
$message = "";

     if(isset($_POST["submit"])) {
        if(!empty($_POST["name"])) {
            $categorie = getCategoryByName($bdd,$_POST["name"]);
            if(!$categorie) {
                 addCategory($bdd, $_POST["name"]);
                $message = 'La catégorie "'. $_POST["name"] .'" a été ajouté';
            }
            else {
                $message = 'La catégorie "'. $_POST["name"] .'" existe déja en BDD';
            } 
        }
    }
   


include './controller/layout/headerController.php';
echo "<main>";
include 'vue/addCategory.php';
echo "</main>";
include './controller/layout/footerController.php';

