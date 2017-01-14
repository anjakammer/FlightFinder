	<?php get_header(); ?>
	
	<div id="map"></div>
	
	<div id="search-box">
		<form id="search-form" name="search-form" action="" method="post" onsubmit="return validateForm()">
				<label>One-Way-Flight: </label>
				<input type="checkbox" name="one-way-flight" id="one-way-flight" />
				<div class="form-group">
					<input type="text" placeholder="Origin Airport" name="origin" id="origin" class="origin_input" />
					<div id="origin-results"></div>
					<span class="error origin">Please set an origin-airport.</span>
				
					<input type="text" placeholder="Destination Airport" name="destination" id="destination" class="dest_input" />
					<div id="destination-results"></div>
					<span class="error destination">Please set a destination-airport.</span>
				</div>

				<div class="form-group">
					<div class="date-input">
						<div class='input-group date' id='datetimepicker'>
							<input type="date" placeholder="Outward Date" name="outward-date" id="outward-date" class="form-control" />
							<span class="input-group-addon">
								<span class="glyphicon glyphicon-calendar"></span>
							</span>
							<span class="error outward-date">Please select an outward-date.</span>
						</div>
					</div>
					<div class="date-input">	
						<div class='input-group date' id='datetimepicker1'>
							<input type="date" placeholder="Return Date" name="return-date" id="return-date" class="form-control" />
							<span class="input-group-addon">
								<span class="glyphicon glyphicon-calendar"></span>
							</span>
							<span class="error return-date">Please select a return-date.</span>
						</div>
					</div>
				</div>
				
				<div class="form-group">
					<input type="number" placeholder="Number of Adults" name="adult" id="adult" min="0" max="10" />
					<input type="number" placeholder="Number of Childs" name="child" id="child" min="0" max="10" />
					<input type="number" placeholder="Number of Seniors" name="senior" id="senior" min="0" max="10" />
					<span class="error senior">Please set at minimum 1 adult passenger.</span>
				</div>
				
				<div class="form-group">
					<select id="booking-category" name="booking-category">
						<option selected="selected">COACH</option>
						<option>PREMIUM_COACH</option>
						<option>BUSINESS</option>
						<option>FIRST</option>
					</select>
				</div>

				<input id="submit-flight-request" type="submit" value="Search">
		</form>
	</div>
	
	<div id="filter-box">
		<div class="filters outward">
			<div class="price-filter">
				<p>
					<label for="amount">Outward-Price:</label>
					<input type="text" id="amount" class="filter-input" readonly>
				</p> 
				<div id="price-range" class="filter-slider"></div>
			</div>
			<div class="time-filter">
				<p>
					<label for="time">Departure-Time:</label>
					<input type="text" id="time" class="filter-input" readonly>
				</p> 
				<div id="time-range" class="filter-slider"></div>
			</div>
		</div>
		<div class="filters return">
			<div class="price-filter">
				<p>
					<label for="amount">Return-Price:</label>
					<input type="text" id="amount2" class="filter-input" readonly>
				</p> 
				<div id="price-range2" class="filter-slider"></div>
			</div>
			<div class="time-filter">
				<p>
					<label for="time">Departure-Time:</label>
					<input type="text" id="time2" class="filter-input" readonly>
				</p> 
				<div id="time-range2" class="filter-slider"></div>
			</div>
		</div>
	</div>
	
	<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAqXVnrgrwAEb5XqokfoNhGR9USsonp5iQ&callback=initMap"></script>	
	<script>
		var firstSearch = true;
		var markers = [];
		var flightpath ;
		var map;
		var iconBase = '<?php echo get_template_directory_uri(); ?>/img/';

		var to_airport = $('#destination');
		var from_airport = $('#origin');

		var to_lat = 0;
		var to_long = 0;

		var from_lat = 0;
		var from_long = 0;

		var to = to_airport.val();
		var from = from_airport.val();


		function initMap() {
			map = new google.maps.Map(document.getElementById('map'), {
				zoom: 4,
				center: {lat: 45.6906294, lng: 26.2947221},
				mapTypeControl: false,
				draggable: false,
				scaleControl: false,
				scrollwheel: false,
				navigationControl: false,
				streetViewControl: false,
				mapTypeId: google.maps.MapTypeId.SATELLITE,
				zoomControlOptions: {
					position: google.maps.ControlPosition.LEFT_BOTTOM
				}
			});
		}

		var reloadMarker = function() {

			var flightPlanCoordinates = [
				// To Airport
				{lat: to_lat, lng: to_long},
				// From Airport
				{lat: from_lat, lng: from_long}
			];

			var lineSymbol = {
				path: 'M 0,-1 0,1',
				strokeOpacity: 0.8,
				scale: 2,
				strokeColor: '#FFFFFF'
			};

			flightPath = new google.maps.Polyline({
				path: flightPlanCoordinates,
				strokeOpacity: 0,
				icons: [{
					icon: lineSymbol,
					offset: '0',
					repeat: '10px'
				}]
			});

			flightPath.setMap(map);

			// To Airport
			marker = new google.maps.Marker({
				map: map,
				draggable: false,
				animation: google.maps.Animation.DROP,
				position: {lat: to_lat, lng: to_long},
				icon: iconBase + 'map-pointer-to.png'
			});
			markers.push(marker);

			// From Airport
			marker = new google.maps.Marker({
				map: map,
				draggable: false,
				animation: google.maps.Animation.DROP,
				position: {lat: from_lat, lng: from_long},
				icon: iconBase + 'map-pointer-from.png'
			});

			markers.push(marker);

			function toggleBounce() {
				if (marker.getAnimation() !== null) {
					marker.setAnimation(null);
				} else {
					marker.setAnimation(google.maps.Animation.BOUNCE);
				}
			}
			firstSearch = false;
		};

		function removeFlight()
		{
			for (var i = 0; i < markers.length; i++) {
				markers[i].setMap(null);
			}
			flightPath.setMap(null);
		}
		
		function setMarkers(lat_from, long_from, lat_to, long_to) {
			to_lat = parseFloat(lat_to);
			to_long = parseFloat(long_to);
			from_lat = parseFloat(lat_from);
			from_long = parseFloat(long_from);
			if(!firstSearch){
				removeFlight();
			}
			reloadMarker();
		}
	</script>
	<script>
		$("#one-way-flight").attr('checked', $("#return-date")[0].disabled);
		$("#one-way-flight").click(function(){   
			$("#return-date").attr('disabled', this.checked)
		});
	</script>
		
	<div id="result-box">
		<div id="outward">
			<div class="outward-flights">OUTWARD-FLIGHTS</div>
			<div id="outward-head" class="">
				<div class="info-head"><strong>AIRLINE</strong></div>
				<div class="info-head"><strong>ORIGIN</strong></div>
				<div class="info-head"><strong>DESTINATION</strong></div>
				<div class="info-head"><strong>DEPARTURE</strong></div>
				<div class="info-head"><strong>ARRIVAL</strong></div>
				<div class="info-head"><strong>DURATION</strong></div>
			</div>
		</div>
		<div id="return">
			<div class="return-flights">RETURN-FLIGHTS</div>
			<div id="return-head" class="">
				<div class="info-head"><strong>AIRLINE</strong></div>
				<div class="info-head"><strong>ORIGIN</strong></div>
				<div class="info-head"><strong>DESTINATION</strong></div>
				<div class="info-head"><strong>DEPARTURE</strong></div>
				<div class="info-head"><strong>ARRIVAL</strong></div>
				<div class="info-head"><strong>DURATION</strong></div>
			</div>
		</div>
	</div>
	
	<script>
		/*$( document ).ready(function() {
			var outwardFlights = JSON.parse(localStorage.getItem("outward"));
			var returnFlights = JSON.parse(localStorage.getItem("return"));
							 
			createFlightInfo(outwardFlights,'outward');
			createFlightInfo(returnFlights,'return');
							  
			$('#result-box').css('display', 'block');
		});*/
	</script>

	<?php get_footer(); ?>


