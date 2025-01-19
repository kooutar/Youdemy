<?php
require_once '../autoload.php';
if(isset($_POST['inscrire'])){
    var_dump($_POST['role']);
    if($_POST['role']=='1'){
            $etudiant = new Etudiant($_POST['nom'],$_POST['prenom'],$_POST['email'],1,null,$_POST['password']);
            $etudiant::inscrire($etudiant->nom,$etudiant->prenom,$etudiant->email,$etudiant->role,$etudiant->password);
       
    }else{
        // // traitement prof
        $Enseignant=new Enseignant($_POST['nom'],$_POST['prenom'],$_POST['email'],2,null,$_POST['password']);
        $Enseignant::inscrire($Enseignant->nom,$Enseignant->prenom,$Enseignant->email,$Enseignant->role,$Enseignant->password);
        // die();
        
    } 
   
}

if(isset($_POST['connecter'])){
   $role= user::RoleMail($_POST['email']);
   echo $role;
   if($role){
     if($role=='1'){
         Etudiant::login($_POST['email'],$_POST['password']);
     }
     if($role =='2' ){
        Enseignant::login($_POST['email'],$_POST['password']);
     }else{
         admin::login($_POST['email'],$_POST['password']);
     }
   }
}

if(isset($_POST['deconnexion'])){
    $etudiant = new Etudiant($_SESSION['userData']['nom'],$_SESSION['userData']['prenom'],$_SESSION['userData']['email'],$_SESSION['userData']['role'],$_SESSION['userData']['iduser']);
    $etudiant->logout();
}

