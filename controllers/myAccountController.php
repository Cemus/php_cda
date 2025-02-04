<?php

include './controllers/layout/headerController.php';
include './models/account.php';
include './utils/connexion.php';
include './env.php';
include "./utils/utils.php";

if(!isset($_SESSION['user_id'])){
    header(header:'location:/');
    exit;
}

$bdd = connexion();


/*
*@method Créer un nouveau compte utilisateur
*@param PDO $bdd
*@return string
*/

function editAccount(PDO $bdd): string {
    if (isset($_POST['editAccount'])) {
        $informations = [
            "lastname" => $_POST["lastname"],
            "firstname" => $_POST["firstname"],
            "email" => $_POST["email"],
            "password" => $_POST["password"],
            "passwordConf" => $_POST["passwordConf"]
        ];

        if (isset($informations["password"])) {
            if ($informations['password'] != $informations['passwordConf']) {
                return "Les mots de passe doivent correspondre !";
            }
        }

        if (isset($informations["email"])) {
            if (!filter_var($informations['email'], FILTER_VALIDATE_EMAIL)) {
                return "Email pas au bon format !";
            }
        }

        $lastname = sanitize($informations['lastname']);
        $firstname = sanitize($informations['firstname']);
        $email = sanitize($informations['email']);
        $password = sanitize($informations['password']);

        try {
            $sql = "UPDATE users SET lastname = :lastname, firstname = :firstname, email = :email, password = :password WHERE user_id = :user_id";
            $stmt = $bdd->prepare($sql);
            $stmt->bindParam(':lastname', $lastname);
            $stmt->bindParam(':firstname', $firstname);
            $stmt->bindParam(':email', $email);
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            $stmt->bindParam(':password', $hashedPassword);
            $stmt->bindParam(':user_id', $_SESSION['user_id']);
            $stmt->execute();

            return "Compte mis à jour avec succès.";
        } catch (Exception $e) {
            return "Erreur lors de la mise à jour du compte : " . $e->getMessage();
        }
    }

    return "Aucune modification apportée.";
}


echo "<main>";
include './views/account/myAccount.php';
include './views/account/editAccount.php';
echo "</main>";

include './controllers/layout/footerController.php';

