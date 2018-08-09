<?php
	session_start();
	require_once(__DIR__ . "/../../req/utility.php");
	
	if(!isset($_SESSION['email']) || empty($_SESSION['email'])) {
		redirect('../../index.php');
	}
?>
<!DOCTYPE html>
<html>
    <head>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <style>
		select {
			padding: 5px;
			width: 150px;
		}
	</style>
	<script>
		$('document').ready(function() {
			var C;
			$('#committees1').on('change', function() {
				var committee = this.value;
				$.ajax({
					type: "POST",
					url: 'prefScript.php',
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
				$.ajax({
					type: "POST",
					url: 'prefScript.php',
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
				$.ajax({
					type: "POST",
					url: 'prefScript.php',
					data:{committee: committee},
					success: function(result){
						$("#p3c1").html(result);
						$("#p3c2").html(result);
						$("#p3c3").html(result);
					}
				});
			});
			
			$('#submit-btn').on('click', function() {
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
				$.ajax( {
					type: "POST",
					url: 'addPref.php',
					data: {committees1: committees1, committees2: committees2, committees3: committees3, p1c1: p1c1, p1c2: p1c2, p1c3: p1c3, p2c1: p2c1, p2c2: p2c2, p2c3: p2c3, p3c1: p3c1, p3c2: p3c2, p3c3: p3c3},
					success: function(result) {
						$('#msg').html(result);
					}
				});
			});
		});
	</script>
</head>
<body>
	<a href = "../../index.php">Back to Profile</a>
	<div id="preferences">
		<div id = "pref1">
			<label class="page1">Committee</label><br /><br />
			<select id="committees1" name="committees" placeholder="Committee">
				<option value = "" ->Choose Committee</option>
				<option value = "Secretariat">Secretariat</option>
				<option value = "SOCHUM">SOCHUM</option>
				<option value = "Atomic">Atomic</option>
				<option value = "Legal">Legal</option>
				<option value = "Health">Health</option>
				<option value = "UNODC">UNODC</option>
				<option value = "SC">SC</option>
				<option value = "Planning">Planning</option>
				<option value = "WEF">WEF</option>
				<option value = "AD-Hoc">AD-Hoc</option>
				<option value = "JCC (both)">JCC (both)</option>
				<option value = "Illuminati">Illuminati</option>
				<option>Russia</option>
			</select><br /><br />
			<label class="page1">Countries</label><br /><br />
			<select id="p1c1" class = "country" name="country1" placeholder="country"></select><br /><br />
			<select id="p1c2" class = "country"name="country2" placeholder="country"></select><br /><br />
			<select id="p1c3" class = "country"name="country3" placeholder="country"></select><br /><br />
		</div>
		
		<div id = "pref2">
			<label class="page1">Committee</label><br /><br />
			<select id="committees2" name="committees" placeholder="Committee">
				<option value = "" ->Choose Committee</option>
				<option value = "Secretariat">Secretariat</option>
				<option value = "SOCHUM">SOCHUM</option>
				<option value = "Atomic">Atomic</option>
				<option value = "Legal">Legal</option>
				<option value = "Health">Health</option>
				<option value = "UNODC">UNODC</option>
				<option value = "SC">SC</option>
				<option value = "Planning">Planning</option>
				<option value = "WEF">WEF</option>
				<option value = "AD-Hoc">AD-Hoc</option>
				<option value = "JCC (both)">JCC (both)</option>
				<option value = "Illuminati">Illuminati</option>
				<option>Russia</option>
			</select><br /><br />
			<label class="page1">Countries</label><br /><br />
			<select id="p2c1" class = "country" name="country1" placeholder="country"></select><br /><br />
			<select id="p2c2" class = "country" name="country2" placeholder="country"></select><br /><br />
			<select id="p2c3" class = "country" name="country3" placeholder="country"></select><br /><br />
		</div>
		
		<div id = "pref3">
			<label class="page1">Committee</label><br /><br />
			<select id="committees3" name="committees" placeholder="Committee">
				<option value = "" ->Choose Committee</option>
				<option value = "Secretariat">Secretariat</option>
				<option value = "SOCHUM">SOCHUM</option>
				<option value = "Atomic">Atomic</option>
				<option value = "Legal">Legal</option>
				<option value = "Health">Health</option>
				<option value = "UNODC">UNODC</option>
				<option value = "SC">SC</option>
				<option value = "Planning">Planning</option>
				<option value = "WEF">WEF</option>
				<option value = "AD-Hoc">AD-Hoc</option>
				<option value = "JCC (both)">JCC (both)</option>
				<option value = "Illuminati">Illuminati</option>
				<option>Russia</option>
			</select><br /><br />
			<label class="page1">Countries</label><br /><br />
			<select id="p3c1" class = "country" name="country1" placeholder="country"></select><br /><br />
			<select id="p3c2" class = "country" name="country2" placeholder="country"></select><br /><br />
			<select id="p3c3" class = "country" name="country3" placeholder="country"></select><br /><br />
		</div>
		
		<input type = "submit" id = "submit-btn" /><span id = "msg"></span>
	</div>
</body>
</html>