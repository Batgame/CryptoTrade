<?php

#echo file_get_contents("https://api.blockchain.info/charts/market-price?timespan=".$_GET["timespan"]."&format=json");
echo file_get_contents("https://poloniex.com/public?command=returnChartData&currencyPair=".$_GET['currencyPair']."&start=". strtotime($_GET['start'])."&end=". strtotime($_GET['end'])."&period=".$_GET['period']."");

?>