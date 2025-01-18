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
                if($result['EstActive']==false){
                    Session::validateSession($result);
                    $_SESSION['error'] = "votre compte est  Binder !"; 
                    header('location: ../front/connexion.php');
                    exit();
                   }   
                if(password_verify($password,$result['password'])){
                     Session::validateSession($result); 
                     header('location: ../front/cours.php');
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

    
public static  function  getAlletudiants(){
    $etudiants=[];
    $db=database::getInstance()->getConnection();
    try {
        $stmt=$db->prepare("SELECT * FROM user where role= 1");
       if($stmt->execute())
       {
        $results = $stmt->fetchAll();
        
        foreach ($results as $result) {
            // Crée un nouvel objet Enseignant pour chaque ligne de résultat
            $etudiants[] = new Enseignant(
                $result['nom'],
                $result['prenom'],
                $result['email'],
                $result['role'],
                $result['iduser'],
                $result['password'],
                $result['EstActive']
            );
        }
        return $etudiants;
       }
       return [];
    } catch (\Throwable $th) {
        //throw $th;
    }
}
 }

 

?>