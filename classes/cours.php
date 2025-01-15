<?php
require_once 'db.php';
 abstract class  cours{
  protected $idcours;
  protected $titre;
  protected $description;

  public function __construct($id,$titre,$description)
  {
    $this->idcours=$id;
    $this->titre=$titre;
    $this->description=$description;
  }

  abstract  public static function createCours($id,$titre,$description,$documentation,$vedio,$idcategorie,$idEnseignant);
 

 

    public function __get($attribut) {
        
      if (property_exists($this, $attribut)) {
          return $this->$attribut;
      } else {
         
          echo "L'attribut '$attribut' n'existe pas.";
      }
  }   
  

 }
