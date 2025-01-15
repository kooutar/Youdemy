<?php

require_once '../autoload.php';
session::ActiverSession();
$prof = new Enseignant($_SESSION['userData']['nom'],$_SESSION['userData']['prenom'],$_SESSION['userData']['email'],$_SESSION['userData']['role'],$_SESSION['userData']['iduser']);
if(isset($_POST['ajoutCours'])){
    echo $_FILES["url"]["name"];
    if($_POST['typeCours']=='vedio'){
        $urlvedio=coursVedio::validatepathVedio($_FILES["url"]["name"],$_FILES["url"]["tmp_name"]);
        $cours=new coursVedio(null,$_POST['titre'],$_POST['description'],$urlvedio);
        $prof->ajouterCours($cours,$_POST['categorie']);
        Session::ActiverSession();
        $_SESSION['success'] = "ajout cours  avec success !"; 
        header('location: ../front/pageProf.php');
        exit();
    }if($_POST['typeCours']=='document'){
        
       $documentation= new coursDocument(null,$_POST['titre'],$_POST['description'],$urlvedio);
    }

}


