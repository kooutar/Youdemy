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
        
        if($stmt->execute([$categorie])){
        
          $lastInsertId = $db->lastInsertId();

        $categorie = new categorie($categorie,$lastInsertId );
        return $categorie;
        
        }else{
          return false;
        }
        
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

public static function affichecategorie(){
  $categorie=[];
  $db = database::getInstance()->getConnection();
  try{
    $stmt=$db->prepare("SELECT * FROM categorie;");
    if($stmt->execute()){
       $result=$stmt->fetchAll();
       foreach($result as $cat){
        $categorie[] = $cat;
       }
    }
  return $categorie;
  }catch(PDOException $e){
      $e->getMessage();
  }
}
public function getCategorie(){return $this->categorie;}

}