						//From Airport
						$(function(){
							$("#origin").keyup(function() { 
								var searchid = $(this).val();
								var dataString = 'origin='+ searchid;
								if(searchid!='') {
									$.ajax({
										type: "POST",
										url: "http://localhost:8080/flight-finder/wp-content/themes/flightfindertheme/db_query.php",
										data: dataString,
										cache: false,
										success: function(html) {
											$("#origin-results").fadeIn();
											$("#origin-results").html(html).show();
										}
									});
								}
								return false;    
							});

							$("#origin-results").on("click",function(e){ 
								var $clicked = $(e.target);
								var ap_city = $clicked.attr('data-city');
								var ap_iata = $clicked.attr('data-iata');
								var ap_latitude = $clicked.attr('data-latitude');
								var ap_longitude = $clicked.attr('data-longitude');
								//set text and attributes
								$('#origin').val(ap_iata);
								$('#origin').attr("value", ap_iata);
								$('#origin').attr("data-latitude", ap_latitude);
								$('#origin').attr("data-longitude", ap_longitude);
							});
							
							$(document).on("click", function(e) { 
								var $clicked = $(e.target);
								if (! $clicked.hasClass("origin_input")){
									jQuery("#origin-results").fadeOut(); 
								}
							});
						});
						
						//To Airport
						$(function(){
							$("#destination").keyup(function() { 
								var searchid = $(this).val();
								var dataString = 'destination='+ searchid;
								if(searchid!='') {
									$.ajax({
										type: "POST",
										url: "http://localhost:8080/flight-finder/wp-content/themes/flightfindertheme/db_query.php",
										data: dataString,
										cache: false,
										success: function(html) {
											$("#destination-results").fadeIn();
											$("#destination-results").html(html).show();
										}
									});
								}
								return false;    
							});

							$("#destination-results").on("click",function(e){ 
								var $clicked = $(e.target);
								var ap_city = $clicked.attr('data-city');
								var ap_iata = $clicked.attr('data-iata');
								var ap_latitude = $clicked.attr('data-latitude');
								var ap_longitude = $clicked.attr('data-longitude');
								//set text and attributes
								$('#destination').val(ap_iata);
								$('#destination').attr("value", ap_iata);
								$('#destination').attr("data-latitude", ap_latitude);
								$('#destination').attr("data-longitude", ap_longitude);
							});
							
							$(document).on("click", function(e) { 
								var $clicked = $(e.target);
								if (! $clicked.hasClass("dest_input")){
									jQuery("#destination-results").fadeOut(); 
								}
							});
						});