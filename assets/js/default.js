$(document).ready(function() {
	
	$('#generate_password').click(function(e) {
		e.preventDefault();
		$.get($(this).attr('href'), function(data) {
			$('#inputPassword3').val(data);	
		});	
	});

	$('#reg-form').validate({   
		invalidHandler:
		function() {
			$('.join-button').toggleClass('animated shake');
		}, 
		rules: {
			full_name: {
				minlength: 3,
				maxlength: 30,
				required: true
			},
			email_address: {
				minlength: 3,
				required: true,
				email: true
			},
			password: {
				required: true,
				maxlength: 18,
				minlength: 3
			}
		},
		highlight: function(element) {
			var id_attr = "#" + $( element ).attr("id") + "1";
			$(element).closest('.form-group').removeClass('has-success').addClass('has-error');
			$(id_attr).removeClass('glyphicon-ok').addClass('glyphicon-remove');         
			$(element).addClass('input-error');
		},
		unhighlight: function(element) {
			var id_attr = "#" + $( element ).attr("id") + "1";
			$(element).closest('.form-group').removeClass('has-error').addClass('has-success');
			$(id_attr).removeClass('glyphicon-remove').addClass('glyphicon-ok');         
			$(element).removeClass('input-error');
		},
		errorElement: 'span',
			errorClass: 'help-block',
			errorPlacement: function(error, element) {
				if(element.length) {
					// error.insertAfter(element);
				} else {
				// error.insertAfter(element);
				}
			} 
	 });



	$('#login-form').validate({   
		invalidHandler:
		function() {
			$('.login-button').toggleClass('animated shake');
		}, 
		rules: {
			username: {
				required: true,
				email: true,
				minlength: 3,
				maxlength: 40
			},
			login_password: {
				required: true,
				minlength: 3,
				maxlength: 18
			}
		},
		highlight: function(element) {
			var id_attr = "#" + $( element ).attr("id") + "1";
			$(element).closest('.form-group').removeClass('has-success').addClass('has-error');
			$(id_attr).removeClass('glyphicon-ok').addClass('glyphicon-remove');         
			$(element).addClass('input-error');
		},
		unhighlight: function(element) {
			var id_attr = "#" + $( element ).attr("id") + "1";
			$(element).closest('.form-group').removeClass('has-error').addClass('has-success');
			$(id_attr).removeClass('glyphicon-remove').addClass('glyphicon-ok');         
			$(element).removeClass('input-error');
		},
		errorElement: 'span',
			errorClass: 'help-block',
			errorPlacement: function(error, element) {
				if(element.length) {
					// error.insertAfter(element);
				} else {
				// error.insertAfter(element);
				}
			} 
	 });


	$('.remember-me').on('click', function() {
		$('#remember-me').toggleClass('check-selected');
	});

});