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
