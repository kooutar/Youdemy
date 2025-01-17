<?php
require_once 'db.php';
require_once 'Enseignant.php';
require_once 'categorie.php';
class  cours
{
  protected $idcours;
  protected $titre;
  protected $description;
  protected $image;
  protected $status;
  protected Enseignant $prof;
  protected categorie $categorie;

  public function __construct($id, $titre, $description, $image,$status='en attente')
  {
    $this->idcours = $id;
    $this->titre = $titre;
    $this->description = $description;
    $this->image = $image;
    $this->status=$status;
  }

  public static function validateImage($imagename, $imageTmp)
  {
    $dir = '../cours/';
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

  public function __get($attribut)
  {

    if (property_exists($this, $attribut)) {
      return $this->$attribut;
    } else {

      echo "L'attribut '$attribut' n'existe pas.";
    }
  }
  public function setProfessor(Enseignant $professor)
  {
    $this->prof = $professor;
  }
  public function setCategorie(categorie $categorie)
  {
    $this->categorie = $categorie;
  }
  // public static function getTotalCours(){

  // }
  public static function totalcours()
  {
    $db = Database::getInstance()->getConnection();
    try {
      $req = "SELECT COUNT(*) as total FROM cours";
      $stmt = $db->prepare($req);
      $stmt->execute();
      return $stmt->fetch();
    } catch (PDOException $e) {
      echo "Erreur lors du comptage des cours : " . $e->getMessage();
      return [];
    }
  }

  public static function getAllCours()
  {
    $courses = [];
    $db = Database::getInstance()->getConnection();
    try {
      $req = "SELECT * FROM  vuecours";
      $stmt = $db->prepare($req);
      if ($stmt->execute()) {
        $result = $stmt->fetchALL();
        foreach ($result as $row) {
          $course = new cours($row['idcours'], $row['titre'], $row['description'], $row['path_image'],$row['statusCours']);
          $prof = new Enseignant($row['nom'], $row['prenom'], $row['email'], $row['role'], $row['iduser'], $row['password']);
          $course->setProfessor($prof);
          $categorie = new categorie($row['categorie']);
          $course->setCategorie($categorie);
          $courses[] = $course;
        }
        return $courses;
      }
    } catch (PDOException $e) {
      echo "Erreur lors du comptage des cours : " . $e->getMessage();
      return [];
    }
  }

  public static function afficherTousLesCours($page, $parpage)
  {
    $courses = [];
    $premier = ($page * $parpage) - $parpage;

    $db = database::getInstance()->getConnection();
    try {
      $stmt = $db->prepare("SELECT * FROM  vuecours  where statusCours='accepter' limit :premier , :parpage ");
      $stmt->bindParam(':premier', $premier, PDO::PARAM_INT);
      $stmt->bindParam(':parpage', $parpage, PDO::PARAM_INT);
      if ($stmt->execute()) {
        $result = $stmt->fetchALL();
        foreach ($result as $row) {
          $course = new cours($row['idcours'], $row['titre'], $row['description'], $row['path_image']);
          $prof = new Enseignant($row['nom'], $row['prenom'], $row['email'], $row['role'], $row['iduser'], $row['password']);
          $course->setProfessor($prof);
          $categorie = new categorie($row['categorie']);
          $course->setCategorie($categorie);
          $courses[] = $course;
        }
        return $courses;
      }
      return [];
    } catch (PDOException $e) {
      die("err sql" . $e->getMessage());
    }
  }

  public static function getcoursById($coursId)
  {
    $db = database::getInstance()->getConnection();
    try {
      $stmt = $db->prepare("SELECT * FROM  vuecours where idcours=? ");
      $stmt->execute([$coursId]);
      $result = $stmt->fetch();
      if ($result['documentation'] == null) {
        $course = new  coursVedio($result['idcours'], $result['titre'], $result['description'], $result['path_image'], $result['path_vedio']);
        $prof = new Enseignant($result['nom'], $result['prenom'], $result['email'], $result['role'], $result['iduser'], $result['password']);
        $course->setProfessor($prof);
        $categorie = new categorie($result['categorie']);
        $course->setCategorie($categorie);
        return $course;
      } elseif ($result['path_vedio'] == null) {
        $course = new coursDocument($result['idcours'], $result['titre'], $result['description'], $result['path_image'], $result['documentation']);
        $prof = new Enseignant($result['nom'], $result['prenom'], $result['email'], $result['role'], $result['iduser'], $result['password']);
        $course->setProfessor($prof);
        $categorie = new categorie($result['categorie']);
        $course->setCategorie($categorie);
        return $course;
      } else {
        return false;
      }
    } catch (PDOException $e) {
      die("err sql" . $e->getMessage());
    }
  }

  public function setStatus($status){
    $this->status=$status;
  }

  public function accepterCours(){
    $db = database::getInstance()->getConnection();
    try {
        $stmt = $db->prepare("UPDATE cours SET status = 'accepter' WHERE idcours = ?");
        $stmt->execute([$this->idcours]);
        $this->setStatus('accepter');
    } catch (PDOException $th) {
       
        error_log("SQL Error: " . $th->getMessage());
       
        return "An error occurred while updating the course status.";
    }
}

public function refuserCours(){
  $db = database::getInstance()->getConnection();
  try {
      $stmt = $db->prepare("UPDATE cours SET status = 'refuser' WHERE idcours = ?");
      $stmt->execute([$this->idcours]);
      $this->setStatus('refuser');
  } catch (PDOException $th) {
     
      error_log("SQL Error: " . $th->getMessage());
     
      return "An error occurred while updating the course status.";
  }
}

}
