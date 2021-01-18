<?php

try {
  $bdd = new PDO("mysql:host=localhost;dbname=m1106_Pong;charset=utf8", "username", "password");
  $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
}
catch (PDOException $e){
  echo $e->getMessage();
}

if (isset($_POST['signin'])){

    if(!empty($_POST['pseudo']) || !empty($_POST['mdp']) || !empty($_POST['mail'])){ 

        $username = ucfirst(strtolower(htmlspecialchars($_POST['pseudo'])));
        $mail = htmlspecialchars($_POST['mail']);
        $password = htmlspecialchars($_POST['mdp']);
        $password2 = htmlspecialchars($_POST['mdp2']);
        
        if (filter_var($mail, FILTER_VALIDATE_EMAIL)) { 
            if (strlen($password) > 7){ 
                if (preg_match('/[0-9]/', $password)){
                    if(preg_match('/[.,!?:;]/', $password)) {
                        if($password == $password2){

                          $insertUser = $bdd->prepare('INSERT INTO membres (pseudo, mail, mdp, USD) VALUES (?, ?, ?)');
                          $insertUser->execute(array($username, $mail, password_hash($password, PASSWORD_DEFAULT), 10000)) or die(print_r($insertUser>errorInfo(), true));
                          $error = "Membre ajouté avec succès";

                        }else {$error = "Les mots de passe doivent être identiques";}
                    } else {$error = "Le mot de passe doit contenir une ponctuation";}
                } else {$error = "Le mot de passe doit contenir un chiffre";}
            } else {$error = "Mot de passe trop court";}
        } else {$error = "$mail n'est pas valide";}
    } else {$error = "Veuillez remplir tous les champs";}
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Inscription</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="css/login.css">
  <link rel="icon" href="images/favicon.ico">
</head>


<body>

  <header>
        <div id="petite_bande_bleue">
            <marquee scrollamount="10" width="100%"><p>Cryptotrade et ses concepteurs ont besoins de votre soutien!</p></marquee>
        </div>
    <div id="navigation-header">
        <nav> 
    <ul>
        <li><a>Historique</a> 
            <ul>
                <li><a href="historique.php">Dates clés</a></li>
                <li><a href="crypto.html">Qu’est ce que la crypto monnaie?</a></li>
            </ul>
        </li>
        <li class ="exception"><a >Comment ça marche ?</a>
            <ul>
                <li><a href="platform.html">Plateforme d’échanges</a></li>
                <li><a href="legislation.html">Législation</a></li>
            </ul>
        </li>
        <li><a>Actualités</a>
            <ul>
                <li><a href="cours.php">Cours des cryptos</a></li>
                <li><a href="#">Crypto-news</a></li>
            </ul>
        </li>
        <li><a>Ressources</a>
            <ul>
                <li><a href="vocabulaire.php">Vocabulaire</a></li>
            </ul>
        </li>

    </ul>
    <a id="logo-site-header" href="index.html"><img src="images/logoNoir.png"></a>
 </nav>
    
</div>
</header>
  <form method="POST" action="sign_in.php">
	<div class="login-box">
	  <h1>Inscription</h1>
	  <div class="textbox">
		<i class="fas fa-user"></i>
		<input type="text" name="pseudo" placeholder="Identifiant" required>
	  </div>

      <div class="textbox">
        <i class="fas fa-envelope"></i>
		<input type="mail" name="mail" placeholder="E-mail" required>
	  </div>

	  <div class="textbox">
		<i class="fas fa-lock"></i>
		<input type="password" name="mdp" placeholder="Mot de passe" required>
	  </div>
      <div class="textbox">
		<i class="fas fa-lock"></i>
		<input type="password" name="mdp2" placeholder="Confirmer mot de passe" required>
	  </div>

	  <input type="submit" class="btn" value="Créer un compte" name="signin">
	  <p align="center"><?php if(isset($error)){echo $error;} ?></p>
	  <a href="login.php" style="color: black;">Se connecter</a>
	</div>
  </form>

  <footer>
      <div id="footer-haut">
            <div id="footer-haut-haut">
            <a id="logo-site-footer" href="index.html"><img src="images/logo.png"></a>
            </div>
            <div id="footer-haut-bas">
                <div id="partie-don">
                     <p>Soutenez-nous !      <a href="#">Donnez</a></p>
                </div>
                <div id="navigation-footer">
                    <nav>
                    <ul>
                        <li><a class="titre-menu" >Historique</a> 
                    <ul>
                    <li><a class="element-menu" href="historique.php">Dates clés</a></li>
                    <li><a class="element-menu" href="crypto.html">Qu’est ce que la crypto monnaie?</a></li>
                    </ul>
                    </li>
                <li><a class="titre-menu" >Comment ça marche ?</a>
                <ul>
                    <li><a  class="element-menu"href="platform.html">Plateforme d’échanges</a></li>
                    <li><a class="element-menu"href="legislation.html">Législation</a></li>
                </ul>
            </li>
            <li><a class="titre-menu">Actualités</a>
                <ul>
                    <li><a class="element-menu" href="cours.php">Cours des cryptos</a></li>
                    <li><a class="element-menu" href="#">Crypto-news</a></li>
                </ul>
            </li>
             <li><a class="titre-menu">Ressources</a>
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