		function validateForm() {
			if($('#one-way-flight').prop('checked')) {
				if ($('#origin').val() == '') {
					$('#origin').css({"border-color": "#E10000", "border-width":"1px", "border-style":"solid"});
					$('.error.origin').css({"display": "block"});
					return false;
				}
				if ($('#outward-date').val() == '') {
					$('#outward-date').css({"border-color": "#E10000", "border-width":"1px", "border-style":"solid"});
					$('.error.outward-date').css({"display": "block"});
					return false;
				}
				if ($('#adult').val() == '' && $('#senior').val() == '' || $('#adult').val() == 0 && $('#senior').val() == 0) {
					$('#adult').css({"border-color": "#E10000", "border-width":"1px", "border-style":"solid"});
					$('.error.adult').css({"display": "block"});
					$('#senior').css({"border-color": "#E10000", "border-width":"1px", "border-style":"solid"});
					$('.error.senior').css({"display": "block"});
					return false;
				}
			} else {	
				if ($('#origin').val() == '') {
					$('#origin').css({"border-color": "#E10000", "border-width":"1px", "border-style":"solid"});
					$('.error.origin').css({"display": "block"});
					return false;
				}
				if ($('#destination').val() == '') {
					$('#destination').css({"border-color": "#E10000", "border-width":"1px", "border-style":"solid"});
					$('.error.destination').css({"display": "block"});
					return false;
				}
				if ($('#outward-date').val() == '') {
					$('#outward-date').css({"border-color": "#E10000", "border-width":"1px", "border-style":"solid"});
					$('.error.outward-date').css({"display": "block"});
					return false;
				}
				if ($('#return-date').val() == '') {
					$('#return-date').css({"border-color": "#E10000", "border-width":"1px", "border-style":"solid"});
					$('.error.return-date').css({"display": "block"});
					return false;
				}
				if ($('#adult').val() == '' && $('#senior').val() == '' || $('#adult').val() == 0 && $('#senior').val() == 0) {
					$('#adult').css({"border-color": "#E10000", "border-width":"1px", "border-style":"solid"});
					$('.error.adult').css({"display": "block"});
					$('#senior').css({"border-color": "#E10000", "border-width":"1px", "border-style":"solid"});
					$('.error.senior').css({"display": "block"});
					return false;
				}
			}
			return true;
		}