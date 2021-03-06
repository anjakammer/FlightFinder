$(function () {
	$('#datetimepicker').datetimepicker({
		format: 'YYYY-MM-DD', //'DD.MM.YYYY - HH:mm'
		showTodayButton: true,
		showClear: true
	});
	$('#datetimepicker1').datetimepicker({
		format: 'YYYY-MM-DD', //'DD.MM.YYYY - HH:mm'
		showTodayButton: true,
		showClear: true
	});
	
	//Outward-Flights
	$( "#price-range" ).slider({
		range: true,
		min: 0,
		max: 2000,
		values: [ 0, 2000 ],
		slide: function( event, ui ) {
			$( "#amount" ).val( ui.values[ 0 ] + "€" + " - " + ui.values[ 1 ] + '€');
			var mi = ui.values[0];
			var mx = ui.values[1];
			filterPrice(mi, mx, 'outward');
		}
	});
	$( "#amount" ).val( 0 + "€" + " - " + 2000 + '€');
			
	$("#time-range").slider({
		range: true,
		min: 0,
		max: 1440,
		step: 15,
		values: [ 0, 1440 ],
		slide: function( event, ui) {
			var hours1 = Math.floor(ui.values[0] / 60);
			var minutes1 = ui.values[0] - (hours1 * 60);
			var hours2 = Math.floor(ui.values[1] / 60);
			var minutes2 = ui.values[1] - (hours2 * 60);

			if(hours1.toString().length == 1) hours1 = '0' + hours1;
			if(minutes1.toString().length == 1) minutes1 = '0' + minutes1;
			if(hours2.toString().length == 1) hours2 = '0' + hours2;
			if(minutes2.toString().length == 1) minutes2 = '0' + minutes2;

			$( "#time" ).val(hours1+':'+minutes1 + ' - ' + hours2+':'+minutes2);

			filterTime(hours1,minutes1,hours2,minutes2,'outward');
		}
	});
	$( "#time" ).val('0' + 0+':'+ '0' + 0 + ' - ' + 24+':'+ '0' + 0);
			
	//Return-Flights
	$( "#price-range2" ).slider({
		range: true,
		min: 0,
		max: 2000,
		values: [ 0, 2000 ],
		slide: function( event, ui ) {
			$( "#amount2" ).val( ui.values[ 0 ] + "€" + " - " + ui.values[ 1 ] + '€');
			var mi = ui.values[0];
			var mx = ui.values[1];
			filterPrice(mi, mx, 'return');
		}
	});
	$( "#amount2" ).val( 0 + "€" + " - " + 2000 + '€');
			
	$("#time-range2").slider({
		range: true,
		min: 0,
		max: 1440,
		step: 15,
		values: [ 0, 1440 ],
		slide: function( event, ui) {
			var hours1 = Math.floor(ui.values[0] / 60);
			var minutes1 = ui.values[0] - (hours1 * 60);
			var hours2 = Math.floor(ui.values[1] / 60);
			var minutes2 = ui.values[1] - (hours2 * 60);

			if(hours1.toString().length == 1) hours1 = '0' + hours1;
			if(minutes1.toString().length == 1) minutes1 = '0' + minutes1;
			if(hours2.toString().length == 1) hours2 = '0' + hours2;
			if(minutes2.toString().length == 1) minutes2 = '0' + minutes2;

			$( "#time2" ).val(hours1+':'+minutes1 + ' - ' + hours2+':'+minutes2);

			filterTime(hours1,minutes1,hours2,minutes2,'return');
		}
	});
	$( "#time2" ).val('0' + 0+':'+ '0' + 0 + ' - ' + 24+':'+ '0' + 0);
});