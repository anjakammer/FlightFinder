<?php
		
		require_once('../../../wp-config.php');
		global $wpdb;
		
		if (isset($_REQUEST['origin'])) {
			$origin_airport = $_REQUEST['origin'];
			$results = $wpdb->get_results("SELECT id,iata,city,full_name,latitude,longitude FROM airports WHERE full_name LIKE '$origin_airport%' OR city LIKE '$origin_airport%' OR iata LIKE '$origin_airport%' ORDER BY full_name ASC");
			foreach($results as $key => $row) {
				
				$origin_airport_iata = $row->iata;
				$origin_airport_name = $row->full_name;
				$origin_airport_city = $row->city;
				$origin_airport_latitude = $row->latitude;
				$origin_airport_longitude = $row->longitude;
				
?>
				<div class="ap_item" align="left" value="<?php echo $origin_airport_iata; ?>" data-latitude="<?php echo $origin_airport_latitude; ?>" data-longitude="<?php echo $origin_airport_longitude; ?>" data-city="<?php echo $origin_airport_city; ?>" data-name="<?php echo $origin_airport_name; ?>" data-iata="<?php echo $origin_airport_iata; ?>">
					<?php echo $origin_airport_city; ?> - <?php echo $origin_airport_name; ?><?php if($origin_airport_iata != ''){echo ' ('. $origin_airport_iata .')';} ?>
				</div>
<?php
			}
		}
		
		if (isset($_REQUEST['destination'])) {
			$dest_airport = $_REQUEST['destination'];
			$results = $wpdb->get_results("SELECT id,iata,city,full_name,latitude,longitude FROM airports WHERE full_name LIKE '$dest_airport%' OR city LIKE '$dest_airport%' OR iata LIKE '$dest_airport%' ORDER BY full_name ASC");
			foreach($results as $key => $row) {
				
				$dest_airport_iata = $row->iata;
				$dest_airport_name = $row->full_name;
				$dest_airport_city = $row->city;
				$dest_airport_latitude = $row->latitude;
				$dest_airport_longitude = $row->longitude;
						
?>
				<div class="ap_item" align="left" value="<?php echo $dest_airport_iata; ?>" data-latitude="<?php echo $dest_airport_latitude; ?>" data-longitude="<?php echo $dest_airport_longitude; ?>" data-city="<?php echo $dest_airport_city; ?>" data-name="<?php echo $dest_airport_name; ?>" data-iata="<?php echo $dest_airport_iata; ?>">
					<?php echo $dest_airport_city; ?> - <?php echo $dest_airport_name; ?> <?php if($dest_airport_iata != ''){echo ' ('. $dest_airport_iata .')';} ?>
				</div>
<?php
			}
		}
?>