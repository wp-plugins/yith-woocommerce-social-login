jQuery(document).ready( function($){
    "use strict";

    $('.show-ywsl-box').on('click', function(e){
        e.preventDefault();
        $('.ywsl-box').slideToggle();
    });

});