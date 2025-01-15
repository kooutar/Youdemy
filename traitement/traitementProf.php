<?php

require_once '../autoload.php';
session::ActiverSession();
$prof = new Enseignant($_SESSION['userData']['nom'],$_SESSION['userData']['prenom'],$_SESSION['userData']['email'],$_SESSION['userData']['role'],$_SESSION['userData']['iduser']);

if(isset($_POST['ajoutCours'])){
    if (isset($_POST['categorie'])) {
        echo "Valeur sélectionnée : " . $_POST['categorie'];
    } else {
        echo "Aucune catégorie sélectionnée.";
    }
    echo $_FILES["url"]["name"];
    if($_POST['typeCours']=='vedio'){
        $urlvedio=coursVedio::validatepathVedio($_FILES["url"]["name"],$_FILES["url"]["tmp_name"]);
        $cours=new coursVedio(null,$_POST['titre'],$_POST['description'],$urlvedio);
       $return= $prof->ajouterCours($cours,$_POST['categorie']);
       var_dump($return);
    }

}


