<?php
// require_once '../autoload.php';
require_once '../classes/db.php';
class tag implements JsonSerializable{
    private $id;
    private $tag;

    function __construct($tag,$id=null)
    {
        $this->tag=$tag;
        $this->id=$id;
    }

    public function jsonSerialize() :array{
      return [
          'id' => $this->id,
          'tag' => $this->tag
      ];
  }

  public function getTag(){return $this->tag;}
    public static function insertTag($tag){
          $db=database::getInstance()->getConnection();
          try {
            $stmt=$db->prepare("INSERT INTO  tag(tag) VALUES(?)");
             $stmt->execute([$tag]);
            $lastinsertId=$db->lastInsertId();
            $tag= new tag($tag,$lastinsertId);
            return $tag;

          } catch (PDOException $e){
            $e->getMessage();
            //throw $th;
          }
    }
  
    public static function afficheTag(){
      $tags=[];
      $db=database::getInstance()->getConnection();
      try{
        $stmt=$db->prepare("SELECT * FROM tag");
        if($stmt->execute()){
         $result= $stmt->fetchAll();
         foreach($result as $row){
          $tags[] = new tag($row['tag'], $row['idtag']);
         }
        }
        return $tags;
      } catch(PDOException $e){
        $e->getMessage();
      } 
    }




}

