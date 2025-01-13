<?php
require_once 'db.php';
class categorie{
  private $idcategorie;
  private $categorie;
  public function __construct($categorie,$idcategorie=null)
  {
    $this->idcategorie=$idcategorie;
    $this->categorie=$categorie; 
  }
   
  public static function inserCategorie($categorie) {
   
    $db = database::getInstance()->getConnection();

    try {
       
        $stmt = $db->prepare("INSERT INTO categorie(categorie) VALUES(?)");
        $stmt->execute([$categorie]);

      
        $lastInsertId = $db->lastInsertId();

        $categorie = new categorie($categorie,$lastInsertId );
        return $categorie;

    } catch (PDOException $e) {
        return $e->getMessage();
    }
}


}