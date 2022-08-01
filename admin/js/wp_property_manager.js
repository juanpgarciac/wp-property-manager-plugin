
jQuery(document).on( 'ready', function($){
    $ = jQuery;
	//This script disable the user to select more than one location for the property 
	//Also when selecting a children location, the parents are selected as well.
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