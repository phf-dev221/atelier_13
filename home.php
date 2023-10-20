<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "Papaf@ll21";
$nomdb = "taxi";

try {
    $database = new PDO("mysql:host=$servername;dbname=$nomdb", $username, $password);
    $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//echo 'connexion reussie';

} catch (PDOException $e) {
    echo "Échec : " . $e->getMessage();
}

$liste = $database->query('SELECT * FROM utilisateurs');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des utilisateurs</title>
</head>
<body>
    <p>
        <?php
        if(!$_SESSION['user']){
            header('location:inscription.php');
            die();
        } ?>
    </p>
    <h3>Bienvenue M/Me <?php print_r ($_SESSION['user']['nom'])?></h3>
    <h1>Liste des utilisateurs</h1>
    <table border="1">
        <tr>
           
            <th>Prénom</th>
            <th>Nom</th>
            <th>Téléphone</th>
            <th>E-mail</th>
            <th>Date d'inscription</th>
        </tr>
        <?php while ($data = $liste->fetch(PDO::FETCH_ASSOC)): ?>
        <tr>
            
            <td><?php echo $data['prenom']; ?></td>
            <td><?php echo $data['nom']; ?></td>
            <td><?php echo $data['telephone']; ?></td>
            <td><?php echo $data['mail']; ?></td>
            <td><?php echo $data['dateInscription']; ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
    <?php
    echo 'se deconnecter <a href="deconnecter.php">ICI</a>'

    ?>
</body>
</html>
