<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "Papaf@ll21";
$nomdb = "taxi";

try {
    $database = new PDO("mysql:host=$servername;dbname=$nomdb", $username, $password);
    $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   // echo 'Connexion réussie';
} catch (PDOException $e) {
    echo "Échec : " . $e->getMessage();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

     /* Vérification de données */
     $regex_email = '/^[a-zA-Z][a-zA-Z0-9]+@+[a-zA-Z]+.+[a-zA-Z]+$/';
     $errors = [];
 
     if (!preg_match("/^[A-Za-zÀ-ÖØ-öø-ÿ '-]+$/", $_POST['prenom'])||(empty($_POST['prenom']))) {
         $errors[]="prenom invalide";
     }
   
     
     if (!preg_match("/^[A-Za-zÀ-ÖØ-öø-ÿ '-]+$/", $_POST['nom'])||(empty($_POST['nom']))) {
         $errors[]="nom invalide";
     }
   
     /*if ((strlen($_POST['telephone']) < 9)||(empty($_POST['telephone']))) {
        $errors[] = "Entrez un numéro valide.";
    }*/

    if (!preg_match("/^[0-9]+$/", $_POST['telephone']) || substr($_POST['telephone'], 0, 1) != '7' || strlen($_POST['telephone']) != 9) {
        $errors[] = 'Format numéro invalide';
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
     if(!empty($errors)){
        //print_r($errors);
        foreach($errors as $error){
            echo '<pre>'.$error.'</pre>';
            
        }
        echo 'veuillez <a href="inscription.php">REESSAYER</a>"';
        die();
     }

     else{
        $prenom =  $_POST['prenom'];
        $nom = $_POST['nom'];
        $tel = $_POST['telephone'];
        $mail = $_POST['mail'];
        $mot_passe = md5($_POST['motDePasse']);
        $dat = date('Y-m-d');
      

        $doublons = $database->prepare('SELECT * FROM utilisateurs WHERE mail= :mail');
        $doublons->execute([':mail' => $mail]);
        $resultat = $doublons->fetchColumn();

        $doublontel = $database->prepare('SELECT * FROM utilisateurs WHERE telephone= :tel');
        $doublontel->execute([':tel' => $tel]);
        $resultattel = $doublontel->fetchColumn();

        if($resultat>0){
            /*header('location:inscription.php');
            die();*/
            echo "E-mail déja utilisé, essayez un nouveau en cliquant <a href='inscription.php'>ICI</a>";
            die();
        }

        if($resultattel>0){
            
            echo "Numéro de téléphone déja utilisé, essayez un nouveau en cliquant <a href='inscription.php'>ICI</a>";
            die();
        }
try{
        $requete = $database->prepare("INSERT INTO utilisateurs(prenom, nom, telephone, mail, motDePasse, dateInscription) VALUES(:prenom, :nom, :tel, :mail, :mot_passe, :dateInscription)");

       // if($requete){ 

        $requete->execute(
           array(
                ':prenom' => $prenom,
                ':nom' => $nom,
                ':tel' => $tel,
                ':mail' => $mail,
                ':mot_passe' => $mot_passe,
                ':dateInscription' => $dat
            )
        );
        echo 'inscription reussie veuillez cliquer <a href="inscription.php">ICI</a>pour vous connecter"';
    }
    catch(PDOException $e){
       // echo 'inscription non valide';
    }
    }
}
?>

