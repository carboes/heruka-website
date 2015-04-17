( function( $ ) {
	if ( $.isFunction( $.fn.masonry ) ) {
		$( '#secondary .widget-area' ).masonry( 'destroy' );
	}
} )( jQuery );