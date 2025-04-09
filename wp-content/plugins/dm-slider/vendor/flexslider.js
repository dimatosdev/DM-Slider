jQuery(window).load(function() {
    jQuery('.flexslider').flexslider({
        animation: "slide",
        controlNav: SLIDER_OPTIONS.controlNav,
        directionNav: false,
        smoothHeight: true,
        touch: true
    });
});