$('document').ready(function() {
	
	//Adding details
	$('#submit-details').on('click', function(event) {
		event.preventDefault();
		var numMuns = $('#numMuns').val(),
			phone = $('#phone').val();
			numAwards = $('#numAwards').val(),
			info = $('#info').val();
			
		if(!$.isNumeric(phone) || phone.length != 10) {
					$('#error-details').html('10 digit phone number !');
			}
			else {
				$('#error-details').html('');
				$('#submit-details').attr('value', 'processing');
				if( $.isNumeric(numMuns) && $.isNumeric(numAwards) && numAwards >= 0 && numMuns >= 0) {
					$.ajax({
						type:  "POST",
						url : "../change/addDet.php",
						data:{phone: phone, numAwards: numAwards, numMuns: numMuns, info: info},
						success: function(result){
							$('#submit-details').attr('value', 'Add');
							$('#error-details').html(result);
							
							if(result === 'Details Added!') {
								$('#numMuns').attr('value', '');
								$('#numAwards').attr('value', '');
								$('#phone').attr('value', '');
								$('#info').attr('value', '');
								$('#numMuns').html('');
							}
						}
					});
					}
				else {
					$('#error-details').html('Can\'t be negative numbers!');
				}
			}
	});
	
	
	//Committee Pref
	
			var C;
			processing = '<option value = "" >Processing</option>';
			$('#committees1').on('change', function() {
				var committee = this.value;
				
				$("#p1c1").html(processing);
				$("#p1c2").html(processing);
				$("#p1c3").html(processing);
				
				$.ajax({
					type: "POST",
					url: '../preference/prefScript.php',
					data:{committee: committee},
					success: function(result){
						$("#p1c1").html(result);
						$("#p1c2").html(result);
						$("#p1c3").html(result);
					}
				});
			});
			
			$('#committees2').on('change', function() {
				var committee = this.value;
				$("#p2c1").html(processing);
				$("#p2c2").html(processing);
				$("#p2c3").html(processing);
				
				$.ajax({
					type: "POST",
					url: '../preference/prefScript.php',
					data:{committee: committee},
					success: function(result){
						$("#p2c1").html(result);
						$("#p2c2").html(result);
						$("#p2c3").html(result);
					}
				});
			});
			
			$('#committees3').on('change', function() {
				var committee = this.value;
				$("#p3c1").html(processing);
				$("#p3c2").html(processing);
				$("#p3c3").html(processing);
				
				$.ajax({
					type: "POST",
					url: '../preference/prefScript.php',
					data:{committee: committee},
					success: function(result){
						$("#p3c1").html(result);
						$("#p3c2").html(result);
						$("#p3c3").html(result);
					}
				});
			});
			
			$('#submit-pref').on('click', function(event) {
				event.preventDefault();
				
				var committees1 = $('#committees1').val(),
				committees2 = $('#committees2').val(),
				committees3 = $('#committees3').val(),
				p1c1 = $('#p1c1').val(),
				p1c2 = $('#p1c2').val(),
				p1c3 = $('#p1c3').val(),
				p2c1 = $('#p2c1').val(),
				p2c2 = $('#p2c2').val(),
				p2c3 = $('#p2c3').val(),
				p3c1 = $('#p3c1').val(),
				p3c2 = $('#p3c2').val(),
				p3c3 = $('#p3c3').val();
				
				$('#submit-pref').attr('value', 'processing');
				$.ajax( {
					type: "POST",
					url: '../preference/addPref.php',
					data: {committees1: committees1, committees2: committees2, committees3: committees3, p1c1: p1c1, p1c2: p1c2, p1c3: p1c3, p2c1: p2c1, p2c2: p2c2, p2c3: p2c3, p3c1: p3c1, p3c2: p3c2, p3c3: p3c3},
					success: function(result) {
						$('#error-pref').html(result);
						$('#submit-pref').attr('value', 'Add');
					}
				});
			});

});