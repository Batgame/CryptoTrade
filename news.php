<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

try {
  $bdd = new PDO("mysql:host=localhost;dbname=m1106_Pong;charset=utf8", "username", "password");
  $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
}
catch (PDOException $e){
  echo $e->getMessage();
}


function getNews(){

    $requete = curl_init('https://cryptonews-api.com/api/v1?tickers=BTC,ETH,XRP&items=20&token={token}');

    $news = array();

    curl_setopt($requete, CURLOPT_RETURNTRANSFER, true);
    $data = curl_exec($requete);
    if ($data === false){
        var_dump(curl_error($requete));

    }else {

        $fp = fopen('news.json', 'w');
        fwrite($fp, $data);
        fclose($fp);
    }
    
}

#getNews();

$dataJson = file_get_contents("news.json");
$news = json_decode($dataJson, true);


?>
<!DOCTYPE html>
<html>
<head>
    <title>Articles de Presse</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/news.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" />
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
                <li><a href="news.php">Crypto-news</a></li>
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
    <div class="Co">
        <a id="connexion" href="login.php">Connexion</a>
        <a id ="demarre" href="debute.php">Démarrer</a>
    </div>
</div>
</header>

<h1>Crypto News !</h1>

<div class="news">
    <div class="container">

        <?php
        foreach($news['data'] as $article){

            echo '
                <div class="articles">
                    <div class="images"><img src="'.$article["image_url"].'" width="100%"></div>
                    <div class="content">
                        <span class="titre"><a href="'.$article["news_url"].'" target="_blank">'.$article["title"].'</a></span><br/><br />
                        <p class="resume">'.$article["text"].'</p><br/>
                        <div class="bottom">
            ';

            foreach ($article['tickers'] as $ticker){

                echo '<span class="tickers">'.$ticker.'</span>';
            }

            echo '
                            <span class="publisher">'.$article["source_name"].' | </span> 
                            <span class="date">'.$article["date"].' | </span>
                            <span class="sentiment">'.$article["sentiment"].'</span>
                        </div>
                    </div>
                </div>
            ';
        }
        ?>

    </div>
</div>

    <footer>
     <div id="footer-haut">
            <div id="footer-haut-haut">
            <a id="logo-site-footer" href="index.html"><img src="images/logo.png"></a>
            </div>
            <div id="footer-haut-bas">
                <div id="partie-don">
                     <p>Soutenez nous! <a href="#">Donnez</a></p>
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
                    <li><a class="element-menu" href="news.php">Crypto-news</a></li>
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