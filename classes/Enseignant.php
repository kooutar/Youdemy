<?php 
require_once 'user.php';
require_once 'session.php';

class Enseignant extends user{
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
                    Session::validateSession($result['iduser'],$result['role']); 
                    header('location: ../front/pageProf.php');
                    exit();
               }
               else{
                   Session::ActiverSession();
                   $_SESSION['error'] = "Mot de passe incorrect abiiiiiiiiiiiiiiiiiiiid !"; 
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

   


   


   
}

