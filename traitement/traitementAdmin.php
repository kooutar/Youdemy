<?php
require_once '../autoload.php';
session::ActiverSession();
$admin=new admin($_SESSION['userData']['nom'],$_SESSION['userData']['prenom'],$_SESSION['userData']['email'],$_SESSION['userData']['role'],null);
if(isset($_POST['ajoutCategorie'])){
     
      $admin->ajouterCategorie($_POST['categorie']);
    
}
if(isset($_POST['ajoutTag'])){
   $tags =$_POST['tags'];
   $myjsondecode= json_decode($tags,true);
   $tags = array_column($myjsondecode, 'value');
   $tagString= implode(", ", $tags);
   $arraytags= explode(',', $tagString);
   foreach($arraytags as $tag){
      tag::insertTag($tag);
   }
}

if(isset($_POST['accepterCours'])){
     $cours= new cours($_POST['idcours'],$_POST['titre'],$_POST['description'],$_POST['image']);
     $cours->accepterCours();
     session::ActiverSession();
     $_SESSION['success']=" vous etes accepter le cours";
     header('location: ../front/gestionCentenu.php');
     exit();
}
  


