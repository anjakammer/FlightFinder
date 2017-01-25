	$(function () {
		
		$("#adult").val("1");
		$("#child").val("0");
		$("#senior").val("0");
		form_validation();
		
        $('#search-form').on('submit', function (e) {
			
			var latitude_from = $("#origin").attr("data-latitude");
			var longitude_from = $("#origin").attr("data-longitude");
			var latitude_to = $("#destination").attr("data-latitude");
			var longitude_to = $("#destination").attr("data-longitude");
			
			if($("#adult").val() == "0" && $("#senior").val() == "0") {
				
				alert("You have to select at minimum 1 adult passenger (adult/senior)!")
			
			} else {				
			
				$("#submit-flight-request").prop('value', 'Loading...');
				$("#loading-overlay").css('display', 'block');
				$("#loading").css('display', 'block');
				
				var url = window.location.href + "/wp-content/themes/flightfindertheme/qpx_query.php";
			
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
						   $("#show-results").css('display', 'block');
						   $('#result-box').css('display', 'block');
						   $('#filter-box').fadeIn( "slow" );							   
						   $("#submit-flight-request").prop('value', 'Search');   
						   setMarkers(latitude_from, longitude_from, latitude_to, longitude_to);
					   }
				});
			}
			e.preventDefault(); // avoid to execute the actual submit of the form.
		});
		
		
		$('#show-results').on("click", function() {
			$('html, body').animate({
				scrollTop: $("#result-box").offset().top
			}, 1000);
		});
	});
	
	function createFlightInfo(element,flight) {
		var last_price = '';
		var id = '';
		
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
				$( priceField ).append(element[i].price + '€ Outward- & Returnflight');
				$( flightBlock ).append( priceField );
			}
			
			var singleFlight = document.createElement("div");
				$( singleFlight ).addClass('single-flight');
			var airlineField = document.createElement("div");
				$( airlineField ).addClass('info-field');
				$( airlineField ).append('<a href="' + element[i].airline_link + '"><img src="' + element[i].airline_image + '" /><br>' + element[i].airline_name + ' (' + element[i].airline_iata + ')</a>');
				
				$( flightBlock ).append( singleFlight );	
				$( singleFlight ).append( airlineField );
				$( singleFlight ).append( getField(element[i].origin,'') );
				$( singleFlight ).append( getField(element[i].destination,'') );
				$( singleFlight ).append( getField(element[i].departure,'dat') );
				$( singleFlight ).append( getField(element[i].arrival,'dat2') );
				$( singleFlight ).append( getField(element[i].duration,'dur') );
			
			last_price = element[i].price;
		}
	}
	
	function getField(element,type) {
		var field = document.createElement("div");
		$( field ).addClass('info-field');
		if(type == 'dat') {
			$( field ).append(element);
			$( field ).addClass('departure');
		} else if(type == 'dat2') {
			$( field ).append(element);
			$( field ).addClass('arrival');
		} else if(type == 'dur') {
			$( field ).append(element + " min.");
			$( field ).addClass('duration');
		} else {
			$( field ).append(element);
		}
		return field;
	}
	
	function form_validation() {
		$( "#origin" ).prop('required',true);
		$( "#destination" ).prop('required',true);
		$( "#outward_date" ).prop('required',true);
		$( "#return_date" ).prop('required',true);
		$( "#adult" ).prop('required',true);
		$( "#child" ).prop('required',true);
		$( "#senior" ).prop('required',true);		
	}