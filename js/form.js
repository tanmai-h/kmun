function validateEmail(email) {
			var pattern = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;

			return pattern.test($.trim(email));

}
$('document').ready(function() {
	/////////////////////// login
	$('#submit-login').on('click', function(event) {
		
		event.preventDefault();
		
		var email = $('#email-login').val();
		var password = $('#password-login').val();
		
		console.log(validateEmail(email));
		if(validateEmail(email)) {
			if(password === '') {
				$('#error-login').html('Password can\'t be empty');
			}
			else {
				$('#submit-login').attr('value', 'Logging in');
				$.ajax({
					type: "POST", 
					url: "user/login/index.php",
					data: {email: $.trim(email), password: password},
					success : function(result) {

							if(result === "OK") {								
								window.location.href = 'user/index.php';
							}
							else {
							        $('#submit-login').attr('value', 'Login');
								$('#error-login').html(result);
							}								
					}
				});
			}
		}
		else {
			$('#error-login').html('Enter valid email');
		}
	});

	////////////////////register
	//student
	$('#submit-reg-stu').on('click', function(event) {
		
		event.preventDefault();
		
		var email      =  $('#email-reg-stu').val(),
			pass  =  $('#password-reg-stu').val(),
			fName      =  $('#fName-reg-stu').val(),
			lName      =  $('#lName-reg-stu').val(),
			school     =  $('#school-reg-stu').val();
			
		if(validateEmail(email)) {
			
			if(pass   === "" || 			fName  === "" ||  			lName  === "" ||  			school === "") {
				$('#error-reg-stu').html('All details required');
			}
			else {
				$('#submit-reg-stu').attr('value', 'Processing');
				$.ajax({
					type: "POST", 
					url: "user/register/student/index.php",
					data: {email: $.trim(email), school: school, pass: pass, firstName: fName, lastName: lName,captcha: grecaptcha.getResponse(widgetId1)},
					success : function(result) {
							$('#submit-reg-stu').attr('value', 'Get Started');
							grecaptcha.reset(widgetId1);
							$('#error-reg-stu').html(result);								
					}
				});
			}
			
		}
		else {
			$('#error-reg-stu').html('Type valid email!');
		}
			           
	});
	
	////school
	
	$('#submit-reg-grp').on('click', function(event) {
		
		event.preventDefault();
		
		var email      =  $('#email-reg-grp').val(),
			pass  =  $('#password-reg-grp').val(),
			fName      =  $('#fName-reg-grp').val(),
			lName      =  $('#lName-reg-grp').val(),
			school     =  $('#school-reg-grp').val();
			
		if(validateEmail(email)) {
			
			if(pass   === "" || 			fName  === "" ||  			lName  === "" ||  			school === "") {
				$('#error-reg-grp').html('All details required');
			}
			else {
				$('#submit-reg-grp').attr('value', 'Processing');
				$.ajax({
					type: "POST", 
					url: "user/register/school/index.php",
					data: {email: $.trim(email), school: school, pass: pass, firstName: fName, lastName: lName,captcha: grecaptcha.getResponse(widgetId2)},
					success : function(result) {
							$('#submit-reg-grp').attr('value', 'Get Started');
							grecaptcha.reset(widgetId2);
							$('#error-reg-grp').html(result);								
					}
				});
			}
			
		}
		else {
			$('#error-reg-grp').html('Type valid email!');
		}
			           
	});
});

