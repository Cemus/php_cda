<?php
include './model/account.php';



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

            return "Bienvenue, " . $account['firstname'] . " !";
        } else {
                return "Mot de passe incorrect.";
            }
        }
        return "";
}


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
    $message = signUp($bdd);
    $message = signIn($bdd);
    $listUsers = displayAccounts($bdd);
    $userListExpanded = isset($_POST['expand']) && $_POST['expand'] === 'Voir';

    include "./vue/account.php";
    
    if(session_id() == '') {
        session_start();
    }

    if (!isset($_SESSION["user_id"])){
        include "./vue/account/signInView.php";
        include "./vue/account/SignUpView.php";
    }
}

function expandUserList(bool $visible):bool{
    if(isset($_POST['expand'])){
        return !$visible;
    }
}





