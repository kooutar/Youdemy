<?php
require_once '../autoload.php';
if(isset($_POST['inscrire'])){
    if($_POST['role']=='etudiant'){
            $etudiant = new Etudiant($_POST['nom'],$_POST['prenom'],$_POST['email'],$_POST['role'],$_POST['password']);
            $etudiant::inscrire($etudiant->nom,$etudiant->prenom,$etudiant->email,$etudiant->role,$etudiant->password);
       
    }else{
        // traitement prof
        $Enseignant=new Enseignant($_POST['nom'],$_POST['prenom'],$_POST['email'],$_POST['role'],$_POST['password']);
        $Enseignant::inscrire($Enseignant->nom,$Enseignant->prenom,$Enseignant->email,$Enseignant->role,$Enseignant->password);
        // die();
    } 
   
}

if(isset($_POST['connecter'])){
   $role= user::RoleMail($_POST['email']);
   if($role){
     if($role=='etudiant'){
         Etudiant::login($_POST['email'],$_POST['password']);
     }
     if($role =='Enseignant' ){
        Enseignant::login($_POST['email'],$_POST['password']);
     }else{
         admin::login($_POST['email'],$_POST['password']);
     }
   }
}

