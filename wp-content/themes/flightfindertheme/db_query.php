<?php
		
		include('db_connect.php');
		
		if (isset($_REQUEST['origin'])) {
			$origin_airport = $_REQUEST['origin'];
			$sql_res = mysql_query("select id,iata,city,full_name,latitude,longitude from airports where full_name like '$origin_airport%' or city like '$origin_airport%' or iata like '$origin_airport%' order by full_name ASC");
			while($row=mysql_fetch_array($sql_res)) {
				$origin_airport_iata = $row['iata'];
				$origin_airport_name = $row['full_name'];
				$origin_airport_city = $row['city']; 
				$origin_airport_latitude = $row['latitude'];
				$origin_airport_longitude = $row['longitude']; 
				
?>
				<div class="ap_item" align="left" value="<?php echo $origin_airport_iata; ?>" data-latitude="<?php echo $origin_airport_latitude; ?>" data-longitude="<?php echo $origin_airport_longitude; ?>" data-city="<?php echo $origin_airport_city; ?>" data-name="<?php echo $origin_airport_name; ?>" data-iata="<?php echo $origin_airport_iata; ?>">
					<?php echo $origin_airport_city; ?> - <?php echo $origin_airport_name; ?><?php if($origin_airport_iata != ''){echo ' ('. $origin_airport_iata .')';} ?>
				</div>
<?php
			}
		}
		
		if (isset($_REQUEST['destination'])) {
			$dest_airport = $_REQUEST['destination'];
			$sql_res2 = mysql_query("select id,iata,city,full_name,latitude,longitude from airports where full_name like '$dest_airport%' or city like '$dest_airport%' or iata like '$dest_airport%' order by full_name ASC");
			while($row=mysql_fetch_array($sql_res2)) {
				$dest_airport_iata = $row['iata'];
				$dest_airport_name = $row['full_name'];
				$dest_airport_city = $row['city']; 
				$dest_airport_latitude = $row['latitude'];
				$dest_airport_longitude = $row['longitude']; 
						
?>
				<div class="ap_item" align="left" value="<?php echo $dest_airport_iata; ?>" data-latitude="<?php echo $dest_airport_latitude; ?>" data-longitude="<?php echo $dest_airport_longitude; ?>" data-city="<?php echo $dest_airport_city; ?>" data-name="<?php echo $dest_airport_name; ?>" data-iata="<?php echo $dest_airport_iata; ?>">
					<?php echo $dest_airport_city; ?> - <?php echo $dest_airport_name; ?> <?php if($dest_airport_iata != ''){echo ' ('. $dest_airport_iata .')';} ?>
				</div>
<?php
			}
		}
?>