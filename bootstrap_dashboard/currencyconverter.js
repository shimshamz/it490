function currencyconverter(currency, search_input) {
	var currSymbol = $(".symbol").toArray()[0].innerHTML;
	var money = $(".money").toArray();
	console.log(search_input);
	switch(currSymbol) {
		case '$':
			if (currency == 'gbp') {
				let response;
				let url = 'https://marketdata.websol.barchart.com/getQuote.json?apikey=aedef88fae1654cbca88ef03ee28b57e&symbols=^GBPUSD';
				$.getJSON(url, function(result){
			    	response = result.results[0].lastPrice;
			    	for (let i = 0; i < money.length; i++) {
						let currVal = money[i].innerHTML;
						newVal = currVal * response;
						newVal = Math.round(newVal * 100) / 100;
						money[i].innerHTML = newVal;
						$(".symbol").html('&#163;');
						$(".currCurrency").html('GBP (&#163;)');
					}
			  	});
			}
			else if (currency == 'eur') {
				let response;
				let url = 'https://marketdata.websol.barchart.com/getQuote.json?apikey=aedef88fae1654cbca88ef03ee28b57e&symbols=^EURUSD';
				$.getJSON(url, function(result){
			    	response = result.results[0].lastPrice;
			    	for (let i = 0; i < money.length; i++) {
						let currVal = money[i].innerHTML;
						newVal = currVal * response;
						newVal = Math.round(newVal * 100) / 100;
						money[i].innerHTML = newVal;
						$(".symbol").html('&#8364;');
						$(".currCurrency").html('EUR (&#8364;)');
					}
			  	});
			}
			break;

		case '£':
			if (currency == 'usd') {
				window.location.replace('searchresults.php?search=' + search_input);
			}
			else if (currency == 'eur') {
				let response;
				let url = 'https://marketdata.websol.barchart.com/getQuote.json?apikey=aedef88fae1654cbca88ef03ee28b57e&symbols=^EURGBP';
				$.getJSON(url, function(result){
			    	response = result.results[0].lastPrice;
			    	for (let i = 0; i < money.length; i++) {
						let currVal = money[i].innerHTML;
						newVal = currVal * response;
						newVal = Math.round(newVal * 100) / 100;
						money[i].innerHTML = newVal;
						$(".symbol").html('&#8364;');
						$(".currCurrency").html('EUR (&#8364;)');
					}
			  	});
			}
			break;

		case '€':
			if (currency == 'usd') {
				window.location.replace('searchresults.php?search=' + search_input);
			}
			else if (currency == 'gbp') {
				let response;
				let url = 'https://marketdata.websol.barchart.com/getQuote.json?apikey=aedef88fae1654cbca88ef03ee28b57e&symbols=^GBPEUR';
				$.getJSON(url, function(result){
			    	response = result.results[0].lastPrice;
			    	for (let i = 0; i < money.length; i++) {
						let currVal = money[i].innerHTML;
						newVal = currVal * response;
						newVal = Math.round(newVal * 100) / 100;
						money[i].innerHTML = newVal;
						$(".symbol").html('&#163;');
						$(".currCurrency").html('GBP (&#163;)');
					}
			  	});
			}
			break;
}
}

function currConverter(currency) {
	var currSymbol = $(".symbol").toArray()[0].innerHTML;
	var money = $(".money").toArray();
	switch(currSymbol) {
		case '$':
			if (currency == 'gbp') {
				let response;
				let url = 'https://marketdata.websol.barchart.com/getQuote.json?apikey=aedef88fae1654cbca88ef03ee28b57e&symbols=^GBPUSD';
				$.getJSON(url, function(result){
			    	response = result.results[0].lastPrice;
			    	for (let i = 0; i < money.length; i++) {
						let currVal = money[i].innerHTML;
						newVal = currVal * response;
						newVal = Math.round(newVal * 100) / 100;
						money[i].innerHTML = newVal;
						$(".symbol").html('&#163;');
						$(".currCurrency").html('GBP (&#163;)');
					}
			  	});
			}
			else if (currency == 'eur') {
				let response;
				let url = 'https://marketdata.websol.barchart.com/getQuote.json?apikey=aedef88fae1654cbca88ef03ee28b57e&symbols=^EURUSD';
				$.getJSON(url, function(result){
			    	response = result.results[0].lastPrice;
			    	for (let i = 0; i < money.length; i++) {
						let currVal = money[i].innerHTML;
						newVal = currVal * response;
						newVal = Math.round(newVal * 100) / 100;
						money[i].innerHTML = newVal;
						$(".symbol").html('&#8364;');
						$(".currCurrency").html('EUR (&#8364;)');
					}
			  	});
			}
			break;

		case '£':
			if (currency == 'usd') {
				window.location.replace('index.php');
			}
			else if (currency == 'eur') {
				let response;
				let url = 'https://marketdata.websol.barchart.com/getQuote.json?apikey=aedef88fae1654cbca88ef03ee28b57e&symbols=^EURGBP';
				$.getJSON(url, function(result){
			    	response = result.results[0].lastPrice;
			    	for (let i = 0; i < money.length; i++) {
						let currVal = money[i].innerHTML;
						newVal = currVal * response;
						newVal = Math.round(newVal * 100) / 100;
						money[i].innerHTML = newVal;
						$(".symbol").html('&#8364;');
						$(".currCurrency").html('EUR (&#8364;)');
					}
			  	});
			}
			break;

		case '€':
			if (currency == 'usd') {
				window.location.replace('index.php');
			}
			else if (currency == 'gbp') {
				let response;
				let url = 'https://marketdata.websol.barchart.com/getQuote.json?apikey=aedef88fae1654cbca88ef03ee28b57e&symbols=^GBPEUR';
				$.getJSON(url, function(result){
			    	response = result.results[0].lastPrice;
			    	for (let i = 0; i < money.length; i++) {
						let currVal = money[i].innerHTML;
						newVal = currVal * response;
						newVal = Math.round(newVal * 100) / 100;
						money[i].innerHTML = newVal;
						$(".symbol").html('&#163;');
						$(".currCurrency").html('GBP (&#163;)');
					}
			  	});
			}
			break;
}
}