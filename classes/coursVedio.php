<?php
require_once 'db.php';
require_once 'cours.php';
class coursVedio extends cours
{
    private $vedio;

    public function __construct($id, $titre, $description,$image, $vedio)
    {
        parent::__construct($id, $titre, $description,$image);
        $this->vedio = $vedio;
    }


    public static function validatepathVedio($vedioName, $vedioTmp)
    {
        $dir = '../uploads/';
        $path = basename($vedioName);
        $finalPath = $dir . uniqid() . "_" . $path;
        $allowedExtensions = ['mp4', 'mov', 'avi', 'wmv', 'flv'];
        $extension = pathinfo($finalPath, PATHINFO_EXTENSION);
        if (in_array(strtolower($extension), $allowedExtensions)) {
            if (move_uploaded_file($vedioTmp, $finalPath)) {
                return $finalPath;
            } else {
                throw new Exception("Erreur lors du déplacement du fichier : $vedioName");
            }
        } else {
            throw new Exception("Extension non autorisée pour le fichier : $vedioName");
        }
    }


    public static function createCours($id, $titre, $description,$image,$doc,$vedio, $idcategorie, $idEnseignant)
    {
        $db = database::getInstance()->getConnection();
        try {
            $stmt = $db->prepare("INSERT into cours(titre,description,path_image,path_vedio,idcategorie,idEnseignant) 
                              values(?,?,?,?,?,?)");
            $stmt->execute([$titre, $description,$image, $vedio, $idcategorie, $idEnseignant]);
            $lastInsertId = $db->lastInsertId();
            return new coursVedio($lastInsertId, $titre, $description,$image, $vedio);
        } catch (PDOException $th) {
            echo "Erreur PDO : " . $th->getMessage(); 
        return false; 
        }
    }
    public static function getAllCours($idEnseignant){
        $db=database::getInstance()->getConnection();
        $courses=[];
        try{
       $stmt=$db->prepare("SELECT * FROM  vuecours where documentation is null and idEnseignant=? ");
       if($stmt->execute([$idEnseignant])){
         $result=$stmt->fetchALL();
         foreach($result as $row){
            $courses[]= new coursVedio($row['idcours'],$row['titre'],$row['description'],$row['path_image'],$row['path_vedio']);
         }
         return $courses;
       }
       return [];

        }catch(PDOException $e)
        {
             $e->getMessage();
        }
       
    }

    public function getvedio()
    {
        return $this->vedio;
    }
}
