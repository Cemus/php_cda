<?php

include './vendor/autoload.php';

include './env.php';
include './utils/connexion.php';
include './utils/utils.php';

include 'controller/categorieController.php';
include 'controller/accountController.php';

$bdd = connexion();

session_start();

include './controller/headerController.php';
echo "<main>";
ajouterCategory(bdd: $bdd);
renderAccounts(bdd: $bdd);
echo "</main>";
include './vue/layout/footer.php';
