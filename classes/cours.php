<?php
require_once 'db.php';
 class cours{
  protected $idcours;
  protected $titre;
  protected $description;

  public function __construct($id,$titre,$description)
  {
    $this->idcours=$id;
    $this->titre=$titre;
    $this->description=$description;
  }

  // public static function insertCours($titre,$description,$idcategorie,$idEnseignant,$documentation=null,$path_vedio=null){
  //   $db=database::getInstance()->getConnection();
  //   try {
  //      $stmt=$db->prepare("INSERT INTO cours(titre,description,idcategorie,idEnseignant,documentation,path_vedio) value(?,?,?,?,?,?) ");
  //      $stmt->execute([$titre,$description,$idcategorie,$idEnseignant,$documentation,$path_vedio]);
       
  //   } catch (PDOException $e) {
  //      $e->getMessage();
  //   }
  // }

    public function __get($attribut) {
        
      if (property_exists($this, $attribut)) {
          return $this->$attribut;
      } else {
         
          echo "L'attribut '$attribut' n'existe pas.";
      }
  }   
  

 }
