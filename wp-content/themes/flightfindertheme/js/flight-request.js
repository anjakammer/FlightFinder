	$(function () {
		
        $('#search-form').on('submit', function (e) {
			
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

			var url = "http://localhost:8080/flight-finder/wp-content/themes/flightfindertheme/qpx_query.php";
			
			if (to_airport != '' && from_airport != '' && outward_date != '' && return_date != '' && adults != '' || seniors != '') {
				$.ajax({
					   type: "POST",
					   url: url,
					   data: $("#search-form").serialize(),
					   beforeSend: function () {
						   $('#submit-flight-request').html('Loading Flights...');
					   },
					   success: function(data)
					   {
						   $('#submit-flight-request').html('Search Flights');
						   $('#result-box').css('display', 'block');
						   $('#result-box').html(data);
						   setMarkers(latitude_from, longitude_from, latitude_to, longitude_to);
					   }
				});
			}

			e.preventDefault(); // avoid to execute the actual submit of the form.
		});
	});