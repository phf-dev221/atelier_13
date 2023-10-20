<?php 
session_start();

$servername = "localhost";
$username = "root";
$password = "Papaf@ll21";
$nomdb = "taxi";

try {
    $database = new PDO("mysql:host=$servername;dbname=$nomdb", $username, $password);
    $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo 'Connexion réussie';
} catch (PDOException $e) {
    echo "Échec : " . $e->getMessage();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $regex_email = '/^[a-zA-Z][a-zA-Z0-9]+@+[a-zA-Z]+.+[a-zA-Z]+$/';
    $errors = [];

    if (!preg_match($regex_email, $_POST["mail"]) || empty($_POST['mail'])) {
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
        print_r($errors);
    }
    else{
        $mail = $_POST['mail'];
        $password = md5($_POST['motDePasse']);

        $requete = $database->prepare('SELECT * FROM utilisateurs WHERE mail= :mail');
        $requete->execute([':mail' => $mail]);
        $utilisateur = $requete->fetch();
        //var_dump($utilisateur);

        if ($utilisateur==true && $password===$utilisateur['motDePasse']) {
            
            $_SESSION['user'] =$utilisateur;
            
            
           // $_SESSION['username'] = $utilisateur['prenom'];
             header('Location: home.php');
            
        } else {
            echo "Nom d'utilisateur ou mot de passe incorrect.";
        }
    }
}
?>
