	<?php get_header(); ?>
	
	<div id="map"></div>
	<div id="loading-overlay"></div>
	<img id="loading" src="<?php echo home_url() . '/wp-content/uploads/airlines/loading.gif'; ?>"/>
	<div id="search-box">
		<form id="search-form" name="search-form" action="" method="post" onsubmit="return validateForm()">
				<label>One-Way-Flight </label>
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