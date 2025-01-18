<?php
require_once '../autoload.php';
session::ActiverSession();
$prof = new Enseignant($_SESSION['userData']['nom'],$_SESSION['userData']['prenom'],$_SESSION['userData']['email'],$_SESSION['userData']['role'],$_SESSION['userData']['iduser']);
if(isset($_POST['ajoutCours'])){
   $tags=$_POST['tags'];
   $tagsArray=json_decode($tags,true);
   $tags = array_column($tagsArray, 'value');
   $tagString= implode(", ", $tags);
  $arraytag=explode(',',$tagString);
   $image= cours::validateImage($_FILES['image']['name'],$_FILES['image']['tmp_name']);
    if($_POST['typeCours']=='vedio'){
        $urlvedio=coursVedio::validatepathVedio($_FILES["url"]["name"],$_FILES["url"]["tmp_name"]);
        $cours=new coursVedio(null,$_POST['titre'],$_POST['description'],$image,$urlvedio);
        $categorie=new categorie($_POST['categorie']);
        $cours->setCategorie($categorie);
       $finalCours= $prof->ajouterCours($cours);
        foreach ($arraytag as $tag) {
            
            $existingTag = tag::tagNameExist($tag);
            
            if (!empty($existingTag)) {

                tag_cours::insert_tag_cours($finalCours->idcours, $existingTag);
                
            }
           
        }
        
        Session::ActiverSession();
        $_SESSION['success'] = "ajout cours  avec success !"; 
        header('location: ../front/mesCours.php');
        exit();
    }if($_POST['typeCours']=='document'){
        $document=coursDocument::validateDocument($_FILES['document']['name'],$_FILES['document']['tmp_name']);
       $cours= new coursDocument(null,$_POST['titre'],$_POST['description'],$image,$document);
       $categorie=new categorie($_POST['categorie']);
       $cours->setCategorie($categorie);
       $finalCours=$prof->ajouterCours($cours);
       foreach ($arraytag as $tag) {
            echo $tag."<br>";
        $existingTag = tag::tagNameExist($tag);
         var_dump($existingTag);
        if (!empty($existingTag)) {

            tag_cours::insert_tag_cours($finalCours->idcours, $existingTag);
            
        }
       
    }
       Session::ActiverSession();
       $_SESSION['success'] = "ajout cours  avec success !"; 
       header('location: ../front/mesCours.php');
       exit();

    }
}
//  affichage 

$cours=new coursVedio(null,null,null,null,null);
$cours->setProfessor($prof);
$coursVedio= $prof->consulterMesCours($cours);
// foreach($coursVedio as $cours){
//     var_dump($cours);
// }
// ****************
$cours=new coursDocument(null,null,null,null,null);
$cours->setProfessor($prof);
$coursDocument= $prof->consulterMesCours($cours);
//  print_r($coursDocument);



