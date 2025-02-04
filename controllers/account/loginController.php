<?php
include './models/account.php';
include './utils/connexion.php';
include './env.php';
include "./utils/utils.php";
include './vendor/autoload.php';

$bdd = connexion();
$message = signIn($bdd);


function signIn(PDO $bdd):string{

    //Vérifier qu'on reçoit le formulaire
    if(isset($_POST['submitSignIn'])){
        //Vérifier les champs vide
        if(empty($_POST['email']) || empty($_POST['password'])){
            //Retourne le message d'erreur
            return "Veuillez remplir les champs !";
        }

        //Vérifier le format des données : ici l'email
        if(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
            //Retourne le message d'erreur
            return "Email pas au bon format !";
        }

        //Nettoyer les données
        $email = sanitize($_POST['email']);
        $password = sanitize($_POST['password']);

        $account = getAccountByEmail($bdd, $email);
        
        if ($account === null || empty($account)){
            return "Aucun utilisateur trouvé...";
        }


        if (password_verify($password, $account['password'])) {
            $_SESSION['user_id'] = $account['id_account'];
            $_SESSION['user_firstname'] = $account['firstname']; 
            $_SESSION['user_lastname'] = $account['lastname']; 
            $_SESSION['user_email'] = $account['email']; 
            header(header:'location:/my-account');
            exit;
        } else {
                return "Mot de passe incorrect.";
            }
        }
        return "";
}

include "./controllers/layout/headerController.php";
include "./views/account/signInView.php";
include "./controllers/layout/footerController.php";
