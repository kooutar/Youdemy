<?php
require_once '../autoload.php';


if($_SERVER['REQUEST_METHOD']=='POST'){

    $inscription =new inscrire($_POST['coursId'],$_POST['idetudiant']);
    $inscription->inscrire();
 
}
