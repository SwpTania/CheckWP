$('.selectpicker').selectpicker({
    style: 'btn-info',
    size: 4,
    dropupAuto: false
});
// Owl Slider Home
$('.keyCarousel').owlCarousel({
    loop: false,
    margin: 0,
    nav: true,
    items: 1
});

// Add open class on body
$('.mobile-toggles').click(function () {
    $('body').toggleClass('open');
});

// Remove open class on body

// Mobile toggle
$('.mobile-toggles').click(function () {
    $('header .navMain ul').slideToggle();
});

jQuery('.parallax-window').parallax({
    bleed: 100
});

// On scroll add remove

$(window).scroll(function () {
    if ($(this).scrollTop() > 30) {
        $('header').addClass("sticky");
    } else {
        $('header').removeClass("sticky");
    }
});


jQuery(function () {

    jQuery(window).scroll(function () {
        if (jQuery(window).scrollTop() == jQuery(document).height() - jQuery(window).height()) {
             if (jQuery('body').hasClass('page-template-tpl-bloglisting')) {
                blogPageLoadMore();
             } else if (jQuery('body').hasClass('post-type-archive-transformations')) {
                transfomationLoadMore();                
             }
        }
    });

});

function blogPageLoadMore() {
    var obj = jQuery('.transformationsLoadMore');
    var page_no = obj.data('page');
    jQuery.ajax({
        type: "GET",
        url: ajaxUrl,
        dataType: 'JSON',
        data: {
            action: 'blogs_listing_function',
            page: page_no
        },
        success: function (response) {
            if (response.result.length > 0) {
                var html = '';
                jQuery.each(response.result, function (index, item) {
                    html += getBlogsHtml(item);
                });
                jQuery('.ourList').append(html);
                obj.data('page', response.page);
            }
        }
    });
}

function transfomationLoadMore() {
    var obj = jQuery('.transformationsLoadMore');
    var page_no = obj.data('page');
    jQuery.ajax({
        type: "GET",
        url: ajaxUrl,
        dataType: 'JSON',
        data: {
            action: 'transformations',
            page: page_no
        },
        success: function (response) {
            if (response.result.length > 0) {
                var html = '';
                jQuery.each(response.result, function (index, item) {
                    html += getTransformationHtml(item);
                });
                jQuery('.ourList').append(html);
                obj.data('page', response.page);
            }
        }
    });
}

function getTransformationHtml(data) {
    var html = '';

    html += '<div class="ourlists">';
    html += '  <div class="listImg">';
    html += '      <img src="' + data.image + '" alt="' + data.title + '" />';
    html += '  </div>';
    html += '  <div class="listCnt">';
    html += '      <h4>' + data.title + '</h4>';
    html += '      <span class="mystTag">my story</span>';
    html += '      <p>' + data.content + '</p>';
    html += '  </div>';
    html += '</div>';

    return html;
}

function getBlogsHtml(data) {
    var html = '';
    
    html += '<div class="ourlists">';
    html += '  <div class="listImg">';
    html += '      <img src="' + data.image + '" alt="' + data.title + '" />';
    html += '  </div>';
    html += '  <div class="listCnt">';
    html += '      <h4>' + data.title + '</h4>';
    html += '      <p>' + data.content + '</p>';
    html += '  </div>';
    html += '</div>';

    return html;
}



jQuery('.Home_slide .owl-carousel').owlCarousel({
    loop:true,
    margin:0,
	autoplay:true,
	animateOut: 'fadeOut',
    autoplayTimeout:4000,
	autoplayHoverPause:true,
    nav:true,
    responsive:{
        0:{
            items:1
        },
		
		 400:{
			items:3
		},
		
        600:{
            items:3
        },
        1000:{
            items:4
        }
    }
})
