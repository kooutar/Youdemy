<?php

class tag_cours{
    private tag $tag;
    private cours $cours;
    
    public static function insert_tag_cours($idcours,$idtag) {
        $db = database::getInstance()->getConnection();
        try {
          
            $stmt = $db->prepare("INSERT INTO tag_cours (idcours, idtag) VALUES (?, ?)");
            $stmt->execute([$idcours, $idtag]);
            
           
            return true;
        } catch (\PDOException $th) {
         
            die("Erreur SQL : " . $th->getMessage());
        }
        return false;
    }
    

}