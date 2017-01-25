	<?php get_header(); ?>
	
	<div id="map"></div>
	<div id="loading-overlay"></div>
	<img id="loading" src="<?php echo home_url() . '/wp-content/uploads/airlines/loading.gif'; ?>"/>
	<div id="search-box">
		<form id="search-form" name="search-form" action="" method="post">
				<label style="float:left;">One-Way-Flight </label>
				<input type="checkbox" name="one-way-flight" id="one-way-flight"/>
				
				<div class="form-group">
					<div class="input-group"><label>Origin </label><input type="text" placeholder="Origin Airport" name="origin" id="origin" class="origin_input input" /></div>
					<div id="origin-results"></div>
					
					<div class="input-group"><label>Destination </label><input type="text" placeholder="Destination Airport" name="destination" id="destination" class="dest_input input" /></div>
					<div id="destination-results"></div>
				</div>
				
				<div class="form-group">
					<div class="date-input">
						<div class='input-group date' id='datetimepicker'>
							<label>Outward-Date </label>
							<input type="date" placeholder="Outward Date" name="outward_date" id="outward_date" class="form-control input" />
							<span class="input-group-addon">
								<span class="glyphicon glyphicon-calendar"></span>
							</span>
						</div>
					</div>
					<div class="date-input">
						<div class='input-group date' id='datetimepicker1'>
							<label>Return-Date </label>
							<input type="date" placeholder="Return Date" name="return_date" id="return_date" class="form-control input" />
							<span class="input-group-addon">
								<span class="glyphicon glyphicon-calendar"></span>
							</span>
						</div>
					</div>
				</div>
				
				<div class="form-group">
					<div class="input-group"><label>Adults </label><input type="number" placeholder="Number of Adults" name="adult" id="adult" class="input" min="0" max="10" /></div>
					<div class="input-group"><label>Childs </label><input type="number" placeholder="Number of Childs" name="child" id="child" class="input" min="0" max="10" /></div>
					<div class="input-group"><label>Seniors </label><input type="number" placeholder="Number of Seniors" name="senior" id="senior" class="input" min="0" max="10" /></div>
				</div>
				
				<div class="form-group">
					<label>Booking-Class </label>
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
	
	<button id="show-results">Show Results</button>
	
	<div id="filter-box">
		<div class="filters outward">
			<div class="price-filter">
				<p>
					<label for="amount">Outward</label>
					<input type="text" id="amount" class="filter-input" readonly>
				</p> 
				<div id="price-range" class="filter-slider"></div>
			</div>
			<div class="time-filter">
				<p>
					<label for="time">Departure:</label>
					<input type="text" id="time" class="filter-input" readonly>
				</p> 
				<div id="time-range" class="filter-slider"></div>
			</div>
		</div>
		<div class="filters return">
			<div class="price-filter">
				<p>
					<label for="amount">Return</label>
					<input type="text" id="amount2" class="filter-input" readonly>
				</p> 
				<div id="price-range2" class="filter-slider"></div>
			</div>
			<div class="time-filter">
				<p>
					<label for="time">Departure:</label>
					<input type="text" id="time2" class="filter-input" readonly>
				</p> 
				<div id="time-range2" class="filter-slider"></div>
			</div>
		</div>
	</div>
		
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

	<?php get_footer(); ?>