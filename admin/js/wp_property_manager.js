
jQuery(document).on( 'ready', function($){
    $ = jQuery;
	$('#taxonomy-property-cpt-location .categorychecklist').on( 'click', 'input[type="checkbox"]', function(){
		$('#taxonomy-property-cpt-location .categorychecklist').find( 'input[type="checkbox"]' ).not($(this)).prop('checked',false)
		if ( ! $(this).is( ':checked' ) ) return;
		$(this).closest( 'ul.children' )
				.parentsUntil( '.categorychecklist', 'li' )
				.children( 'label' )
				.children( 'input[type="checkbox"]' )
				.prop( 'checked', true );
	});
});