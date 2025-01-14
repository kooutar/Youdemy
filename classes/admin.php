<?php 
require_once '../autoload.php';
class admin extends user{

    public static function login($Email,$password){
        $db=database::getInstance()->getConnection();
        try{
           $stmt=$db->prepare("SELECT * From user where email=? ");
           if($stmt->execute([$Email])){
               $result = $stmt->fetch();

               if(password_verify($password,$result['password'])){
                    Session::validateSession($result); 
                    header('location: ../front/pageAdmin.php');
                    exit();
               }
               else{
                   Session::ActiverSession();
                   $_SESSION['error'] = "Mot de passe incorrect !"; 
                   header('location: ../front/connexion.php'); 
                   exit();
               }
           }else{
               Session::ActiverSession();
               $_SESSION['error'] = "Mail n'exist pas !"; 
               header('location: ../front/connexion.php'); 
               exit();
           }
          
           
          
        } catch(PDOException $e){
           
        }
   }

   public function ajouterCategorie($categorie){
      $categorie=categorie::inserCategorie($categorie);
        Session::ActiverSession();
        $_SESSION['success'] = "ajoute de categorie avec success !"; 
      header('location: ../front/pageAdmin.php');
      exit();
   }

   public function ajouterag($tag){
    $tag= tag::insertTag($tag);
    Session::ActiverSession();
    $_SESSION['success']="Ajoute de Tag avec success !";
    header('location: ../front/pageAdmin.php');
    exit();
   }

}


