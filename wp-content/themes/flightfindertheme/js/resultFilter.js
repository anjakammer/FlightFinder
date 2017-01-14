	//Time filtering
	function filterTime(minHours, minMinutes, maxHours, maxMinutes, flight) {
		if(flight == 'outward') {
			$("#outward .flight-block").hide().filter(function () {
				var datetime = $(this).find( ".departure" ).html();
				datetime = datetime.slice(12, datetime.length-4);
				var time = datetime.slice(0,3) + datetime.substr(datetime.length-2,datetime.length);
				time = parseInt(time, 10);
				var minTime = parseInt(minHours.toString() + minMinutes.toString(), 10);
				var maxTime = parseInt(maxHours.toString() + maxMinutes.toString(), 10);
				return time >= minTime && time <= maxTime;
			}).show();
		}
		if(flight == 'return') {
			$("#return .flight-block").hide().filter(function () {
				var datetime = $(this).find( ".departure" ).html();
				datetime = datetime.slice(12, datetime.length-4);
				var time = datetime.slice(0,3) + datetime.substr(datetime.length-2,datetime.length);
				time = parseInt(time, 10);
				var minTime = parseInt(minHours.toString() + minMinutes.toString(), 10);
				var maxTime = parseInt(maxHours.toString() + maxMinutes.toString(), 10);
				return time >= minTime && time <= maxTime;
			}).show();
		}
	}
	
	function filterPrice(minPrice, maxPrice, flight) {
		if(flight == 'outward') {
			$("#outward .flight-block").hide().filter(function () {
				var number = $(this).find( ".price-field" ).html();
				number = number.slice(0, number.length-21);
				var price = parseInt(number, 10);
				return price >= minPrice && price <= maxPrice;
			}).show();
		}
		if(flight == 'return') {
			$("#return .flight-block").hide().filter(function () {
				var number = $(this).find( ".price-field" ).html();
				number = number.slice(0, number.length-21);
				var price = parseInt(number, 10);
				return price >= minPrice && price <= maxPrice;
			}).show();
		}
	}