<?php


include './models/account.php';
include './utils/connexion.php';
include './env.php';
include "./utils/utils.php";
$bdd = connexion();


$message = signUp($bdd);


/*
*@method Créer un nouveau compte utilisateur
*@param PDO $bdd
*@return string
*/

function signUp(PDO $bdd):string{
    //Vérifier qu'on reçoit le formulaire
    if(isset($_POST['submitSignUp'])){
        //Vérifier les champs vide
        if(empty($_POST['lastname']) || empty($_POST['firstname']) || empty($_POST['email']) || empty($_POST['password'])){
            //Retourne le message d'erreur
            return "Veuillez remplir les champs !";
        }

        //Vérifier le format des données : ici l'email
        if(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
            //Retourne le message d'erreur
            return "Email pas au bon format !";
        }

        //Nettoyer les données
        $lastname = sanitize($_POST['lastname']);
        $firstname = sanitize($_POST['firstname']);
        $email = sanitize($_POST['email']);
        $password = sanitize($_POST['password']);

        //Hasher le mot de passe
        $password = password_hash($password, PASSWORD_BCRYPT);

        //Vérifier que l'utilisateur n'existe pas déjà en bdd
        if(!empty(getAccountByEmail($bdd, $email))){
            //Retourne le message d'erreur
            return "Cet email existe déjà !";
        }

        //J'enregistre mon utilisateur en bdd
        $account = [$firstname, $lastname, $email, $password];
        addAccount($bdd, $account);
    
        return "$firstname $lastname a été enregistré avec succès !";
    }
    return '';
}

include "./controllers/layout/headerController.php";
include "./views/account/signUpView.php";
include "./controllers/layout/footerController.php";
