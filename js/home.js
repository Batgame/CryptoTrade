window.onload = function() {
 
	var dataPointsBTC = [];
	 
	var chartBTC = new CanvasJS.Chart("chartContainerBTC", {
		animationEnabled: true,
		theme: "light1",
		zoomEnabled: true,
		title: {
			text: "" 
		},
		axisY: {
			title: "",
			titleFontSize: 24,
			prefix: "",
			gridThickness: 0,
	    	tickLength: 0,
	    	lineThickness: 0,
	    	labelFormatter: function(){
	      	return " ";
	      	}
		},
		axisX: {
	    	gridThickness: 0,
	    	tickLength: 0,
	    	lineThickness: 0,
	    	labelFormatter: function(){
	      	return " ";
		    }
		},
		data: [{
			type: "line",
			yValueFormatString: "$#,##0.00",
			lineColor: "#016197",
			dataPoints: dataPointsBTC
		}]
	});
	 
	function addData(data) {
		var dps = data;
		for (var i = 0; i < dps.length; i++) {
			dataPointsBTC.push({
				x: new Date(dps[i]['date']*1000),
				y: dps[i]['close']
			});
		}
		chartBTC.render();
	}

	function updateDataBTC(updatedData) {
		var dpsUpdated = updatedData;
		var dataPointsBTC = [];
		chartBTC.options.data[0].dataPoints = [];
		for (var i = 0; i < dpsUpdated.length; i++) {
			dataPointsBTC.push({
				x: new Date(dpsUpdated[i]['date']*1000),
				y: dpsUpdated[i]['close']
			});
		}
		chartBTC.options.data[0].dataPoints = dataPointsBTC;
		chartBTC.render();
	}

	$.getJSON("bc.php?currencyPair=USDC_BTC&start=-1year&end=now&period=86400", addData); 
	document.getElementById("BTC1y").style["color"] = "#016197";
	document.getElementById("BTC30d").style["color"] = "black";
	document.getElementById("BTC7d").style["color"] = "black";
	document.getElementById("BTC1d").style["color"] = "black";


	document.querySelector("#BTC1d").addEventListener("click", function() {
		
		$.getJSON("bc.php?currencyPair=USDC_BTC&start=-1day&end=now&period=300", updateDataBTC);
		document.getElementById("BTC1d").style["color"] = "#016197";
		document.getElementById("BTC30d").style["color"] = "black";
		document.getElementById("BTC7d").style["color"] = "black";
		document.getElementById("BTC1y").style["color"] = "black";
	})
	document.querySelector("#BTC7d").addEventListener("click", function() {
		
		$.getJSON("bc.php?currencyPair=USDC_BTC&start=-7days&end=now&period=7200", updateDataBTC);
		document.getElementById("BTC7d").style["color"] = "#016197";
		document.getElementById("BTC30d").style["color"] = "black";
		document.getElementById("BTC1d").style["color"] = "black";
		document.getElementById("BTC1y").style["color"] = "black";
	})
	document.querySelector("#BTC30d").addEventListener("click", function() {
		
		$.getJSON("bc.php?currencyPair=USDC_BTC&start=-30days&end=now&period=14400", updateDataBTC);
		document.getElementById("BTC30d").style["color"] = "#016197";
		document.getElementById("BTC1d").style["color"] = "black";
		document.getElementById("BTC7d").style["color"] = "black";
		document.getElementById("BTC1y").style["color"] = "black";
	})
	document.querySelector("#BTC1y").addEventListener("click", function() {
		
		$.getJSON("bc.php?currencyPair=USDC_BTC&start=-1year&end=now&period=86400", updateDataBTC);
		document.getElementById("BTC1y").style["color"] = "#016197";
		document.getElementById("BTC30d").style["color"] = "black";
		document.getElementById("BTC7d").style["color"] = "black";
		document.getElementById("BTC1d").style["color"] = "black";
	})

	

	/*------------------------------------------*/
	var dataPointsETH = [];
	 
	var chartETH = new CanvasJS.Chart("chartContainerETH", {
		animationEnabled: true,
		theme: "light1",
		zoomEnabled: true,
		title: {
			text: "" 
		},
		axisY: {
			title: "",
			titleFontSize: 24,
			prefix: "",
			gridThickness: 0,
	    	tickLength: 0,
	    	lineThickness: 0,
	    	labelFormatter: function(){
	      	return " ";
	      	}
		},
		axisX: {
	    	gridThickness: 0,
	    	tickLength: 0,
	    	lineThickness: 0,
	    	labelFormatter: function(){
	      	return " ";
		    }
		},
		data: [{
			type: "line",
			yValueFormatString: "$#,##0.00",
			lineColor: "#016197",
			dataPoints: dataPointsETH
		}]
	});
	 
	function addDataETH(data) {
		var dps = data;
		for (var i = 0; i < dps.length; i++) {
			dataPointsETH.push({
				x: new Date(dps[i]['date']*1000),
				y: dps[i]['close']
			});
		}
		chartETH.render();
	}

	function updateDataETH(updatedData) {
		var dpsUpdated = updatedData;
		var dataPointsETH = [];
		chartETH.options.data[0].dataPoints = [];
		for (var i = 0; i < dpsUpdated.length; i++) {
			dataPointsETH.push({
				x: new Date(dpsUpdated[i]['date']*1000),
				y: dpsUpdated[i]['close']
			});
		}
		chartETH.options.data[0].dataPoints = dataPointsETH;
		chartETH.render();
	}

	$.getJSON("bc.php?currencyPair=USDC_ETH&start=-1year&end=now&period=86400", addDataETH);
	document.getElementById("ETH1y").style["color"] = "#016197";
	document.getElementById("ETH1d").style["color"] = "black";
	document.getElementById("ETH7d").style["color"] = "black";
	document.getElementById("ETH30d").style["color"] = "black";

	document.querySelector("#ETH1d").addEventListener("click", function() {
		
		$.getJSON("bc.php?currencyPair=USDC_ETH&start=-1day&end=now&period=300", updateDataETH);
		document.getElementById("ETH1d").style["color"] = "#016197";
		document.getElementById("ETH7d").style["color"] = "black";
		document.getElementById("ETH30d").style["color"] = "black";
		document.getElementById("ETH1y").style["color"] = "black";
	})
	document.querySelector("#ETH7d").addEventListener("click", function() {
		
		$.getJSON("bc.php?currencyPair=USDC_ETH&start=-7days&end=now&period=7200", updateDataETH);
		document.getElementById("ETH7d").style["color"] = "#016197";
		document.getElementById("ETH1d").style["color"] = "black";
		document.getElementById("ETH30d").style["color"] = "black";
		document.getElementById("ETH1y").style["color"] = "black";
	})
	document.querySelector("#ETH30d").addEventListener("click", function() {
		
		$.getJSON("bc.php?currencyPair=USDC_ETH&start=-30days&end=now&period=14400", updateDataETH);
		document.getElementById("ETH30d").style["color"] = "#016197";
		document.getElementById("ETH1d").style["color"] = "black";
		document.getElementById("ETH7d").style["color"] = "black";
		document.getElementById("ETH1y").style["color"] = "black";
	})
	document.querySelector("#ETH1y").addEventListener("click", function() {
		
		$.getJSON("bc.php?currencyPair=USDC_ETH&start=-1year&end=now&period=86400", updateDataETH);
		document.getElementById("ETH1y").style["color"] = "#016197";
		document.getElementById("ETH1d").style["color"] = "black";
		document.getElementById("ETH7d").style["color"] = "black";
		document.getElementById("ETH30d").style["color"] = "black";
	})

	


	/*------------------------------------------*/

	var dataPointsXRP = [];
	 
	var chartXRP = new CanvasJS.Chart("chartContainerXRP", {
		animationEnabled: true,
		theme: "light1",
		zoomEnabled: true,
		title: {
			text: "" 
		},
		axisY: {
			title: "",
			titleFontSize: 24,
			prefix: "",
			gridThickness: 0,
	    	tickLength: 0,
	    	lineThickness: 0,
	    	labelFormatter: function(){
	      	return " ";
	      	}
		},
		axisX: {
	    	gridThickness: 0,
	    	tickLength: 0,
	    	lineThickness: 0,
	    	labelFormatter: function(){
	      	return " ";
		    }
		},
		data: [{
			type: "line",
			yValueFormatString: "$#,##0.00",
			lineColor: "#016197",
			dataPoints: dataPointsXRP
		}]
	});
	 
	function addDataXRP(data) {
		var dps = data;
		for (var i = 0; i < dps.length; i++) {
			dataPointsXRP.push({
				x: new Date(dps[i]['date']*1000),
				y: dps[i]['close']
			});
		}
		chartXRP.render();
	}

	function updateDataXRP(updatedData) {
		var dpsUpdated = updatedData;
		var dataPointsXRP = [];
		chartETH.options.data[0].dataPoints = [];
		for (var i = 0; i < dpsUpdated.length; i++) {
			dataPointsXRP.push({
				x: new Date(dpsUpdated[i]['date']*1000),
				y: dpsUpdated[i]['close']
			});
		}
		chartXRP.options.data[0].dataPoints = dataPointsXRP;
		chartXRP.render();
	}

	$.getJSON("bc.php?currencyPair=USDC_XRP&start=-1year&end=now&period=86400", addDataXRP);
	document.getElementById("XRP1y").style["color"] = "#016197";
	document.getElementById("XRP1d").style["color"] = "black";
	document.getElementById("XRP7d").style["color"] = "black";
	document.getElementById("XRP30d").style["color"] = "black"

	document.querySelector("#XRP1d").addEventListener("click", function() {
		
		$.getJSON("bc.php?currencyPair=USDC_XRP&start=-1day&end=now&period=300", updateDataXRP);
		document.getElementById("XRP1d").style["color"] = "#016197";
		document.getElementById("XRP7d").style["color"] = "black";
		document.getElementById("XRP30d").style["color"] = "black";
		document.getElementById("XRP1y").style["color"] = "black";
	})
	document.querySelector("#XRP7d").addEventListener("click", function() {
		
		$.getJSON("bc.php?currencyPair=USDC_XRP&start=-7days&end=now&period=7200", updateDataXRP);
		document.getElementById("XRP7d").style["color"] = "#016197";
		document.getElementById("XRP1d").style["color"] = "black";
		document.getElementById("XRP30d").style["color"] = "black";
		document.getElementById("XRP1y").style["color"] = "black";
	})
	document.querySelector("#XRP30d").addEventListener("click", function() {
		
		$.getJSON("bc.php?currencyPair=USDC_XRP&start=-30days&end=now&period=14400", updateDataXRP);
		document.getElementById("XRP30d").style["color"] = "#016197";
		document.getElementById("XRP1d").style["color"] = "black";
		document.getElementById("XRP7d").style["color"] = "black";
		document.getElementById("XRP1y").style["color"] = "black";
	})
	document.querySelector("#XRP1y").addEventListener("click", function() {
		
		$.getJSON("bc.php?currencyPair=USDC_XRP&start=-1year&end=now&period=86400", updateDataXRP);
		document.getElementById("XRP1y").style["color"] = "#016197";
		document.getElementById("XRP1d").style["color"] = "black";
		document.getElementById("XRP7d").style["color"] = "black";
		document.getElementById("XRP30d").style["color"] = "black";
	})
	/*
	    
	$.getJSON("https://api.blockchain.info/charts/market-price?timespan=1year&format=json", addData);


	*/

}
