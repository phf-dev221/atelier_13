<?php 

$regex_email = '/^[a-zA-Z][a-zA-Z0-9]+@+[a-zA-Z]+.+[a-zA-Z]+$/';
     $errors = [];
 
     if (!preg_match("/^[A-Za-zÀ-ÖØ-öø-ÿ'-]+$/", $_POST['prenom'])||(empty($_POST['prenom']))) {
         $errors[]="nom invalide";
     }
   
     
     if (!preg_match("/^[A-Za-zÀ-ÖØ-öø-ÿ'-]+$/", $_POST['nom'])||(empty($_POST['nom']))) {
         $errors[]="prenom invalide";
     }
   
     if ((strlen($_POST['telephone']) < 9)||(empty($_POST['telephone']))) {
        $errors[] = "Entrez un numéro valide.";
    }
 
     if ((!preg_match($regex_email, $_POST["mail"]))||(empty($_POST['mail']))) {
         $errors[] = "L'adresse email est invalide.";
     }
 
     if (strlen($_POST['motDePasse']) < 8) {
         $errors[] = "Le mot de passe doit avoir au moins 8 caractères.";
     }
 
     if (
         !preg_match("/[A-Z]/", $_POST['motDePasse']) ||
         !preg_match("/[a-z]/", $_POST['motDePasse']) ||
         !preg_match("/[0-9]/", $_POST['motDePasse'])
     ) {
         $errors[] = "Le mot de passe doit contenir au moins une lettre majuscule, une lettre minuscule et au moins un chiffre.";
     }

?>