<?php

try {
  $bdd = new PDO("mysql:host=localhost;dbname=m1106_Pong;charset=utf8", "username", "password");
  $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
}
catch (PDOException $e){
  echo $e->getMessage();
}
session_start();

if (isset($_SESSION['user'])){

  header('Location: home.php');
}

if (isset($_POST['signin'])){

  $username = ucfirst(strtolower(htmlspecialchars($_POST['pseudo'])));
  $password = htmlspecialchars($_POST['mdp']);

  $reqUser = $bdd->prepare("SELECT * FROM membres WHERE pseudo = :username");
  $reqUser->bindParam("username", $username, PDO::PARAM_STR);
  $reqUser->execute();

  $result = $reqUser->fetch(PDO::FETCH_ASSOC);

  if (!$result) {$error = "Identifiant ou mot de passe invalide. Veuillez réessayer...";} 
  else {
    if (password_verify($password, $result['mdp'])) {

    	$_SESSION['user'] = $result['pseudo'];
      $_SESSION['id'] = $result['id'];
      header('Location: home.php');
     
    } else {

      $error = "Identifiant ou mot de passe invalide. Veuillez réessayer...";
    }
  }

}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Connexion</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="css/login.css">
  <link rel="icon" href="images/favicon.ico">
</head>

<body>
  <header>
    <div id="petite_bande_bleue">
        <marquee scrollamount="10" width="100%">
            <p>Cryptotrade et ses concepteurs ont besoins de votre soutien!</p>
        </marquee>
    </div>
    <div id="navigation-header">
        <nav>
            <ul>
                <li>
                    <a>Historique</a> 
                    <ul>
                        <li><a href="historique.php">Dates clés</a></li>
                        <li><a href="crypto.html">Qu’est ce que la crypto monnaie?</a></li>
                    </ul>
                </li>
                <li class ="exception">
                    <a >Comment ça marche ?</a>
                    <ul>
                        <li><a href="platform.html">Plateforme d’échanges</a></li>
                        <li><a href="legislation.html">Législation</a></li>
                    </ul>
                </li>
                <li>
                    <a>Actualités</a>
                    <ul>
                        <li><a href="cours.php">Cours des cryptos</a></li>
                        <li><a href="news.php">Crypto-news</a></li>
                    </ul>
                </li>
                <li>
                    <a>Ressources</a>
                    <ul>
                        <li><a href="vocabulaire.php">Vocabulaire</a></li>
                    </ul>
                </li>
            </ul>
            <a id="logo-site-header" href="index.html"><img src="images/logoNoir.png"></a>
        </nav>
    </div>
</header>
<form method="POST" action="login.php">
    <div class="login-box">
        <h1>Login</h1>
        <div class="textbox">
            <i class="fas fa-user"></i>
            <input type="text" name="pseudo" placeholder="Identifiant" required>
        </div>
        <div class="textbox">
            <i class="fas fa-lock"></i>
            <input type="password" name="mdp" placeholder="Mot de passe" required>
        </div>
        <input type="submit" class="btn" value="Se connecter" name="signin">
        <p align="center"><?php if(isset($error)){echo $error;} ?></p>
        <a href="sign_in.php" style="color: black;">Créer un compte</a>
    </div>
</form>
<footer>
    <div id="footer-haut">
        <div id="footer-haut-haut">
            <a id="logo-site-footer" href="index.html"><img src="images/logo.png"></a>
        </div>
        <div id="footer-haut-bas">
            <div id="partie-don">
                <p>Soutenez-vous! <a href="#">Donnez</a></p>
            </div>
            <div id="navigation-footer">
                <nav>
                    <ul>
                        <li>
                            <a class="titre-menu" >Historique</a> 
                            <ul>
                                <li><a class="element-menu" href="historique.php">Dates clés</a></li>
                                <li><a class="element-menu" href="crypto.html">Qu’est ce que la crypto monnaie?</a></li>
                            </ul>
                        </li>
                        <li>
                            <a class="titre-menu" >Comment ça marche ?</a>
                            <ul>
                                <li><a  class="element-menu"href="platform.html">Plateforme d’échanges</a></li>
                                <li><a class="element-menu"href="legislation.html">Législation</a></li>
                            </ul>
                        </li>
                        <li>
                            <a class="titre-menu">Actualités</a>
                            <ul>
                                <li><a class="element-menu" href="cours.php">Cours des cryptos</a></li>
                                <li><a class="element-menu" href="#">Crypto-news</a></li>
                            </ul>
                        </li>
                        <li>
                            <a class="titre-menu">Ressources</a>
                            <ul>
                                <li><a class="element-menu" href="vocabulaire.php">Vocabulaire</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <div id="footer-bas">
        <span id="copy-right">&copy;Pong industry 2021</span>
    </div>
</footer>
</body>
</html>