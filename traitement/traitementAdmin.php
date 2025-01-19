<?php
require_once '../autoload.php';
session::ActiverSession();
$admin=new admin($_SESSION['userData']['nom'],$_SESSION['userData']['prenom'],$_SESSION['userData']['email'],$_SESSION['userData']['role'],null);
if(isset($_POST['ajoutCategorie'])){
     
      $admin->ajouterCategorie($_POST['categorie']);
      $_SESSION['success']=" vous avez ajouter categorie";
      header('location: ../front/gestionCentenu.php');
      exit();
    
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
   $_SESSION['success']=" vous avez ajouter les tages ";
   header('location: ../front/gestionCentenu.php');
   exit();
}

if(isset($_POST['accepterCours'])){
     $cours= new cours($_POST['idcours'],$_POST['titre'],$_POST['description'],$_POST['image']);
     $cours->accepterCours();
     session::ActiverSession();
     $_SESSION['success']=" vous etes accepter le cours";
     header('location: ../front/gestionCentenu.php');
     exit();
}

if(isset($_POST['RefuserCours'])){
   $cours= new cours($_POST['idcours'],$_POST['titre'],$_POST['description'],$_POST['image']);
   $cours->refuserCours();
   session::ActiverSession();
   $_SESSION['success']=" vous etes refuser le cours";
   header('location: ../front/gestionCentenu.php');
   exit();
}

if(isset($_POST['supprimerCategorie'])){
   $categorie=new categorie($_POST['categorie'],$_POST['idcategorie']);
   $categorie->delete();
   session::ActiverSession();
   $_SESSION['success']=" vous etes suppremer le categore";
   header('location: ../front/gestionCentenu.php');
   exit();
   
}

if(isset($_POST['accepterProf'])){
  
   $prof=new Enseignant($_POST['nom'],$_POST['prenom'],$_POST['email'],$_POST['role'],$_POST['iduser']);
   $prof->updateStatus($_POST['status']);
   session::ActiverSession();
   $_SESSION['success']=" changer le status avec success";
   header('location: ../front/gestionProfEtudiant.php');
   exit();
}


if(isset($_POST['refuseProf'])){
  
   $prof=new Enseignant($_POST['nom'],$_POST['prenom'],$_POST['email'],$_POST['role'],$_POST['iduser']);
   $prof->updateStatus($_POST['status']);
   session::ActiverSession();
   $_SESSION['success']=" changer le status avec success";
   header('location: ../front/gestionProfEtudiant.php');
   exit();
}

if(isset($_POST['debanire'])){
  
   $prof=new Etudiant($_POST['nom'],$_POST['prenom'],$_POST['email'],$_POST['role'],$_POST['iduser']);
   $prof->updateStatusEtudiant(true);
   session::ActiverSession();
   $_SESSION['success']=" debanirer etudiante avec success";
   header('location: ../front/gestionProfEtudiant.php');
   exit();
}

if(isset($_POST['banire'])){
  
   $prof=new Etudiant($_POST['nom'],$_POST['prenom'],$_POST['email'],$_POST['role'],$_POST['iduser']);
   $prof->updateStatusEtudiant(false);
   session::ActiverSession();
   $_SESSION['success']=" banirer etudiante avec success";
   header('location: ../front/gestionProfEtudiant.php');
   exit();
}

if(isset($_POST['EditCategorie'])){
  
   $categorie=new categorie(null,$_POST['idcategorie']);
   $categorie->update($_POST['categorie']);
   session::ActiverSession();
   $_SESSION['success']=" Edite categorie avec success";
   header('location: ../front/gestionCentenu.php');
   exit();
}

if(isset($_POST['Edittag'])){
 
   $tag=new tag(null,$_POST['idtag']);
   $tag->update($_POST['tag']);
   session::ActiverSession();
   $_SESSION['success']=" Edite tag avec success";
   header('location: ../front/gestionCentenu.php');
   exit();
}

