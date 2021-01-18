<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Cours Cryptos</title>
        <script type="text/javascript" src="js/cours.js"></script>
        <link rel="stylesheet" type="text/css" href="css/cours.css">
        <link rel="icon" href="images/favicon.ico">
    </head>
    <body>
        <header>
            <div id="petite_bande_bleue">
                <marquee scrollamount="10" behavoir="scroll">
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
                            <a>Comment ça marche ?</a>
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
                            <a href="">Ressources</a>
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
        <div id="fondIntro">
            <h1>Cours des crypto monnaies</h1>
        </div>
        <div class="container">
            <div class="courbeBTC">
                <div class="block">	
                    <span id="BTC1d">1 Day</span>
                    <span id="BTC7d">7 Days</span>
                    <span id="BTC30d">30 Days</span>
                    <span id="BTC1y">1 Years</span>
                </div>
                <div id="chartContainerBTC" style="height: 80%; width: 90%;"></div>
            </div>
            <div id="separation"></div>
            <div class="courbeETH">
                <span id="ETH1d">1 Day</span>
                <span id="ETH7d">7 Days</span>
                <span id="ETH30d">30 Days</span>
                <span id="ETH1y">1 Years</span>
                <div id="chartContainerETH" style="height: 80%; width: 90%;"></div>
            </div>
            <div id="separation"></div>
            <div class="courbeXRP">
                <span id="XRP1d">1 Day</span>
                <span id="XRP7d">7 Days</span>
                <span id="XRP30d">30 Days</span>
                <span id="XRP1y">1 Years</span>
                <div id="chartContainerXRP" style="height: 80%; width: 90%;"></div>
            </div>
        </div>
        <footer>
            <div id="footer-haut">
                <div id="footer-haut-haut">
                    <a id="logo-site-footer" href="index.html"><img src="images/logo.png"></a>
                </div>
                <div id="footer-haut-bas">
                    <div id="partie-don">
                        <p>Soutenez-nous ! <a href="#">Donnez</a></p>
                    </div>
                    <div id="navigation-footer">
                        <nav>
                            <ul>
                                <li>
                                    <a class="titre-menu">Historique</a> 
                                    <ul>
                                        <li><a class="element-menu" href="historique.php">Dates clés</a></li>
                                        <li><a class="element-menu" href="crypto.html">Qu’est ce que la crypto monnaie?</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a class="titre-menu">Comment ça marche ?</a>
                                    <ul>
                                        <li><a  class="element-menu"href="platform.html">Plateforme d’échanges</a></li>
                                        <li><a class="element-menu"href="legislation.html">Législation</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a class="titre-menu" >Actualités</a>
                                    <ul>
                                        <li><a class="element-menu" href="cours.php">Cours des cryptos</a></li>
                                        <li><a class="element-menu" href="news.php">Crypto-news</a></li>
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
        <script src="https://kit.fontawesome.com/da4c316d0b.js" crossorigin="anonymous"></script>
        <script src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
        <script src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>
    </body>
</html>