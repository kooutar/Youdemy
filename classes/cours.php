<?php
require_once 'db.php';
require_once 'Enseignant.php';
require_once 'categorie.php';
 abstract class  cours{
  protected $idcours;
  protected $titre;
  protected $description;
  protected $image;
  protected Enseignant $prof;
  protected categorie $categorie;

  public function __construct($id,$titre,$description,$image)
  {
    $this->idcours=$id;
    $this->titre=$titre;
    $this->description=$description;
    $this->image=$image;
   
  }
  
  public static function validateImage($imagename,$imageTmp){
      $dir='../cours/';
      $path = basename($imagename);
        $finalPath = $dir . uniqid() . "_" . $path;
        $allowedExtensions = ['png', 'jpg', 'jpeg', 'gif', 'svg'];
        $extension = pathinfo($finalPath, PATHINFO_EXTENSION);
        if (in_array(strtolower($extension), $allowedExtensions)) {
            if (move_uploaded_file($imageTmp, $finalPath)) {
                return $finalPath;
            } else {
                throw new Exception("Erreur lors du déplacement du fichier : $imagename");
            }
        } else {
            throw new Exception("Extension non autorisée pour le fichier : $imagename");
        }
  }

  abstract  public static function createCours($id,$titre,$description,$image,$documentation,$vedio,$idcategorie,$idEnseignant);
 
  abstract  public static function getAllCours($idEnseignant);
 

    public function __get($attribut) {
        
      if (property_exists($this, $attribut)) {
          return $this->$attribut;
      } else {
         
          echo "L'attribut '$attribut' n'existe pas.";
      }
  }
  public function setProfessor(Enseignant $professor) {
    $this->prof = $professor;
}   
public function setCategorie(categorie $categorie){
  $this->categorie=$categorie;
}
  public static function afficherTousLesCours(){
    $courses=[];
    $db=database::getInstance()->getConnection();
    try {
      $stmt=$db->prepare("SELECT * FROM  vuecours ");
      if($stmt->execute([])){
        $result=$stmt->fetchALL();
        return $result;
      }
      return[];
    } catch (PDOException $e) {
      die("err sql". $e->getMessage());
    }
  }

 }
