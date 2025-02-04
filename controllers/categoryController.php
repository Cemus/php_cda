<?php

include 'models/category.php';
include './models/account.php';
include './utils/connexion.php';
include './env.php';
include "./utils/utils.php";
include './vendor/autoload.php';

if(!isset($_SESSION['user_id'])){
    header(header:'location:/');
    exit;
}

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




function displayCategories(PDO $bdd){
    //Récupération de la liste des utilisateurs
    $data = getAllCategory($bdd);

    $listCategory = "";
    foreach($data as $category){
        $listCategory = $listCategory."<li><h2>".$category['name']."</h2></li>";
    }
    return $listCategory;
}

function renderCategories(PDO $bdd){

    $listCategory = displayCategories($bdd);
    $categoryListExpanded = isset($_POST['expandCategory']) && $_POST['expandCategory'] === 'Voir';

    include "./views/categoryList.php";
}


function expandCategoryList(bool $visible):bool{
        return !$visible;
}
   


include './controllers/layout/headerController.php';
echo "<main>";
include './views/addCategory.php';
renderCategories($bdd);
echo "</main>";
include './controllers/layout/footerController.php';

