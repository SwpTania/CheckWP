jQuery(document).ready(function($) {

$("#forgotModal").click(function() {
  var button = $(this);  
  //alert(button);
  //console.log(button.closest(".modal"));
  var id = button.val();
  button.closest(".modal").modal('hide');
  $('#modalForgotForm').modal('show');
  e.preventDefault();
});

// Show the login dialog box on click
$('a#show_login').on('click', function(e){
	$('body').prepend('<div class="login_overlay"></div>');
	$('form#login').fadeIn(500);
	$('div.login_overlay, form#login a.close').on('click', function(){
	$('div.login_overlay').remove();
	$('form#login').hide();
	});
	e.preventDefault();
});

// Perform AJAX login on form submit
$('form#login').on('submit', function(e){
	if (!$(this).valid()) return false;
	$('form#login .modal-body p.status').show().text(ajax_login_object.loadingmessage);
	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: ajax_login_object.ajaxurl,
		data: {
		'action': 'ajaxlogin', //calls wp_ajax_nopriv_ajaxlogin
		'username': $('form#login #username').val(),
		'password': $('form#login #password').val(),
		'security': $('form#login #security').val() },
		success: function(data){
		$('form#login p.status').text(data.message);
		if (data.loggedin == true){
		document.location.href = ajax_login_object.redirecturl;
		}
		}
	});
	e.preventDefault();
});


// Perform AJAX forget password on form submit
	$('form#forgot_password').on('submit', function(e){
		if (!$(this).valid()) return false;
		$('form#forgot_password .modal-body p.status').show().text(ajax_login_object.loadingmessage);
		ctrl = $(this);
		$.ajax({
			type: 'POST',
            dataType: 'json',
            url: ajax_login_object.ajaxurl,
			data: { 
				'action': 'ajaxforgotpassword', 
				'user_login': $('#user_login').val(), 
				'security': $('#forgotsecurity').val(), 
			},
			success: function(data){					
				$('p.status',ctrl).text(data.message);				
			}
		});
		e.preventDefault();
		return false;
	});



	
	/*$( '#resetpasswordform' ).on('submit', function(e) {
		e.preventDefault();
 
		var $form = $(this);
 
		$.post($form.attr('action'), $form.serialize(), function(data) {
			alert('This is data returned from the server ' + data);
		}, 'json');
	});*/
 
});