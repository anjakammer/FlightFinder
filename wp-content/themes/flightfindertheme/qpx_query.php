<?php			
		include('db_connect.php');
		
		if(isset($_POST)){	
			function getInformation($slices) {
				$url = "https://www.googleapis.com/qpxExpress/v1/trips/search?key=AIzaSyAqXVnrgrwAEb5XqokfoNhGR9USsonp5iQ";

				$postData = '{
							"request": {
								"passengers": {
									"adultCount":'. $_POST['adult'] .',
									"childCount":'. $_POST['child'] .',
									"seniorCount":'. $_POST['senior'] .'
								},
								"slice": ' . json_encode($slices) . ',
								"solutions":' . 5 . ' 
							}
						}';

				$curlConnection = curl_init();
				curl_setopt($curlConnection, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
				curl_setopt($curlConnection, CURLOPT_URL, $url);
				curl_setopt($curlConnection, CURLOPT_CUSTOMREQUEST, "POST");
				curl_setopt($curlConnection, CURLOPT_POSTFIELDS, $postData);
				curl_setopt($curlConnection, CURLOPT_FOLLOWLOCATION, TRUE);
				curl_setopt($curlConnection, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($curlConnection, CURLOPT_SSL_VERIFYPEER, FALSE);
				$results = json_decode(curl_exec($curlConnection), true);
				if (isset($results['error'])) {
					var_dump($results);
					exit();
				}

				return $results;
			}
			
			if($_POST['origin'] != "" && $_POST['destination'] != "" && $_POST['outward-date'] != "" && $_POST['adult'] != 0 || $_POST['senior'] != 0) {
				$slices = array(
							array('origin' => $_POST['origin'], 
							      'destination' => $_POST['destination'], 
								  'date' => $_POST['outward-date'],
								  'preferredCabin' => $_POST['booking-category']
							), 						  
							array('origin' => $_POST['destination'], 
							      'destination' => $_POST['origin'], 
								  'date' => $_POST['return-date'],
								  'preferredCabin' => $_POST['booking-category']
							));

				$resultAsArray = getInformation($slices);
			}

			if($resultAsArray != null) {
				$trips = array_filter($resultAsArray['trips']['tripOption'], function($kind) {
						if (!isset($kind['kind'])) {
							return false;
						}
						if ($kind['kind'] == "qpxexpress#tripOption") {
							return true;
						}
						return false;
				});
				
				print '<table id="flight-results">';
				print '<tr><th>Outward-Flight: </th><th>Return-Flight: </th></tr>';
				foreach ($trips as $trip) {
					print '<tr><td class="flight-result-price">Offer: ' . $trip['saleTotal'] . '</td></tr>';
					print "<tr>";
					foreach ($trip['slice'] as $index => $slice) {
						print "<td>";
						if($index == 0) {
							print '<table class="outward-details">';
							print "<tr><td><strong>Flight: </strong></td><td><span><strong>FROM</strong> " . $slices[$index]['origin'] . " <strong>TO</strong> " . $slices[$index]['destination'] . "</span></td></tr>";
							foreach ($slice['segment'] as $segment) {
								$airline = $segment['flight']['carrier'];
								$sql_res = mysql_query("select airline_name,iata,image_path,booking_link from airlines where iata like '$airline%'");
								$row = mysql_fetch_array($sql_res);
								print '<tr><td><strong>Airline: </strong></td><td><a href="'. $row['booking_link'] .'" target="_blanket"><img src="http://localhost:8080/flight-finder'. $row['image_path'] . '"><br>'. $row['airline_name'] .' ('. $segment['flight']['carrier'] .')</a></td></tr>';
								foreach ($segment['leg'] as $leg) {
									$departure = new DateTime($leg['departureTime']);
									$departure = $departure->format('d.m.Y - H:i');
									$arrival = new DateTime($leg['arrivalTime']);
									$arrival = $arrival->format('d.m.Y - H:i');
									print "<tr><td><strong>Departure: </strong></td><td><span>" . $departure . " Uhr</span></td></tr>";
									print "<tr><td><strong>Arrival: </strong></td><td><span>" . $arrival . " Uhr</span></td></tr>";
									print "<tr><td><strong>Duration: </strong></td><td><span>" . $leg['duration'] . " min.</span></td></tr>";
									print "<tr><td><strong>Further Information:</strong></td><td></td></tr>";
								}
								print "<tr><td><strong>Cabin: </strong></td><td><span>" . $segment['cabin'] . "</span></td></tr>";
							}
							print "</table>";
						print "</td>";
						} else {
							print '<table class="return-details"><tr>';
							print "<tr><td><strong>Flight: </strong></td><td><span><strong>FROM</strong> " . $slices[$index]['origin'] . " <strong>TO</strong> " . $slices[$index]['destination'] . "</span></td></tr>";
							print "<tr><td></td><td></td></tr>";
							foreach ($slice['segment'] as $segment) {	
								$airline = $segment['flight']['carrier'];
								$sql_res = mysql_query("select airline_name,iata,image_path,booking_link from airlines where iata like '$airline%'");
								$row = mysql_fetch_array($sql_res);
								print '<tr><td><strong>Airline: </strong></td><td><a href="'. $row['booking_link'] .'" target="_blanket"><img src="http://localhost:8080/flight-finder' . $row['image_path'] . '"><br>'. $row['airline_name'] .' ('. $segment['flight']['carrier'] .')</a></td></tr>';
								foreach ($segment['leg'] as $leg) {
									$departure = new DateTime($leg['departureTime']);
									$departure = $departure->format('d.m.Y - H:i');
									$arrival = new DateTime($leg['arrivalTime']);
									$arrival = $arrival->format('d.m.Y - H:i');
									print "<tr><td><strong>Departure: </strong></td><td><span>" . $departure . " Uhr</span></td></tr>";
									print "<tr><td><strong>Arrival: </strong></td><td><span>" . $arrival . " Uhr</span></td></tr>";
									print "<tr><td><strong>Duration: </strong></td><td><span>" . $leg['duration'] . " min.</span></td></tr>";
									print "<tr><td><strong>Further Information:</strong></td><td></td></tr>";
								}
								print "<tr><td><strong>Cabin: </strong></td><td><span>" . $segment['cabin'] . "</span></td></tr>";
							}
							print "</table>";
						print "</td>";							
						}
					}
					echo "</tr>";
				}
				print '</table>';
			}
		}
		?>