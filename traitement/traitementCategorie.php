<?php
require_once '../classes/categorie.php';
require_once '../classes/admin.php';
require_once '../classes/session.php';

if($_SERVER['REQUEST_METHOD']=='POST'){
      session::ActiverSession();
      $admin=new admin($_SESSION['userData']['nom'],$_SESSION['userData']['prenom'],$_SESSION['userData']['email'],$_SESSION['userData']['role']);
      $admin->ajouterCategorie($_POST['categorie']);
    
}
