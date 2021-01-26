// custom script started from here  

jQuery(document).ready(function($) {
    
    
    
    $(".coaches-wrap .expertWrap .box").each(function(index) {
		var imageUrl = $(this).find('.before-img img').attr('src');
        $(this).find('.before-img').css("background-image", "url("+imageUrl+")");
        $(this).find('.before-img img').remove();
    });
    
    $(".coaches-wrap .expertWrap .box").each(function(index) {
		var imageUrl = $(this).find('.after-img img').attr('src');
        $(this).find('.after-img').css("background-image", "url("+imageUrl+")");
        $(this).find('.after-img img').remove();
    });
    
    $(".transformation-wrap .box .image-box").each(function(index) {
		var imageUrl = $(this).find('.before-img img').attr('src');
        $(this).find('.before-img').css("background-image", "url("+imageUrl+")");
        $(this).find('.before-img img').remove();
    });
    
    $(".transformation-wrap .box .image-box").each(function(index) {
		var imageUrl = $(this).find('.after-img img').attr('src');
        $(this).find('.after-img').css("background-image", "url("+imageUrl+")");
        $(this).find('.after-img img').remove();
    });
    
    
    var maxHeight = 0;
	$(".transformation-wrap .row:nth-child(2)").each(function(){
	if ($(this).height() > maxHeight) { maxHeight = $(this).height(); }
	});
	$(".transformation-wrap .row:nth-child(2) .box").height(maxHeight); 
	var maxHeight = 0;
	$(".transformation-wrap .row:nth-child(3)").each(function(){
	if ($(this).height() > maxHeight) { maxHeight = $(this).height(); }
	});
	$(".transformation-wrap .row:nth-child(3) .box").height(maxHeight); 
	var maxHeight = 0;
	$(".transformation-wrap .row:nth-child(4)").each(function(){
	if ($(this).height() > maxHeight) { maxHeight = $(this).height(); }
	});
	$(".transformation-wrap .row:nth-child(4) .box").height(maxHeight); 
	var maxHeight = 0;
	$(".transformation-wrap .row:nth-child(5)").each(function(){
	if ($(this).height() > maxHeight) { maxHeight = $(this).height(); }
	});
	$(".transformation-wrap .row:nth-child(5) .box").height(maxHeight); 
	var maxHeight = 0;
	$(".transformation-wrap .row:nth-child(6)").each(function(){
	if ($(this).height() > maxHeight) { maxHeight = $(this).height(); }
	});
	$(".transformation-wrap .row:nth-child(6) .box").height(maxHeight); 
	var maxHeight = 0;
	$(".transformation-wrap .row:nth-child(7)").each(function(){
	if ($(this).height() > maxHeight) { maxHeight = $(this).height(); }
	});
	$(".transformation-wrap .row:nth-child(7) .box").height(maxHeight); 
	var maxHeight = 0;
	$(".transformation-wrap .row:nth-child(8)").each(function(){
	if ($(this).height() > maxHeight) { maxHeight = $(this).height(); }
	});
	$(".transformation-wrap .row:nth-child(8) .box").height(maxHeight); 
	var maxHeight = 0;
	$(".transformation-wrap .row:nth-child(9)").each(function(){
	if ($(this).height() > maxHeight) { maxHeight = $(this).height(); }
	});
	$(".transformation-wrap .row:nth-child(9) .box").height(maxHeight); 
	var maxHeight = 0;
	$(".transformation-wrap .row:nth-child(10)").each(function(){
	if ($(this).height() > maxHeight) { maxHeight = $(this).height(); }
	});
	$(".transformation-wrap .row:nth-child(10) .box").height(maxHeight); 
	var maxHeight = 0;
	$(".transformation-wrap .row:nth-child(11)").each(function(){
	if ($(this).height() > maxHeight) { maxHeight = $(this).height(); }
	});
	$(".transformation-wrap .row:nth-child(11) .box").height(maxHeight); 
	var maxHeight = 0;
	$(".transformation-wrap .row:nth-child(12)").each(function(){
	if ($(this).height() > maxHeight) { maxHeight = $(this).height(); }
	});
	$(".transformation-wrap .row:nth-child(12) .box").height(maxHeight); 
	
	
	
	var maxHeight = 0;
	$(".details-Box .same-height").each(function(){
	if ($(this).height() > maxHeight) { maxHeight = $(this).height(); }
	});
	$(".details-Box .same-height").height(maxHeight);
	
	
	
	var maxHeight = 0;
	$(".difference-wrap .text-box").each(function(){
	if ($(this).height() > maxHeight) { maxHeight = $(this).height(); }
	});
	$(".difference-wrap .text-box").height(maxHeight);
	
	
	
	var maxHeight = 0;
	$(".coaches-wrap .expertWrap .box, .coaches-wrap .expertWrap .box2").each(function(){
	if ($(this).height() > maxHeight) { maxHeight = $(this).height(); }
	});
	$(".coaches-wrap .expertWrap .box, .coaches-wrap .expertWrap .box2").height(maxHeight);
	
	var maxHeight = 240;
	$(".coaches-wrap .expertWrap .text-box .text .head-title, .coaches-wrap .expertWrap .text-box .text .btn-box").each(function(){
	if ($(this).height() > maxHeight) { maxHeight = $(this).height(); }
	});
	$(".coaches-wrap .expertWrap .text-box .text .head-title, .coaches-wrap .expertWrap .text-box .text .btn-box").height(maxHeight);
    
    
    
    
    
    var owl = $('.gallery-slider');
    owl.owlCarousel({
        loop:true,
        autoplay:true,
        autoplayHoverPause:true,
        autoplayTimeout:10000,
        responsive: {
        0:{
            margin:10,
            items:2
        },
        768:{
            margin:16,
            items:3
        },
        993:{
            margin:16,
            items:4
        }
      }
    })
    
    var duration = 300;
	$({to:0}).animate({to:1}, duration, function() {
        $(".gallery-slider .owl-item").each(function(index) {
			var imageUrl = $(this).find('.item img').attr('src');
            $(this).find('.item').css("background-image", "url("+imageUrl+")");
            $(this).find('.item img').remove();
        });
	});
    
    
}) 