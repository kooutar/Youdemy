<?php 
require_once 'user.php';
require_once 'session.php';
 class Etudiant extends user{

    public static function login($Email,$password){
         $db=database::getInstance()->getConnection();
         try{
            $stmt=$db->prepare("SELECT * From user where email=? ");
            if($stmt->execute([$Email])){
                $result = $stmt->fetch();
                if(password_verify($password,$result['password'])){
                     Session::validateSession($result['iduser'],$result['role']); 
                     header('location: ../front/pageClient.php');
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
 }

 

?>