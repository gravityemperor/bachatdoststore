jQuery(document).ready(function($) {
    
    /* Off canvas cart */
    $('body').on('added_to_cart', function() {
        $('.off-canvas-cart').addClass('show');
    });
    $('.wpop-shopping-cart.offcanvas').on('click', function(e) {
        e.preventDefault();
        $('.off-canvas-cart').addClass('show');

    });
    $('.off-canvas-close').on('click', function() {
        $('.off-canvas-cart').removeClass('show');
    });
});