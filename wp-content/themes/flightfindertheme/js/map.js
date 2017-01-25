		var firstSearch = true;
		var markers = [];
		var flightpath ;
		var map;
		var iconBase = window.location.href + '/wp-content/themes/flightfindertheme/img/';

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
		
		$("#one-way-flight").attr('checked', $("#return_date")[0].disabled);
		$("#one-way-flight").click(function(){   
			$("#return_date").attr('disabled', this.checked)
			if($('#one-way-flight').prop('checked')) {
				$( "#return_date" ).removeAttr('required')
			} else {
				$( "#return_date" ).prop('required',true)
			} 
		});
		