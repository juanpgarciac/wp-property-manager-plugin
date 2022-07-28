
jQuery(document).on( 'ready', function($){
    $ = jQuery;
	$('.categorychecklist').on( 'click', 'input[type="checkbox"]', function(){
		if ( ! $(this).is( ':checked' ) ) return;

		$(this).closest( 'ul.children' )
				.parentsUntil( '.categorychecklist', 'li' )
				.children( 'label' )
				.children( 'input[type="checkbox"]' )
				.prop( 'checked', true );
	});
});