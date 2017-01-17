	$(function () {
		
        $('#search-form').on('submit', function (e) {
			
			$("#submit-flight-request").prop('value', 'Loading...');
			$("#loading-overlay").css('display', 'block');
			$("#loading").css('display', 'block');
			
			var from_airport = $("#origin").val();
			var to_airport = $("#destination").val();
			var outward_date = $("#outward-date").val();
			var return_date = $("#return-date").val();
			var adults = $("#adult").val();
			var childs = $("#child").val();
			var seniors = $("#senior").val();
			var latitude_from = $("#origin").attr("data-latitude");
			var longitude_from = $("#origin").attr("data-longitude");
			var latitude_to = $("#destination").attr("data-latitude");
			var longitude_to = $("#destination").attr("data-longitude");

			var url = window.location.href + "/wp-content/themes/flightfindertheme/qpx_query.php";
			
			if (to_airport != '' && from_airport != '' && outward_date != '' && return_date != '' && adults != '' || seniors != '') {
				$.ajax({
					   type: "POST",
					   url: url,
					   data: $("#search-form").serialize(),
					   dataType: 'json',
					   cache: false,
					   beforeSend: function () {
						   $("#submit-flight-request").prop('value', 'Loading...');
						   $("#loading-overlay").css('display', 'block');
						   $("#loading").css('display', 'block');
					   },
					   success: function(data)
					   {
						   var outwardFlights = data['outward'];
						   var returnFlights = data['return'];
						 
						   createFlightInfo(outwardFlights,'outward');
						   createFlightInfo(returnFlights,'return');
						   
						   $("#loading-overlay").css('display', 'none');
						   $("#loading").css('display', 'none');
						   $('#result-box').css('display', 'block');
						   $('#filter-box').fadeIn( "slow" );							   
						   $("#submit-flight-request").prop('value', 'Search');   
						   setMarkers(latitude_from, longitude_from, latitude_to, longitude_to);
						   
						   /*localStorage.setItem("outward", JSON.stringify(outwardFlights));
						   localStorage.setItem("return", JSON.stringify(returnFlights));
						   var outwardFlights = JSON.parse(localStorage.getItem("outward"));
						   var returnFlights = JSON.parse(localStorage.getItem("return"));*/
					   }
				});
			}
			e.preventDefault(); // avoid to execute the actual submit of the form.
		});
	});
	
	function createFlightInfo(element,flight) {
		var last_price = '';
		var id = '';
		var activeClass = '';
		
		if(flight == 'outward') {
			id = '#outward';
		} else {
			id = '#return';
		}
		
		for(var i=0; i < element.length; i++) {			
			if(element[i].price != last_price) {
				var flightBlock = document.createElement("div");
				$( flightBlock ).addClass('flight-block');
				$( id ).append( flightBlock );
			
				var priceField = document.createElement("div");
				$( priceField ).addClass('price-field');
				$( priceField ).append(element[i].price + '€ Hin- & Rückflug');
				$( flightBlock ).append( priceField );
			}
			
			var airlineField = document.createElement("div");
				$( airlineField ).addClass('info-field');
				$( airlineField ).append('<a href="' + element[i].airline_link + '"><img src="' + element[i].airline_image + '" /><br>' + element[i].airline_name + ' (' + element[i].airline_iata + ')</a>');
				
				$( flightBlock ).append( airlineField );	
				$( flightBlock ).append( getField(element[i].origin,'') );
				$( flightBlock ).append( getField(element[i].destination,'') );
				$( flightBlock ).append( getField(element[i].departure,'dat') );
				$( flightBlock ).append( getField(element[i].arrival,'dat2') );
				$( flightBlock ).append( getField(element[i].duration,'dur') );
			
			last_price = element[i].price;
		}
	}
	
	function getField(element,type) {
		var field = document.createElement("div");
		$( field ).addClass('info-field');
		if(type == 'dat') {
			$( field ).append(element + ' Uhr');
			$( field ).addClass('departure');
		} else if(type == 'dat2') {
			$( field ).append(element + ' Uhr');
			$( field ).addClass('arrival');
		} else if(type == 'dur') {
			$( field ).append(element + ' min');
			$( field ).addClass('duration');
		} else {
			$( field ).append(element);
		}
		return field;
	}