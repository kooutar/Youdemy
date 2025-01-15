<?php
require_once 'db.php';
require_once 'cours.php';
class coursVedio extends cours
{
    private $vedio;

    public function __construct($id, $titre, $description, $vedio)
    {
        parent::__construct($id, $titre, $description);
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


    public static function createCours($id, $titre, $description,$doc,$vedio, $idcategorie, $idEnseignant)
    {
        $db = database::getInstance()->getConnection();
        try {
            $stmt = $db->prepare("INSERT into cours(titre,description,path_vedio,idcategorie,idEnseignant) 
                              values(?,?,?,?,?)");
            $stmt->execute([$titre, $description, $vedio, $idcategorie, $idEnseignant]);
            $lastInsertId = $db->lastInsertId();
            return new coursVedio($lastInsertId, $titre, $description, $vedio);
        } catch (PDOException $th) {
            echo "Erreur PDO : " . $th->getMessage(); 
        return false; // Retourne false en cas d'échec
        }
    }

    public function getvedio()
    {
        return $this->vedio;
    }
}
