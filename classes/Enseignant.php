<?php 
require_once 'user.php';
require_once 'session.php';

class Enseignant extends user{
    static $cours=[];
    private $status;
   
    public static  function getStatusProf($email){
        $db = database::getInstance()->getConnection();
       try {
        $stmt=$db->prepare("SELECT status from user where email=?  ");
        if($stmt->execute([$email])){
            $result =$stmt->fetch();
            return $result['status'] ;
        }else{
            return false;
        }
        
       } catch (PDOException $e) {
           $e->getMessage();
       }
    }

    public static function login($Email,$password){
        $db=database::getInstance()->getConnection();
        try{
           $stmt=$db->prepare("SELECT * From user where email=? ");
           if($stmt->execute([$Email])){
               $result = $stmt->fetch();
               
               if(password_verify($password,$result['password'])){
                    Session::validateSession($result); 
                    header('location: ../front/pageProf.php');
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

   public  function getstatus(){ return $this->status;}


   public function ajouterCours(cours $cours) {
    if ($cours instanceof coursVedio) {
        $result = coursVedio::createCours($cours->idcours, $cours->titre, $cours->description,$cours->image, null,$cours->getvedio(),  $cours->categorie->getCategorie(), $this->id);
        if (!$result) {
            return "Erreur lors de la création du cours vidéo";
        }
        Enseignant::$cours[]=$result;
        return $result;
    }
    if ($cours instanceof coursDocument) {
        $result = coursDocument::createCours($cours->idcours, $cours->titre, $cours->description,$cours->image, $cours->getdocumentation(),null, $cours->categorie->getCategorie(), $this->id);
        if (!$result) {
            return "Erreur lors de la création du cours document";
        }
        Enseignant::$cours[]=$result;
        return $result;
    }
    return "Type de cours non pris en charge";
}

public function consulterMesCours(cours $cours){
       if($cours instanceof coursVedio){
          return coursVedio::getAllCours($this->id);
       }
       if($cours instanceof coursDocument){
        return coursDocument::getAllCours($this->id);
       }
}  
}

