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
								"slice": ' . json_encode($slices) . '
							}
						}';
				
				//"solutions":' . 5 . ' 

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
			
			if(isset($_POST['one-way-flight'])) {
				if($_POST['origin'] != "" && $_POST['outward-date'] != "" && $_POST['adult'] != 0 || $_POST['senior'] != 0) {
					$slices = array(
								array('origin' => $_POST['origin'], 
								  'destination' => $_POST['destination'], 
									  'date' => $_POST['outward-date'],
									  'preferredCabin' => $_POST['booking-category']
								));
				}
			} else {
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
				}
			}

			$resultAsArray = getInformation($slices);

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
				
				$curr_price = 'EUR0.00';
				$outward_flights = array();
				$flights1 = array();
				
				foreach ($trips as $trip) {				
					
					foreach ($trip['slice'] as $index => $slice) {
						
						//Outward
						if($index == 0) {
							
							foreach ($slice['segment'] as $segment) {
								
								if(!in_array($segment['flight']['number'] . $trip['saleTotal'], $outward_flights)) {
									
									//Push flight+price to array to save that it is already printed to the user
									array_push($outward_flights, $segment['flight']['number'] . $trip['saleTotal']);
									
									//Airline
									$airline = $segment['flight']['carrier'];
									$sql_res = mysql_query("select airline_name,iata,image_path,booking_link from airlines where iata like '$airline%'");
									$row = mysql_fetch_array($sql_res);
									
									foreach ($segment['leg'] as $leg) {
										
										//Departure & Arrival
										$departure = new DateTime($leg['departureTime']);
										$departure = $departure->format('d.m.Y - H:i');
										$arrival = new DateTime($leg['arrivalTime']);
										$arrival = $arrival->format('d.m.Y - H:i');
									}
									
									array_push($flights1, array(
											'price' => substr($trip['saleTotal'], 3),
											'flightnum' => $segment['flight']['number'],
											'airline_iata' => $segment['flight']['carrier'],
											'airline_name' => $row['airline_name'],
											'airline_link' => $row['booking_link'],
											'airline_image' => 'http://localhost:8080/flight-finder'. $row['image_path'],
											'origin' => $slices[$index]['origin'],
											'destination' => $slices[$index]['destination'],
											'departure' => $departure,
											'arrival' => $arrival,
											'duration' => $leg['duration'],
											'cabin' => $segment['cabin']));
									
									$price = array();
									$departure_time = array();									
									foreach ($flights1 as $key => $row) {
										$price[$key]  = $row['price'];
										$departure_time[$key] = $row['departure'];
									}

									// Sort the data
									array_multisort($price, SORT_ASC, $departure_time, SORT_ASC, $flights1);
								
								} else {
									//do nothing as the flight is already printed
								}
							}
						}
					}
				}							
				
				$curr_price2 = 'EUR0.00';
				$return_flights = array();
				$flights2 = array();
				
				foreach ($trips as $trip) {				
					
					foreach ($trip['slice'] as $index => $slice) {
						
						//Return
						if($index != 0) {
							
							foreach ($slice['segment'] as $segment) {
								
								if(!in_array($segment['flight']['number'] . $trip['saleTotal'], $return_flights)) {
									
									//Push flight+price to array to save that it is already printed to the user
									array_push($return_flights, $segment['flight']['number'] . $trip['saleTotal']);
									
									//Airline
									$airline = $segment['flight']['carrier'];
									$sql_res = mysql_query("select airline_name,iata,image_path,booking_link from airlines where iata like '$airline%'");
									$row = mysql_fetch_array($sql_res);
									
									foreach ($segment['leg'] as $leg) {
										
										//Departure & Arrival
										$departure = new DateTime($leg['departureTime']);
										$departure = $departure->format('d.m.Y - H:i');
										$arrival = new DateTime($leg['arrivalTime']);
										$arrival = $arrival->format('d.m.Y - H:i');
									}
									
									array_push($flights2, array(
											'price' => substr($trip['saleTotal'], 3),
											'flightnum' => $segment['flight']['number'],
											'airline_iata' => $segment['flight']['carrier'],
											'airline_name' => $row['airline_name'],
											'airline_link' => $row['booking_link'],
											'airline_image' => 'http://localhost:8080/flight-finder'. $row['image_path'],
											'origin' => $slices[$index]['origin'],
											'destination' => $slices[$index]['destination'],
											'departure' => $departure,
											'arrival' => $arrival,
											'duration' => $leg['duration'],
											'cabin' => $segment['cabin']));
											
									$price = array();
									$departure_time = array();
									foreach ($flights2 as $key => $row) {
										$price[$key]  = $row['price'];
										$departure_time[$key] = $row['departure'];
									}

									// Sort the data
									array_multisort($price, SORT_ASC, $departure_time, SORT_ASC, $flights2);
								
								} else {
									//do nothing as the flight is already printed
								}
							}
						}
					}
				}				
				
				$flights = array();
				$flights['outward'] = $flights1;
				$flights['return'] = $flights2;
				
				echo json_encode($flights);
			}
		}
		?>