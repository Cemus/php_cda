<?php
include "./models/account.php";

function displayAccounts(PDO $bdd){
    //Récupération de la liste des utilisateurs
    $data = getAllAccount($bdd);

    $listUsers = "";
    foreach($data as $account){
        $listUsers = $listUsers."<li><h2>".$account['firstname'] ." ". $account['lastname']."</h2>      <p>".$account['email']."</p></li>";
    }
    return $listUsers;
}

function renderAccounts(PDO $bdd){

    $listUsers = displayAccounts($bdd);
    $userListExpanded = isset($_POST['expand']) && $_POST['expand'] === 'Voir';

    include "./views/accountList.php";
}


function expandUserList(bool $visible):bool{
        return !$visible;
}