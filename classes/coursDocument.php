<?php
require_once 'db.php';
require_once 'cours.php';
class coursDocument extends cours{
      private $documentation;

      public function __construct($id,$titre,$description,$documentation)
      {
        parent::__construct($id,$titre,$description);
        $this->documentation=$documentation;
    }
    public static function createCours($id,$titre,$description,$documentation,$idcategorie,$idEnseignant){
        $db=database::getInstance()->getConnection();
        try {
           $stmt=$db->prepare("INSERT into cours(titre,description,documentation,idcategorie,idEnseignant) 
                              values(?,?,?,?,?)");
            $stmt->execute([$titre,$description,$documentation,$idcategorie,$idEnseignant]);
            $lastInsertId=$db->lastInsertId();
            return new coursDocument($lastInsertId,$titre,$description,$documentation);
        } catch (PDOException $th) {
           $th->getMessage();
        }
    }

     public function getdocumentation(){return $this->documentation;} 
}