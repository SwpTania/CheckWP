(function($){
	
	'use strict';

	$( ".sc-addfree-msg" ).hide();

	$( "#delivery-datepicker" ).datepicker({
		minDate: "+0",
  		maxDate: "+1M +10D"
	}); 

	$( "#sc-delivery-check" ).change(function() {
		var $input = $( this );
		var $check = $input.prop( "checked" );
		if ($check) {
			$( ".sc-delivery-address #sc-delivery-address-id" ).val('');
			$( ".sc-delivery-address" ).hide();
		} else {
			$( ".sc-delivery-address" ).show();
		}
	});

	$( "#sc-addfree-check" ).change(function() {
		var $input = $( this );
		var $check = $input.prop( "checked" );
		if ($check) {
			$( ".sc-addfree-msg" ).show();
		} else {
			$( ".sc-addfree-msg #sc-addfree-id" ).val('');
			$( ".sc-addfree-msg" ).hide();
		}
	});
	
	$('#delivery_time').change(function() {
        $('body').trigger('update_checkout');
    });

	$(window).load(function() {	
	    $('#seese-cart-trigger-child').click(function(e) {
			e.preventDefault();
			document.getElementById("seese-aside").style.right = "0";
			document.body.style.overflowX = "hidden";
			document.getElementById("seese-closebtn").style.visibility = "visible";
			document.getElementById("seese-closebtn").style.opacity = "1";
		});
	});
	
})(jQuery);