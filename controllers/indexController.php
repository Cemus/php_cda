<?php

include './vendor/autoload.php';

include './env.php';
include './utils/connexion.php';
include './utils/utils.php';

include 'controllers/accountController.php';

$bdd = connexion();


include './controllers/layout/headerController.php';
echo "<main>";

renderAccounts(bdd: $bdd);
echo "</main>";
include './controllers/layout/footerController.php';
