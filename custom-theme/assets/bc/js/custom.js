$(document).ready(function () {

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

    // On scroll add remove

    $(window).scroll(function () {
        if ($(this).scrollTop() > 50) {
            $('header').addClass("sticky");
        } else {
            $('header').removeClass("sticky");
        }
    });
});

