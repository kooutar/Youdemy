<?php
require_once 'db.php';
require_once 'cours.php';
class coursVedio extends cours{
      private $vedio;

      public function __construct($id,$titre,$description,$vedio)
      {
        parent::__construct($id,$titre,$description);
        $this->vedio=$vedio;
    }
    public static function createCours($id,$titre,$description,$vedio,$idcategorie,$idEnseignant){
        $db=database::getInstance()->getConnection();
        try {
           $stmt=$db->prepare("INSERT into cours(titre,description,path_vedio,idcategorie,idEnseignant) 
                              values(?,?,?,?,?)");
            $stmt->execute([$titre,$description,$vedio,$idcategorie,$idEnseignant]);
            $lastInsertId=$db->lastInsertId();
            return new coursVedio($lastInsertId,$titre,$description,$vedio);
        } catch (PDOException $th) {
           $th->getMessage();
        }
    }

    public function getvedio(){return $this->vedio;} 
}