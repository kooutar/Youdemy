<?php
require_once 'db.php';
require_once 'cours.php';
class coursDocument extends cours{
      private $documentation;

      public function __construct($id,$titre,$description,$image,$documentation)
      {
        parent::__construct($id,$titre,$description,$image);
        $this->documentation=$documentation;
      }

      public static function validateDocument($documentName,$documentTmp){
        $dir='../document/';
        $path = basename($documentName);
        $finalPath = $dir . uniqid() . "_" . $path;
        $allowedExtensions = ['txt', 'doc', 'pdf'];
        $extension = pathinfo($finalPath, PATHINFO_EXTENSION);
        if (in_array(strtolower($extension), $allowedExtensions)) {
            if (move_uploaded_file($documentTmp, $finalPath)) {
                return $finalPath;
            } else {
                throw new Exception("Erreur lors du déplacement du fichier : $documentName");
            }
        } else {
            throw new Exception("Extension non autorisée pour le fichier : $documentName");
        }

      }

    public static function createCours($id,$titre,$description,$image,$documentation,$vedio,$idcategorie,$idEnseignant){
        $db=database::getInstance()->getConnection();
        try {
           $stmt=$db->prepare("INSERT into cours(titre,description,path_image,documentation,idcategorie,idEnseignant) 
                              values(?,?,?,?,?,?)");
            $stmt->execute([$titre,$description,$image,$documentation,$idcategorie,$idEnseignant]);
            $lastInsertId=$db->lastInsertId();
            return new coursDocument($lastInsertId,$titre,$description,$image,$documentation);
        } catch (PDOException $th) {
           $th->getMessage();
        }
    }
    public static function getAllCours($idEnseignant){
        $db=database::getInstance()->getConnection();
        $courses=[];
        try{
       $stmt=$db->prepare("SELECT * FROM  vuecours where path_vedio is null and iduser=?");
       if($stmt->execute([$idEnseignant])){
         $result=$stmt->fetchALL();
         foreach($result as $row){
            $course= new coursDocument($row['idcours'],$row['titre'],$row['description'],$row['path_image'],$row['documentation']);
            $prof=new Enseignant($row['nom'],$row['prenom'],$row['email'],$row['role'],$row['iduser'],$row['password']);
            $course->setProfessor($prof);
            $categorie=new categorie($row['categorie']);
            $course->setCategorie( $categorie);
            $courses[]=$course;
         }
         return $courses;
       }
   
       return [];

        }catch(PDOException $e)
        {
            die("Erreur SQL : " . $e->getMessage());
        }
       
    }


     public function getdocumentation(){return $this->documentation;} 
}