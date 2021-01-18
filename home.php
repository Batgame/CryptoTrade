<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
if (!isset($_SESSION["user"])){
	header("Location: http://iutannecy-deptinfo.fr/m1106/Pong/login.php");
}


try {
  $bdd = new PDO("mysql:host=localhost;dbname=m1106_Pong;charset=utf8", "username", "password");
  $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
}
catch (PDOException $e){
  echo $e->getMessage();
}

$reqWallet = $bdd->prepare("SELECT * from membres WHERE pseudo = ?");
$reqWallet->execute(array($_SESSION['user']));
$infoUser = $reqWallet->fetch(PDO::FETCH_ASSOC);



function getCryptoPrice(){

	$requete = curl_init('https://api.nomics.com/v1/currencies/ticker?key={api_key}&ids=BTC,ETH,XRP&per-page=100&page=1');

	$market = array();

	curl_setopt($requete, CURLOPT_RETURNTRANSFER, true);
	$data = curl_exec($requete);
	if ($data === false){
		var_dump(curl_error($requete));

	}else {
		$data = json_decode($data, true);

		for ($i=0; $i<=2; $i++){

			$market[$i] = [
				'currency' => $data[$i]['currency'],
				'name' => $data[$i]['name'],
				'price' => $data[$i]['price'],
				'logo' => $data[$i]['logo_url'],
				'1d' => [
					'price_change' => $data[$i]['1d']['price_change'],
					'price_change_pct' => $data[$i]['1d']['price_change_pct']*100
				],
				'7d' => [
					'price_change' => $data[$i]['7d']['price_change'],
					'price_change_pct' => $data[$i]['7d']['price_change_pct']*100
				],
				'30d' => [
					'price_change' => $data[$i]['30d']['price_change'],
					'price_change_pct' => $data[$i]['30d']['price_change_pct']*100
				],
				'365d' => [
					'price_change' => $data[$i]['365d']['price_change'],
					'price_change_pct' => $data[$i]['365d']['price_change_pct']*100
				]
			];
		}

	}
	return $market;

}

$market = getCryptoPrice();


if (isset($_POST['buyBTC'])){

	if (!empty($_POST["amontBTC"])){

		$amontBTC = htmlspecialchars($_POST['amontBTC']);
		$amontUSD = htmlspecialchars($_POST['amontUSD']);

		$montantAchat = $amontBTC * $market[0]['price'];

		if ($montantAchat < $infoUser['USD']){

			$updateWallet = $bdd->prepare("UPDATE membres set BTC = BTC+?, USD = USD-? WHERE id = ?");
			$updateWallet->execute(array($amontBTC, round($montantAchat, 4), $_SESSION['id']));

			$erreur = "Achat réalisé de " .$amontBTC. "BTC = ". round($montantAchat, 2) . "$";
			header("Refresh:5");

		} else {

			$erreur = "Achat Impossible de " .$amontBTC. "BTC = ". round($montantAchat, 2) . "$ <br/> Fonds inssufisants";
		}
	}
}

elseif (isset($_POST['sellBTC'])){

	$amontBTC = htmlspecialchars($_POST['amontBTC']);
	$amontUSD = htmlspecialchars($_POST['amontUSD']);

	$montantVente = $amontBTC * $market[0]['price'];

	if ($amontBTC <= $infoUser['BTC']){

		$updateWallet = $bdd->prepare("UPDATE membres set BTC = BTC-?, USD = USD+? WHERE id = ?");
		$updateWallet->execute(array($amontBTC, round($montantVente, 4), $_SESSION['id']));

		$erreur = "Vente réalisée de " . $amontBTC . "BTC = " . round($montantVente, 2) . "$";
		header("Refresh:5");

	} else {

		$erreur = "Vente Impossible de " . $amontBTC . "BTC = " . round($montantVente, 2) . "$";
	}
}

if (isset($_POST['buyETH'])){

	if (!empty($_POST["amontETH"])){

		$amontETH = htmlspecialchars($_POST['amontETH']);
		$amontUSD = htmlspecialchars($_POST['amontUSD']);

		$montantAchat = $amontETH * $market[1]['price'];

		if ($montantAchat < $infoUser['USD']){

			$updateWallet = $bdd->prepare("UPDATE membres set ETH = ETH+?, USD = USD-? WHERE id = ?");
			$updateWallet->execute(array($amontETH, round($montantAchat, 3), $_SESSION['id']));

			$erreur = "Achat réalisé de " .$amontETH. "ETH = ". round($montantAchat, 2) . "$";
			header("Refresh:5");

		} else {

			$erreur = "Achat Impossible de " . round($montantAchat, 2) . "$";
		}
	}
}

elseif (isset($_POST['sellETH'])){

	$amontETH = htmlspecialchars($_POST['amontETH']);
	$amontUSD = htmlspecialchars($_POST['amontUSD']);

	$montantVente = $amontETH * $market[1]['price'];

	if ($amontETH <= $infoUser['ETH']){

		$updateWallet = $bdd->prepare("UPDATE membres set ETH = ETH-?, USD = USD+? WHERE id = ?");
		$updateWallet->execute(array($amontETH, round($montantVente, 3), $_SESSION['id']));

		$erreur = "Vente réalisée de " . $amontETH . "ETH = " . round($montantVente, 2) . "$";
		header("Refresh:5");
	
	} else {

		$erreur = "Vente Impossible de " . $amontETH . "ETH = " . round($montantVente, 2) . "$";
	}
}

if (isset($_POST['buyXRP'])){

	if (!empty($_POST["amontXRP"])){

		$amontXRP = htmlspecialchars($_POST['amontXRP']);
		$amontUSD = htmlspecialchars($_POST['amontUSD']);

		$montantAchat = $amontXRP * $market[2]['price'];

		if ($montantAchat < $infoUser['USD']){

			$updateWallet = $bdd->prepare("UPDATE membres set XRP = XRP+?, USD = USD-? WHERE id = ?");
			$updateWallet->execute(array($amontXRP, round($montantAchat, 2), $_SESSION['id']));

			$erreur = "Achat réalisé de " .$amontXRP. "XRP = ". round($montantAchat, 2) . "$";
			header("Refresh:5");

		} else {

			$erreur = "Achat Impossible de " . round($montantAchat, 2) . "$";
		}
	}
}

elseif (isset($_POST['sellXRP'])){

	$amontXRP = htmlspecialchars($_POST['amontXRP']);
	$amontUSD = htmlspecialchars($_POST['amontUSD']);

	$montantVente = $amontXRP * $market[2]['price'];

	if ($amontXRP <= $infoUser['XRP']){

		$updateWallet = $bdd->prepare("UPDATE membres set XRP = XRP-?, USD = USD+? WHERE id = ?");
		$updateWallet->execute(array($amontXRP, round($montantVente, 2), $_SESSION['id']));

		$erreur = "Vente Possible de " . $amontXRP . "XRP = " . round($montantVente, 2) . "$";
		header("Refresh:5");
	
	} else {

		$erreur = "Vente réalisée de " . $amontXRP . "XRP = " . round($montantVente, 2) . "$";
	}
}



?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <title>Home</title>
  <link rel="stylesheet" href="css/home.css">
  <script type="text/javascript" src="js/home.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="images/favicon.ico">
</head>
<body>
<header>
   <div id="petite_bande_bleue">
      <marquee scrollamount="10" width="100%">
         <p>Cryptotrade et ses concepteurs ont besoins de votre soutien !</p>
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
      <div class="Co">
         <p>Bienvenue <?php echo $infoUser['pseudo'];?></p>
      </div>
   </div>
</header>
	<div id="fondIntro"><h1>Simulation Trading</h1></div>
	<?php
	if (isset($erreur)){

		echo '
			<div class="erreur">
				<div class="alert">
					<span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span> 
				 	'.$erreur.'
				</div>
			</div>
		';
	}

	?>
	<div class="container">
	<?php

	foreach ($market as $crypto){

		echo '
		<div class="trade'.$crypto["currency"].'">
			<div class="top">
				<img src="'.$crypto["logo"].'" height="80%" width="20%" class="logo">
				<div class="cours">
					<span class="price">'.round($crypto["price"], 2).' $</span>
					<span class="variation" id="variation'.$crypto["currency"].'" style="color: #05b169">'.$crypto["1d"]["price_change_pct"].' %</span>
				</div>
				<div class="solde">
					<span class="labelSolde">Portfeuille</span><br />
					<span class="montantSolde" id="montant'.$crypto["currency"].'">'. round($infoUser[$crypto["currency"]], 3).' '. $crypto["currency"].'</span><br />
					<span class="montantSolde" id="montantDollars">'.$infoUser["USD"].' USD</span>
				</div>
			</div>
			<div class="courbe">
				<span id="'.$crypto["currency"].'1d">1 Day</span>
				<span id="'.$crypto["currency"].'7d">7 Days</span>
				<span id="'.$crypto["currency"].'30d">30 Days</span>
				<span id="'.$crypto["currency"].'1y">1 Years</span>
				<div id="chartContainer'.$crypto["currency"].'" style="height: 90%; width: 100%;"></div>
			</div>
			<div class="containerTrade">
				<div class="buy">
					<span>Acheter</span>
					<form method="POST" action="home.php">
						<div class="inputBuy">
							<input type="text" id="inputBuy'.$crypto["currency"].'" name="amontUSD" onkeyup="calculation'.$crypto["currency"].'0()">
							<label for="amontUSD">USD</label><br />
							<i class="fas fa-equals"></i><br />
							<input type="text" id=calculBuy'.$crypto["currency"].' name="amont'.$crypto["currency"].'" readonly>
							<label for="amont'.$crypto["currency"].'">'.$crypto["currency"].'</label><br />
							<input type="submit" name="buy'.$crypto["currency"].'" id="buyButton" value="Acheter">
						</div>
					</form>
				</div>
				<div class="sell">
					<span>Vendre</span>
					<form method="POST" action="home.php">
						<div class="inputSell">
							<input type="text" id=inputSell'.$crypto["currency"].' name="amont'.$crypto["currency"].'" onkeyup="calculation'.$crypto["currency"].'1()">
							<label for="amont'.$crypto["currency"].'">'.$crypto["currency"].'</label><br />
							<i class="fas fa-equals"></i><br />
							<input type="text" id="calculSell'.$crypto["currency"].'" name="amontUSD" readonly>
							<label for="amontUSD">USD</label><br />
							<input type="submit" name="sell'.$crypto["currency"].'" id="sellButton" value="Vendre">
						</div>
					</form>
				</div>
			</div>
		</div>
		';

	}

	?>
	</div>
	
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript">
	if (<?php echo $market[1]['1d']['price_change_pct']; ?> < 0) {

  		$("#variationETH").css("color","#df5f67");
    } 
    else {
    	$("#variationETH").css("color","#05b169");
    }

    if (<?php echo $market[0]['1d']['price_change_pct']; ?> < 0) {

  		$("#variationBTC").css("color","#df5f67");
    }
    else {
    	$("#variationBTC").css("color","#05b169");
    }
    if (<?php echo $market[2]['1d']['price_change_pct']; ?> < 0) {

  		$("#variationXRP").css("color","#df5f67");
    }
    else {
    	$("#variationXRP").css("color","#05b169");
    }

    function calculationBTC0(){

    	var price = document.getElementById("inputBuyBTC").value;
    	document.getElementById("calculBuyBTC").value = (price / <?php echo round($market[0]['price'], 2); ?>).toFixed(4);
    }
    function calculationBTC1(){

    	var price = document.getElementById("inputSellBTC").value;
    	document.getElementById("calculSellBTC").value = (price * <?php echo round($market[0]['price'], 2); ?>).toFixed(4);
    }
    function calculationETH0(){

    	var price = document.getElementById("inputBuyETH").value;
    	document.getElementById("calculBuyETH").value = (price / <?php echo round($market[1]['price'], 2); ?>).toFixed(3);
    }
    function calculationETH1(){

    	var price = document.getElementById("inputSellETH").value;
    	document.getElementById("calculSellETH").value = (price * <?php echo round($market[1]['price'], 2); ?>).toFixed(3);
    }
    function calculationXRP0(){

    	var price = document.getElementById("inputBuyXRP").value;
    	document.getElementById("calculBuyXRP").value = (price / <?php echo round($market[2]['price'], 2); ?>).toFixed(2);
    }
    function calculationXRP1(){

    	var price = document.getElementById("inputSellXRP").value;
    	document.getElementById("calculSellXRP").value = (price * <?php echo round($market[2]['price'], 2); ?>).toFixed(2);
    }
</script>

<script src="https://kit.fontawesome.com/da4c316d0b.js" crossorigin="anonymous"></script>

<script src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
<script src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>

	<div id="footer-haut">
	    <div id="footer-haut-haut">
	        <a id="logo-site-footer" href="index.html"><img src="images/logo.png"></a>
	    </div>
	    <div id="footer-haut-bas">
	        <div id="partie-don">
	            <p>Soutenez-vous !     <a href="#">Donnez</a></p>
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
