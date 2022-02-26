( function( $ ) {
	
	// Make sure you run this code under Elementor.
	$( window ).on( 'elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/infobox.default', function( $scope, $ ) {
			console.log( $scope );
			// $scope.find('.infobox').hide();
		} );
	} );
	
    // Popup Video
    $('.pixer-popup-video, .pixer-addon-popup-video').magnificPopup({
        disableOn: 700,
        type: 'iframe',
        mainClass: 'mfp-fade',
        removalDelay: 160,
        preloader: false,
        fixedContentPos: false
    });

    // testimonials slide
    $('.awesome-addones-testimonials').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        speed: 500,
    });



} )( jQuery );
