<?php
require_once '../classes/etudiant.php';
if(isset($_POST['inscrire'])){
    if($_POST['role']=='etudiant'){
            $etudiant = new Etudiant($_POST['nom'],$_POST['prenom'],$_POST['email'],$_POST['role'],$_POST['password']);
            $etudiant::inscrire($etudiant->nom,$etudiant->prenom,$etudiant->email,$etudiant->role,$etudiant->password);
       
    }else{
        // traitement prof
    }
    
   
}