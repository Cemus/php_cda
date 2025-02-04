<?php

include './vendor/autoload.php';

include './env.php';
include './utils/connexion.php';
include './utils/utils.php';

include 'controller/accountController.php';

$bdd = connexion();


include './controller/layout/headerController.php';
echo "<main>";

renderAccounts(bdd: $bdd);
echo "</main>";
include './controller/layout/footerController.php';
