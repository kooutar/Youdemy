<?php

require_once '../autoload.php';
session::ActiverSession();
$prof = new Enseignant($_SESSION['userData']['nom'],$_SESSION['userData']['prenom'],$_SESSION['userData']['email'],$_SESSION['userData']['role'],$_SESSION['userData']['iduser']);
if(isset($_POST['ajoutCours'])){
   $image= cours::validateImage($_FILES['image']['name'],$_FILES['image']['tmp_name']);
    if($_POST['typeCours']=='vedio'){
        $urlvedio=coursVedio::validatepathVedio($_FILES["url"]["name"],$_FILES["url"]["tmp_name"]);
        $cours=new coursVedio(null,$_POST['titre'],$_POST['description'],$image,$urlvedio);
        $categorie=new categorie($_POST['categorie']);
        $cours->setCategorie($categorie);
        $prof->ajouterCours($cours);
        Session::ActiverSession();
        $_SESSION['success'] = "ajout cours  avec success !"; 
        header('location: ../front/pageProf.php');
        exit();
    }if($_POST['typeCours']=='document'){
        $document=coursDocument::validateDocument($_FILES['document']['name'],$_FILES['document']['tmp_name']);
       $cours= new coursDocument(null,$_POST['titre'],$_POST['description'],$image,$document);
       $categorie=new categorie($_POST['categorie']);
       $cours->setCategorie($categorie);
       $prof->ajouterCours($cours);
       Session::ActiverSession();
       $_SESSION['success'] = "ajout cours  avec success !"; 
       header('location: ../front/pageProf.php');
       exit();

    }
}
//  affichage 

$cours=new coursVedio(null,null,null,null,null);
$cours->setProfessor($prof);
var_dump($cours->prof);
// Obtenir les cours vidéo
// $coursVideo = $prof->consulterMesCours(new coursVedio(null,null,null,null,null,null));
//  foreach($coursVideo as $cours){
//    var_dump($cours);
//  }
//    // Accédez à la propriété "titre"

// Obtenir les cours document



