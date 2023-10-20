<?php 
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Inscription et Connexion</title>
    <link rel="stylesheet" href="inscription.css">
</head>
<body>
    <div id="inscription">
        <h2>Inscription</h2>

        <h4>Faites votre inscription en remplissant les informations suivantes</h4>
     
        <form action="log.php" method="post">
            <div class="container_name">
                <div class="prenom">
            <label for="prenom">Prénom </label>
            <br>
            <input type="text" id="prenom" name="prenom" required><br>
                </div>

                <div class="nom">
            <label for="nom">Nom </label>
            <br>
            <input type="text" id="nom" name="nom" required><br>
                </div>
        </div>

                <div class="tel">
            <label for="telephone">Téléphone </label><br>
            <input type="tel" id="telephone" name="telephone" placeholder="+221" required><br>
                </div>

            <div class="container_connect">
                <div class="mail">
            <label for="mail">E-mail </label><br>
            <input type="email" id="mail" name="mail" required><br>
                </div>

                <div class="mot_pass">
            <label for="motDePasse">Mot de passe </label><br>
            <input type="password" id="motDePasse" name="motDePasse" required><br>
                </div>
        </div>

            <input type="submit" value="S'inscrire">
        </form>
    </div>

    <form action="sign.php" method="POST" id="connexion">
        <h2>Connexion</h2>
        <h4 class="desc">Votre chauffeur en un clic !</h4>
        <form action="traitement_connexion.php" method="post">
            <button>Continuer avec Facebook</button><br><br>
            <div class="containLine">
                <div class="divleft"></div>
                <span class="ou">ou</span>
                <div class="divright"></div>
            </div>

            <div class="mailconnect">
                <label for="emailConnexion">E-mail</label><br>
                <input type="email" id="emailConnexion" name="mail" required><br>
            </div>

            <div class="passconnect">
                <label for="motDePasseConnexion">Mot de passe </label><br>
                <input type="password" id="motDePasseConnexion" name="motDePasse" required><br>
            </div>
            <input type="submit" value="Se connecter" class="sendconnect">
        </form>
    </form>
</body>
</html>
